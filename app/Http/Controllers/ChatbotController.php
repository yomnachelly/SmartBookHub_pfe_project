<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ChatbotController extends Controller
{
    private string $fastApiUrl = 'http://127.0.0.1:8001';

    /**
     * Called at login/register to fetch and store a FastAPI JWT in the session.
     */
    public static function storeFastApiToken(string $email, string $plainPassword, $session): void
    {
        try {
            $response = Http::timeout(10)->post('http://127.0.0.1:8001/auth/token', [
                'email'    => $email,
                'password' => $plainPassword,
            ]);

            if ($response->successful()) {
                $data  = $response->json();
                $token = $data['access_token'] ?? null;

                if (!$token) {
                    Log::error('[Chatbot] storeFastApiToken: no access_token in response', $data);
                    return;
                }

                // Decode JWT payload to get expiry
                $parts = explode('.', $token);
                $payloadB64 = $parts[1] ?? '';
                $payload = json_decode(
                    base64_decode(str_pad($payloadB64, strlen($payloadB64) + (4 - strlen($payloadB64) % 4) % 4, '=')),
                    true
                );
                $exp = $payload['exp'] ?? now()->addMinutes(55)->timestamp;

                $session->put('fastapi_token', $token);
                $session->put('fastapi_token_exp', $exp);
                $session->save(); // force session write immediately

                Log::info('[Chatbot] FastAPI token stored for ' . $email . ' (expires: ' . $exp . ')');
            } else {
                Log::error('[Chatbot] storeFastApiToken failed', [
                    'status' => $response->status(),
                    'body'   => $response->body(),
                ]);
            }
        } catch (\Exception $e) {
            Log::error('[Chatbot] storeFastApiToken exception: ' . $e->getMessage());
        }
    }

    /**
     * Retrieve token from session, refreshing if expired.
     */
    private function getToken(Request $request): ?string
    {
        $token = $request->session()->get('fastapi_token');
        $exp   = $request->session()->get('fastapi_token_exp', 0);

        if ($token && now()->timestamp < ($exp - 300)) {
            return $token;
        }

        Log::warning('[Chatbot] getToken: token missing or expired', [
            'has_token' => !empty($token),
            'exp'       => $exp,
            'now'       => now()->timestamp,
        ]);

        return null;
    }

    /**
     * POST /chatbot/ask
     */
    public function ask(Request $request)
    {
        $request->validate(['prompt' => 'required|string|max:2000']);

        try {
            $token = $this->getToken($request);

            if (!$token) {
                return response()->json([
                    'answer' => 'Session expirée, veuillez vous reconnecter.',
                    'error'  => 'token_missing',
                ], 401);
            }

            $aiResponse = Http::withToken($token)
                ->timeout(60)
                ->post("{$this->fastApiUrl}/ask", [
                    'prompt' => $request->input('prompt'),
                ]);

            if ($aiResponse->successful()) {
                return response()->json([
                    'answer' => $aiResponse->json()['answer'] ?? 'Pas de réponse IA',
                ]);
            }

            // Token expired on FastAPI side (401)
            if ($aiResponse->status() === 401) {
                $request->session()->forget(['fastapi_token', 'fastapi_token_exp']);
                return response()->json([
                    'answer' => 'Session expirée, veuillez vous reconnecter.',
                    'error'  => 'token_expired',
                ], 401);
            }

            Log::error('[Chatbot] /ask failed', [
                'status' => $aiResponse->status(),
                'body'   => $aiResponse->body(),
            ]);

            return response()->json([
                'answer' => 'Erreur IA (' . $aiResponse->status() . ')',
            ], 502);

        } catch (\Exception $e) {
            Log::error('[Chatbot] ask exception: ' . $e->getMessage());
            return response()->json([
                'answer' => 'Service IA indisponible.',
            ], 500);
        }
    }
}
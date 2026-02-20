<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatbotController extends Controller
{
    public function ask(Request $request)
    {
        // Validation
        $request->validate([
            'prompt' => 'required|string'
        ]);

        try {
            // Appel au service FastAPI
            $response = Http::post('http://127.0.0.1:8001/ask', [
                'prompt' => $request->prompt,
                'role' => 'client'
            ]);

            if ($response->successful()) {
                return response()->json([
                    'answer' => $response->json()['answer'] ?? 'Pas de réponse IA'  // Changé 'reply' en 'answer'
                ]);
            } else {
                return response()->json([
                    'answer' => 'Erreur de communication avec l\'IA'  // Changé 'reply' en 'answer'
                ], 500);
            }

        } catch (\Exception $e) {
            return response()->json([
                'answer' => 'Service IA indisponible'  // Changé 'reply' en 'answer'
            ], 500);
        }
    }
}
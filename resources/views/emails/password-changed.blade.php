<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Changement de mot de passe</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 30px 20px;
            text-align: center;
            color: #ffffff;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        .content {
            padding: 40px 30px;
        }
        .greeting {
            font-size: 18px;
            color: #333333;
            margin-bottom: 20px;
        }
        .message {
            background-color: #f8f9fa;
            border-left: 4px solid #667eea;
            padding: 20px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .message p {
            margin: 0 0 10px 0;
        }
        .info-box {
            background-color: #e7f3ff;
            border: 1px solid #b3d9ff;
            border-radius: 4px;
            padding: 15px;
            margin: 20px 0;
        }
        .info-box p {
            margin: 5px 0;
            font-size: 14px;
        }
        .warning {
            background-color: #fff3cd;
            border: 1px solid #ffc107;
            border-radius: 4px;
            padding: 15px;
            margin: 20px 0;
        }
        .warning p {
            margin: 5px 0;
            color: #856404;
            font-size: 14px;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 20px 30px;
            text-align: center;
            font-size: 12px;
            color: #6c757d;
            border-top: 1px solid #dee2e6;
        }
        .button {
            display: inline-block;
            padding: 12px 30px;
            background-color: #667eea;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
            font-weight: 600;
        }
        .button:hover {
            background-color: #5568d3;
        }
        strong {
            color: #667eea;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🔒 Changement de mot de passe</h1>
        </div>
        
        <div class="content">
            <p class="greeting">Bonjour <strong>{{ $user->name }}</strong>,</p>
            
            <div class="message">
                <p>Nous vous confirmons que votre mot de passe a été modifié avec succès.</p>
            </div>
            
            <div class="info-box">
                <p><strong>Détails du changement :</strong></p>
                <p>📅 Date : {{ $changedAt->format('d/m/Y') }}</p>
                <p>🕐 Heure : {{ $changedAt->format('H:i:s') }}</p>
                <p>👤 Compte : {{ $user->email }}</p>
                <p>🏷️ Rôle : {{ ucfirst($user->role ?? 'client') }}</p>
            </div>
            
            <div class="warning">
                <p><strong>⚠️ Vous n'êtes pas à l'origine de ce changement ?</strong></p>
                <p>Si vous n'avez pas demandé ce changement de mot de passe, veuillez contacter immédiatement notre équipe de support pour sécuriser votre compte.</p>
            </div>
            
            <p style="margin-top: 30px;">
                Pour votre sécurité, nous vous recommandons de :
            </p>
            <ul style="color: #666666;">
                <li>Utiliser un mot de passe unique et fort</li>
                <li>Ne jamais partager votre mot de passe</li>
                <li>Vous déconnecter après chaque session</li>
                <li>Vérifier régulièrement l'activité de votre compte</li>
            </ul>
            
            <p style="margin-top: 30px; color: #666666;">
                Merci de votre confiance,<br>
                <strong>L'équipe de support</strong>
            </p>
        </div>
        
        <div class="footer">
            <p>Cet email a été envoyé automatiquement, merci de ne pas y répondre.</p>
            <p>&copy; {{ date('Y') }} Votre Application. Tous droits réservés.</p>
        </div>
    </div>
</body>
</html>
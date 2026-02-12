<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vos identifiants Smart Book Hub</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: linear-gradient(135deg, #01B3BB 0%, #4ECFD7 100%);
            color: white;
            padding: 40px 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: bold;
        }
        .header p {
            margin: 10px 0 0;
            font-size: 16px;
            opacity: 0.9;
        }
        .content {
            padding: 40px 30px;
        }
        .greeting {
            font-size: 18px;
            color: #01B3BB;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .message {
            font-size: 15px;
            line-height: 1.8;
            color: #555;
            margin-bottom: 30px;
        }
        .credentials-box {
            background-color: #f8f9fa;
            border-left: 4px solid #01B3BB;
            padding: 20px;
            margin: 30px 0;
            border-radius: 5px;
        }
        .credentials-box h3 {
            margin: 0 0 15px;
            color: #01B3BB;
            font-size: 16px;
        }
        .credential-item {
            margin: 15px 0;
            padding: 15px;
            background-color: white;
            border-radius: 5px;
            border: 1px solid #e0e0e0;
        }
        .credential-label {
            font-size: 12px;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }
        .credential-value {
            font-size: 16px;
            font-weight: bold;
            color: #333;
            font-family: 'Courier New', monospace;
        }
        .login-button {
            display: inline-block;
            background-color: #01B3BB;
            color: white;
            text-decoration: none;
            padding: 15px 40px;
            border-radius: 8px;
            font-weight: bold;
            margin: 20px 0;
            text-align: center;
        }
        .login-button:hover {
            background-color: #008D94;
        }
        .security-notice {
            background-color: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin: 30px 0;
            border-radius: 5px;
        }
        .security-notice h4 {
            margin: 0 0 10px;
            color: #856404;
            font-size: 14px;
        }
        .security-notice p {
            margin: 0;
            font-size: 13px;
            color: #856404;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            color: #888;
            font-size: 12px;
        }
        .footer p {
            margin: 5px 0;
        }
        .divider {
            height: 1px;
            background-color: #e0e0e0;
            margin: 30px 0;
        }
        ul {
            padding-left: 20px;
        }
        ul li {
            margin: 8px 0;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>🎉 Bienvenue chez Smart Book Hub !</h1>
            <p>Votre compte employé a été créé avec succès</p>
        </div>

        <div class="content">
            <div class="greeting">
                Bonjour {{ $employee->name }},
            </div>

            <div class="message">
                <p>Nous sommes ravis de vous accueillir dans l'équipe Smart Book Hub !</p>
                <p>Votre compte employé a été créé par l'administrateur. Vous trouverez ci-dessous vos identifiants de connexion pour accéder à votre tableau de bord employé.</p>
            </div>

            <!-- credentials -->
            <div class="credentials-box">
                <h3>🔐 Vos identifiants de connexion</h3>
                
                <div class="credential-item">
                    <div class="credential-label">Adresse Email</div>
                    <div class="credential-value">{{ $employee->email }}</div>
                </div>

                <div class="credential-item">
                    <div class="credential-label">Mot de passe</div>
                    <div class="credential-value">{{ $plainPassword }}</div>
                </div>
            </div>

            <!-- login Button -->
            <div style="text-align: center;">
                <a href="{{ url('/login') }}" class="login-button">
                    Se connecter maintenant
                </a>
            </div>

            <div class="divider"></div>

            <div class="security-notice">
                <h4>⚠️ Important - Sécurité de votre compte</h4>
                <p><strong>Pour votre sécurité, veuillez modifier votre mot de passe lors de votre première connexion.</strong></p>
            </div>

            <div class="message">
                <h3 style="color: #01B3BB; font-size: 16px; margin-bottom: 15px;">Ce que vous pouvez faire avec votre compte :</h3>
                <ul>
                    <li>Gérer les commandes des clients</li>
                    <li>Consulter et modifier les informations des clients</li>
                    <li>Valider ou annuler des commandes</li>
                    <li>Accéder aux statistiques et rapports</li>
                    <li>Gérer l'inventaire des livres</li>
                </ul>
            </div>

            <div class="divider"></div>

            <div class="message" style="font-size: 13px; color: #888;">
                <p><strong>Besoin d'aide ?</strong></p>
                <p>Si vous avez des questions ou rencontrez des difficultés pour vous connecter, n'hésitez pas à contacter l'administrateur.</p>
            </div>
        </div>

        <!-- footer -->
        <div class="footer">
            <p><strong>Smart Book Hub</strong></p>
            <p>Plateforme de gestion de librairie en ligne</p>
            <p style="margin-top: 15px; font-size: 11px;">
                Cet email contient des informations confidentielles. Si vous n'êtes pas le destinataire prévu, veuillez le supprimer immédiatement.
            </p>
        </div>
    </div>
</body>
</html>
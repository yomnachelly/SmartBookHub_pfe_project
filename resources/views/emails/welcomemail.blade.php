<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue chez Smart Book Hub</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .wrapper {
            max-width: 600px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, #01B3BB, #4ECFD7);
            padding: 44px 40px;
            text-align: center;
        }
        .header h1 {
            color: #ffffff;
            margin: 0;
            font-size: 28px;
            font-weight: bold;
        }
        .header p {
            color: rgba(255,255,255,0.9);
            margin: 10px 0 0;
            font-size: 15px;
        }
        .body {
            padding: 40px 40px 32px;
            color: #333333;
        }
        .body p {
            line-height: 1.8;
            margin: 0 0 16px;
            font-size: 15px;
        }
        .greeting {
            font-size: 18px;
            color: #01B3BB;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .highlight-box {
            background: #f0fafb;
            border: 1px solid #01B3BB;
            border-radius: 10px;
            padding: 24px 28px;
            margin: 28px 0;
        }
        .highlight-box h3 {
            color: #01B3BB;
            margin: 0 0 16px;
            font-size: 16px;
        }
        .feature-item {
            display: flex;
            align-items: flex-start;
            margin: 10px 0;
            font-size: 14px;
            color: #555;
        }
        .feature-item span.icon {
            margin-right: 10px;
            font-size: 16px;
        }
        .divider {
            border: none;
            border-top: 1px solid #e8e8e8;
            margin: 28px 0;
        }
        .btn-wrap {
            text-align: center;
            margin: 28px 0;
        }
        .btn {
            display: inline-block;
            background: #01B3BB;
            color: #ffffff !important;
            text-decoration: none;
            font-weight: bold;
            font-size: 16px;
            padding: 14px 40px;
            border-radius: 10px;
        }
        .info-box {
            background: #fff8e1;
            border-left: 4px solid #FFC62A;
            border-radius: 6px;
            padding: 14px 18px;
            margin-top: 24px;
            font-size: 14px;
            color: #7a5c00;
        }
        .footer {
            background: #f9f9f9;
            padding: 22px 40px;
            text-align: center;
            font-size: 12px;
            color: #aaa;
            border-top: 1px solid #eeeeee;
        }
    </style>
</head>
<body>
<div class="wrapper">

    <div class="header">
        <h1>🎉 Bienvenue chez Smart Book Hub !</h1>
        <p>Votre compte a été créé avec succès</p>
    </div>

    <div class="body">

        <p class="greeting">Bonjour {{ $user->name }},</p>

        <p>
            Nous sommes ravis de vous accueillir dans la communauté <strong>Smart Book Hub</strong> !
            Votre compte est prêt et vous pouvez dès maintenant explorer notre catalogue et passer vos premières commandes.
        </p>

        <div class="highlight-box">
            <h3>📚 Ce que vous pouvez faire dès maintenant :</h3>
            <div class="feature-item"><span class="icon">🔍</span> Parcourir notre large catalogue de livres</div>
            <div class="feature-item"><span class="icon">🛒</span> Ajouter des livres à votre panier et commander en quelques clics</div>
            <div class="feature-item"><span class="icon">📦</span> Suivre vos commandes en temps réel</div>
            <div class="feature-item"><span class="icon">🧾</span> Accéder à l'historique de vos achats et factures</div>
            <div class="feature-item"><span class="icon">👤</span> Gérer votre profil et vos préférences</div>
        </div>

        <div class="btn-wrap">
            <a href="{{ url('/') }}" class="btn">
                Commencer à explorer
            </a>
        </div>

        <hr class="divider">

        <p style="font-size: 14px; color: #666;">
            Votre adresse e-mail enregistrée : <strong>{{ $user->email }}</strong><br>
            Gardez vos identifiants en lieu sûr et ne les partagez avec personne.
        </p>

        <div class="info-box">
            Si vous n'avez pas créé ce compte, ignorez cet e-mail ou contactez notre support immédiatement.
        </div>

    </div>

    <div class="footer">
        &copy; {{ date('Y') }} Smart Book Hub. Tous droits réservés.<br>
        Cet e-mail a été envoyé automatiquement — merci de ne pas y répondre.
    </div>

</div>
</body>
</html>
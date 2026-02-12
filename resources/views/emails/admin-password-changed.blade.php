<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialisation de mot de passe</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; }
        .wrapper { max-width: 600px; margin: 40px auto; background: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
        .header { background: linear-gradient(135deg, #01B3BB, #4ECFD7); padding: 36px 40px; text-align: center; }
        .header h1 { color: #ffffff; margin: 0; font-size: 24px; }
        .header p  { color: rgba(255,255,255,0.85); margin: 8px 0 0; font-size: 14px; }
        .body { padding: 36px 40px; color: #333333; }
        .body p  { line-height: 1.7; margin: 0 0 16px; }
        .credentials-box {
            background: #f0fafb;
            border: 1px solid #01B3BB;
            border-radius: 10px;
            padding: 24px 28px;
            margin: 24px 0;
        }
        .credentials-box .label { font-size: 12px; color: #888; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px; }
        .credentials-box .value { font-size: 16px; font-weight: bold; color: #01B3BB; word-break: break-all; }
        .credentials-box hr { border: none; border-top: 1px solid #d0eef0; margin: 14px 0; }
        .warning-box {
            background: #fff8e1;
            border-left: 4px solid #FFC62A;
            border-radius: 6px;
            padding: 14px 18px;
            margin-top: 24px;
            font-size: 14px;
            color: #7a5c00;
        }
        .footer { background: #f9f9f9; padding: 20px 40px; text-align: center; font-size: 12px; color: #aaa; border-top: 1px solid #eeeeee; }
    </style>
</head>
<body>
<div class="wrapper">

    <div class="header">
        <h1>🔑 Réinitialisation de mot de passe</h1>
        <p>Smart Book Hub — Notification de sécurité</p>
    </div>

    <div class="body">
        <p>Bonjour <strong>{{ $user->name }}</strong>,</p>
        <p>
            Un administrateur a réinitialisé votre mot de passe le
            <strong>{{ $changedAt->format('d/m/Y') }}</strong> à <strong>{{ $changedAt->format('H:i') }}</strong>.
        </p>
        <p>Voici vos nouveaux identifiants de connexion :</p>

        <div class="credentials-box">
            <div class="label">Adresse e-mail</div>
            <div class="value">{{ $user->email }}</div>
            <hr>
            <div class="label">Nouveau mot de passe</div>
            <div class="value">{{ $plainPassword }}</div>
        </div>

        <p>
            Connectez-vous avec ce mot de passe, puis changez-le immédiatement depuis les paramètres de votre profil.
        </p>

        <div class="warning-box">
            ⚠️ <strong>Important :</strong> Si vous n'avez pas demandé cette modification, contactez immédiatement votre administrateur.
        </div>
    </div>

    <div class="footer">
        &copy; {{ date('Y') }} Smart Book Hub. Tous droits réservés.<br>
        Cet e-mail a été envoyé automatiquement — merci de ne pas y répondre.
    </div>

</div>
</body>
</html>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialisation de mot de passe</title>
    <style>
        body  { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; }
        .wrap { max-width: 600px; margin: 40px auto; background: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.08); }
        .hdr  { background: linear-gradient(135deg, #01B3BB, #4ECFD7); padding: 36px 40px; text-align: center; }
        .hdr h1 { color: #fff; margin: 0; font-size: 24px; }
        .hdr p  { color: rgba(255,255,255,0.85); margin: 8px 0 0; font-size: 14px; }
        .body { padding: 36px 40px; color: #333; }
        .body p { line-height: 1.7; margin: 0 0 16px; }
        .btn-wrap { text-align: center; margin: 28px 0; }
        .btn  {
            display: inline-block;
            background: #01B3BB;
            color: #ffffff !important;
            text-decoration: none;
            font-weight: bold;
            font-size: 16px;
            padding: 14px 36px;
            border-radius: 10px;
        }
        .fallback { background: #f0fafb; border: 1px solid #c8eced; border-radius: 8px; padding: 14px 18px; margin-top: 24px; word-break: break-all; font-size: 13px; color: #444; }
        .warning  { background: #fff8e1; border-left: 4px solid #FFC62A; border-radius: 6px; padding: 12px 16px; margin-top: 20px; font-size: 13px; color: #7a5c00; }
        .footer   { background: #f9f9f9; padding: 20px 40px; text-align: center; font-size: 12px; color: #aaa; border-top: 1px solid #eee; }
    </style>
</head>
<body>
<div class="wrap">

    <div class="hdr">
        <h1>🔒 Réinitialisation du mot de passe</h1>
        <p>Smart Book Hub — Sécurité du compte</p>
    </div>

    <div class="body">
        <p>Bonjour,</p>
        <p>
            Vous avez demandé la réinitialisation du mot de passe de votre compte
            <strong>Smart Book Hub</strong>. Cliquez sur le bouton ci-dessous pour choisir un nouveau mot de passe.
        </p>

        <div class="btn-wrap">
            <a href="{{ $actionUrl }}" class="btn">
                Réinitialiser mon mot de passe
            </a>
        </div>

        <p>Ce lien est valide pendant <strong>{{ $count }} minutes</strong>.</p>
        <p>Si vous n'avez pas demandé cette réinitialisation, vous pouvez ignorer cet e-mail en toute sécurité — votre mot de passe ne sera pas modifié.</p>

        <div class="fallback">
            <strong>Lien de secours :</strong><br>
            Si le bouton ne fonctionne pas, copiez et collez ce lien dans votre navigateur :<br>
            <a href="{{ $actionUrl }}" style="color:#01B3BB;">{{ $actionUrl }}</a>
        </div>

        <div class="warning">
            ⚠️ Ne partagez jamais ce lien. Il est personnel et à usage unique.
        </div>
    </div>

    <div class="footer">
        &copy; {{ date('Y') }} Smart Book Hub. Tous droits réservés.<br>
        Cet e-mail a été envoyé automatiquement — merci de ne pas y répondre.
    </div>

</div>
</body>
</html>
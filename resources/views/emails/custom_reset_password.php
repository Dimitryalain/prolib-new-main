<?php
// Générez le lien avec le token
$resetLink = route('password.reset', ['token' => $token]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialisation de mot de passe - Prolib</title>
</head>
<body>
    <div style="font-family: Arial, sans-serif;">
        <h2 style="color: #007bff;">Réinitialisation de mot de passe - Prolib</h2>
        <p>Bonjour,</p>
        <p>Vous avez demandé la réinitialisation de votre mot de passe sur Prolib. Cliquez sur le lien ci-dessous pour réinitialiser votre mot de passe :</p>
        <!-- Utilisez le lien généré dynamiquement -->
        <p><a href="<?php echo $resetLink; ?>" style="background-color: #00B98E; color: #ffffff; padding: 10px 20px; text-decoration: none; border-radius: 5px;">Réinitialiser votre mot de passe</a></p>
        <p>Si vous n'avez pas demandé cette réinitialisation, vous pouvez ignorer cet email.</p>
        <p>Merci,</p>
        <p>L'équipe Prolib</p>
    </div>
</body>
</html>

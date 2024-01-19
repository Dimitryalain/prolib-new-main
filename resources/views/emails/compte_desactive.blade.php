<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre compte Profession Libérale a été désactivé</title>
    <style>
        body {
            font-family: 'Helvetica', sans-serif;
            background-color: #f8f8f8;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #e74c3c;
            margin-bottom: 20px;
        }
        p {
            line-height: 1.6;
            margin-bottom: 15px;
        }
        .contact-info {
            background-color: #f2f2f2;
            padding: 10px;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Votre compte Profession Libérale a été désactivé</h1>
        <p>Bonjour {{ $professionnel->nom }} {{ $professionnel->prenom }},</p>
        <p>Nous vous informons que votre compte Profession Libérale a été désactivé.</p>
        <p>Si vous avez des questions ou si vous pensez qu'il s'agit d'une erreur, n'hésitez pas à nous contacter.</p>
        <p>Merci pour votre compréhension.</p>

        <!-- Informations de contact de l'administrateur -->
        <div class="contact-info">
            <p>Vous pouvez contacter l'administrateur pour plus d'informations :</p>
            
            <p>Numéro de téléphone: 05 85 00 03 00</p>
        </div>
    </div>
</body>
</html>

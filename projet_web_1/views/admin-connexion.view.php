<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration (Connexion)</title>
    <link rel="stylesheet" href="public/css/style-admin.css">
    <link rel="stylesheet" href="https://use.typekit.net/vwr3mna.css">
    <link rel="stylesheet" href="https://use.typekit.net/vwr3mna.css">
</head>
<body>

    <div class="header-admin">
        <a href="index"><img src="public/images/home.png" alt=""></a>
        <a href="deconnexion">Déconnexion</a>
    </div>

    <div class="container-connexion">

        <img src="public/images/logo.png" alt="">

        <h1>Connexion à la page d'administration (Pub G4)</h1>

        <form action="connexion-submit" method="POST" class="form">
            <div class="courriel">
                <label for="courriel">Courriel</label>
                <input type="email" name="courriel" id="courriel">
            </div>
            <div class="mot_de_passe">
                <label for="mot_de_passe">Mot de passe</label>
                <input type="password" name="mot_de_passe" id="mot_de_passe">
            </div>
            <input class="btn" type="submit" value="Connexion">
        </form>

        <?php if(isset($_GET["erreur"])) : ?>
            <p>Les informations de connexion sont incorrectes</p>
        <?php endif; ?>

    </div>

</body>
</html>
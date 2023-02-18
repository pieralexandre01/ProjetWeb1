<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un utilisateur</title>
    <link rel="stylesheet" href="public/css/style-admin.css">
    <link rel="stylesheet" href="https://use.typekit.net/vwr3mna.css">
    <link rel="stylesheet" href="https://use.typekit.net/vwr3mna.css">
</head>
<body>

    <div class="header-admin">
        <a href="index"><img src="public/images/home.png" alt=""></a>
        <div class="retour-et-deconnexion-container">
            <a class="deconnexion" href="gestion-utilisateurs">Retour</a>
            <a class="deconnexion" href="deconnexion">Déconnexion</a>
        </div>
    </div>

    <?php if(isset($_GET["succes"])) : ?>
        <p>L'utilisateur a été modifié!</p>
    <?php endif; ?>

    <?php if(isset($_GET["erreur"])) : ?>
        <?php if($_GET["erreur"] == 1) : ?>
            <p>Vous devez remplir tous les champs!</p>
        <?php endif; ?>
        <p>Il y a eu une erreur dans l'insertion de vos informations!</p>
    <?php endif; ?>

    <div class="ajout-utilisateur-container">
        <h2>Modifier un utilisateur</h2>

        <form action="modification-utilisateur-submit" method="POST">
            <div>
                <div class="nom">
                    <label for="nom">Nom</label>
                    <input type="text" name="nom" id="nom" value="<?= $utilisateur["nom"] ?>">
                </div>
                <div class="courriel">
                    <label for="courriel">Courriel</label>
                    <input type="email" name="courriel" id="courriel" value="<?= $utilisateur["courriel"] ?>">
                </div>
                <div class="mot_de_passe">
                    <label for="mot_de_passe">Mot de passe</label>
                    <input type="password" name="mot_de_passe" id="mot_de_passe">
                </div>
            </div>

            <input type="hidden" name="id" value="<?= $utilisateur["id"] ?>">
            <input type="submit" value="Modifier">
        </form>
    </div>
</body>
</html>
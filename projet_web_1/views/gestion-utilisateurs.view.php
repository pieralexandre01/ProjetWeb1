<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier ou supprimer les utilisateurs</title>
    <link rel="stylesheet" href="public/css/style-admin.css">
    <link rel="stylesheet" href="https://use.typekit.net/vwr3mna.css">
    <link rel="stylesheet" href="https://use.typekit.net/vwr3mna.css">
</head>
<body>

    <div class="header-admin">
        <a href="index"><img src="public/images/home.png" alt=""></a>
        <div class="retour-et-deconnexion-container">
            <a class="deconnexion" href="zone-admin">Retour</a>
            <a class="deconnexion" href="deconnexion">Déconnexion</a>
        </div>
    </div>

    <?php if(isset($_GET["succes"])) : ?>
        <p>L'utilisateur a été modifié!</p>
    <?php endif; ?>

    <?php if(isset($_GET["supprime"])) : ?>
        <p>L'utilisateur a été supprimé!</p>
    <?php endif; ?>
    
    <div class="gestion-utilisateurs-container">

        <h2>Modifier ou supprimer les utilisateurs</h2>

        <?php foreach($utilisateurs as $utilisateur) : ?>
            <div>
                    <div class="nom">
                        <p><?= $utilisateur["nom"] ?></p>
                    </div>
                    <div class="options">
                        <a class="modifier" href="modification-utilisateur?id=<?=$utilisateur["id"]?>">Modifier</a>
                        <a class="supprimer" href="suppression-utilisateur?id=<?= $utilisateur["id"] ?>">Supprimer</a>
                    </div> 
            </div>           
        <?php endforeach; ?>

    </div>

</body>
</html>
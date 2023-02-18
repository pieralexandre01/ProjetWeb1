<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier ou supprimer les plats</title>
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
    
    <div class="container-gestion-menu">

        <h2>Modifier ou supprimer les plats</h2>

        <?php if(isset($_GET["succes"])) : ?>
            <p>Le plat a été modifié!</p>
        <?php endif; ?>

        <?php if(isset($_GET["supprime"])) : ?>
            <p>Le plat a été supprimé!</p>
        <?php endif; ?>

        <?php foreach($categories as $categorie) : ?>
            <div class="container-plat">
                <h2><?= $categorie["nom"] ?></h2>
                <?php foreach($plats->toutParCategorie($categorie["id"]) as $plat) : ?>
                    
                    <div class="nom-et-prix-container">
                        <p><?= $plat["nom"] ?></p>
                        <p><?= $plat["prix"] ?>$</p>
                    </div>
                    <div class="description-plat">
                        <p><?= $plat["description"] ?></p>
                    </div>

                    <div class="options">
                        <a class="modifier" href="modification-plat?id=<?= $plat["id"] ?>">Modifier</a>
                        <a class="supprimer" href="suppression-plat?id=<?= $plat["id"] ?>">Supprimer</a>
                    </div>
                    
                <?php endforeach; ?>    
            </div>           
        <?php endforeach; ?>

    </div>

</body>
</html>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier ou supprimer les catégories</title>
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

    <div class="gestion-categories-container">

        <h2>Modifier ou supprimer les catégories</h2>
    
        <?php if(isset($_GET["succes"])) : ?>
            <p>La catégorie a été modifiée!</p>
        <?php endif; ?>
    
        <?php if(isset($_GET["supprime"])) : ?>
            <p>La catégorie a été supprimée!</p>
        <?php endif; ?>
    
        <?php foreach($categories as $categorie) : ?>
            <div class="nom-et-options">
                <div>
                    <p><?= $categorie["nom"] ?></p>
                </div>
                <div>
                    <a class="modifier" href="modification-categorie?id=<?= $categorie["id"] ?>">Modifier</a>
                    <a class="supprimer" href="suppression-categorie?id=<?= $categorie["id"] ?>">Supprimer</a>
                </div> 
            </div>           
        <?php endforeach; ?>

    </div>

</body>
</html>
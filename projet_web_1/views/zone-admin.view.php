<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zone administrative</title>
    <link rel="stylesheet" href="public/css/style-admin.css">
    <link rel="stylesheet" href="https://use.typekit.net/vwr3mna.css">
    <link rel="stylesheet" href="https://use.typekit.net/vwr3mna.css">
</head>
<body>

    <div class="header-admin">
        <a href="index"><img src="public/images/home.png" alt=""></a>
        <a class="deconnexion" href="deconnexion">Déconnexion</a>
    </div>

    <div class="msg-operation">
        <?php if(isset($_GET["succes"])) : ?>
            <?php if($_GET["succes"] == 1) : ?>
                <p>Le plat a été ajouté!</p>
            <?php endif; ?>
            <?php if($_GET["succes"] == 2) : ?>
                <p>La catégorie a été ajoutée!</p>
            <?php endif; ?>
            <?php if($_GET["succes"] == 3) : ?>
                <p>L'utilisateur a été ajouté!</p>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <?php if(isset($_SESSION["utilisateur_id"]) && $_SESSION["utilisateur_id"] == 1) : ?>

        <div class="options-admin">
            <h3>Bonjour M. Leclient,</h3>
            <div class="options-admin-select">
                <a href="ajout-plat">Ajouter un plat</a>
                <a href="gestion-menu">Modifier / supprimer un plat</a>
                <a href="ajout-categorie">Ajouter une catégorie</a>
                <a href="gestion-categories">Modifier / supprimer une catégorie</a>
                <a href="ajout-utilisateur">Ajouter un utilisateur</a>
                <a href="gestion-utilisateurs">Modifier / supprimer utilisateur</a>
            </div>
        </div>

    <?php endif; ?>

    <?php if(isset($_SESSION["utilisateur_id"]) && $_SESSION["utilisateur_id"] != 1) : ?>

        <div class="options-admin2">
            <h3>Bonjour <?= $_SESSION["utilisateur_nom"] ?>,</h3>
            <div class="options-admin-select">
                <a href="ajout-plat">Ajouter un plat</a>
                <a href="gestion-menu">Modifier / supprimer un plat</a>
                <a href="ajout-categorie">Ajouter une catégorie</a>
                <a href="gestion-categories">Modifier / supprimer une catégorie</a>
            </div>
        </div>

    <?php endif; ?>

</body>
</html>
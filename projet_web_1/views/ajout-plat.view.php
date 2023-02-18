<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un plat</title>
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

    <?php if(isset($_GET["erreur"])) : ?>
        <?php if($_GET["erreur"] == 1) : ?>
            <p>Vous devez remplir tous les champs!</p>
        <?php endif; ?>
        <?php if($_GET["erreur"] == 2) : ?>
            <p>Il y a eu une erreur dans l'insertion de vos informations!</p>
        <?php endif; ?>
    <?php endif; ?>
    
    <div class="form-ajout-plat-container">
        
        <h2>Ajouter un plat</h2>

        <form action="ajout-plat-submit" method="POST">
            <div class="infrormations-entree-par-utilisateur">  
                <div class="zone-gauche">
                    <div>
                        <div class="label-plus-input">
                            <label for="nom">Nom</label>
                            <input type="text" name="nom" id="nom">
                        </div>
                        <div class="label-plus-input">
                            <label for="prix">Prix</label>
                            <input type="number" step="0.01" min="0" name="prix" id="prix">
                        </div>
                        <div class="label-plus-input">
                            <label for="categorie">Catégorie</label>
                            <select name="categorie" id="categorie">
                                <?php foreach($categories as $categorie) : ?>
                                    <option value="<?= $categorie["id"] ?>"><?= $categorie["nom"] ?></option>
                                <?php endforeach; ?> 
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="zone-droite">
                    <div class="label-plus-input">
                        <label for="description">Description</label>
                        <textarea class="textarea" name="description" id="description"></textarea>
                    </div>
                </div>    
            </div>        
            
            <div class="btn-container">
                <input class="btn" type="submit" value="Ajouter">
            </div>
        </form>

    </div>
</body>
</html>
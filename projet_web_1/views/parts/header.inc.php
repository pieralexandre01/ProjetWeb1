<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="https://use.typekit.net/vwr3mna.css">
    <link rel="stylesheet" href="https://use.typekit.net/vwr3mna.css">
</head>
<body>
    <div class="header">
        <nav>
            <div class="logo">
                <?php if(isset($_SESSION["utilisateur_id"])){ ?>
                    <a href="zone-admin"><img class="maison" src="public/images/home.png" alt=""></a>
                 <?php } ?>   
                <img class="logo-img" src="public/images/logo.png" alt="">
            </div>
            <div class="pages">
                <a href="index">Accueil</a>
                <a href="menu">Menu</a>
                <a href="apropos">À propos</a>
                <a href="contact">Contact</a>
            </div>
            
            <div class="reseaux-sociaux">
                <img src="public/images/facebook.png" alt="">
                <img src="public/images/twitter.png" alt="">
                <img src="public/images/instagram.png" alt="">
            </div>
        </nav>
    </div>
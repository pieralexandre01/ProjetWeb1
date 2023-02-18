<?php include("views/parts/header.inc.php"); ?>

<div class="entete">
    <div class="card01">
        <h1>BIENVENUE <br> CHEZ PUB G4</h1>
        <div class="p-entete">
            <p>« À date, personne a vomi »</p>
            <p>- Gaston Leclient,</p>
            <p>propriétaire</p>
        </div>
        <a href="menu">Consultez notre menu</a>
    </div>
</div>

<div class="main-apropos-ensavoirplus">
    <div class="apropos-ensavoirplus">
        <div class="img-apropos-ensavoirplus"></div>
        <div class="description-apropos-ensavoirplus">
            <h2>À propos</h2>
            <p>Depuis maintenant 20 ans, Pub G4 vous fait découvrir des plats de tout genre avec une touche raffinée que vous n’avez goutée nulle part ailleurs. Venez entre amis, pour une soirée romantique ou pour rencontrer des gens.</p>
            <p class="p2">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nisi scelerisque eu ultrices vitae. Odio tempor orci dapibus ultrices in iaculis nunc sed. Auctor urna nunc id cursus metus aliquam eleifend mi...</p>
            <a href="apropos">En savoir plus</a>
        </div>
    </div>
</div>

<div class="banniere-promo">
    <div class="pitch">
        <img src="public/images/sport-et-competition.png" alt="">
        <p>Des aliments frais</p>
    </div>
    <div class="pitch">
        <img src="public/images/kindness.png" alt="">
        <p>Un service chaleureux</p>
    </div>
    <div class="pitch">
        <img src="public/images/piggy-bank.png" alt="">
        <p>Des prix compétitifs</p>
    </div>
</div>

<div class="section-commentaires-container">
    <div class="section-commentaires">
        <div class="commentaires-container">
            <div class="h1">
                <h1>Expérience client</h1>
                <img src="public/images/satisfaction.png" alt="">
            </div>
            <div id="app" class="contenu">
                <div class="commentaire_texte">
                    <p>« {{ commentaire_infos.texte }} »</p>
                </div>
                <div class="commentaire_note">
                    <p>Note : {{ commentaire_infos.note }} / 5 étoiles</p>
                </div>
            </div>
            <a href="menu">Consultez notre Menu</a>
        </div>
        <div class="img-section-commentaires"></div>
    </div>
</div>

<script src="public/js/main.js" type="module"></script>
<?php include("views/parts/footer.inc.php"); ?>
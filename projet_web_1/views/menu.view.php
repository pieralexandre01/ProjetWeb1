<?php include("views/parts/header.inc.php"); ?>

<div class="entete-menu">
    <div class="card02">
        <h1>NOTRE MENU</h1>
    </div>
</div>

<?php foreach($categories as $categorie) : ?>
    <div class="section">
        <div class="banniere-categorie">
            <h2><?= $categorie["nom"] ?></h2>
        </div>
        <div class="section-categorie">
            <div class="section-categorie-container-interne">
                <?php if($categorie["ordre"] % 2 == 0){ ?>
                    <div class="img-categorie">
                        <img src="<?= $categorie["image"] ?>" alt="">
                    </div>
                <?php } ?>
                <div class="plats-categorie">
                    <?php foreach($plats->toutParCategorie($categorie["id"]) as $plat) : ?>
                        <div class="nom-et-prix-container">
                            <p><?= $plat["nom"] ?></p>
                            <p><?= $plat["prix"] ?>$</p>
                        </div>
                        <div class="description-plat">
                            <p><?= $plat["description"] ?></p>
                        </div>
                    <?php endforeach; ?> 
                </div>
                <?php if($categorie["ordre"] % 2 != 0){ ?>
                    <div class="img-categorie">
                        <img src="<?= $categorie["image"] ?>" alt="">
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>           
<?php endforeach; ?>

<?php include("views/parts/footer.inc.php"); ?>

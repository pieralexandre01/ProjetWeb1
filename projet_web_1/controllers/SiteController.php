<?php

require_once("bases/Controller.php");
require_once("bases/Model.php");
require_once("models/Inscriptions.php");
require_once("models/Plats.php");
require_once("models/Utilisateurs.php");
require_once("models/Categories.php");
require_once("utils/Upload.php");

class SiteController extends Controller {

    /**
     * Affiche l'index, donc la page d'Accueil du site
     *
     * @return void
     */
    public function index(){

        include("views/index.view.php");
    }

    /**
     * Traite les informations d'ajout d'une inscription à l'infolettre
     *
     * @return void
     */
    public function ajoutInscriptionSubmit(){

        if (empty($_POST)) {
            header("location:index");
            exit();
        }

        if (empty($_POST["courriel"])) {
            header("location:index?erreur=1");
            exit();
        }

        $courriel = $_POST["courriel"];

        $modele_inscriptions = new Inscriptions();
        $succes = $modele_inscriptions->creer($courriel);

        if( ! $succes){
            header("location:index?erreur=1");
            exit();
        }

        header("location:index?succes=1");
        exit();

    }

    /**
     * Affiche la page Menu sur le site
     *
     * @return void
     */
    public function afficherMenu(){

        $modele_plats = new Plats();
        $plats = $modele_plats;

        $modele_categories = new Categories();
        $categories = $modele_categories->toutEnOrdre();

        include("views/menu.view.php");
    }

    /**
     * Affiche la page À propos sur le site
     *
     * @return void
     */
    public function afficherAPropos(){

        include("views/apropos.view.php");

    }

    /**
     * Affiche la page Contact sur le site
     *
     * @return void
     */
    public function afficherContact(){

        include("views/contact.view.php");

    }

    /**
     * Affiche le formulaire de connexion pour les administrateurs
     *
     * @return void
     */
    public function afficherAdminConnexion(){

        include("views/admin-connexion.view.php");

    }

    /**
     * Affiche la page d'administration
     *
     * @return void
     */
    public function afficherZoneAdmin(){

        if(empty($_SESSION["utilisateur_id"])) {
            header("location:admin-connexion");
            exit();

        }

        include("views/zone-admin.view.php");
    }

    /**
     * Connecte l'utilisateur si ses informations sont valides
     *
     * @return void
     */
    public function connexionSubmit(){

        if(empty($_POST)){
            header("location:admin-connexion");
            exit();
        }

        if(empty($_POST["courriel"]) || empty($_POST["mot_de_passe"])){
            header("location:admin-connexion?erreur=1");
            exit();
        }

        $modele_utilisateurs = new Utilisateurs();

        if( ! $modele_utilisateurs->verifier($_POST["courriel"], $_POST["mot_de_passe"])){
            header("location:admin-connexion?erreur=1");
            exit();
        }

        header("location:zone-admin");
        exit();
    }

    /**
     * Déconnecte l'utilisateur présentement déconnecter en vidant la session
     *
     * @return void
     */
    public function deconnexion(){

        unset($_SESSION["utilisateur_id"]);
        unset($_SESSION["utilisateur_nom"]);

        header("location:admin-connexion");

    }

    /**
     * Affiche le formulaire afin d'ajouter un plat
     *
     * @return void
     */
    public function afficherFomulaireAjoutPlat(){

        if(empty($_SESSION["utilisateur_id"])) {
            header("location:admin-connexion");
            exit();
        }

        $modele_categories = new Categories();
        $categories = $modele_categories->toutEnOrdre();

        include("views/ajout-plat.view.php");

    }
    
    /**
     * Soumet le plat à la BDD et redirige vers la zone admin
     *
     * @return void
     */
    public function ajoutPlatSubmit(){
        
        if(empty($_SESSION["utilisateur_id"])) {
            header("location:admin-connexion");
            exit();
        }

        if (empty($_POST["nom"]) || empty($_POST["description"]) || empty($_POST["prix"]) || empty($_POST["categorie"])) {
            header("location:ajout-plat?erreur=1");
            exit();
        }

        $prix = str_replace(",",".",$_POST["prix"]);
        $prix = floatval($prix);

        if($prix == 0){
            header("location:ajout-plat?erreur=1");
            exit();
        };

        $nom = $_POST["nom"];
        $description = $_POST["description"];
        $categorie_id = $_POST["categorie"];

        $modele_plats = new Plats();
        $succes = $modele_plats->creer($nom, $description, $prix, $categorie_id);

        if( ! $succes){
            header("location:ajout-plat?erreur=2");
            exit();
        }

        header("location:zone-admin?succes=1");
        exit();
    }

    /**
     * Affiche la page de gestion du Menu pour modifier et supprimer des plats
     *
     * @return void
     */
    public function afficherGestionMenu(){

        if(empty($_SESSION["utilisateur_id"])) {
            header("location:admin-connexion");
            exit();
        }

        $modele_plats = new Plats();
        $plats = $modele_plats;

        $modele_categories = new Categories();
        $categories = $modele_categories->toutEnOrdre();

        include("views/gestion-menu.view.php");

    }

    /**
     * Affiche le formulaire pour modifier un plat
     *
     * @return void
     */
    public function modifierPlat(){

        if(empty($_SESSION["utilisateur_id"])) {
            header("location:admin-connexion");
            exit();
        }

        $id = $_GET["id"];

        $modele_plats = new Plats();
        $plat = $modele_plats->parId($id);

        $modele_categories = new Categories();
        $categories = $modele_categories->toutEnOrdre();

        include("views/modification-plat.view.php");

    }

    /**
     * Soumet le formulaire pour modifier un plat à la BDD 
     *
     * @return void
     */
    public function modifierPlatSubmit(){

        if(empty($_SESSION["utilisateur_id"])) {
            header("location:admin-connexion");
            exit();
        }

        $id = $_POST["id"];

        if (empty($_POST)) {
            header("location:modification-plat?erreur=1&id=$id");
            exit();
        }

        if (empty($_POST["id"]) || empty($_POST["nom"]) || empty($_POST["description"]) || empty($_POST["prix"]) || empty($_POST["categorie"])) {
            header("location:modification-plat?erreur=1&id=$id");
            exit();
        }

        $prix = str_replace(",",".",$_POST["prix"]);
        $prix = floatval($prix);

        if($prix == 0){
            header("location:modification-plat?erreur=1");
            exit();
        };

        $nom = $_POST["nom"];
        $description = $_POST["description"];
        $categorie_id = $_POST["categorie"];

        $modele_plats = new Plats();
        $succes = $modele_plats->modifier($id, $nom, $description, $prix, $categorie_id);

        if( ! $succes){
            header("location:modification-plat?erreur=2&id=$id");
            exit();
        }

        header("location:gestion-menu?succes=1&id=$id");
        exit();

    }

    /**
     * Supprime un plat
     *
     * @return void
     */
    public function supprimerPlat(){

        if(empty($_SESSION["utilisateur_id"])) {
            header("location:admin-connexion");
            exit();
        }

        $id = $_GET["id"];

        $modele_plats = new Plats();
        $modele_plats->supprimer($id);

        header("location:gestion-menu?supprime=1");

    }

    /**
     * Affiche le formulaire permettant d'ajouter une catégorie
     *
     * @return void
     */
    public function afficherFormulaireAjoutCategorie(){

        if(empty($_SESSION["utilisateur_id"])) {
            header("location:admin-connexion");
            exit();
        }

        include("views/ajout-categorie.view.php");

    }

    /**
     * Soumet les informations afin de créer une catégorie
     *
     * @return void
     */
    public function ajoutCategorieSubmit(){

        if(empty($_SESSION["utilisateur_id"])) {
            header("location:admin-connexion");
            exit();
        }

        if (empty($_POST["nom"]) || empty($_POST["ordre"]) || empty($_FILES["image"])) {
            header("location:ajout-categorie?erreur=1");
            exit();
        }

        $nom = $_POST["nom"];
        $ordre = $_POST["ordre"];
        $image = $_FILES["image"];

        $upload = new Upload("image");

        $image = $upload->estValide() ?
            $upload->placerDans("public/uploads") :
            null;

        $modele_categories = new Categories();
        $succes = $modele_categories->creer($nom, $ordre, $image);

        if( ! $succes){
            header("location:ajout-categorie?erreur=2");
            exit();
        }

        header("location:zone-admin?succes=2");
        exit();
    }

    /**
     * Affiche la page de gestion des catégories qui permet de modifier ou supprimer un catégorie
     *
     * @return void
     */
    public function afficherGestionCategories(){

        if(empty($_SESSION["utilisateur_id"])) {
            header("location:admin-connexion");
            exit();
        }

        $modele_categories = new Categories();
        $categories = $modele_categories->tout();

        include("views/gestion-categories.view.php");

    }

    /**
     * Afficher le formulaire qui permet de modifier une catégorie
     *
     * @return void
     */
    public function modifierCategorie(){

        if(empty($_SESSION["utilisateur_id"])) {
            header("location:admin-connexion");
            exit();
        }

        $id = $_GET["id"];

        $modele_categories = new Categories();
        $categorie = $modele_categories->parId($id);

        include("views/modification-categorie.view.php");

    }

    /**
     * Soumet le formulaire de modification d'une catégorie à la BDD
     *
     * @return void
     */
    public function modifierCategorieSubmit(){

        if(empty($_SESSION["utilisateur_id"])) {
            header("location:admin-connexion");
            exit();
        }

        $id = $_POST["id"];

        if (empty($_POST["nom"]) || empty($_POST["ordre"]) || empty($_FILES["image"])) {
            header("location:modification-categorie?erreur=1&id=$id");
            exit();
        }

        $nom = $_POST["nom"];
        $ordre = $_POST["ordre"];
        $image = $_FILES["image"];

        $upload = new Upload("image");

        $image = $upload->estValide() ?
            $upload->placerDans("public/uploads") :
            null;

        $modele_categories = new Categories();
        $succes = $modele_categories->modifier($id, $nom, $ordre, $image);

        if( ! $succes){
            header("location:modification-categorie?erreur=2&id=$id");
            exit();
        }

        header("location:gestion-categories?succes=1&id=$id");
        exit();
        
    }

    /**
     * Supprime une catégorie dans la BDD
     *
     * @return void
     */
    public function supprimerCategorie(){

        if(empty($_SESSION["utilisateur_id"])) {
            header("location:admin-connexion");
            exit();
        }

        $id = $_GET["id"];

        $modele_categories = new Categories();
        $modele_categories->supprimer($id);

        header("location:gestion-categories?supprime=1");

    }

    /**
     * Affiche le formulaire qui permet d'ajouter un utilisateur
     *
     * @return void
     */
    public function afficherFormulaireAjoutUtilisateur(){

        if(empty($_SESSION["utilisateur_id"])) {
            header("location:admin-connexion");
            exit();
        }

        if($_SESSION["utilisateur_id"] != 1) {
            header("location:zone-admin");
            exit();
        }

        include("views/ajout-utilisateur.view.php");

    }

    /**
     * Soummet les informations afin de créer un utilisateur
     *
     * @return void
     */
    public function ajoutUtilisateurSubmit(){

        if(empty($_SESSION["utilisateur_id"])) {
            header("location:admin-connexion");
            exit();
        }

        if($_SESSION["utilisateur_id"] != 1) {
            header("location:zone-admin");
            exit();
        }

        if(empty($_POST["nom"]) || empty($_POST["courriel"]) || empty($_POST["mot_de_passe"])){
            header("location:ajout-utilisateur?erreur=1");
            exit();
        }

        $nom = $_POST["nom"];
        $courriel = $_POST["courriel"];
        $mot_de_passe = $_POST["mot_de_passe"];

        $modele_utilisateurs = new Utilisateurs();

        $succes = $modele_utilisateurs->creer($nom, $courriel, $mot_de_passe);      
             
        if($succes){
            header("location:zone-admin?succes=3");
            exit();
        }

        header("location:ajout-utilisateur?erreur=2");
        exit();
         
    }

    /**
     * Affiche la page qui permet de faire la gestion des utilisateurs en modifiant ou supprimant celui sélectionné
     *
     * @return void
     */
    public function afficherGestionUtilisateurs(){

        if(empty($_SESSION["utilisateur_id"])) {
            header("location:admin-connexion");
            exit();
        }

        if($_SESSION["utilisateur_id"] != 1) {
            header("location:zone-admin");
            exit();
        }

        $modele_utilisateurs = new Utilisateurs();
        $utilisateurs = $modele_utilisateurs->tout();

        include("views/gestion-utilisateurs.view.php");

    }

    /**
     * Affiche le formulaire qui permet de modifier un utilisateur
     *
     * @return void
     */
    public function modifierUtilisateur(){

        if(empty($_SESSION["utilisateur_id"])) {
            header("location:admin-connexion");
            exit();
        }

        if($_SESSION["utilisateur_id"] != 1) {
            header("location:zone-admin");
            exit();
        }

        $id = $_GET["id"];

        $modele_utilisateurs = new Utilisateurs();
        $utilisateur = $modele_utilisateurs->parId($id);

        include("views/modification-utilisateur.view.php");

    }

    /**
     * Soumet la modification d'un utilisateur à la BDD et redirige vers la page de gestion des utilisateurs
     *
     * @return void
     */
    public function modifierUtilisateurSubmit(){

        if(empty($_SESSION["utilisateur_id"])) {
            header("location:admin-connexion");
            exit();
        }

        if($_SESSION["utilisateur_id"] != 1) {
            header("location:zone-admin");
            exit();
        }

        $id = $_POST["id"];

        if (empty($_POST)) {
            header("location:modification-utilisateur?erreur=1&id=$id");
            exit();
        }

        if (empty($_POST["id"]) || empty($_POST["nom"]) || empty($_POST["courriel"]) || empty($_POST["mot_de_passe"])) {
            header("location:modification-utilisateur?erreur=1&id=$id");
            exit();
        }

        $nom = $_POST["nom"];
        $courriel = $_POST["courriel"];
        $mot_de_passe = $_POST["mot_de_passe"];

        $modele_utilisateurs = new Utilisateurs();
        $succes = $modele_utilisateurs->modifier($id, $nom, $courriel, $mot_de_passe);

        if( ! $succes){
            header("location:modification-utilisateur?erreur=2&id=$id");
            exit();
        }

        header("location:gestion-utilisateurs?succes=1&id=$id");
        exit();

    }

    /**
     * Surpprime un utilisateur sélectionné
     *
     * @return void
     */
    public function supprimerUtilisateur(){

        if(empty($_SESSION["utilisateur_id"])) {
            header("location:admin-connexion");
            exit();
        }

        if($_SESSION["utilisateur_id"] != 1) {
            header("location:zone-admin");
            exit();
        }

        $id = $_GET["id"];

        $modele_utilisateurs = new Utilisateurs();
        $modele_utilisateurs->supprimer($id);

        header("location:gestion-utilisateurs?supprime=1");

    }

}
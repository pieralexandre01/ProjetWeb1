<?php

require_once("bases/Model.php");

class Utilisateurs extends Model {
    // Le modèle doit spécifier la table associée
    protected $table = "utilisateurs";
    
    /**
     * Vérifie si l'utilisateur existe et si le mot de passe fourni correspond aux données
     *
     * @param string $courriel
     * @param string $mot_de_passe  Mot de passe reçu du formulaire
     * 
     * @return bool Retourne false si l'utilisateur n'existe pas ou si le mot de passe est erroné
     */
    public function verifier($courriel, $mot_de_passe){
        
        $sql = "SELECT *
                FROM $this->table
                WHERE courriel = :courriel";

        $stmt = $this->pdo()->prepare($sql);

        $stmt->execute([
            ":courriel" => $courriel
        ]);

        $entree = $stmt->fetch();

        if(! $entree) {
            return false;
        }

        $mot_de_passe_ok = password_verify($mot_de_passe, $entree["mot_de_passe"]);
        
        if( ! $mot_de_passe_ok) {
            return false;
        }

        $_SESSION["utilisateur_id"] = $entree["id"];
        $_SESSION["utilisateur_nom"] = $entree["nom"];
        
        return true;

    }

    /**
     * Ajoute une nouveau plat
     *
     * @param string $nom
     * @param string $courriel
     * @param string $mot_de_passe
     * 
     * @return bool
     */
    public function creer($nom, $courriel, $mot_de_passe){

        $sql = "INSERT INTO $this->table (nom, courriel, mot_de_passe) 
                VALUES (:nom, :courriel, :mot_de_passe)";

        $stmt = $this->pdo()->prepare($sql);

        return $stmt->execute([
            ":nom" => $nom,
            ":courriel" => $courriel,
            ":mot_de_passe" => password_hash($mot_de_passe, PASSWORD_DEFAULT),
        ]);
    }

    /**
     * Modifie les informations d'un utilisateur
     *
     * @param int $id
     * @param string $nom
     * @param string $courriel
     * @param string $mot_de_passe
     * @return void
     */
    public function modifier($id, $nom, $courriel, $mot_de_passe){

        $sql = "UPDATE $this->table 
                SET nom = :nom, courriel = :courriel, mot_de_passe = :mot_de_passe
                WHERE $this->table.id = :id";

        $stmt = $this->pdo()->prepare($sql);

        return $stmt->execute([
            ":id" => $id,
            ":nom" => $nom,
            ":courriel" => $courriel,
            ":mot_de_passe" => password_hash($mot_de_passe, PASSWORD_DEFAULT),
        ]);
    }
}
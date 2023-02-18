<?php

require_once("bases/Model.php");

class Plats extends Model {
    // Le modèle doit spécifier la table associée
    protected $table = "plats";
    
    /**
     * Récupère tout en fonction de l'id de la catégorie qui lui est fourni en paramètre
     *
     * @param int $categorie_id
     * @return void
     */
    public function toutParCategorie($categorie_id){

        $sql = "SELECT $this->table.*
                FROM $this->table
                JOIN categories ON $this->table.categorie_id = categories.id
                WHERE $this->table.categorie_id = :categorie_id";
        
        $stmt = $this->pdo()->prepare($sql) ;
        $stmt->execute([
            ":categorie_id" => $categorie_id
        ]);
            
        return $stmt->fetchAll();
    }

    /**
     * Ajoute une nouveau plat
     *
     * @param string $titre
     * @param string $description
     * @param float $prix
     * @param int $categorie_id
     * 
     * @return bool
     */
    public function creer($nom, $description, $prix, $categorie_id){

        $sql = "INSERT INTO $this->table (nom, description, prix, categorie_id) 
                VALUES (:nom, :description, :prix, :categorie_id)";

        $stmt = $this->pdo()->prepare($sql);

        return $stmt->execute([
            ":nom" => $nom,
            ":description" => $description,
            ":prix" => $prix,
            ":categorie_id" => $categorie_id,
        ]);
    }

    /**
     * Modifie les informations d'un plat existant
     *
     * @param int $id
     * @param string $nom
     * @param string $description
     * @param float $prix
     * @param int $categorie_id
     * @return void
     */
    public function modifier($id, $nom, $description, $prix, $categorie_id){

        $sql = "UPDATE $this->table 
                SET nom = :nom, description = :description, prix = :prix, categorie_id = :categorie_id
                WHERE $this->table.id = :id";

        $stmt = $this->pdo()->prepare($sql);

        return $stmt->execute([
            ":id" => $id,
            ":nom" => $nom,
            ":description" => $description,
            ":prix" => $prix,
            ":categorie_id" => $categorie_id,
        ]);
    }

}
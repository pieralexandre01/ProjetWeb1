<?php

require_once("bases/Model.php");

class Categories extends Model {
    // Le modèle doit spécifier la table associée
    protected $table = "categories";
    
    /**
     * Retourne tous les résultats de la table associée au modèle
     *
     * @return array|false Tableau associatif ou false si erreur
     */
    public function toutEnOrdre(){
    
        $sql = "SELECT *
                FROM $this->table
                ORDER BY ordre ASC";


        // Préparation de la requête            
        $stmt = $this->pdo()->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll();
    }

    /**
     * Ajoute une nouvelle publication
     *
     * @param string $nom
     * @param int $ordre
     * @param string $image
     * 
     * @return bool
     */
    public function creer($nom, $ordre, $image){

        $sql = "INSERT INTO $this->table (nom, ordre, image) 
                VALUES (:nom, :ordre, :image)";

        $stmt = $this->pdo()->prepare($sql);

        return $stmt->execute([
            ":nom" => $nom,
            ":ordre" => $ordre,
            ":image" => $image,
        ]);
    }

    /**
     * Modifie les informations d'une catégorie sélectionnée
     *
     * @param int $id
     * @param string $nom
     * @param int $ordre
     * @param string $image
     * 
     * @return void
     */
    public function modifier($id, $nom, $ordre, $image){

        $sql = "UPDATE $this->table 
                SET nom = :nom, ordre = :ordre, image = :image
                WHERE $this->table.id = :id";

        $stmt = $this->pdo()->prepare($sql);

        return $stmt->execute([
            ":id" => $id,
            ":nom" => $nom,
            ":ordre" => $ordre,
            ":image" => $image,
        ]);
    }

}
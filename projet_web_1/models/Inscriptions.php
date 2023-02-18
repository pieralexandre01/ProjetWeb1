<?php

require_once("bases/Model.php");

class Inscriptions extends Model {
    // Le modèle doit spécifier la table associée
    protected $table = "inscriptions";
    
    /**
     * Crée une inscription à l'infolettre
     *
     * @param string $courriel
     * @return void
     */
    public function creer($courriel){

        $sql = "INSERT INTO $this->table (courriel) 
                VALUES (:courriel)";

        $stmt = $this->pdo()->prepare($sql);

        return $stmt->execute([
            ":courriel" => $courriel
        ]);
    }
}
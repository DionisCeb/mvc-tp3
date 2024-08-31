<?php
namespace App\Models;
use App\Models\DB\CRUD;

class Car extends CRUD{

    protected $table = "car";
    protected $primaryKey = "id";
    protected $fillable = ['type', 'make', 'model', 'color'];


     /**
     * Mettre à jour les données de la voiture
     *
     * @param int $car_id
     * @param array $data
     * @return bool
     */

     public function updateCar($car_id, $data) {
        $sql = "UPDATE car SET 
                type = :type, 
                make = :make, 
                model = :model, 
                color = :color 
                WHERE id = :car_id";
                
        $stmt = $this->prepare($sql);
        $stmt->bindValue(':type', $data['type']);
        $stmt->bindValue(':make', $data['make']);
        $stmt->bindValue(':model', $data['model']);
        $stmt->bindValue(':color', $data['color']);
        $stmt->bindValue(':car_id', $car_id, \PDO::PARAM_INT);
    
        return $stmt->execute();
    }
    
    /**
     * Récupérer la voiture par type/marque/modèle/couleur de filtres de base
     */
    public function findOneByFilters(array $filters):array
    {
        if (!$filters) {
            //si aucun filtre, aucune voiture à trouver
            return [];
        }
        // Commencer à construire la requête SQL
        $sql = "SELECT * FROM $this->table";
        // Créez les conditions de filtre
        $conditions = [];
        foreach ($filters as $key => $value) {
            $conditions[] = "$key = :$key";
        }        
        // Conditions de jointure avec AND
        $sql .= " WHERE " . implode(" AND ", $conditions);
        // Ajoutez LIMIT 1 pour récupérer uniquement le premier enregistrement
        $sql .= " LIMIT 1";
        
        // Préparez la déclaration
        $stmt = $this->prepare($sql);

        // Lier les valeurs
        foreach ($filters as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        
        // Exécuter la requête
        $stmt->execute();
        
        // Récupérer le premier résultat
        $result = $stmt->fetch();
        
        // Renvoyer le résultat (faux si aucun enregistrement n'est trouvé)
        return $result !== false ? $result : [];
    }

    public function findAll(): array {
        // Définir la requête SQL pour récupérer tous les enregistrements de la table car
        $sql = "SELECT * FROM $this->table";
        
        // Préparer l'instruction SQL
        $stmt = $this->prepare($sql);
        
        // Exécuter l'instruction
        $stmt->execute();
        
        // Récupérer tous les résultats sous forme de tableau associatif
        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        
        // Renvoyer les résultats
        return $results;
    }
    

    
}
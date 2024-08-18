<?php
namespace App\Models;
use App\Models\DB\CRUD;

class Car extends CRUD{

    protected $table = "car";
    protected $primaryKey = "id";
    protected $fillable = ['type', 'make', 'model', 'color'];


     /**
     * Update car data
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
     * Retieve car by base filters type/make/model/color
     */
    public function findOneByFilters(array $filters):array
    {
        if (!$filters) {
            //if no filters, no cars to be found
            return [];
        }
        // Start building the SQL query
        $sql = "SELECT * FROM $this->table";
        // Add WHERE clause and build the filter conditions
        $conditions = [];
        foreach ($filters as $key => $value) {
            $conditions[] = "$key = :$key";
        }        
        // Join conditions with AND
        $sql .= " WHERE " . implode(" AND ", $conditions);
        // Add LIMIT 1 to fetch only the first record
        $sql .= " LIMIT 1";
        
        // Prepare the statement
        $stmt = $this->prepare($sql);

        // Bind values
        foreach ($filters as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        
        // Execute the query
        $stmt->execute();
        
        // Fetch the first result
        $result = $stmt->fetch();
        
        // Return result (false if no record is found)
        return $result !== false ? $result : [];
    }
}
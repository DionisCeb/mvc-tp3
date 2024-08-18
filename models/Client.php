<?php
namespace App\Models;
use App\Models\DB\CRUD;

class Client extends CRUD{

    protected $table = "client";
    protected $primaryKey = "id";
    protected $fillable = ['name', 'surname', 'email', 'phone'];

    /**
     * Update client data
     *
     * @param int $client_id
     * @param array $data
     * @return bool
     */
    public function updateClient($client_id, $data) {
        $sql = "UPDATE client SET 
                name = :name, 
                surname = :surname, 
                email = :email, 
                phone = :phone 
                WHERE id = :client_id";
                
        $stmt = $this->prepare($sql);
        $stmt->bindValue(':name', $data['name']);
        $stmt->bindValue(':surname', $data['surname']);
        $stmt->bindValue(':email', $data['email']);
        $stmt->bindValue(':phone', $data['phone']);
        $stmt->bindValue(':client_id', $client_id, \PDO::PARAM_INT);

        return $stmt->execute();
    }

    /**
     * Retieve client by email
     */
    public function findByEmail(string $email) : array
    {
        $sql = "SELECT * FROM $this->table WHERE email = :email ";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(":email", $email);
        $stmt->execute();
        $count = $stmt->rowCount();
        if($count == 1){
            return $stmt->fetch();
        }
        return [];
    }

}
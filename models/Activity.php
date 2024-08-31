<?php
namespace App\Models;
use App\Models\DB\CRUD;

class Activity extends CRUD {
    protected $table = "activity";
    protected $primaryKey = "id";
    protected $fillable = ['username', 'ip_address', 'activity_date', 'page_visited'];

    public function getAllActivities() {
        $sql = "
            SELECT a.ip_address AS ip, 
                   a.activity_date AS date, 
                   a.username AS username, 
                   a.page_visited AS page
            FROM {$this->table} a
            ORDER BY a.activity_date DESC
        ";

        $stmt = $this->query($sql);
        return $stmt->fetchAll();
    }

    public function getStats() {
        $sql = "
            SELECT 
                DATE_FORMAT(a.activity_date, '%Y-%m-%d') AS date, 
                a.page_visited AS page, 
                COUNT(*) AS count
            FROM 
                {$this->table} a
            GROUP BY 
                DATE_FORMAT(a.activity_date, '%Y-%m-%d'), 
                a.page_visited
            ORDER BY 
                DATE_FORMAT(a.activity_date, '%Y-%m-%d') DESC
        ";

        $stmt = $this->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

   public function updateActivity(string $username, string $ip, string $page) {

        $sql = "INSERT INTO activity (username, ip_address, activity_date, page_visited)
        VALUES (:username, :ip_address, :activity_date, :page_visited)";

        // préparer la requête
        $stmt = $this->prepare($sql);
        //les paramètres de la requête
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':ip_address', $ip);
        $stmt->bindValue(':activity_date', \date('Y-m-d h:i:s'));
        $stmt->bindValue(':page_visited', $page);


        // Exécuter la requête
        $success = $stmt->execute();

        if ($success) {
        // Retourner l'identifiant de la réservation nouvellement créée
            return $this->lastInsertId();
        } else {
            return false;
        }

    }


}

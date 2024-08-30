<?php
namespace App\Models;
use App\Models\DB\CRUD;

class Activity extends CRUD {
    protected $table = "activity";
    protected $primaryKey = "id";
    protected $fillable = ['user_id', 'ip_address', 'activity_date', 'page_visited'];

    public function getAllActivities() {
        $sql = "
            SELECT a.ip_address AS ip, 
                   a.activity_date AS date, 
                   u.username AS username, 
                   a.page_visited AS page
            FROM {$this->table} a
            JOIN user u ON a.user_id = u.id
            ORDER BY a.activity_date DESC
        ";

        $stmt = $this->query($sql);
        return $stmt->fetchAll();
    }
}

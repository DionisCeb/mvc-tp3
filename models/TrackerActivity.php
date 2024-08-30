<?php
namespace App\Models;

class TrackerActivity {
    // Fetches activity log entries from the database
    public static function getAllActivities() {
        // Example: Replace with actual database logic
        return [
            ['ip' => '192.168.1.1', 'date' => '2024-08-30 14:35', 'username' => 'john_doe', 'page' => '/home'],
            ['ip' => '192.168.1.2', 'date' => '2024-08-30 14:37', 'username' => 'jane_smith', 'page' => '/about']
            // More data as needed
        ];
    }
}

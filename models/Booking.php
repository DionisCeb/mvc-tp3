<?php
namespace App\Models;
use App\Models\DB\CRUD;

class Booking extends CRUD{

    // Table associée au modèle
    protected $table = "booking";
    // Clé primaire de la table
    protected $primaryKey = "id";
     // Champs pour remplir lors de l'insertion
    protected $fillable = ['car_id', 'client_id', 'check_in_date', 'check_in_time', 'check_in_time', 'check_out_date', 'check_out_time', 'updated_at'];


    /**
     * Crée une nouvelle réservation dans la base de données
     * 
     * @param array $data Les données de réservation à insérer
     * @return mixed L'identifiant de la réservation nouvellement créée ou false en cas d'échec
     */
    public function store($data) {
        //la requête SQL d'insertion
        $sql = "INSERT INTO booking (car_id, client_id, check_in_date, check_in_time, check_out_date, check_out_time)
                VALUES (:car_id, :client_id, :check_in_date, :check_in_time, :check_out_date, :check_out_time)";
    
         // préparer la requête
        $stmt = $this->prepare($sql);
        //les paramètres de la requête
        $stmt->bindValue(':car_id', $data['car_id'], \PDO::PARAM_INT);
        $stmt->bindValue(':client_id', $data['client_id'], \PDO::PARAM_INT);
        $stmt->bindValue(':check_in_date', $data['check_in_date']);
        $stmt->bindValue(':check_in_time', $data['check_in_time']);
        $stmt->bindValue(':check_out_date', $data['check_out_date']);
        $stmt->bindValue(':check_out_time', $data['check_out_time']);
    
        // Exécuter la requête
        $success = $stmt->execute();
    
        if ($success) {
            // Retourner l'identifiant de la réservation nouvellement créée
            return $this->lastInsertId();
        } else {
            return false;
        }
    }
    


    /**
     * Récupère toutes les réservations avec les informations associées sur les clients et les voitures
     * 
     * @return array Liste des réservations avec les informations associées
     */

    public function findAll() {
        //la requête SQL pour obtenir toutes les réservations
        $sql = "SELECT b.id AS booking_id, c.id AS client_id, ca.id AS car_id, c.name AS client_name, c.surname AS client_surname, 
               c.email AS client_email, c.phone AS client_phone, 
               b.check_in_date, DATE_FORMAT(b.check_in_time, '%H:%i') AS check_in_time, b.check_out_date, DATE_FORMAT(b.check_out_time, '%H:%i') AS check_out_time, 
               ca.type AS car_type, ca.make AS car_make, ca.model AS car_model, ca.color AS car_color
        FROM booking b
        INNER JOIN client c ON b.client_id = c.id
        INNER JOIN car ca ON b.car_id = ca.id";
        // exécuter la requête
        $stmt = $this->query($sql);
        // récupère toutes les réservations
        $bookings = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $bookings;
    }

     /**
     * Récupère une réservation spécifique avec les informations associées sur le client et la voiture
     * 
     * @param int $booking_id L'identifiant de la réservation à récupérer
     * @return array Les informations de la réservation ou null si non trouvée
     */

    public function findOne(int $booking_id) {
        // la requête SQL pour obtenir une réservation spécifique
        $sql = "SELECT 
            b.id AS booking_id, 
            c.id AS client_id, 
            c.name AS client_name, 
            c.surname AS client_surname, 
            c.email AS client_email, 
            c.phone AS client_phone, 
            b.check_in_date, 
            b.check_in_time, 
            b.check_out_date, 
            b.check_out_time, 
            car.id AS car_id,  -- Add this line
            car.type AS car_type, 
            car.make AS car_make, 
            car.model AS car_model, 
            car.color AS car_color 
        FROM 
            booking b 
            INNER JOIN client c ON b.client_id = c.id 
            INNER JOIN car ON b.car_id = car.id 
        WHERE 
            b.id = :booking_id";

        // Prépare la requête
        $stmt = $this->prepare($sql);
        // Lier le paramètre de la requête
        $stmt->bindValue(':booking_id', $booking_id, \PDO::PARAM_INT);
        $stmt->execute();

        // Récupère les informations de la réservation
        $booking = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $booking;

    }

    /**
     * Récupère l'identifiant de la voiture associée à une réservation
     * 
     * @param int $booking_id L'identifiant de la réservation
     * @return int|null L'identifiant de la voiture ou null si non trouvé
     */

     public function getCarIdByBookingId($booking_id) {
        //la requête SQL pour obtenir l'identifiant de la voiture
        $sql = "SELECT car_id FROM booking WHERE id = :booking_id";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(':booking_id', $booking_id, \PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result['car_id'] ?? null;
    }


    /**
     * Récupère l'identifiant du client associé à une réservation
     * 
     * @param int $booking_id L'identifiant de la réservation
     * @return int|null L'identifiant du client ou null si non trouvé
     */
    public function getClientIdByBookingId($booking_id) {
        //la requête SQL pour obtenir l'identifiant du client
        $sql = "SELECT client_id FROM booking WHERE id = :booking_id";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(':booking_id', $booking_id, \PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result['client_id'] ?? null;
    }

}
<?php
namespace App\Controllers;

use App\Providers\View;
use App\Providers\Validator;
use App\Models\Booking;
use App\Models\Client;
use App\Models\Car;
use App\Providers\Auth;

class BookingController{


    /**
     * Fonction pour afficher le formulaire de création d'une réservation
     */
    public function create() {
        // Check if the user is logged in; redirect to /login if not
        if (!Auth::session()) {
            return; // Auth::session() already handles redirection
        }
    
        // Create an instance of the Car model to retrieve car data
        $car = new Car();
        $carData = $car->findAll(); // Assuming findAll() returns all car records
    
        // Create an instance of the Booking model to retrieve booking data (if needed)
        $booking = new Booking();
        $listBookings = $booking->findAll(); // Assuming findAll() returns all booking records
    
        // Render the booking creation view with the necessary scripts, car data, and booking data
        View::render('booking/create', [
            /* 'scripts' => ['select-options.js'], */
            'cars' => $carData, // Pass car data to the view
            'bookings' => $listBookings // Pass booking data to the view (if needed)
        ]);
    }

    /**
     * Fonction pour enregistrer les données d'une nouvelle réservation dans la base de données
     * @param array $data Les données de réservation à enregistrer
     * @return mixed La vue à rendre après l'enregistrement
     */

     public function store($data) {
        // Valider les données de la réservation
        $validator = new Validator();
        $validator->field('check_in_date', $data['check_in_date'])->required()->date();
        $validator->field('check_in_time', $data['check_in_time'])->required()->time();
        $validator->field('check_out_date', $data['check_out_date'])->required()->date();
        $validator->field('check_out_time', $data['check_out_time'])->required()->time();
    
        // Valider les données du client
        $validator->field('name', $data['name'])->required()->min(3)->max(45);
        $validator->field('surname', $data['surname'])->required()->min(3)->max(45);
        $validator->field('email', $data['email'])->required()->email()->max(45);
        $validator->field('phone', $data['phone'])->required()->max(20);
    
        // Valider les données de la voiture
        $validator->field('type', $data['type'])->required();
        $validator->field('make', $data['make'])->required();
        $validator->field('model', $data['model'])->required();
        $validator->field('color', $data['color'])->required();
    
        if ($validator->isSuccess()) {
            // Créer ou trouver les données du client
            $client = new Client();
            $clientData = $client->findByEmail($data['email']);
            if ($clientData) {
                $clientId = $clientData['id'];
            } else {
                // Insèrer les données du nouveau client
                $clientId = $client->insert([
                    'name' => $data['name'],
                    'surname' => $data['surname'],
                    'phone' => $data['phone'],
                    'email' => $data['email'],
                ]);
                if (!$clientId) {
                    return View::render('error/error', ['msg' => 'Le client n\'a pas pu être créé !']);
                }
            }
    
            // Créer ou trouver les données de la voiture
            $car = new Car();
            $carData = $car->findOneByFilters([
                'type' => $data['type'],
                'make' => $data['make'],
                'model' => $data['model'],
                'color' => $data['color'],
            ]);
            if ($carData) {
                $carId = $carData['id'];
            } else {
                // Insèrer les données de la nouvelle voiture
                $carId = $car->insert([
                    'type' => $data['type'],
                    'make' => $data['make'],
                    'model' => $data['model'],
                    'color' => $data['color'],
                ]);
                if (!$carId) {
                    return View::render('error/error', ['msg' => 'Car could not be created!']);
                }
            }
    
            // Insèrer les nouvelles données de réservation
            $booking = new Booking();
            $bookingId = $booking->store([
                'car_id' => $carId,
                'client_id' => $clientId,
                'check_in_date' => $data['check_in_date'],
                'check_in_time' => $data['check_in_time'],
                'check_out_date' => $data['check_out_date'],
                'check_out_time' => $data['check_out_time'],
            ]);
    
            if ($bookingId) {
                $privilegeId = $_SESSION['privilege_id'] ?? null;
                if ($privilegeId == 1 || $privilegeId == 2 || $privilegeId == 3) {
                    // Redirect to bookings page with all bookings
                    return View::redirect('bookings');
                } else {
                    // Redirect to bookings page with only the user's booking
                    return View::redirect('booking/show?id=' . $bookingId);
                }
            } else {
                // Afficher un message d'erreur si la réservation n'a pas pu être créée
                return View::render('booking/create', ['errors' => ["Error: Booking could not be created"], 'booking' => $data]);
            }
        } else {
            // Afficher les erreurs de validation
            $errors = $validator->getErrors();
            return View::render('booking/create', ['errors' => $errors, 'booking' => $data]);
        }
    }
    
    

    /**
     * Fonction pour afficher toutes les réservations de la base de données dans un tableau
     */

    public function list(){ 
        // Créer une instance du modèle Booking pour récupérer les données    
        $queryBuilder = new Booking();
        $listBookings = $queryBuilder->findAll();
        // Rend la vue de la liste des réservations
        View::render('booking/list', ['bookings' =>$listBookings]);
    }


    /**
     * Fonction pour afficher les détails d'une réservation spécifique
     * @param array $data Les données de la réservation à afficher
     * @return mixed La vue à rendre avec les détails de la réservation
     */
    public function show($data = []) {
        if(isset($_GET['id']) && $data['id']!=null){
            // Créer une instance du modèle Booking pour récupérer les données
            $queryBuilder = new Booking();
            $bookingData = $queryBuilder->findOne((int)$data['id']);

            if($bookingData){
                // Rend la vue avec les détails de la réservation
                return View::render('booking/details', ['booking'=>$bookingData]);
            } else {
                // Afficher une erreur si la réservation n'est pas trouvée
                return View::render('error/error');
            }       
        }else{
            // Affiche une erreur si l'identifiant de la réservation est manquant
            return View::render('error/error', ['msg'=>'Réservation non trouvée!']);
        }    
    }

    /**
     * Fonction pour afficher le formulaire d'édition d'une réservation spécifique
     * @param array $data Les données de la réservation à modifier
     * @return mixed La vue à rendre pour modifier la réservation
     */
    public function edit($data = []) {
        if(isset($_GET['id']) && $data['id']!=null){
            // Créer une instance du modèle Booking pour récupérer les données
            $queryBuilder = new Booking();
            $bookingData = $queryBuilder->findOne((int)$data['id']);

            if($bookingData){
                // Retourner la vue du formulaire d'édition avec les données de la réservation
                return View::render('booking/edit', ['booking'=>$bookingData]);
            } else {
                // Afficher une erreur si la réservation n'est pas trouvée
                return View::render('error/error');
            }       
        }else{
            //Affiche une erreur si l'identifiant de la réservation est manquant
            return View::render('error/error', ['msg'=>'Client not found!']);
        }    
    }


    /**
     * Fonction pour mettre à jour les données d'une réservation existante
     * @param array $data Les nouvelles données de la réservation
     * @param array $get_data Les données GET contenant l'identifiant de la réservation
     * @return mixed La vue à rendre après la mise à jour
     */
    public function update($data, $get_data) {
        if (isset($get_data['id']) && $get_data['id'] != null) {
            $id = $get_data['id'];
            // Créer une instance du modèle Validator pour valider les données
            $validator = new Validator();
            // Valider les données de la réservation
            $validator->field('check_in_date', $data['check_in_date'])->required()->date();
            $validator->field('check_in_time', $data['check_in_time'])->required()->time();
            $validator->field('check_out_date', $data['check_out_date'])->required()->date();
            $validator->field('check_out_time', $data['check_out_time'])->required()->time();
    
            // Valider les données du client
            $validator->field('name', $data['name'])->required()->min(3)->max(45);
            $validator->field('surname', $data['surname'])->required()->min(3)->max(45);
            $validator->field('email', $data['email'])->required()->email()->max(45);
            $validator->field('phone', $data['phone'])->required()->max(20);
    
            // Valider les données de la voiture
            $validator->field('type', $data['type'])->required();
            $validator->field('make', $data['make'])->required();
            $validator->field('model', $data['model'])->required();
            $validator->field('color', $data['color'])->required();
    
            
            if ($validator->isSuccess()) {
                // Mettre à jour les données du client ou les créer si elles n'existent pas (par email)
                $client = new Client();
                $clientData = $client->findByEmail($data['email']);
                if ($clientData) {
                    $clientId = $clientData['id'];

                    /**
                     * Si nous trouvons le client dans la base de données, 
                     * nous autoriserons toujours l'utilisateur à mettre à jour les données du client, 
                     * à l'exception de l'e-mail.
                     */
                    $updateClient = $client->update([
                        'name' => $data['name'],
                        'surname' => $data['surname'],
                        'phone' => $data['phone']
                    ], $clientId);
                    if (!$updateClient) {
                        // Retourner la page d'erreur
                        return View::render('error/error', ['msg' => 'Le client n\'a pas pu être mis à jour !']);
                    }
                } else {
                    // Créer un nouveau client si non trouvé
                    $clientId = $client->insert([
                        'name' => $data['name'],
                        'surname' => $data['surname'],
                        'phone' => $data['phone'],
                        'email' => $data['email'],
                    ]);
                    
                    if (!$clientId) {
                        return View::render('error', ['msg' => 'Client has not been created!']);
                    } 
                }
    
                // Créer ou mettre à jour les données de la voiture
                $car = new Car();
                $carData = $car->findOneByFilters([
                    'type' => $data['type'],
                    'make' => $data['make'],
                    'model' => $data['model'],
                    'color' => $data['color'],
                ]);
                if ($carData) {
                    $carId = $carData['id'];

                } else {
                    $carId = $car->insert([
                        'type' => $data['type'],
                        'make' => $data['make'],
                        'model' => $data['model'],
                        'color' => $data['color'],
                    ]);
                    
                    if (!$carId) {
                        return View::render('error', ['msg' => 'Car has not been created!']);
                    } 
                }
                // Mettre à jour les données de la réservation
                $booking = new Booking();
                $updated = $booking->update([
                    'car_id' => $carId,
                    'client_id' => $clientId,
                    'check_in_date' => $data['check_in_date'],
                    'check_in_time' => $data['check_in_time'],
                    'check_out_date' => $data['check_out_date'],
                    'check_out_time' => $data['check_out_time'],
                    'updated_at' => date('Y-m-d H:i:s')
                ], $id);
                if($updated) {
                    return View::redirect('bookings');
                } else {
                    // Afficher un message d'erreur si la mise à jour n'a pas pu être effectuée
                    return View::render('booking/edit', ['errors' => ["Error: Update didn't go through"], 'booking' => $data]);
                }
            } else {
                // Afficher les erreurs de validation
                $errors = $validator->getErrors();

                return View::render('booking/edit', ['errors' => $errors, 'booking' => $data]);
            }
        } else {
            // Afficher une erreur si l'identifiant de la réservation est manquant
            return View::render('error/error');
        }
    }
    
    /**
     * Fonction pour supprimer une réservation de la base de données
     * @param array $data Les données contenant l'identifiant de la réservation à supprimer
     */
    public function delete($data){
        if (!isset($_POST['id'])) {
            echo json_encode([
                'status' => 'error',
                'message' => "L'identifiant de réservation n'a pas été transmis"
            ]);
            return;
        }

        // Convertit l'identifiant de réservation en entier pour garantir qu'il est du bon type
        $bookingId = (int)$data['id'];
        // Créer une nouvelle instance du modèle Booking pour interagir avec la base de données
        $booking = new Booking();
        // Appelle la méthode delete du modèle Booking pour tenter de supprimer la réservation en utilisant l'identifiant fourni
        $deleted = $booking->delete($bookingId);

        // Vérifie si la suppression a réussi
        if($deleted){
           // !!! -> Si la réservation a été supprimée avec succès, renvoie une réponse JSON indiquant le succès
           echo json_encode([
                'status' => 'success',
                'message' => "Réservation supprimée avec succès, élément avec l'ID : " . $bookingId
           ]);
        }else{
            // Si la réservation n'a pas été trouvée ou n'a pas pu être supprimée, renvoie une réponse JSON indiquant l'erreur
            echo json_encode([
                'status' => 'error',
                'message' => 'Réservation non trouvée'
            ]);
        }
    }

    public function generatePdf() {
    
        // If you want to render the view first, before generating the PDF
        View::render('booking/generate-pdf', []);
    
        $options = new \Dompdf\Options();
        $options->setIsRemoteEnabled(true);

        // Initialize Dompdf
        $dompdf = new \Dompdf\Dompdf($options);

        // Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        $html = '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Booking Confirmation</title>
            <style>
                .confirmation-print-box {
                    display: flex;
                    flex-direction: column;
                    gap: 10px;
                    padding: 20px;
                    border: 1px solid #ddd;
                    border-radius: 5px;
                    background-color: #f9f9f9;
                }

                .confirmation-print-box div {
                    display: flex;
                    justify-content: space-between;
                    padding: 10px 0;
                    border-bottom: 1px solid #eee;
                }

                .confirmation-print-box div:last-child {
                    border-bottom: none;
                }

                .confirmation-print-box p {
                    font-weight: bold;
                    color: brown;
                    margin: 0;
                    font-size: 16px;
                }

                .confirmation-print-box span {
                    font-weight: bold;
                    color: #000;
                }
            </style>
        </head>
        <body>
            <h1>Booking Confirmation</h1>
            <div class="confirmation-print-box">
                <div>
                    <p>Type: <span>Luxury</span></p>
                </div>
                <div>
                    <p>Make: <span>Mercedes</span></p>
                </div>
                <div>
                    <p>Model: <span>S-Class</span></p>
                </div>
                <div>
                    <p>Color: <span>Black</span></p>
                </div>
                <div>
                    <p>Check In Date: <span>2024-09-01</span></p>
                </div>
                <div>
                    <p>Check In Time: <span>10:00 AM</span></p>
                </div>
                <div>
                    <p>Check Out Date: <span>2024-09-05</span></p>
                </div>
                <div>
                    <p>Check Out Time: <span>02:00 PM</span></p>
                </div>
                <div>
                    <p>Name: <span>John</span></p>
                </div>
                <div>
                    <p>Surname: <span>Doe</span></p>
                </div>
                <div>
                    <p>Email: <span>john.doe@example.com</span></p>
                </div>
                <div>
                    <p>Phone: <span>+1 439 678 9091</span></p>
                </div>
            </div>
        </body>
        </html>';

        $dompdf->loadHtml($html);

        // Render the PDF
        $dompdf->render();

        // Output the generated PDF to the browser
        $dompdf->stream("booking-confirmation.pdf", ["Attachment" => false]);
    }

}

?>
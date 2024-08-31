<?php
namespace App\Controllers;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/**
 * Contrôleur pour envoyer un e-mail à l'e-mail abonné à la newsletter
 */
class NewsletterController {
    public function subscribe() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];

            if (empty($email)) {
                echo 'Email address is required.';
                exit;
            }

            $mail = new PHPMailer(true);

            try {
                // Paramètres du serveur
                $mail->isSMTP();
                $mail->SMTPAuth = true;
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                // Informations d'identification SMTP
                $mail->Username = 'luxurycarbookingg@gmail.com'; // Gmail address
                $mail->Password = 'iotq gwaw tles ytlt'; 

                //Destinataires :
                // Expéditeur et destinataire
                $mail->setFrom('luxurycarbookingg@gmail.com', 'Luxury Car Booking');
                $mail->addAddress($email);

                // Contenu
                $mail->isHTML(true);
                $mail->Subject = 'Thank you for your subscription';
                $mail->Body    = 'Here is your Booking at Deluuxe Location. Thank you for subscribing to our newsletter!';

                if (empty($mail->Body)) {
                    throw new Exception('Email body is empty.');
                }

                $mail->send();

                /**
                 * Rediriger l'utilisateur vers la page d'accueil après avoir soumis le formulaire de newsletter
                 */
                $baseURL = BASE;
                header("Location: {$baseURL}/home");
                exit();
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            echo 'Invalid request method.';
        }
    }
}

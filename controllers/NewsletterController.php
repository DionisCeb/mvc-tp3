<?php
namespace App\Controllers;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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
                // Server settings
                $mail->isSMTP();
                $mail->SMTPAuth = true;
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                // SMTP credentials
                $mail->Username = 'luxurycarbookingg@gmail.com'; // Gmail address
                $mail->Password = 'iotq gwaw tles ytlt'; 

                //Recipents:
                // Sender and recipient
                $mail->setFrom('luxurycarbookingg@gmail.com', 'Luxury Car Booking');
                $mail->addAddress($email);

                // Content
                $mail->isHTML(true);
                $mail->Subject = 'Thank you for your subscription';
                $mail->Body    = 'Here is your Booking at Deluuxe Location. Thank you for subscribing to our newsletter!';

                if (empty($mail->Body)) {
                    throw new Exception('Email body is empty.');
                }

                $mail->send();

                /**
                 * Redirect the user to home page after submiting the newsletter form
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

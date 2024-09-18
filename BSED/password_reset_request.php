<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
 include 'db_connect.php';   // Assume you have this file for DB connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }

    // Check if email exists in the database
    $query = $conn->prepare('SELECT * FROM users WHERE email = ?');
    $query->execute([$email]);
    $user = $query->fetch();

    if ($user) {
        // Generate a unique token
        $token = bin2hex(random_bytes(32));
        $expires = date('U') + 3600;  // Token expires in 1 hour

        // Store the token and expiration in the database
        $query = $conn->prepare('INSERT INTO password_resets (email, token, expires) VALUES (?, ?, ?)');
        $query->execute([$email, $token, $expires]);

        // Send password reset email
        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';           // SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'your_email@gmail.com'; // Your Gmail address
            $mail->Password = 'your_app_password';    // Gmail App Password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Recipients
            $mail->setFrom('your_email@gmail.com', 'Your Website');
            $mail->addAddress($email); // Recipient email

            // Email content
            $url = "https://yourwebsite.com/reset_password.php?token=$token";
            $mail->isHTML(true);
            $mail->Subject = 'Password Reset Request';
            $mail->Body    = "Click <a href='$url'>here</a> to reset your password. This link will expire in 1 hour.";
            $mail->AltBody = "Click the following link to reset your password: $url";

            $mail->send();
            echo 'Password reset link has been sent to your email.';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Email not found.";
    }
}
?>

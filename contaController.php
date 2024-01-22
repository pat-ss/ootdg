<?php

require_once "config.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

class Conta{
    
    function hashPasswordWithBcrypt($password) {
        // Hash the password using bcrypt
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        return $hashedPassword;
    }
    
    function verifyPassword($password, $hashedPassword) {
        // Compare the provided password with the stored hash using bcrypt
        return password_verify($password, $hashedPassword);
    }

    function generateToken($email) {
        // Generate a token containing user information (e.g., user ID)
        $payload = [
            'email' => $email,
            'expiry' => time() + (86400 * 30)  // Expiry set to 30 days from now
        ];
    
        // Generate a random token using md5(uniqid().rand(10000, 99999))
        $randomToken = md5(uniqid().rand(10000, 99999));
    
        // Encode the payload and random token as a JSON web token (JWT)
        $token = base64_encode(json_encode($payload) . '.' . $randomToken);
    
        return $token;
    }
    
    function login($email, $password, $rememberMe) {
        global $conn;
        $result = "";
    
        $sql = "SELECT * FROM users WHERE email = '" . $email . "';";
        $fetched = $conn->query($sql);
        $flag = 0;
        $token = md5(uniqid() . rand(10000, 99999));
        $userId = 0;
    
        if ($fetched->num_rows > 0) {
            $flag = 1;
            while ($row = $fetched->fetch_assoc()) {
                $storedPassword = $row['password'];
                $userId = $row['idUser'];
                if ($password == $storedPassword) {
                    $result = "Passwords match";
                    $flag = 2;
                    /*if ($rememberMe) {
                        $sql2 = "UPDATE users SET token = '" . $token . "' WHERE idUser = " . $userId . ";";
                        if (!mysqli_query($conn, $sql2)) {
                            $result = mysqli_error($conn);
                        }
                        $token = generateToken($email);
    
                        // Set a cookie with the token (valid for 30 days)
                        setcookie('loggedin_user', $email . ':' . $userId . ':' . $token, time() + (86400 * 30), "/"); // 30 days
                    }*/
    
                    // Start a PHP session and store relevant information
                    session_start();
                    $_SESSION['user_id'] = $userId;
                    $_SESSION['email'] = $email;
    
                    
                } else {
                    $result = "Password does not match";
                }
            }
        } else {
            $result = "User not found";  // Set result for user not found
        }
    
    
        
    
        // Return the JSON result
        return $result;
    }
    
    

    
    
    
    
    function register($nome, $apelido, $email, $password) {
        global $conn;
        $result = "";
    
        $sql2 = "SELECT * FROM users WHERE email = '".$email."';";
        $fetched2 = $conn->query($sql2);
    
        if ($fetched2->num_rows > 0) {
            $result = "Este email já tem uma conta associada.";
        } else {
            // Hash the password using bcrypt
            $hashedPassword = $this->hashPasswordWithBcrypt($password);
    
            $today = date("Y-m-d");
            $sql = "INSERT INTO users VALUES(NULL, '".$email."', '".$hashedPassword."', '".$nome."', '".$apelido."', '".$today."', '2099-09-18', 1, NULL);";
    
            if (mysqli_query($conn, $sql)) {
                $result = "done";
            } else {
                $result = mysqli_error($conn);
            }
        }
    
        return $result;
    }
    
    

    function sendConfirmationEmail($nome, $apelido, $email){
        
        $mail = new PHPMailer(true);

        try {
            // SMTP configuration
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'ssaicirtap@gmail.com'; // Your Gmail email
            $mail->Password = 'Pat:54144000';       // Your Gmail password
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Sender and recipient
            $mail->setFrom('your_email@gmail.com', 'Your Name');
            $mail->addAddress($email, 'Recipient Name');

            // Email content
            $mail->Subject = 'Subject of the Email';
            $mail->Body = 'This is the body of the email.';

            // Send the email
            $mail->send();
            $result = 'Email sent successfully.';
        } catch (Exception $e) {
            $result = 'Failed to send email: '. $mail->ErrorInfo;
        }

        return($result);
    }
    
    
    
    
}

?>
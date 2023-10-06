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
    
    function login($email, $password, $rememberMe) {
        global $conn;
        $result = "";
    
        $sql = "SELECT * FROM users WHERE email = '".$email."';";
        $fetched = $conn->query($sql);
        $flag = 0;
    
        if ($fetched->num_rows > 0) {
            $flag = 1;
            while ($row = $fetched->fetch_assoc()) {
                $storedPassword = $row['password'];
    
                // Compare the login password with the stored password
                if ($password == $storedPassword) {
                    $flag = 2;
                    if ($rememberMe) {
                        // Set a cookie to remember the logged-in user
                        setcookie('loggedin_user', $email, time() + (86400 * 30), "/"); // 30 days
                    }
                
                    // Store the email in session
                    session_start();
                    $_SESSION['loggedin_user'] = $email;
                
                    // Redirect to index.html
                    header("Location: index.html");
                    exit();
                } else {
                    $result = "Password does not match";
                }
            }
        }
    
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
            $sql = "INSERT INTO users VALUES(NULL, '".$email."', '".$hashedPassword."', '".$nome."', '".$apelido."', '".$today."', '2099-09-18', 1);";
    
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
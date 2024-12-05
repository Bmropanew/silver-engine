<?php
require_once("conexion/cls_conectar.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
        sendEmail();
    
} else {
    
    if (isset($_GET['action']) && $_GET['action'] === 'getUsers') {
        getUsers();
    }
}

function getUsers()
{
    try {
        $obj = new conexion();
        $conn = $obj->getConexion();
        $query = "SELECT id_usuario, nombre, apellidos, correo FROM usuario";
        $result = $conn->query($query);
        $users = $result->fetch_all(MYSQLI_ASSOC);
        echo json_encode($users);
    } catch (Exception $e) {
        echo json_encode(["error" => $e->getMessage()]);
    }
}

function sendEmail()
{
    try {
        $asunto = htmlspecialchars($_POST['asunto']);
        $contenido = htmlspecialchars($_POST['contenido']);
        $destinatarios = filter_var($_POST['destinatario'], FILTER_SANITIZE_STRING);

        $emails = explode(',', $destinatarios);
        
        $success = true; 
        $errorEmails = [];

        foreach ($emails as $email) {
            $email = trim($email); 
            
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errorEmails[] = $email;
                continue; 
            }

            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->SMTPAuth = true;
            $mail->Username = 'utpbrayansoft@gmail.com';
            $mail->Password = 'ythd wxfj ifsi pibd';

            $mail->setFrom('utpbrayansoft@gmail.com', 'Brayan Olivas');
            $mail->addAddress($email);  
            $mail->Subject = $asunto;
            $mail->isHTML(true);
            $mail->Body = "<h1>El mensaje es:</h1><p>{$contenido}</p>";

            $mail->SMTPOptions = [
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true,
                ],
            ];

            if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] == UPLOAD_ERR_OK) {
                $rutaTemporal = $_FILES['archivo']['tmp_name'];
                $nombreArchivo = $_FILES['archivo']['name'];
                $mail->addAttachment($rutaTemporal, $nombreArchivo);
            }
            if (!$mail->send()) {
                $errorEmails[] = $email; 
                $success = false; 
            }
        }
        if ($success) {
            echo 'Correo enviado con éxito a todos los destinatarios.';
        } else {
            $errorList = implode(', ', $errorEmails);
            echo 'Hubo un error al enviar el correo a los siguientes destinatarios: ' . $errorList;
        }
    } catch (Exception $e) {
        echo 'Error al enviar el correo: ' . $e->getMessage();
    }
}



?>

<?php
// TODO:REVISAR ENVIO DE CORREO
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

require '../../modelo/modelo_usuario.php';

$MU = new Modelo_Usuario();
$email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
$contraactual = htmlspecialchars($_POST['contrasena'], ENT_QUOTES, 'UTF-8');
$contra = password_hash($_POST['contrasena'], PASSWORD_DEFAULT, ['cost' => 10]);;
$consulta = $MU->Restablecer_Contra($email, $contra);
if ($consulta == "1") {

    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {

        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );



        //Server settings
        $mail->SMTPDebug = 2;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'fimercadog@gmail.com';                     // SMTP username
        $mail->Password   = 'faidel2010**';                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom('fimercadog@gmail.com', 'Mailer');
        $mail->addAddress($email);     // Add a recipient

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Restablecer Password';
        $mail->Body    = 'su contraseña fue restablecida<br> Nueva contraseña: <br>' . $contraactual . '</br>';

        $mail->send();
        echo '1';
    } catch (Exception $e) {
        echo "0";
    }
} else {
    echo "2";
}
<?php
// Incluye las clases de PHPMailer desde la carpeta src/
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

// === 2. Recolección y Validación de Datos en Servidor ===
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header('Location: index.php?status=error');
    exit;
}

// Recolección y sanitización inicial
$nombre = trim($_POST['nombre'] ?? '');
$apellido = trim($_POST['apellido'] ?? '');
$nombre_completo = $nombre . ' ' . $apellido;
$correo_remitente = trim($_POST['correo'] ?? '');
$asunto = trim($_POST['asunto'] ?? '');
$mensaje = trim($_POST['mensaje'] ?? '');

$validacion_exitosa = true;

// Validación de campos obligatorios y formato de correo
if (empty($nombre) || empty($apellido) || empty($correo_remitente) || empty($asunto) || empty($mensaje) || !filter_var($correo_remitente, FILTER_VALIDATE_EMAIL)) {
    $validacion_exitosa = false;
}

if (!$validacion_exitosa) {
    header('Location: index.php?status=error');
    exit;
}

// Saneamiento de datos (Seguridad)
$nombre_saneado = htmlspecialchars($nombre_completo, ENT_QUOTES, 'UTF-8');
$correo_saneado = filter_var($correo_remitente, FILTER_SANITIZE_EMAIL);
$asunto_saneado = htmlspecialchars($asunto, ENT_QUOTES, 'UTF-8');
$mensaje_saneado = htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8');


// === 3. Configuración y Envío con PHPMailer ===
$mail = new PHPMailer(true);

try {
    // Configuración SMTP para GMAIL - USANDO STARTTLS (Puerto 587)
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';             
    $mail->SMTPAuth   = true;
    
    // TUS CREDENCIALES FINALES
    $mail->Username   = 'chutaantony@gmail.com';        
    $mail->Password   = 'caqq cwmq qlcc rzzl';          // ¡TU NUEVA CLAVE!
    
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
    $mail->Port       = 587;                          
    
    // Remitente y Destinatario
    $mail->setFrom('chutaantony@gmail.com', 'Formulario de Contacto Web'); 
    $mail->addAddress('denyschuta10@gmail.com', 'Administrador'); // Correo de destino
    $mail->addReplyTo($correo_saneado, $nombre_saneado);       

    // Contenido del Correo
    $mail->isHTML(false); 
    $mail->CharSet = 'UTF-8';
    $mail->Subject = 'Nuevo Mensaje: ' . $asunto_saneado;
    
    $cuerpo_correo = "¡Has recibido un nuevo mensaje de contacto!\n\n";
    $cuerpo_correo .= "Nombre Completo: " . $nombre_saneado . "\n";
    $cuerpo_correo .= "Correo del Remitente: " . $correo_saneado . "\n";
    $cuerpo_correo .= "Asunto: " . $asunto_saneado . "\n\n";
    $cuerpo_correo .= "Mensaje:\n" . $mensaje_saneado;
    
    $mail->Body = $cuerpo_correo;

    $mail->send();
    
    // Éxito: Redirige con mensaje de éxito
    header('Location: index.php?status=success');
    exit;

} catch (Exception $e) {
    // FALLO: MUESTRA EL ERROR DETALLADO PARA DIAGNÓSTICO
    echo "ERROR DETALLADO DE ENVÍO: " . $mail->ErrorInfo;
    exit;
}
?>
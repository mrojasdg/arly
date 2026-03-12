<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strip_tags(trim($_POST["nombre"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message_content = strip_tags(trim($_POST["mensaje"]));

    if (empty($name) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($message_content)) {
        http_response_code(400);
        echo "Por favor completa todos los campos correctamente.";
        exit;
    }

    $to = "ventas@arly.com.mx";
    $subject = "Nuevo Mensaje de Contacto: $name";

    $email_content = "Has recibido un nuevo mensaje desde el sitio web.\n\n";
    $email_content .= "Nombre: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Mensaje:\n$message_content\n";

    $from_email = "ventas@arly.com.mx";
    $headers = "From: Arly Web <$from_email>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    if (mail($to, $subject, $email_content, $headers, "-f $from_email")) {
        http_response_code(200);
        echo "¡Gracias! Tu mensaje ha sido enviado correctamente.";
    } else {
        http_response_code(500);
        echo "Lo sentimos, hubo un error al enviar el mensaje.";
    }
} else {
    http_response_code(403);
    echo "Acceso denegado.";
}
?>
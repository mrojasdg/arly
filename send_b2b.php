<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input
    $name = strip_tags(trim($_POST["nombre"]));
    $company = strip_tags(trim($_POST["empresa"]));
    $rfc = strip_tags(trim($_POST["rfc"]));
    $city = strip_tags(trim($_POST["ciudad"]));
    $phone = strip_tags(trim($_POST["tel"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $business_type = strip_tags(trim($_POST["negocio"]));
    $volume = strip_tags(trim($_POST["volumen"]));
    $message_content = strip_tags(trim($_POST["mensaje"]));

    // Destination email
    $to = "ventas@arly.com.mx";

    // Email subject
    $subject = "Nueva Solicitud de Distribuidor: $company";

    // Email content
    $email_content = "Has recibido una nueva solicitud de distribución desde el sitio web.\n\n";
    $email_content .= "Nombre: $name\n";
    $email_content .= "Empresa: $company\n";
    $email_content .= "RFC: $rfc\n";
    $email_content .= "Ciudad/Estado: $city\n";
    $email_content .= "Teléfono: $phone\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Tipo de Negocio: $business_type\n";
    $email_content .= "Volumen Estimado: $volume\n";
    $email_content .= "Mensaje:\n$message_content\n";

    $from_email = "ventas@arly.com.mx";
    $headers = "From: Solicitud Distribuidor <$from_email>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    // Send the email
    if (mail($to, $subject, $email_content, $headers, "-f $from_email")) {
        http_response_code(200);
        echo "¡Gracias! Tu mensaje ha sido enviado correctamente.";
    } else {
        http_response_code(500);
        echo "Lo sentimos, ocurrió un error al enviar el mensaje. Por favor intenta de nuevo.";
    }
} else {
    http_response_code(403);
    echo "Hubo un problema con tu envío, por favor intenta de nuevo.";
}
?>
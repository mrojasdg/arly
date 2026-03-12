<<<<<<< HEAD
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Por favor ingresa un correo electrónico válido.";
        exit;
    }

    // Destination email
    $to = "ventas@arly.com.mx";
    $subject = "Nueva suscripción al Newsletter: $email";
    $from_email = "ventas@arly.com.mx";
    $headers = "From: Arly Newsletter <$from_email>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    if (mail($to, $subject, $email_content, $headers, "-f $from_email")) {
        http_response_code(200);
        echo "¡Gracias por suscribirte!";
    } else {
        http_response_code(500);
        echo "Error al procesar la suscripción.";
    }
} else {
    http_response_code(403);
    echo "Acceso denegado.";
}
=======
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Por favor ingresa un correo electrónico válido.";
        exit;
    }

    // Destination email
    $to = "ventas@arly.com.mx";
    $subject = "Nueva suscripción al Newsletter: $email";
    $from_email = "ventas@arly.com.mx";
    $headers = "From: Arly Newsletter <$from_email>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    if (mail($to, $subject, $email_content, $headers, "-f $from_email")) {
        http_response_code(200);
        echo "¡Gracias por suscribirte!";
    } else {
        http_response_code(500);
        echo "Error al procesar la suscripción.";
    }
} else {
    http_response_code(403);
    echo "Acceso denegado.";
}
>>>>>>> cf3dbd9cbfc38fdc0655fd2db3d47a04242c3344
?>
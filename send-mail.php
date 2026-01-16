<?php
// Замініть цей email на пошту Юрія
$to = "test.mail@gmail.com"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strip_tags(trim($_POST["name"]));
    $phone = strip_tags(trim($_POST["phone"]));
    $email = strip_tags(trim($_POST["email"]));
    $boxType = strip_tags(trim($_POST["boxType"]));

    $subject = "Нова заявка з сайту Mistseye: $name";
    
    $message = "Отримана нова заявка:\n\n";
    $message .= "Ім'я: $name\n";
    $message .= "Телефон: $phone\n";
    $message .= "Email: $email\n";
    $message .= "Що хоче: $boxType\n";

    $headers = "From: no-reply@mistseye.com.ua\r\n";
    
    if (mail($to, $subject, $message, $headers)) {
        http_response_code(200);
        echo "Success";
    } else {
        http_response_code(500);
        echo "Error";
    }
} else {
    http_response_code(403);
    echo "Access denied";
}
?>
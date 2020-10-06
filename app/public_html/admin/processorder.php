<?php
error_reporting(E_ALL); 
ini_set("display_errors", 1);
require '../mail/PHPMailerAutoload.php';
$mysqli = new mysqli('mysql', 'creativekits', '12345678', 'creativekits');
$mysqli->set_charset('utf-8');

function getUserInfo($roww, $id){
    global $mysqli;
    $query = "SELECT * FROM `users` WHERE ID = $id";
    $result = $mysqli->query($query);
    $row = $result->fetch_object();
    return($row->$roww);
}
function getOrderInfo($roww, $id){
    global $mysqli;
    $query = "SELECT * FROM `orders` WHERE ID = $id";
    $result = $mysqli->query($query);
    $row = $result->fetch_object();
    return($row->$roww);
}
function processOrder($c){
    global $mysqli;
    foreach($c as $prod => $qt){
if($prod != 'dummyval'){
    $query = "SELECT * FROM `products` WHERE ID = $prod";
    $result = $mysqli->query($query);
    if($mysqli->error){
die($mysqli->error);
    }
    $row = $result->fetch_object();
    $qt2 = $row->stock - 1;

    $query2 = "UPDATE `products` SET `stock` = $qt2 WHERE `products`.`id` =$prod;";
    $result = $mysqli->query($query2);
}
    }
}

$userid = getOrderInfo('userid', $custom);
$email = getUserInfo('email', $userid);
$name = getUserInfo('name', $userid);

$cartt = unserialize(getOrderInfo('items', $custom));
processOrder($cartt);

$sql = "UPDATE `orders` SET  `status` =  '1' WHERE  `id` =$custom;";
$mysqli->query($sql);

$msg = "<html> <head> <meta http-equiv='content-type' content='text/html; charset=ISO-8859-1'> </head> <body> <style>@import url(http://fonts.googleapis.com/css?family=Open+Sans:400,600); </style> <div style='font-family: Open Sans, Verdana; font-size: 13px; width: 550px; text-align: justify;'> <p>¡Hola, $name!</p> <p>Te enviamos este correo para confirmarte que hemos recibido tu pedido, y estamos procesándolo. Cuando lo hayamos enviado, te enviaremos otro mensaje para confirmarlo.<br> </p> <p>Te dejamos también un enlace con la factura del pedido, para que compruebes que todo está correcto - si hay algo mal, no dudes en mandarnos un correo: estaremos encantados de atenderte :)</p> <p> <a href='http://www.creativekits.es/genfact/?id=$custom' style='display: block; background: #D93B3B; padding: 10px 20px; font-size: 20px; text-transform: uppercase; color: #FFF !important; border-radius: 3px; text-decoration: none !important; cursor: pointer; font-weight: bold; text-align: center;'>Descargar factura</a> </p> <p>¡Un saludo!<br> <strong>CreativeKits</strong></p> <p> <img src='http://www.creativekits.es/img/mailimg/' style='border-radius: 2px;'> </p> </div> </body></html>";

/*mail($email, 'Confirmación de pedido • CreativeKits', $msg, $headers);*/
mail('santi.espada@gmail.com', 'Pedido recibido', $msg, $headers);

$mail = new PHPMailer;

$mail->CharSet = 'UTF-8';
$mail->isSMTP();      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;       // Enable SMTP authentication
$mail->Username = 'santi.espada@gmail.com'; // SMTP username
$mail->Password = 'ladygaga.-98';   // SMTP password
$mail->SMTPSecure = 'tls';    // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;    // TCP port to connect to

$mail->From = 'contacto@creativekits.es';
$mail->FromName = 'CreativeKits';
$mail->addBCC($email);     // Add a recipient*/
$mail->addBCC('contacto@creativekits.es');
$mail->addReplyTo('contacto@creativekits.es', 'CreativeKits');

$mail->isHTML(true);  // Set email format to HTML

$mail->Subject = 'Confirmación de pedido • CreativeKits';
$mail->Body    = $msg;

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}
?>
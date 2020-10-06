<?php
$mysqli = new mysqli('mysql', 'creativekits', '12345678', 'creativekits');
$mysqli->set_charset('utf-8');


require 'mail/PHPMailerAutoload.php';

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

// CONFIG: Enable debug mode. This means we'll log requests into 'ipn.log' in the same directory.
// Especially useful if you encounter network errors or other intermittent problems with IPN (validation).
// Set this to 0 once you go live or don't require logging.
define("DEBUG", 1);

// Set to 0 once you're ready to go live
define("USE_SANDBOX", 0);


define("LOG_FILE", "./ipn.log");


// Read POST data
// reading posted data directly from $_POST causes serialization
// issues with array data in POST. Reading raw POST data from input stream instead.
$raw_post_data = file_get_contents('php://input');
$raw_post_array = explode('&', $raw_post_data);
$myPost = array();
foreach ($raw_post_array as $keyval) {
    $keyval = explode ('=', $keyval);
    if (count($keyval) == 2)
        $myPost[$keyval[0]] = urldecode($keyval[1]);
}
// read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-validate';
if(function_exists('get_magic_quotes_gpc')) {
    $get_magic_quotes_exists = true;
}
foreach ($myPost as $key => $value) {
    if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
        $value = urlencode(stripslashes($value));
    } else {
        $value = urlencode($value);
    }
    $req .= "&$key=$value";
}

// Post IPN data back to PayPal to validate the IPN data is genuine
// Without this step anyone can fake IPN data

if(USE_SANDBOX == true) {
    $paypal_url = "https://www.sandbox.paypal.com/cgi-bin/webscr";
} else {
    $paypal_url = "https://www.paypal.com/cgi-bin/webscr";
}

$ch = curl_init($paypal_url);
if ($ch == FALSE) {
    return FALSE;
}

curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);

if(DEBUG == true) {
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
}

// CONFIG: Optional proxy configuration
//curl_setopt($ch, CURLOPT_PROXY, $proxy);
//curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);

// Set TCP timeout to 30 seconds
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));

// CONFIG: Please download 'cacert.pem' from "http://curl.haxx.se/docs/caextract.html" and set the directory path
// of the certificate as shown below. Ensure the file is readable by the webserver.
// This is mandatory for some environments.

//$cert = __DIR__ . "./cacert.pem";
//curl_setopt($ch, CURLOPT_CAINFO, $cert);

$res = curl_exec($ch);
if (curl_errno($ch) != 0) // cURL error
    {
    if(DEBUG == true) { 
        error_log(date('[Y-m-d H:i e] '). "Can't connect to PayPal to validate IPN message: " . curl_error($ch) . PHP_EOL, 3, LOG_FILE);
    }
    curl_close($ch);
    exit;

} else {
        // Log the entire HTTP response if debug is switched on.
        if(DEBUG == true) {
            error_log(date('[Y-m-d H:i e] '). "HTTP request of validation request:". curl_getinfo($ch, CURLINFO_HEADER_OUT) ." for IPN payload: $req" . PHP_EOL, 3, LOG_FILE);
            error_log(date('[Y-m-d H:i e] '). "HTTP response of validation request: $res" . PHP_EOL, 3, LOG_FILE);

            // Split response headers and payload
            list($headers, $res) = explode("\r\n\r\n", $res, 2);
        }
        curl_close($ch);
}

// Inspect IPN validation result and act accordingly

if (strcmp ($res, "VERIFIED") == 0 ) {
    // check whether the payment_status is Completed
    // check that txn_id has not been previously processed
    // check that receiver_email is your PayPal email
    // check that payment_amount/payment_currency are correct
    // process payment and mark item as paid.

    // assign posted variables to local variables
    //$item_name = $_POST['item_name'];
    //$item_number = $_POST['item_number'];
    //$payment_status = $_POST['payment_status'];
    //$payment_amount = $_POST['mc_gross'];
    //$payment_currency = $_POST['mc_currency'];
    //$txn_id = $_POST['txn_id'];
    //$receiver_email = $_POST['receiver_email'];
    //$payer_email = $_POST['payer_email'];
    
    if(DEBUG == true) {
        error_log(date('[Y-m-d H:i e] '). "Verified IPN: $req ". PHP_EOL, 3, LOG_FILE);
    }

    $payment_status = $_POST['payment_status'];
    $custom = $_POST['custom'];
    $txn_type = $_POST["txn_type"];
    $txn_id = $_POST['txn_id'];

    
    $userid = getOrderInfo('userid', $custom);
    $email = getUserInfo('email', $userid);
    $name = getUserInfo('name', $userid);

    if(getOrderInfo('status', $custom) == 0){
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
    }

} else if (strcmp ($res, "INVALID") == 0) {
    // log for manual investigation
    // Add business logic here which deals with invalid IPN messages
    if(DEBUG == true) {
        error_log(date('[Y-m-d H:i e] '). "Invalid IPN: $req" . PHP_EOL, 3, LOG_FILE);
    }
}

?>
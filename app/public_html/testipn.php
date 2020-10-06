<?php

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

$custom = 22;
$txn_id = 'Pruebarrl';
$userid = getOrderInfo('userid', $custom);
$mail = getUserInfo('email', $userid);


		$headers .= "Reply-To: ". strip_tags('contacto@creativekits.es') . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

				$cartt = unserialize(getOrderInfo('items', $custom));
				processOrder($cartt);

				$sql = "UPDATE `orders` SET  `status` =  '1' WHERE  `id` =$custom;";
				$mysqli->query($sql);

				$sql2 = "UPDATE `orders` SET  `transactionid` =  '$txn_id' WHERE  `id` =$custom;";
				$mysqli->query($sql2);

				$msg = "<html> <head> <meta http-equiv='content-type' content='text/html; charset=UTF-8'> </head> <body> <style>@import url(http://fonts.googleapis.com/css?family=Open+Sans:400,600); </style> <div style='font-family: Open Sans, Verdana; font-size: 13px; width: 550px; text-align: justify;'> <p>¡Hola, $name!</p> <p>Te enviamos este correo para confirmarte que hemos recibido tu pedido. Ya está pagado y estamos procesándolo. Cuando enviemos tu pedido, te enviaremos otro correo para confirmarlo.<br> </p> <p> Te dejamos también un enlace con la factura del pedido. Comprueba que todo está correcto y, si hay algo mal, no dudes en mandarnos un correo. </p> <p> <a href='http://www.creativekits.es/genfact/?id=$custom' style='display: block; background: #D93B3B; padding: 10px 20px; font-size: 20px; text-transform: uppercase; color: #FFF !important; border-radius: 3px; text-decoration: none !important; cursor: pointer; font-weight: bold; text-align: center;'>Descargar factura</a> </p> <p>¡Un saludo!<br> <strong>CreativeKits</strong></p> <p> <img src='http://www.creativekits.es/img/mailimg/' style='border-radius: 2px;'> </p> </div> </body></html>";

				mail($mail, 'Confirmación de pedido • CreativeKits', $msg, $headers);
				mail('contacto@creativekits.es', 'Pedido recibido', $msg, $headers);
?>
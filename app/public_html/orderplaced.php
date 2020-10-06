<?php
$val = array('dummyval' => 1);
setcookie('ck_shoppingcart', serialize($val), time()+259200, '/', '.creativekits.es');
if($_SESSION['descuento'] == 'DESC14A'){
	setcookie('DESC14AUSED', 'yes', time()+259200, '/', '.creativekits.es');
}
session_start();
include('inc.php');
if(empty($_SESSION['orderid'])){
	header("Location: $baseurl/placeorder.php");
}
$id = $_SESSION['orderid'];
$price = getOrderInfo('cost', $id);
$shippingprice = getOrderInfo('shippingcost', $id);
$totalprice = $price + $shippingprice;
$_SESSION['descuento'] = '';
$_SESSION['comments'] = '';
?>
<!DOCTYPE html>
<html lang=es style="background: #FFF;">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="<?php echo $baseurl ?>/css/reset.css">
		<link rel="stylesheet" href="<?php echo $baseurl ?>/css/main.css">
	</head>
	<body class="frame2">
		<header>Pedido confirmado (referencia: <?=$id?>)</header>
		<div style="padding: 20px">
			<strong>¡Estupendo!</strong>
			<hr>
			El pedido ya ha sido realizado. <br><br>
			• Si has elegido el pago por transferencia bancaria, recibirás un correo próximamente con la información para realizar la transferencia.<br>
			<br>• Si has elegido el pago contrareembolso, recibirás un correo electrónico en el momento en el que se envie tu pedido con la fecha aproximada de entrega, para que puedas tener preparado el importe del pedido en efectivo.<br>
			<br>• Si, por el contrario, has elegido el pago por PayPal, serás redirigido en unos segundos a la pasarela de pago para pagar tu pedido.<br>
			<br>
			¡Muchas gracias por comprar en CreativeKits!<br>
			<?php if(getOrderInfo('payment', $id) == 'PayPal'){ echo "<script>function redirect(){ window.top.location.href = '$baseurl/processpaypal.php';} setTimeout(redirect(), 6000);</script>";  } else { unset($_SESSION['orderid']);}  ?>
		</div>
	</body>
</html>
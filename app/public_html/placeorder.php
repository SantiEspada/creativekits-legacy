<?php
session_start();
include('inc.php');
$cr_cost = ($preciosredondos ? 2 : 2.9);
if($_SESSION['isLoggedIn'] != true){
	header("Location: $baseurl/login.php");
}
$id = $_SESSION['userid'];
if($_POST){
	$items = serialize($cart);
    $cost = $_POST['cost'];
    if($trespordos_on != false){
	   $cost = $_SESSION['3x2_rcost'] - $_POST['shippingcost'];
    } elseif($vat_desc == true && $totalcost >= 30){
        $cost = $_SESSION['vatdesc_total'];
    }
	$shippingcost = $_POST['shippingcost'];
	$shippingadress = $_POST['shippingadress'];
	$shippingzip = $_POST['shippingzip'];
	$shippingcity = $_POST['shippingcity'];
	$shippingregion = $_POST['shippingregion'];
	$userid = $_POST['userid'];
	$payment = $_POST['payment'];
	$comments = $_SESSION['comments'];
	$discount = $_SESSION['descuento'];
	$telf = $_POST['telf'];
	$date = date("d/m/Y H:i");
    $discountprice = 0;
    if($trespordos_on != false){
	   $discountprice = $_SESSION['3x2_disc'];
    } elseif($vat_desc == true && $totalcost >= 30){
        $totalcostWOvat = removeVAT($_SESSION['vatdesc_total']);
        $VAT = $_SESSION['vatdesc_total'] - $totalcostWOvat;
        $discountprice = $VAT;
    }
	if($payment == 'Contrareembolso'){
		$cost = $cost + $cr_cost;
		$items = unserialize($items);
		$items['470'] = 1;
		$items = serialize($items);
	}
	if($_POST['savetelf'] == true){
		$mysqli->query("update `users` set `telf` = '$telf' where `id` = $userid");
	}
	$query = "INSERT INTO `orders` (`id`, `status`, `items`, `cost`, `shippingcost`, `shippingadress`, `shippingzip`, `shippingcity`, `shippingregion`, `userid`, `payment`, `comments`, `discount`, `telf`, `date`, `discountprice`) VALUES (NULL, '0', '$items', '$cost', '$shippingcost', '$shippingadress', '$shippingzip', '$shippingcity', '$shippingregion', '$userid', '$payment', '$comments', '$discount', '$telf', '$date', '$discountprice');";
	if($mysqli->query($query)){
		$_SESSION['orderid'] = $mysqli->insert_id;
	} else {
		die($mysqli->error);
	}
}
if($_SESSION['orderid']){
	header("Location: $baseurl/orderplaced.php");
}
?>
<!DOCTYPE html>
<html lang=es style="background: #FFF;">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="<?php echo $baseurl ?>/css/reset.css">
		<link rel="stylesheet" href="<?php echo $baseurl ?>/css/main.css">
		<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
		<script>
		$(document).ready(function () {
            <?php if($preciosredondos == true){?>
    		$("input[name=payment]:radio").change(function () {
        		var ordervalue = $('#ordervalue').data('originalval');
				if($('input[name=payment]:checked').val() == 'Contrareembolso'){
                    ordervalue = ordervalue + 2;
					$('#ordervalue').html(ordervalue);
				} else {
					$('#ordervalue').html(ordervalue);
				}
    		})
            <?php } else { ?>
            $("input[name=payment]:radio").change(function () {
        		var ordervalue = $('#ordervalue').data('originalval');
				if($('input[name=payment]:checked').val() == 'Contrareembolso'){
					ordervalue = ordervalue.replace(',', '.');
					ordervalue = parseFloat(ordervalue) + 2.90;
					ordervalue = ordervalue.toFixed(2);
					ordervalue = ordervalue.replace('.', ',');
					$('#ordervalue').html(ordervalue);
				} else {
					$('#ordervalue').html(ordervalue);
				}
    		})
            <?php } ?>
		});
		</script>
	</head>
	<body class="frame2">
		<header>Confirmar pedido</header>
		<form action="" method="post" id="orderform">
			<strong>¿Todo bien?</strong>
			<hr>
			Esta es la dirección a la que se enviará tu pedido:<br>
			<div class="shippingbox">
				<strong><?=utf8_decodeAlt(getUserInfo('name', $id))?> <?=utf8_decodeAlt(getUserInfo('surname', $id))?> <?=utf8_decodeAlt(getUserInfo('surname2', $id))?></strong><br>
				<?=utf8_decodeAlt(getUserInfo('adress', $id))?><br>
				<?=utf8_decodeAlt(getUserInfo('zip', $id))?><br>
				<?=utf8_decodeAlt(getUserInfo('city', $id))?> (<?=utf8_decodeAlt(getUserInfo('region', $id))?>)
			</div>
			Y así es como nos pagarás los <span id="ordervalue" data-originalval="<?=dotToComma(twoDecimals($totalcost))?>"><?=dotToComma(twoDecimals($totalcost))?></span>€:<br>
			<input type="radio" name="payment" value="PayPal" checked> Paypal<br>
            <?php if($totalcostWOshipment >= 20){ ?>
                <input type="radio" name="payment" value="Contrareembolso"> Contrareembolso (+<?=$cr_cost?>€ de gastos de gestión)<br>
            <?php }?>
			<input type="radio" name="payment" value="Transferencia"> Transferencia bancaria<br>
			<input type="hidden" name="items" value="<?=serialize($cart)?>">
			<input type="hidden" name="cost" value="<?=$totalcostWOshipment?>">
			<input type="hidden" name="shippingcost" value="<?=$shippingcost?>">
			<input type="hidden" name="shippingadress" value="<?=utf8_decodeAlt(getUserInfo('adress', $id))?>">
			<input type="hidden" name="shippingcity" value="<?=utf8_decodeAlt(getUserInfo('city', $id))?>">
			<input type="hidden" name="shippingzip" value="<?=utf8_decodeAlt(getUserInfo('zip', $id))?>">
			<input type="hidden" name="shippingregion" value="<?=utf8_decodeAlt(getUserInfo('region', $id))?>">
			<input type="hidden" name="userid" value="<?=$id?>">
			<div class="shippingbox" id="telf" style="font-size: 12px;">
				Introduce un número de teléfono (fijo o móvil) sin espacios ni guiones. Lo utilizaremos para comunicarte cualquier problema o incidencia grave relacionado con tu pedido, y no lo compartiremos con nadie. ¡De verdad! :)<br><br>
				<input type="text" name="telf" size="9" style="background: #FFF" value="<?=getUserInfo('telf', $id)?>" required>
				<input type="checkbox" name="savetelf" checked> Guardar para próximos pedidos
			</div>
			<hr>
			<button type="submit" class="button">Realizar pedido y pagar</button>
		</form>
	</body>
</html>
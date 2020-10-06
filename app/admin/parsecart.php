<html style="background: #FFF !important;">
<?php
include('inc.php');
$preciosredondos = true;
function showCart($cart){
	global $mysqli;
	global $baseurl;
	global $totalcost;
    global $set;
    global $preciosredondos;
	foreach($cart as $prodid => $prodqt){
		if($prodid != 'dummyval'){
			$query = "SELECT * FROM `products` WHERE `id` = $prodid";
			$result = $mysqli->query($query);
			$result = $result->fetch_object();

			$name = utf8_decodeAlt($result->name);
			$seoname = seoName($name);
			$cost = $result->cost;
            floor($cost);
			$cost = $cost * $prodqt;

			$categoria = $result->cat;
			$liq = false;
			$liq2 = false;
			$liq3 = false;
			if(strpos($categoria, ' 7,') !== false){
				$liq = true;
			} else if(strpos($categoria, ' 50, ') !== false){
				$liq2 = true;
			} else if(strpos($categoria, ' 62, ') !== false){
				$liq3 = true;
			}
            /*
			$okcats = array('37', '38', '39', '40', '41', '25', '27', '29', '31', '32', '4', '5');

			$catarray = str_replace(' ', '', $categoria);
			$catarray = explode(',', $catarray);

			foreach($catarray as $k){
				if(in_array($k, $okcats)){
					$liq3 = true;
				}
			}
*/
            
			if($liq == true){ $cost = $cost * 0.7; } else if($liq2 == true){ $cost = $cost * 0.7; } else if($liq3 == true){ $cost = $cost * 0.9; } else {
			switch($set['descuento']){
				case 'DESC10JU':
				if($totalcost >= 30){
						$cost = $cost * 0.9;
				}
				break;
				case 'DESC2014':
				if(getTotalCost($cart) >= 30){
						$cost = $cost * 0.85;
				}
				default:
				break;
			}
			}
			$cost = twoDecimals($cost);
            $cost = ($preciosredondos ? floor($cost) : $cost);
			$cost = dotToComma($cost);

			echo "<div class=\"cartproduct\">
							<div>$prodid</div><div><a style=\"border: none !important;\" href=\"$baseurl/prod/$prodid/$seoname/\">$name</a></div><div>$prodqt</div><div>$cost €</div>
						</div>";
		}
	}
}
function applyDiscount($cart, $set){
	global $mysqli;
	global $totalcost;
	global $cart;
	switch($set['descuento']){
		case 'DESC10JU':
			if($totalcost >= 30){
				$totalcost = 0.00;
				foreach($cart as $prodid => $prodqt){
					if($prodid != 'dummyval'){
						$query = "SELECT * FROM `products` WHERE `id` = $prodid";
						$result = $mysqli->query($query);
						$result = $result->fetch_object();

						$cost = $result->cost;
                        $cost = floor($cost);
						$cost = $cost * $prodqt;
                        
                        
			$categoria = $result->cat;
			$liq = false;
			$liq2 = false;
			$liq3 = false;
			if(strpos($categoria, ' 7,') !== false){
				$liq = true;
			} else if(strpos($categoria, ' 50, ') !== false){
				$liq2 = true;
			} else if(strpos($categoria, ' 62, ') !== false){
				$liq3 = true;
			}
/*
			$okcats = array('37', '38', '39', '40', '41', '25', '27', '29', '31', '32', '4', '5');

			$catarray = str_replace(' ', '', $categoria);
			$catarray = explode(',', $catarray);

			foreach($catarray as $k){
				if(in_array($k, $okcats)){
					$liq3 = true;
				}
			}
*/
			if($liq == true){ $cost = $cost * 0.7; } else if($liq2 == true){ $cost = $cost * 0.7; } else if($liq3 == true){ $cost = $cost * 0.9; }
                        
                        
						$totalcost = $totalcost + $cost;
						/*$okcat = array(4, 25, 27, 29, 31, 32);*/
						$nocat = array(7, 50);
						$descok = true;
						foreach($nocat as $cat){
							if(strpos($result->cat, ' '.$cat.',') !== false){
								$descok = false;
							}
						}

						
						if($descok == true){
							$totalcost = $totalcost - $cost;
							$cost = $cost * 0.9;
							$totalcost = $totalcost + $cost;
						}
					}
				}
			}
		break;
		case 'DESC2014':
			if(/*$totalcost >= 30*/true){
				$totalcost = 0.00;
				foreach($cart as $prodid => $prodqt){
					if($prodid != 'dummyval'){
						$query = "SELECT * FROM `products` WHERE `id` = $prodid";
						$result = $mysqli->query($query);
						$result = $result->fetch_object();

						$cost = $result->cost;


						$categoria = $result->cat;
						$liq = false;
			$liq2 = false;
			$liq3 = false;
			if(strpos($categoria, ' 7,') !== false){
				$liq = true;
			} else if(strpos($categoria, ' 50, ') !== false){
				$liq2 = true;
			} else if(strpos($categoria, ' 62, ') !== false){
				$liq3 = true;
			}

/*
						$okcats = array('37', '38', '39', '40', '41', '25', '27', '29', '31', '32', '4', '5');

						$catarray = str_replace(' ', '', $categoria);
			$catarray = explode(',', $catarray);
			foreach($catarray as $k){
				if(in_array($k, $okcats)){
					$liq3 = true;
				}
			}
*/
						$cost = $cost * $prodqt;
						if($liq == true){ $cost = $cost * 0.7; } else if($liq2 == true){ $cost = $cost * 0.7; } else if($liq3 == true){ $cost = $cost * 0.9; } else {
							$cost = $cost * 0.85;}
							$totalcost = $totalcost + $cost;
						}
					}
				}
		default:
		break;
	}
}
function removeVAT($val){
	$val = commaToDot($val);
	$val = $val * 0.79;
	return($val);
}
function addVAT($val){
	$val = commaToDot($val);
	$val = $val * 1.21;
	return($val);
}
function getTotalCost($cart){
	global $mysqli;
    global $preciosredondos;
	$totalcost = 0.00;
	foreach($cart as $prodid => $prodqt){
		if($prodid != 'dummyval'){
			$query = "SELECT * FROM `products` WHERE `id` = $prodid";
			$result = $mysqli->query($query);
			$result = $result->fetch_object();

			$cost = $result->cost;
			$categoria = $result->cat;

			$liq = false;
			if(strpos($categoria, ' 7,') !== false){
				$cost = $cost * 0.7;
			} else if(strpos($categoria, ' 50,') !== false){
				$cost = $cost * 0.7;
			} else if(strpos($categoria, ' 62,') !== false){
				$cost = $cost * 0.9;
			}
			/*
			if($descapplied != true){
				if(strpos($categoria, ' 7,') == false && strpos($categoria, ' 50, ') == false){
					$cost = $cost * 0.95;
					$descapplied = true;
				}
			}
			*/
            $cost = ($preciosredondos ? floor($cost) : $cost);
			$cost = $cost * $prodqt;
			$totalcost = $totalcost + $cost;
		} else {
			$totalcost = 0;
		}
	}
	return($totalcost);
}
function dotToComma($string){
	return(str_replace('.', ',', $string));
}
function commaToDot($string){
	return(str_replace(',', '.', $string));
}
function utf8_decodeAlt($string){
	return(utf8_decode(utf8_encode($string)));
}
function seoName($string){
    $string = preg_replace('~&([a-z]{1,2})(acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($string, ENT_QUOTES, 'UTF-8'));
    return(str_replace(' ', '-', $string));
}
function twoDecimals($val){
	return(round($val, 2));
}
function getTotalWeight($cart){
	global $mysqli;
	$totalweight = 0;
	foreach($cart as $prodid => $prodqt){
		if($prodid != 'dummyval'){
			$query = "SELECT * FROM `products` WHERE `id` = $prodid";
			$result = $mysqli->query($query);
			$result = $result->fetch_object();

			$weight = $result->weight;
			$weight = $weight * $prodqt;

			$totalweight = $totalweight + $weight;
		}
	}
	return($totalweight);
}
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
	$result = $mysqli->query($query) or die($mysqli->error);
	$row = $result->fetch_object();
	return($row->$roww);
}
function getProdInfo($roww, $id){
	global $mysqli;
	$query = "SELECT * FROM `products` WHERE ID = $id";
	$result = $mysqli->query($query);
	$row = $result->fetch_object();
	return($row->$roww);
}
$id = $_GET['id'];
$cart = unserialize(getOrderInfo('items', $id));
$set['comments'] = getOrderInfo('comments', $id);
if(empty($set['comments'])){
	$set['comments'] = '(vacío)';
}
$set['descuento'] = getOrderInfo('discount', $id);
if(!empty($cart)){
	$totalcost = getTotalCost($cart);
	if($totalcost >= 1){
	applyDiscount();}
	if($set['descuento'] == 'DESC14A' && $totalcost >= 50 && $_COOKIE['DESC14AUSED'] != 'yes'){
		$totalcost = $totalcost - 5;

	}
	$totalcostWOvat = removeVAT($totalcost);
	$VAT = $totalcost - $totalcostWOvat;
	$weight = getTotalWeight($cart);
	$shippingcost = 0;
	if($weight > 0 && $weight <= 500){
		$shippingcost = 2;
	} elseif($weight > 500 && $weight <= 3000){
		$shippingcost = 6;
	} elseif($weight > 3000 && $weight <= 10000){
		$shippingcost = 8;
	} else {
		$shippingcost = 0;
		$shippingwarning = true;
	}
	if($totalcost >= 100){
		$shippingcost = 0;
	}

	if(strpos($set['comments'], '20OFF14A') !== false){
		/*$totalcost = $totalcost * 1.05;*/
		$totalcost = $totalcost * 0.8;
	}

	if(strpos($set['comments'], 'ENVIO14A') !== false){
		$shippingcost = 0;
	}
	$totalcostWOshipment = $totalcost;
	$totalcost = $totalcost + $shippingcost;

	if($set['descuento'] == 'DESC14A' && $totalcost >= 50 && $_COOKIE['DESC14AUSED'] != 'yes'){
		$totalcost = $totalcost - 5;
	}
}
$payment = getOrderInfo('payment', $id);
$transactionID = getOrderInfo('transactionid', $id);
$userid = getOrderInfo('userid', $id);
$name = getUserInfo('name', $userid);
$surname = getUserInfo('surname', $userid);
$surname2 = getUserInfo('surname2', $userid);
$adress = getUserInfo('adress', $userid);
$zip = getUserInfo('zip', $userid);
$city = getUserInfo('city', $userid);
$region = getUserInfo('region', $userid);
$totalcostWOshipment = getOrderInfo('cost', $id);
$shippingcost = getOrderInfo('shippingcost', $id);
$totalcost = $totalcostWOshipment + $shippingcost;
$totalcost = $totalcost - getOrderInfo('discountprice', $id);
$totalcost = $totalcost + getOrderInfo('aditionalprice', $id);
?>
<link rel=stylesheet href="../css/reset.css">
<link rel=stylesheet href="main.css">
<style>
@font-face {
    font-family: 'littlesnorlax';
    src: url('littlesnorlax-webfont.woff') format('woff');
    font-weight: normal;
    font-style: normal;
}
</style>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
<body style="width: 960px !important; margin: 0 auto; background: #FFF !important;">
<div style="float: right; font-family: Open Sans; font-size: 65px; margin-top: 0px;">Factura #<?=$id?></div>
<div style="margin-bottom: 30px; margin-top: 10px;"><img src="logock.png" height="65px"></div>
<hr>
<div style="float: right; font-size: 20px; width: 480px;">
<strong>Datos de pago: </strong><br>
<?=$payment?><br>
<?if($payment == 'PayPal'){?>
<strong>ID de transacción: </strong><br>
<?=$transactionID?>
<? } ?>
</div>
<div style="font-size: 20px;">
<strong>Dirección de envío: </strong><br>
<?=$name?> <?=$surname?> <?=$surname2?><br>
<?=$adress?><br>
<?=$zip?> <?=$city?> (<?=$region?>)
</div>
<hr>
<div class="table">
					<div class="title">
						<div>Ref.</div><div>Nombre del producto</div><div>Cantidad</div><div>Precio</div>
					</div>
					<?php showCart($cart, $set);
						if(!empty($set['descuento'])){
							$desc = $set['descuento'];
							switch($desc){
								case 'DESC10JU':
									echo '<div class="cartproduct"><div></div><div>[DESC10JU] Descuento - 10% menos en artículos de regalo si el pedido es mayor a 30€</div><div></div><div></div></div>';
								break;
								case 'DESC2014':
									echo '<div class="cartproduct"><div></div><div>[DESC2014] Descuento -15% menos si el pedido es mayor a 30€</div><div></div><div></div></div>';
								break;
								default:
									echo '<div class="cartproduct"><div></div><div>[DESC?] Descuento</div><div></div><div></div></div>';
								break;
							}
						}
					?>
				</div>
				<div style="float:right; font-size: 20px; text-transform: uppercase; text-align: right; width: 340px;">
					<div style="float: left; width: 230px; text-align: left;">
						Base (sin IVA):<br>
						IVA (21%):<br>
						<?php if(getOrderInfo('discountprice', $id)) echo 'Descuentos:<br>';?>
						<?php if(getOrderInfo('aditionalprice', $id)) echo 'Cargos adicionales*:<br>';?>
						Envío:<br><br>
						<strong>Total:</strong>
					</div>
					<?=dotToComma(twoDecimals($totalcostWOvat))?>€<br>
					<?=dotToComma(twoDecimals($VAT))?>€<br>
					<?php if(getOrderInfo('discountprice', $id)) echo '- '.twoDecimals(getOrderInfo('discountprice', $id)).'€<br>';?>
					<?php if(getOrderInfo('aditionalprice', $id)) echo twoDecimals(getOrderInfo('aditionalprice', $id)).'€<br>';?>
					<?=dotToComma(getOrderInfo('shippingcost', $id))?>€<br><br>
					<?=dotToComma(twoDecimals($totalcost))?>€<br>
				</div>
				<div style="font-size: 20px; width: 600px; text-align: justify;">
					<strong>Comentarios del pedido:</strong><br>
					<?=nl2br($set['comments']);?>
				</div>
				<?php if(getOrderInfo('aditionalprice', $id)) echo '<div style="font-size: 20px; margin-top: 20px;"><strong>(*) Cargos adicionales:</strong> '. getOrderInfo('aditionalprice_text', $id).'</div>';?>
				<div style="clear: both"></div>
				<hr>
				<div style="font-size: 20px;">
					¡Muchas gracias, <?=$name?>, por hacer tu pedido en CreativeKits! Esperamos verte pronto de nuevo por aquí :)
				</div>
<div style="width: 960px; margin: 300px auto 0 auto; position: relative; top: 280px; color: rgba(000,000,000,0.6); font-size: 20px;">
CREATIVEKITS • CALLE PANADÉS 9 PISO 5 PUERTA 3, 28915 LEGANÉS (MADRID)<br>
NIF 08945145P • contacto@creativekits.es
</div>
</body>
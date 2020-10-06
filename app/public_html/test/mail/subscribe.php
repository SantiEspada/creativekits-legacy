<?php
session_start();
include('../inc.php');
$id = $_GET['id'];
$id = intval($id);
$mysqli->query("update users set email_subscription = 1 where id = $id");
?>
<!DOCTYPE html>
<html lang=es>
	<head>
		<meta charset="utf-8">
		<title>CreativeKits • Suscripción realizada</title>
	</head>
		<header>
			<div class="content">
				<div class="shoppingcart">
					<div class="icon">
						&#59197;
					</div>
					<a href="<?=$baseurl?>/cart/">Cesta de la compra</a>
					<?=countProducts($cart)?> artículo(s) - <?=dotToComma(twoDecimals($totalcostWOshipment))?>€
				</div>
				<a href="<?=$baseurl?>"><div class="logo"></div></a>
			</div>
		</header>
		<nav class="main">
			<div class="content">
				<?php showCats() ?>
			</div>
		</nav>
		</header>
		<div class="header header2">
			<div class="content">
				<a href="javascript:history.back();">&laquo; Volver atrás</a>
			</div>
		</div>
		<div class="fulltextbody">
			<div class="content">
				<?=showHappy('¡Bienvenido/a!', "Hemos añadido tu dirección a nuestra lista de correos. A partir de ahora recibirás promociones y ofertas de nuestra web.<br><br>No cederemos tu correo a terceras partes (¡odiamos el spam tanto como tú!)<div style=\"font-size: 14px; margin-top: 20px;\">¿Has llegado aquí por error? <a href=\"unsubscribe.php?id=$id\" style=\"color: rgba(000,000,000,0.7);\">pulsa aquí para dejar de recibir nuestros correos</a></div>")?>
			</div>
		</div>
		<div class="footer">
			<div class="content">
				<div class="right">
					Todos los precios incluyen IVA
				</div>
				<a href="<?php echo $baseurl ?>/legal/condiciones#envios">Envíos y formas de pago</a> • 
				<a href="<?php echo $baseurl ?>/legal/avisolegal">Aviso legal</a> • 
				<a href="<?php echo $baseurl ?>/legal/privacidad">Política de privacidad</a> • 
				<a href="<?php echo $baseurl ?>/legal/privacidad#cookies">Política de cookies</a> • 
				<a href="<?php echo $baseurl ?>/legal/condiciones">Condiciones de uso</a>
			</div>
		</div>
		<div class="footer footer2">
			<div class="content">
				<div class="right">
					<?=$socialLinks?>
				</div>
				&copy; 2013-2014 CreativeKits
			</div>
		</div>
	</body>
</html>

<link rel="stylesheet" href="<?php echo $baseurl ?>/css/main.css">
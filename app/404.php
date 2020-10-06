<?php
session_start();
include('inc.php');
?>
<!DOCTYPE html>
<html lang=es>
	<head>
		<meta charset="utf-8">
		<?=$keywords?>
		<title>CreativeKits • Error</title>
		<script>
 // Add a script element as a child of the body
 function downloadJSAtOnload() {
 var element = document.createElement("script");
 element.src = "<?=$baseurl?>/js/main.js";
 document.body.appendChild(element);
 }

 // Check for browser support of event handling capability
 if (window.addEventListener)
 window.addEventListener("load", downloadJSAtOnload, false);
 else if (window.attachEvent)
 window.attachEvent("onload", downloadJSAtOnload);
 else window.onload = downloadJSAtOnload;
</script>
	</head>
	<body onload="cookieLaw('CreativeKits');">
	<?=$discount?>
	<?=$analytics?>
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
				<?=showError()?>
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
				&copy; 2013 CreativeKits
			</div>
		</div>
	</body>
</html>

<link rel="stylesheet" href="<?php echo $baseurl ?>/css/main.css">
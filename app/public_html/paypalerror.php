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
		<link rel="stylesheet" href="<?php echo $baseurl ?>/css/reset.css">
		<link rel="stylesheet" href="<?php echo $baseurl ?>/css/main.css">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
		<script src="<?php echo $baseurl ?>/js/main.js"></script>
		<?php if(ifPlaySlider($id)){?>
		<script>
			$(function(){
    			$('#picgallery div:gt(0)').hide();
    			setInterval(function(){
    		  $('#picgallery div:first-child').fadeOut(500)
    		     .next('div').fadeIn(1000)
    		     .end().appendTo('#picgallery');}, 5000);
			});
		</script>
		<?php } ?>
	</head>
	<body>
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
					<a href="//facebook.com/X">Facebook</a> | <a href="//twitter.com/CreativeKitsES">Twitter</a> | <a href="//youtube.com/Susanaylosbaobas">YouTube</a> | <a href="<?php echo $baseurl ?>/blog">Blog</a> | <a href="mailto:contacto@creativekits.es">contacto@creativekits.es</a>
				</div>
				&copy; 2013 CreativeKits
			</div>
		</div>
	</body>
</html>
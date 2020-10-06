<?php session_start(); include('inc.php'); 

if($_GET['d']){
	$_SESSION['descuento'] = 'DESC'. $_GET['d'];
	?>
	<script>alert('¡Has obtenido un descuento! :)');</script>
	<?
}

if($_GET['logout']){
	session_destroy();
}
?>
<!DOCTYPE html>
<html lang=es>
	<head>
		<meta charset="utf-8">
		<?=$keywords?>
		<meta property="og:image" content="<?=$baseurl?>/img/facebookpic.jpg"/>
		<meta property="og:title" content="CreativeKits • Scrapbooking, kits creativos, regalos originales y mucho más ;)" />
		<title>CreativeKits • Scrapbooking, kits creativos, regalos originales y mucho más ;)</title>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script src="<?php echo $baseurl ?>/js/main.js"></script>
		<script>
			function mostrarAviso(){
 			  $('div#newproducts_overlay').lightbox_me();
 			  $('div#sanvalentin_overlay').lightbox_me();
			}
			setTimeout(mostrarAviso(), 0);
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
		<div class="featured" style="height: 275px !important; background: url(../img/salesbg.jpg) !important;">
			<div class="content slide" style="padding: 0 !important; height: 300px !important; background: url(../img/sliderebajas.png) !important;">
                <h1>
				<span style="margin-top: 35px; background: rgba(000,000,000,0.4);">¡REBAJAS!</span></h1>
				<div style="text-align: left; width: 390px; line-height: 120%;">
					¡Llegan maaaás descuentos a CreativeKits!<br><br>Con descuentos desde el 10%, encontrarás productos con ahorro de hasta el 50% - ¡No los dejes escapar!
				</div><span style="margin-top: 25px; background: rgba(000,000,000,0.4); font-size: 10px; text-transform: uppercase;">Descuentos válidos hasta el 28/02/2015</span>
			</div>
		</div>
		<div class="fpbottom">
			<div class="content">
				<div class="newproducts">
					<span>Novedades</span>
					<?php fpNewProduct() ?>
				</div>
				<div class="fpabout">
					<span class="title">¿Qué es CreativeKits?</span>
					CreativeKits surge de mi afición por el mundo de las manualidades, el arte y el scrapbooking. La idea es poder adquirir kits de productos que te faciliten la realización de trabajos y proyectos. La mayoría de los productos son exclusivos, buscando la originalidad e introducir novedades hasta ahora desconocidas en España, o difíciles de encontrar. Es por este motivo que trabajamos con unidades limitadas, y nuestra filosofía es la continua búsqueda de nuevos productos. Por tanto, es una tienda que va a ofrecerte, de manera continua, productos nuevos, originales y diferentes.
					<br>
					<br>Como el mundo de la creatividad y la imaginación no tiene edad, mi búsqueda abarca todas las edades; y no distingo entre hombre y mujer. Simplemente está pensado para personas que ocupan su tiempo creando ;) Por cierto, en el apartado "Productos Baobab" muestro mis trabajos, los cuales podeis adquirir a un precio muy asequible. Y también os invito a que sigáis mis tutoriales en YouTube (tenéis el enlace ahí abajo :P)<br>
					<br>
					Espero que os guste y disfrutéis con la selección que he realizado y los productos que iré introduciendo.
					<br><br>
					<strong>Susana Escolar</strong><br>
					Fundadora de CreativeKits
				</div>
			</div>
		</div>
		<div class="footer">
			<div class="content">
				<div class="right">
					Todos los precios incluyen IVA
				</div>
				<a href="<?php echo $baseurl ?>/legal/condiciones#envios">Envíos y formas de pago</a> • 
				<a href="<?php echo $baseurl ?>/legal/avisolegal">Aviso legal</a> • 
				<a href="<?php echo $baseurl ?>/legal/privacidad">Política de privacidad y cookies</a> • 
				<a href="<?php echo $baseurl ?>/legal/condiciones">Términos y condiciones</a>
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
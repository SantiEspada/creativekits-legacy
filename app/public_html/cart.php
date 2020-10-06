<?php
include('inc.php');
session_start();
if($_GET['add']){
	addToCart($_GET['add']);
	header("Location: $baseurl/cart/");
}
if($_GET['remove']){
	removeFromCart($_GET['remove']);
	header("Location: $baseurl/cart/");
}
$shippingtxt = dotToComma($shippingcost) . '€';
if($shippingwarning) $shippingtxt = 'Consultar';
?>
<!DOCTYPE html>
<html lang=es>
	<head>
		<meta charset="utf-8">
		<?=$keywords?>
		<title>CreativeKits • Cesta de la compra</title>
		<meta property="og:image" content="<?=$baseurl?>/img/facebookpic.jpg"/>
		<meta property="og:title" content="CreativeKits • Scrapbooking, kits creativos, regalos originales y mucho más ;)" />
		
		<link rel="stylesheet" href="<?php echo $baseurl ?>/css/main.css">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script src="<?php echo $baseurl ?>/js/main.js"></script>
		<script>
		$(window).load(function(){
			$( "#com_codes" ).keyup(function() {
				var text = $(this).val();
				if (text.indexOf("DESC") >= 0){
					checkCode(text);
				}
				saveComments(text);
			});
		});
		</script>
	</head>
	<body>
	<?=$discount?>
		<iframe class="loginframe" src="<?=$baseurl?>/login.php"></iframe>
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
		<div class="header">
			<div class="content">
				Cesta de la compra
			</div>
            
		</div>
		<div class="header header2">
			<div class="content">
				<a href="javascript:history.back();">&laquo; Volver atrás y seguir comprando</a>
			</div>
		</div>
		<div class="fulltextbody">
			<div class="content cartpage">
                <?/*
            switch($trespordos_remaining){
                case 0: 
                    ?><span style="font-size: 14px">¡Promo 3x2! Añade <strong>tres</strong> productos más (que no sean de liquidación) para llevarte uno gratis, el de menor importe.</span><?       break;

                case 1:
                    ?><span style="font-size: 14px">¡Promo 3x2! Añade <strong>un</strong> producto más (que no sea de liquidación) para llevarte uno gratis, el de menor importe.</span><?       break;

                default:
                    ?><span style="font-size: 14px">¡Promo 3x2! Añade <strong><?=$trespordos_remaining;?></strong> productos más (que no sean de liquidación) para llevarte uno gratis (el de menor importe)</span><?       break;
            }
?><br><br>
			<?php */if(count($cart) > 1){ ?>
				<div class="table">
					<div class="title">
						<div>Referencia</div><div>Nombre del producto</div><div>Cantidad</div><div>Precio</div>
					</div>
					<?php showCart($cart);
						if(!empty($_SESSION['descuento'])){
							$desc = $_SESSION['descuento'];
							switch($desc){
								case 'DESC10JU':
									echo '<div class="cartproduct"><div>DESC10JU</div><div>Descuento - 10% menos en artículos de regalo si el pedido es mayor a 30€</div><div></div><div></div></div>';
								break;
								case 'DESC2014':
									echo '<div class="cartproduct"><div>DESC2014</div><div>Descuento - 15% menos si el pedido es mayor a 30€</div><div></div><div></div></div>';
								break;
								case 'DESC14A':
									if($totalcost >= 50){
										echo '<div class="cartproduct"><div>DESC2014</div><div>Descuento (-5€ si el pedido es superior a 50€)</div><div>1</div><div>-5 €</div></div>';
									}
								break;
								default:
									echo '<div class="cartproduct"><div>?</div><div>Descuento</div><div></div><div></div></div>';
								break;
							}
						}
					?>
				</div>
				<hr>
				<div style="float:right; font-size: 14px; text-transform: uppercase; text-align: right; margin-top: 5px; width: 220px;">
					<div style="float: left; width: 160px; text-align: left;">
						Base (sin IVA):<br>
						IVA (21%):<br>
						Envío:<br><br>
						<strong>Total:</strong>
					</div>
					<?=dotToComma(twoDecimals($totalcostWOvat))?>€<br>
					<?=dotToComma(twoDecimals($VAT))?>€<br>
					<?=$shippingtxt?><br><br>
					<?=dotToComma(twoDecimals($totalcost))?>€<br>
					<a href="javascript:placeOrder();" class="button">Realizar pedido</a><br>
				</div>
				Comentarios del pedido (y códigos de descuento):<br>
				<textarea id="com_codes" style="width: 650px; margin-top: 4px; min-height: 90px;" rows="3" placeholder="Introduce aquí comentarios que consideres oportunos, como el color de un artículo o el modelo. También puedes introducir códigos descuento. Los comentarios se guardan automáticamente a los pocos segundos de ser escritos, no te preocupes por cerrar la pestaña o seguir comprando :)"><?=$_SESSION['comments']?></textarea>
				<br>
				<hr>
				<span style="font-size: 10px; color: rgba(000,000,000,0.3); text-transform: uppercase;">Podrás crear una cuenta (o iniciar sesión) e introducir tu dirección de envío en el siguiente paso</span>
			<?php } else {showError('¡Esto está vacío!', 'Vaya... parece que no has añadido ningún producto todavía a tu cesta de la compra');}?>
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
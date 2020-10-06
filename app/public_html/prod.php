<?php
include('inc.php');
session_start(); 
$id = $_GET['id'];
$pictureglob = glob("./imgpr/$id/*.*");
$picture = './img/nophoto.png';
if(count($pictureglob) > 0){
	$picture = utf8_encode(str_replace(' ', '%20', $pictureglob[0]));
}
$cat = getProdInfo('cat', $id);
$liq = false;
$liq3 = false;
$liqdiscount = 1;
if(strpos($cat, ' 7,') !== false){
	$liq = true;
	$liqdiscount = .5;
	$liqpercent = "50%";
} else if(strpos($cat, ' 50,') !== false){
	$liq = true;
	$liqdiscount = .7;
	$liqpercent = "30%";
} else if(strpos($cat, ' 62,') !== false){
	$liq = true;
	$liqdiscount = .9;
	$liqpercent = "10%";
}
$price = getPrice($id);
$price = $price * $liqdiscount;
$price = ($preciosredondos ? floor($price) : twoDecimals($price));
if($preciosredondos && $price < 1) $price = 1;
/*
$okcats = array('37', '38', '39', '40', '41', '25', '27', '29', '31', '32', '4', '5');

$catarray = str_replace(' ', '', $cat);
$catarray = explode(',', $catarray);

foreach($catarray as $k){
	if(in_array($k, $okcats)){
		$liq3 = true;
	}
}
*/
$video = 0;
if(strlen(getProdInfo('video', $id)) >= 1){
	$video = 1;
}
if($video){
	$embed = '<iframe id="ytplayer" type="text/html" width="580" height="325"
  src="http://www.youtube.com/embed/'.getProdInfo('video', $id).'"
  frameborder="0"></iframe>';
}
?>
<!DOCTYPE html>
<html lang=es>
	<head>
		<meta charset="utf-8">
		<?=$keywords?>
		<meta name="description" content="<?php
					$descr = utf8_decodeAlt(getProdInfo('descr', $id));
					$descr = str_replace('â€¢', '•', $descr);
					$descr = explode('{', $descr);
					echo croptxt($descr[0], 75);
				?>"/>
		<meta property="og:image" content="<?=$baseurl?>/<?=$picture?>"/>
		<meta property="og:title" content="<?=utf8_decodeAlt(getProdInfo('name', $id))?>" />
		<meta property="og:description" content="<?php
					$descr = utf8_decodeAlt(getProdInfo('descr', $id));
					$descr = str_replace('â€¢', '•', $descr);
					$descr = explode('{', $descr);
					echo croptxt($descr[0], 75);
				?>"/>
		<title>CreativeKits • <?=utf8_decodeAlt(getProdInfo('name', $id))?></title>
		
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
		<div class="header header2" style="font-size: 14px; padding: 20px 0;">
			<div class="content">
				<div style="float:right; width: 200px; margin-top: -4px;"><gcse:search></gcse:search></div><a href="javascript:history.back();">&laquo; Volver atrás</a>
			</div>
		</div>
		<div class="fulltextbody">
			<div class="content productpage">
				<div style="float:left;">
					<div id="picgallery">
						<?php getProdPictures($id) ?>
					</div>
					<span style="font-size: 12px; color: rgba(000,000,000,0.4); position: relative; top: -25px; left: 15px;">Haz clic en una imagen para ampliarla</span>
					
				</div>
				<span style="font-size: 24px;"><?=getProdInfo('name', $id)?></span>
				<hr>
				<?php 
				if(getProdInfo('stock', $id) > 0){
				if($liq){?>
				<strong style="font-size: 16px; text-decoration: line-through; color: rgba(000,000,000,0.8);"><?=dotToComma(getProdInfo(cost, $id))?></strong> <strong style="font-size: 20px; color: red;"><?=dotToComma($price)?> &euro;</strong> <a class="addtocartbtn" href="<?=$baseurl?>/cart/?add=<?=$id?>">Añadir a la cesta</a><br>
				<span style="font-size: 12px;">¡Descuentos, descuentos! <?=$liqpercent?> de descuento aplicado en este producto :)</span>
				<?php } else { ?>
				<strong style="font-size: 20px;"><?=dotToComma($price)?> &euro;</strong> <a class="addtocartbtn" href="<?=$baseurl?>/cart/?add=<?=$id?>">Añadir a la cesta</a><br>
				<?php }

				} else {
					?>
				<strong style="font-size: 20px; color: rgba(000,000,000,0.3); font-weight: normal !important;"><?=dotToComma($price)?> &euro;</strong> <a class="addtocartbtn" href="#">SIN STOCK</a><br>
				<span style="font-size: 12px;">¡Lo sentimos! Actualmente no tenemos stock de este producto</span>
					<?
					} ?>
				<hr>
				<?php
					$descr = utf8_decode(utf8_encode(getProdInfo('descr', $id)));
					$descr = explode('{', $descr);
					echo $descr[0];
					echo '<br><br>';
				?>
				<?php if($video){ ?>
					<div id="picgallery2">
						<?=$embed?>
						<span style="font-size: 12px; color: rgba(000,000,000,0.4); position: relative; top: 5px;">¿Qué hacer con este producto? ¡Te damos ideas!</span>
					</div>
				<?php } ?>
                <div style="clear: both; height: 30px;"></div>
                <h2>También podría interesarte... :)</h2><hr>
                    <?=showRelatedProducts($id);?>
			</div>
            <div style="clear:both;"></div>
		</div>
		</header>
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
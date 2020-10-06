<?php include('inc.php'); session_start(); $id = $_GET['id']; ?>
<!DOCTYPE html>
<html lang=es>
	<head>
		<meta charset="utf-8">
		<?=$keywords?>
		<meta property="og:image" content="<?=$baseurl?>/img/facebookpic.jpg"/>
		<meta property="og:title" content="<?php echo utf8_decodeAlt(getCatInfo('name', $id)) ?>" />
		<title>CreativeKits • <?php echo utf8_decodeAlt(getCatInfo('name', $id)) ?></title>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script src="<?php echo $baseurl ?>/js/main.js"></script>
<script>
	function mostrarAviso(){
 		$('div#newproducts_overlay').lightbox_me();
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
				<?php showCats($id) ?>
			</div>
		</nav>
		<div class="header">
			<div class="content">
				<div style="float:right; width: 200px;"><gcse:search></gcse:search></div><?php echo utf8_decodeAlt(getCatInfo('name', $id)) ?>
			</div>
		</div>
		<div class="header header2">
			<div class="content" style="line-height: 1.9 !important;">
				<?php if($id == 7){ echo '¡Productos en liquidación! Descuento directo en todos estos productos :)';} else {echo substr(showSubCats($id), 0, -9);}?>
			</div>
		</div>
		<div class="products">
			<div class="content">
				<?php /*$products = getAllCatProducts($id); showProducts($products); if($id == 3){$products = getSubCatProducts($id); showSubCatProducts($products);}*/
                
                foreach(getSubcats($id) as $key=>$subcat){
                    showSubCatProducts(getSubCatProducts($subcat));
                }
                
                if($id == 3){showSubCatProducts(getSubCatProducts(3));}

                if($id == 7){showSubCatProducts(getSubCatProducts(7));}

                ?>
			</div>
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
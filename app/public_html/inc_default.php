<?php
error_reporting(E_ERROR | E_PARSE);
date_default_timezone_set('Europe/Madrid');
session_start();
/*if($_SESSION['descuento'] == 'DESC2014') $_SESSION['descuento'] = '';*/

if(isset($_GET['key']) && $_GET['key'] == '1234567890abc'){
	$_SESSION['betaok'] = true;
}

if($_SESSION['betaok'] != true){
	include('maintenance.php');
	die();
}

/*$discount = '<div style="position: float; width: 100%; padding: 10px 0; font-family: \'Open Sans\'; color: rgba(255,255,255,.6); font-size: 12px; background: rgba(000,000,000,0.6); box-shadow: inset 0 -5px 10px rgba(000,000,000,0.6); z-index: 999; text-align: center; text-transform: uppercase;"><span style="color: #ec5e00; font-size: 14px;">[!]</span> ¡Descuentos de año nuevo en CreativeKits! 15% de descuento en pedidos mayores a 30€ - Código: <span style="background: rgba(255,255,255,0.2); box-shadow: 0 0 5px rgba(000,000,000,0.6); padding: 2px 4px; border-radius: 2px;">DESC2014</span> ;)</div>';
*/
$val = array('dummyval' => 1);
$cart = serialize($val);
if(empty($_COOKIE['ck_shoppingcart'])){
	$val = array('dummyval' => 1);
	setcookie('ck_shoppingcart', serialize($val), time()+259200, '/', '.creativekits.es');
} else {
	global $cart;
	$cart = unserialize($_COOKIE['ck_shoppingcart']);
}
$keywords = '<meta name="keywords" content="Tienda online, scrapbook, scrapbooking, manualidades, original, divertido, exclusivo, barato, económico, asequible, papel scrapbook, kits inicio scrapbook, scrapbook para principiantes, productos importados, papelería niños, sellos estampación, dibujo, manga, tye-dive, zentangle, quilling, maskingtape, mashi tape, celo japonés, regalos, creativo, creatividad, hazlo tú mismo, álbumes fotos, marcos fotos, kits, lotes, ribbon, cintas, papel decorado, libros, juguetes, artesanal, hecho a mano, para regalo, adorno scrapbook, scrap, tutorales, vídeos, paso a paso, magnético, mickey, minie, cajas regalo, vintage, retro, papelería, stickers, brads, ojales, ojetes, tijeras, pegamento, tarjetas regalo, christmas, álbumes, álbum, bebe, niño, niña, romántico, love, papelkraft, papel kraft, bolsas de papel, anillas, agendas, libretas, diario, papiroflexia, origami, navidad, vacaciones, importado, diferente, imaginación, creativo, surtido, iniciarse, principiante, minialbum, boda, wedding, novios, regalo, present, gift, sobres, paquetes, cajas, bolsas, tags, troquelados, hombre, mujer, regalos de hombre, regalos de mujer, pinzas, pizarra, clips, chipboard, cartón, metal, madera, caucho, silicona, pinturas, colores, infantil, magnético, crear, jugar, divertido, encuadernar, encuadernación, dibujo, princesas, escobillones, soporte para portátil, funda iPad, marcos de fotos, cajas de madera, cajas metálicas, cajas de cartón, libreta con imán, álbum de estrella, álbum campana, álbum chipboard, pinturas tie-dyed, pinzas colones, pinzas bebé niño, pinzas bebé niña, saco regalo, rotulador dorado, rotulador plateado, cola blanca, cinta de doble cara, regla, base de corte, cutter, plantillas sobre, plantilla madera, kit de postit, postit parís, postit de música, postit de cupcakes, postit viajes, marcos foto resina, marcos foto madera, adorno navidad fieltro, adorno navidad madera, adornos madera flores, tarjeta regalo, collares trapillo, trapillo, kit de scrapbook para niños, kits de sellos para niños, kit de estampación para niños, kit de juegos magnéticos para niños, kit de tampones de tinta, sellos de madera, kit de sellos, caja metálica tarjetas para regalar, estuche bolígrafo centangle, papel origami, kit de cintas vintage, kit de cintas navideñas, cinta navideña organiza, cinta de raso, cinta de algodón, cinta de organa con adornos navideños, estuche botellas vino, tablero portanotas con pinzas, caja madera con marco de fotos, estuche de fieltro, shape cutter, fiskars, tool kit, kit de herramientas, tijeras fantasía, tijeras manualidades, disco kumihimo, kit regalo álbum scrapbook, kit estampación, sellos de animales, sellos de princesas, sellos de coches, sellos de bicis, sellos de motos, muñeco magnético oficios, muñeca magnética princesa, kit de adornos scrapbook, precortados, etiquetas, papel quilling, quilling tool, álbumes de fotos, caja de clips, clips metálicos, pinzas metálicas, pinzas con pizarra, figuras de madera adhesivas, christmas pop-up, brillantinas, perlitas, rinhstones, strass, estuches acetato, regalos niños, regalos originales, regalos divertidos, regalos creativos, regalos diferentes, económico, kits exclusivos, importado de EEUU, importado de Italia, importado de Alemania, baobabs, susana y los baobabs, creativekits, creativekit.es, flores de madera, paquetería, cintas regalo, cintas con glitter">
<meta name="description" content="Scrapbooking, regalos originales, kits creativos ¡y mucho más! Visítanos y te sorprenderás ;)">
<meta property="og:site_name" content="CreativeKits"/>';
$analytics = "<script>
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-46497275-1']);
_gaq.push(['_trackPageview']);
(function() {
var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true; 

ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';

var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();
</script>";
$newproducts_overlay = '<div id="newproducts_overlay">
	<img src="http://www.creativekits.es/img/newproductspic.png">
	<div class="title"><a href="#" class="close">Cerrar</a>¡Busca las novedades!</div>
	<div>
		Te proponemos descubrir nuestras novedades de forma creativa. Busca los productos con marco naranja ¡son nuevos! :)
	</div>
</div>';
if($_COOKIE['newproducts_overlay'] != 'SHOWN'){
	setcookie('newproducts_overlay', 'SHOWN', time()+259200, '/', '.creativekits.es');
	echo $newproducts_overlay;
}
$socialLinks = '<a href="//facebook.com/CreativeKits" target="_new">Facebook</a> | <a href="//youtube.com/Susanaylosbaobas" target="_new">YouTube</a> | <a href="mailto:contacto@creativekits.es">contacto@creativekits.es</a>';
/*
function injections($val) {
        $val = preg_replace('/([\x00-\x08][\x0b-\x0c][\x0e-\x20])/', '', $val); //Borramos todos los elementos que no pertenezcan a la codificación web.
 
        
        $search = 'abcdefghijklmnopqrstuvwxyz'; //Caracteres admitidos
        $search .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'; //Caracteres admitidos
        $search .= '1234567890!@#$%^&*()'; //Caracteres admitidos
        $search .= '~`";:?+/={}[]-_|\'\\'; //Caracteres admitidos
        for ($i = 0; $i < strlen($search); $i++) {
            $val = preg_replace('/(&#38;#[x|X]0{0,8}'.dechex(ord($search[$i])).';?)/i', $search[$i], $val); //Buscamos valores HEX
            $val = preg_replace('/(&#38;#0{0,8}'.ord($search[$i]).';?)/', $search[$i], $val); // Ahora con ;
        }
        //Array de todo lo que queremos evitar
        $ra1 = Array('javascript', 'vbscript', 'expression', 'applet', 'meta', 'xml', 'blink', 'link', 'style', 'script', 'embed', 'object', 'iframe', 'frame', 'frameset', 'ilayer', 'layer', 'bgsound', 'title', 'base');
        $ra2 = Array('onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavailable', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate', 'onfilterchange', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove', 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onrowenter', 'onrowexit', 'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload');
        $ra = array_merge($ra1, $ra2);
 
        $found = true; // Reemplazamos las vulnerabilidades
        while ($found == true) {
            $val_before = $val;
            for ($i = 0; $i < sizeof($ra); $i++) {
                $pattern = '/';
                for ($j = 0; $j < strlen($ra[$i]); $j++) {
                    if ($j > 0) {
                        $pattern .= '(';
                        $pattern .= '(&#38;#[x|X]0{0,8}([9][a][b]);?)?';
                        $pattern .= '|(&#38;#0{0,8}([9][10][13]);?)?';
                        $pattern .= ')?';
                }
                $pattern .= $ra[$i][$j];
             }
             $pattern .= '/i';
             $replacement = substr($ra[$i], 0, 2).'*'.substr($ra[$i], 2); // Quitar <>
             $val = preg_replace($pattern, $replacement, $val); // Filtrar tags HEX
             if ($val_before == $val) {
                // ¿No se reemplazó nada? ¡Escapamos!
                $found = false;
             }
          }
        }
 
        return $val;
    }
/*
$input_arr = array();
foreach ($_POST as $key => $input_arr)  //Buscamos y depuramos todas las variables $_POST
{ 
 $_POST[$key] = addslashes(injections($input_arr)); 
}
 
$input_arr = array(); 
foreach ($_GET as $key => $input_arr) //Buscamos y depuramos todas las variables $_GET
{ 
 $_GET[$key] = addslashes(injections($input_arr)); 
}
$input_arr = array(); 
}*/
$mysqli = new mysqli('mysql', 'creativekits', '12345678', 'creativekits');
$mysqli->set_charset("utf8");
$baseurl = 'http://www.creativekits.es';

function croptxt($txt, $limit=100){   
    $txt = trim($txt);
    $txt = strip_tags($txt);
    $size = strlen($txt);
    $result = '';
    if($size <= $limit){
        return $txt;
    }else{
        $txt = substr($txt, 0, $limit);
        $words = explode(' ', $txt);
        $result = implode(' ', $words);
        $result .= '...';
    }   
    return $result;
}
function seoName($string){
    $string = preg_replace('~&([a-z]{1,2})(acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($string, ENT_QUOTES, 'UTF-8'));
    return(str_replace(' ', '-', $string));
}
function showError($title = '¡Lo sentimos! Ha ocurrido un error desconocido', $text = 'Pero, tranquilo, nuestro equipo de monos ingenieros altamente cualificados está trabajando en el problema ;)'){
	echo "	<div class=\"error\">
				<div>:(</div>
				<span>$title</span>
				$text
			</div>";
}
function showHappy($title = '¡Lo sentimos! Ha ocurrido un error desconocido', $text = 'Pero, tranquilo, nuestro equipo de monos ingenieros altamente cualificados está trabajando en el problema ;)'){
	echo "	<div class=\"error\">
				<div>:)</div>
				<span>$title</span>
				$text
			</div>";
}
function showError2(){
	$error = error_get_last();
	$errno = $error['type'];
	$title = "¡Lo sentimos! Ha ocurrido un error ($errno)";
	$text = "Pero, tranquilo, nuestro equipo de monos ingenieros altamente cualificados está trabajando en el problema<br>
Por cierto, si les ves, dales el número que está entre paréntesis. Les ayudarás mucho :)";
	echo '<html style="background: #000;">';
	echo "<link rel=\"stylesheet\" href=\"$baseurl/css/main.css\">";
	echo "	<div class=\"error2\">
				<div>:(</div>
				<span>$title</span>
				$text
			</div>";
	echo '</html>';
}
function showCats($cat=NULL){
	global $baseurl;
	global $mysqli;
	$query = 'SELECT * FROM `cat`';
	$result = $mysqli->query($query);
	while($row = $result->fetch_object()){
		$id = $row->id;
		$catname = $row->name;
		$seoname = str_replace(' ', '-', $catname);
		$seoname = str_replace('ú', 'u', $seoname);
		$seoname = str_replace('ñ', 'n', $seoname);
		if($row->parent == NULL && $id != 7 && $id != 51 && $id != 53 && $id != 2){
			$word = explode(' ', $catname);
			$name = $word[0].'<strong>'.$word[1].'</strong>';
			if($cat == $id){
				echo "<a href=\"$baseurl/cat/$id/$seoname/\" class=\"active\">$name</a> ";
			} else {
				echo "<a href=\"$baseurl/cat/$id/$seoname/\">$name</a> ";
			}
		}
	}
	if($cat == 7){
		echo "<a href=\"$baseurl/cat/7/Liquidacion/\" class=\"active\"><strong>Liquidación</strong></a>";
	} else {
		echo "<a href=\"$baseurl/cat/7/Liquidacion/\"><strong>Liquidación</strong></a>";
	}
}
function showSubCats($parent){
	global $baseurl;
	global $mysqli;
	$query = "SELECT * FROM `cat` WHERE `parent` = $parent";
	$result = $mysqli->query($query);
	$return = '';
	while($row = $result->fetch_object()){
		$id = $row->id;
		$name = $row->name;
		$seoname = seoName($name);
		$return .= "<a href=\"$baseurl/subcat/$id/$seoname/\">$name</a> &#8226; ";
	}
	return($return);
}
function showCats2(){
	global $mysqli;
	$query = 'SELECT * FROM `cat`';
	$result = $mysqli->query($query);
	while($row = $result->fetch_object()){
		$id = $row->id;
		$parent = utf8_encode($row->parent);
		$catname = $row->name;
		if($parent){
			echo "<br>$id -> $catname (Subcat. de $parent)";
		} else {
			echo "<br>$id -> $catname";
		}
	}
}
function fpNewProduct(){
	global $mysqli;
	global $baseurl;
	$query = "SELECT * FROM `products` WHERE `cat` <> ' 0, ' ORDER BY `id` DESC LIMIT 1";
	$result = $mysqli->query($query);
	$row = $result->fetch_object();
	$id = $row->id;
	$name = $row->name;
	$seoname = seoName($name);
	$picture = glob("./imgpr/$id/*.*");
	$picture = $picture[0];
	echo "	<div>
							<a href=\"$baseurl/prod/$id/$seoname/\">
								<img src=\"$baseurl/img/blank.gif\" style=\"background-image: url($baseurl/$picture)\">
								$name
							</a>
						</div>";
}
function showSubCatProducts($parent){
	global $mysqli;
	$query = "SELECT * FROM `cat` WHERE `parent` = $parent";
	$result = $mysqli->query($query);
	while($cat = $result->fetch_object()){
		$catid = $cat->id;
		$catid2 = ' '.$catid.', ';
		$query2 = "SELECT * FROM `products` WHERE `cat` = $catid OR `cat` LIKE concat('%', '$catid2', '%') ORDER BY `id`";
		$result2 = $mysqli->query($query2);
		while($row2 = $result2->fetch_object()){
			$id = $row2->id;
			$name = utf8_decodeAlt($row2->name);
			$name = str_replace('&quot;', '"', $name);
			$cropname = croptxt($name, 40);
			$seoname = seoName($name);
			$pictureglob = glob("./imgpr/$id/*.*");
			$picture = './img/nophoto.png';
			$stock = $row2->stock;
			if(count($pictureglob) > 0){
				$picture = utf8_encode(str_replace(' ', '%20', $pictureglob[0]));
			}
		if($stock >=1){
			if($row2->new == 1){
			echo "	<div class=\"product newproduct\">
					<a href=\"$baseurl/prod/$id/$seoname/\">
						<img src=\"$baseurl/img/blank.gif\" style=\"background-image: url($baseurl/$picture)\">
						$cropname
					</a>
				</div>";
			} else {
				echo "	<div class=\"product\">
					<a href=\"$baseurl/prod/$id/$seoname/\">
						<img src=\"$baseurl/img/blank.gif\" style=\"background-image: url($baseurl/$picture)\">
						$cropname
					</a>
				</div>";
				}
			}
		}
	}
}
function showIfCatEmpty($catid){
	global $mysqli;
	global $baseurl;
	$catid2 = ' '.$catid.', ';
	$query = "SELECT * FROM `products` WHERE `cat` = $catid OR `cat` LIKE concat('%', '$catid2', '%')";
	$result = $mysqli->query($query);
	if($result->num_rows <= 0){
		echo showError('¡Esto está vacío!', 'Pero, tranquilo, seguro que en breve añadiremos productos maravillosos en esta categoría ;)');
	}
}
function showProducts($catid){
	global $mysqli;
	global $baseurl;
	$catid2 = ' '.$catid.', ';
	$query = "SELECT * FROM `products` WHERE `cat` = $catid OR `cat` LIKE concat('%', '$catid2', '%') ORDER BY `id`";
	$result = $mysqli->query($query);
	while($row = $result->fetch_object()){
		$id = $row->id;
		$name = utf8_decodeAlt($row->name);
		$name = str_replace('&quot;', '"', $name);
		$cropname = croptxt($name, 40);
		$seoname = seoName($name);
		$pictureglob = glob("./imgpr/$id/*.*");
		$picture = './img/nophoto.png';
		$stock = $row->stock;
		if(count($pictureglob) > 0){
			$picture = utf8_encode(str_replace(' ', '%20', $pictureglob[0]));
		}
		if($stock >=1){
			if($row->new == 1){
			echo "	<div class=\"product newproduct\">
					<a href=\"$baseurl/prod/$id/$seoname/\">
						<img src=\"$baseurl/img/blank.gif\" style=\"background-image: url($baseurl/$picture)\">
						$cropname
					</a>
				</div>";
			} else {
				echo "	<div class=\"product\">
					<a href=\"$baseurl/prod/$id/$seoname/\">
						<img src=\"$baseurl/img/blank.gif\" style=\"background-image: url($baseurl/$picture)\">
						$cropname
					</a>
				</div>";
			}
		}
	}
}
function getCatInfo($roww, $id){
	global $mysqli;
	$query = "SELECT * FROM `cat` WHERE ID = $id";
	$result = $mysqli->query($query);
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
function dotToComma($string){
	return(str_replace('.', ',', $string));
}
function commaToDot($string){
	return(str_replace(',', '.', $string));
}
function getProdPictures($id){
	global $baseurl;
	$pictureglob = glob("./imgpr/$id/*.*");
	if(count($pictureglob) > 0){
		foreach($pictureglob as $pic){
			$picc = utf8_encode(str_replace(' ', '%20', $pic));
			echo "<div style=\"background-image: url($baseurl/$picc);\"><a href=\"javascript:lbmePhoto('$baseurl/$picc');\"><img src=\"$baseurl/img/blank.gif\"></a></div>";
		}
	} else {
		echo "<div style=\"background-image: url($baseurl/img/nophoto.png);\"></div>";
	}
}
function utf8_decodeAlt($string){
	return(utf8_decode(utf8_encode($string)));
}
function ifPlaySlider($id){
	$return = false;
	$pictureglob = glob("./imgpr/$id/*.*");
	if(count($pictureglob) > 1){
		$return = true;
	}
	return($return);
}
function showCart($cart){
	global $mysqli;
	global $baseurl;
	global $totalcost;
	foreach($cart as $prodid => $prodqt){
		if($prodid != 'dummyval'){
			$query = "SELECT * FROM `products` WHERE `id` = $prodid";
			$result = $mysqli->query($query);
			$result = $result->fetch_object();

			$name = utf8_decodeAlt($result->name);
			$seoname = seoName($name);
			$cost = $result->cost;
			$cost = $cost * $prodqt;
			$cost = removeVAT($cost);

			$categoria = $result->cat;
			$liq = false;
			$liq2 = false;
			$liq3 = false;
			if(strpos($categoria, ' 7,') !== false){
				$liq = true;
				$liq3 = false;
			} else if(strpos($categoria, ' 50, ') !== false){
				$liq2 = true;
				$liq3 = false;
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
			if($liq == true){ $cost = $cost * 0.5; } else if($liq2 == true){ $cost = $cost * 0.7; } else if($liq3 == true){ $cost = $cost * 0.95; } else {
			switch($_SESSION['descuento']){
				case 'DESC30FB':
				if(getTotalCost($cart) >= 30){
					$okcat = array(4, 25, 27, 29, 31, 32);
					$descok = false;
					foreach($okcat as $cat){
						if(strpos($result->cat, ' '.$cat.',') !== false){
							$descok = true;
						}
					}
					if($descok == true){
						$cost = $cost * 0.75;
					}
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
			$cost = dotToComma($cost);

			echo "<div class=\"cartproduct\">
							<div>$prodid</div><div><a href=\"$baseurl/prod/$prodid/$seoname/\">$name</a></div><div>$prodqt • <a class=\"icon\" href=\"$baseurl/cart/?add=$prodid\">Más</a> • <a class=\"icon\" href=\"$baseurl/cart/?remove=$prodid\">Menos</a></div><div>$cost €</div>
						</div>";
		}
	}
}
function removeFromCart($id){
	global $cart;
	if(!empty($cart[$id])){
		if($cart[$id] == 1){
			unset($cart[$id]);
		} else {
			$cart[$id] = $cart[$id] - 1;
		}
	}
	setcookie('ck_shoppingcart', serialize($cart), time()+259200, '/', '.creativekits.es');
}
function addToCart($id){
	global $cart;
	if(!empty($cart[$id])){
		$proposedstock = $cart[$id] + 1;
		if(getProdInfo('stock', $id) > $proposedstock){
			$cart[$id] = $proposedstock;
		} else {
			echo '<script>alert("No tenemos taaaanto stock de ese producto :( ¡Lo sentimos!");</script>';
		}
	} else {
		$cart[$id] = 1;
	}
	setcookie('ck_shoppingcart', serialize($cart), time()+259200, '/', '.creativekits.es');
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
				$cost = $cost * 0.5;
			} else if(strpos($categoria, ' 50,') !== false){
				$cost = $cost * 0.7;
			}
			/*
			if($descapplied != true){
				if(strpos($categoria, ' 7,') == false && strpos($categoria, ' 50, ') == false){
					$cost = $cost * 0.95;
					$descapplied = true;
				}
			}
			*/
			$cost = $cost * $prodqt;
			$totalcost = $totalcost + $cost;
		} else {
			$totalcost = 0;
		}
	}
	return($totalcost);
}
function applyDiscount(){
	global $mysqli;
	global $totalcost;
	global $cart;
	switch($_SESSION['descuento']){
		case 'DESC30FB':
			if($totalcost >= 30){
				$totalcost = 0.00;
				foreach($cart as $prodid => $prodqt){
					if($prodid != 'dummyval'){
						$query = "SELECT * FROM `products` WHERE `id` = $prodid";
						$result = $mysqli->query($query);
						$result = $result->fetch_object();

						$cost = $result->cost; 
						$cost = $cost * $prodqt;

						$totalcost = $totalcost + $cost;
						$okcat = array(4, 25, 27, 29, 31, 32);
						$descok = false;
						
						foreach($okcat as $cat){
							if(strpos($result->cat, ' '.$cat.',') !== false){
								$descok = true;
							}
						}
						if($descok == true){
							$totalcost = $totalcost - $cost;
							$cost = $cost * 0.75;
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
							$liq3 = false;
						} else if(strpos($categoria, ' 50, ') !== false){
							$liq2 = true;
							$liq3 = false;
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
						if($liq == true){ $cost = $cost * 0.5; } else if($liq2 == true){ $cost = $cost * 0.7; } else if($liq3 == true){ $cost = $cost * 0.95; } else {
							$cost = $cost * 0.85;}
							$totalcost = $totalcost + $cost;
						}
					}
				}
		default:
		break;
	}
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
function twoDecimals($val){
	return(round($val*100)/100);
}
function countProducts($cart){
	$qt = 0;
	foreach($cart as $prodid => $prodqt){
		if($prodid != 'dummyval'){
			$qt = $qt + $prodqt;
		}
	}
	return($qt);
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
	$result = $mysqli->query($query);
	$row = $result->fetch_object();
	return($row->$roww);
}
function processOrder($c){
	global $mysqli;
	foreach($c as $prod => $qt){
		if($prod != 'dummyval'){
		$query = "SELECT * FROM `products` WHERE ID = $prod";
		$result = $mysqli->query($query);
		if($mysqli->error){
			die($mysqli->error);
		}
		$row = $result->fetch_object();
		$qt2 = $row->stock - 1;

		$query2 = "UPDATE `products` SET `stock` = $qt2 WHERE `products`.`id` =$prod;";
		$result = $mysqli->query($query2);
	}
	}
    
    return(true);
}
if(!empty($cart)){
	$totalcost = getTotalCost($cart);
	if($totalcost >= 1){
	applyDiscount();}
	if($_SESSION['descuento'] == 'DESC14A' && $totalcost >= 50 && $_COOKIE['DESC14AUSED'] != 'yes'){
		$totalcost = $totalcost - 5;

	}
	$totalcostWOvat = removeVAT($totalcost);
	$VAT = $totalcost - $totalcostWOvat;
	$weight = getTotalWeight($cart);
	$shippingcost = 0;
	if($weight > 0 && $weight <= 500){
		$shippingcost = 2.90;
	} elseif($weight > 500 && $weight <= 3000){
		$shippingcost = 6.90;
	} elseif($weight > 3000 && $weight <= 10000){
		$shippingcost = 8.90;
	} else {
		$shippingcost = 0;
		$shippingwarning = true;
	}
	if($totalcost >= 100){
		$shippingcost = 0;
	}

	if(strpos($_SESSION['comments'], '20OFF14A') !== false){
		/*$totalcost = $totalcost * 1.05;*/
		$totalcost = $totalcost * 0.8;
	}

	if(strpos($_SESSION['comments'], 'ENVIO14A') !== false){
		$shippingcost = 0;
	}
	$totalcostWOshipment = $totalcost;
	$totalcost = $totalcost + $shippingcost;

	if($_SESSION['descuento'] == 'DESC14A' && $totalcost >= 50 && $_COOKIE['DESC14AUSED'] != 'yes'){
		$totalcost = $totalcost - 5;
	}
}
?>
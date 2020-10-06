<?php
error_reporting(E_ERROR | E_PARSE);
date_default_timezone_set('Europe/Madrid');


$trespordos_on = false;
unset($_SESSION['3x2_p']);
unset($_SESSION['3x2_disc']);
unset($_SESSION['3x2_rcost']);
$vat_desc = false;
$preciosredondos = false;

/*if($_SESSION['descuento'] == 'DESC2014') $_SESSION['descuento'] = '';*/

if($_COOKIE['testsite_access'] !== 'GRANTED'){
	$output = file_get_contents('http://nginx:80/maintenance.php');
	die($output);
}


/*$discount = '<div style="position: float; width: 100%; padding: 10px 0; font-family: \'Open Sans\'; color: rgba(255,255,255,.6); font-size: 12px; background: rgba(000,000,000,0.6); box-shadow: inset 0 -5px 10px rgba(000,000,000,0.6); z-index: 999; text-align: center; text-transform: uppercase;"><span style="color: #ec5e00; font-size: 14px;">[!]</span> ¡Descuentos de año nuevo en CreativeKits! 15% de descuento en pedidos mayores a 30€ - Código: <span style="background: rgba(255,255,255,0.2); box-shadow: 0 0 5px rgba(000,000,000,0.6); padding: 2px 4px; border-radius: 2px;">DESC2014</span> ;)</div>';
*/

if(isset($_GET['key']) && $_GET['key'] == 'testuser'){
	$_SESSION['testuser'] = 'OK';
}

$val = array('dummyval' => 1);
$cart = serialize($val);
if(empty($_COOKIE['ckt_shoppingcart'])){
	$val = array('dummyval' => 1);
	setcookie('ckt_shoppingcart', serialize($val), time()+259200, '/', 'localhost');
} else {
	global $cart;
	$cart = unserialize($_COOKIE['ckt_shoppingcart']);
}
$keywords = '<div id="testsite_warning" style="z-index: 9999; background: red; font-size: 15px; color: #FFF; width: 100%; text-align: center; padding: 5px; position: fixed; top: 0; left: 0;">[SITIO DE PRUEBAS] Tienda real en <a href="http://wwwlocalhost/">wwwlocalhost</a></div><br>';
$analytics = "";
$newproducts_overlay = '<div id="newproducts_overlay">
	<img src="http://testlocalhost/img/newproductspic.png">
	<div class="title"><a href="#" class="close">Cerrar</a>¡Busca las novedades!</div>
	<div>
		Te proponemos descubrir nuestras novedades de forma creativa. Busca los productos con marco naranja ¡son nuevos! :)
	</div>
</div>';
$socialLinks = '<a href="//facebook.com/CreativeKits" target="_new">Facebook</a> | <a href="//twitter.com/CreativeKitsMAD" target="_new">Twitter</a> | <a href="//youtube.com/Susanaylosbaobas" target="_new">YouTube</a> | <a href="mailto:contacto@creativekits.es">contacto@creativekits.es</a>';
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
$baseurl = 'http://localhost:1025';

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
	$query = 'SELECT * FROM `cat` ORDER BY `id`';
	$result = $mysqli->query($query);
    if( !$result)
        die($mysqli->error);
	while($row = $result->fetch_object()){
		$id = $row->id;
		$catname = $row->name;
		$seoname = str_replace(' ', '-', $catname);
		$seoname = str_replace('ú', 'u', $seoname);
		$seoname = str_replace('ñ', 'n', $seoname);
		if($row->parent == NULL && $id != 7 && $id != 51 && $id != 53 && $id != 62){
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
		$return .= "<a href=\"$baseurl/subcat/$id/$seoname/\" style=\"color: rgba(255,255,255,.8) !important;\">$name</a> &#8226; ";
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
function showRelatedProducts($product){
    global $mysqli;
    $query = $mysqli->query("SELECT * FROM `themes` WHERE `products` LIKE '%$product%'");
    echo $mysqli->error;
    $themes = array();
    $n = 0;
    while($arr = $query->fetch_array()){
        $themes[$n] = $arr['products'];
        $n = $n + 1;
    }
    foreach($themes as $id => $products){
        $themes[$id] = preg_split('/$\R?^/m', $products);
        $themes[$id] = array_flip($themes[$id]);
        foreach($themes[$id] as $key => $val){
            $themes[$id][$key] = $key;
            if($key == $product){
                unset($themes[$id][$key]);
            }
        }
    }
    shuffle($themes);
    $themes = array_slice($themes, 0, 3);
    $count = count($themes);
    $rel = array();
    $relprod = array();
    switch($count){
        case 0:
            $prodcat = getProdInfo('cat', $product);
            $prodcats = explode(',', $prodcat);
            $prodcatn = count($prodcats) - 2;
            $prodcatn = rand(0, $prodcatn);
            $prodcat = str_replace(' ', '', $prodcats[$prodcatn]);
            $relprodsquery = $mysqli->query("select * from products where cat like '% $prodcat,%'");
            $prodcatn = 1;
            $relprodsarr = array();
            while($arr = $relprodsquery->fetch_object()){
                if($arr->stock >= 1){
                    $relprodsarr[$arr->id] = $arr->id;
                }
            }
            shuffle($relprodsarr);
            foreach($relprodsarr as $key => $id){
                if($prodcatn <= 3){
                    $relprod[$prodcatn] = $id;
                    $prodcatn = $prodcatn + 1;
                }
            }
        break;
        case 1:
            $rel[1] = 0;
            $rel[2] = 0;
            $rel[3] = 0;
        break;
        case 2:
            $rel[1] = 0;
            $rel[2] = 1;
            $rel[3] = rand(0,1);
        break;
        case 3:
            $rel[1] = 0;
            $rel[2] = 1;
            $rel[3] = 2;
        break;
    }
    foreach($rel as $key => $value){
        foreach($themes as $key2 => $prods){
            shuffle($prods);
            foreach($prods as $key3 => $prod){
                $prod = preg_replace('/\t+/', '', $prod);
                $prod = preg_replace('/\s+/', '', $prod);
                if(!array_key_exists($key, $relprod)){
                    $relprod2 = array_flip($relprod);
                    if(!array_key_exists($prod, $relprod2)){
                        if($prod != $product && getProdInfo('stock', $prod) >= 1){
                            $relprod[$key] = $prod;
                        }
                    }
                }
            }
        }
    }
    foreach($relprod as $key => $id){
        $query = $mysqli->query("SELECT * FROM `products` where id = '$id'");
        $row2 = $query->fetch_object();
        
        $prodid = $row2->id;
        $name = utf8_decodeAlt($row2->name);
        $name = str_replace('&quot;', '"', $name);
        $cropname = croptxt($name, 40);
        $seoname = seoName($name);
        $pictureglob = glob("./imgpr/$prodid/*.*");
        $picture = './img/nophoto.png';
        $stock = $row2->stock;
        if(count($pictureglob) > 0){
            $picture = utf8_encode(str_replace(' ', '%20', $pictureglob[0]));
        }
        echo "	<div class=\"product\">
                    <a href=\"$baseurl/prod/$prodid/$seoname/\">
                        <img src=\"$baseurl/img/blank.gif\" style=\"background-image: url($baseurl/$picture)\">
                        $cropname
                    </a>
                </div>";
    }
}
function showProducts($array){
    global $mysqli;
    global $baseurl;
    foreach($array as $cat => $prods){
        $cat_grouped = array();
        foreach($prods as $prodid => $prodgroup){
            
            if (!array_key_exists($prodgroup, $cat_grouped)) {
                // Set new array for a category if it does not exist
                $cat_grouped[$prodgroup] = array();
            }
            
            $cat_grouped[$prodgroup][$prodid] = $prodid;
        }
        
        foreach($cat_grouped as $prodgroup => $products){
            krsort($cat_grouped[$prodgroup]);
            
            foreach($cat_grouped[$prodgroup] as $id){
                $query = $mysqli->query("SELECT * FROM `products` where id = '$id'");
                $row2 = $query->fetch_object();
        
                $prodid = $row2->id;
			$name = utf8_decodeAlt($row2->name);
			$name = str_replace('&quot;', '"', $name);
			$cropname = croptxt($name, 40);
			$seoname = seoName($name);
			$pictureglob = glob("./imgpr/$prodid/*.*");
			$picture = './img/nophoto.png';
			$stock = $row2->stock;
			if(count($pictureglob) > 0){
				$picture = utf8_encode(str_replace(' ', '%20', $pictureglob[0]));
			}
		if($stock >=1){
			if($row2->new == 1){
			echo "	<div class=\"product newproduct\">
					<a href=\"$baseurl/prod/$prodid/$seoname/\">
						<img src=\"$baseurl/img/blank.gif\" style=\"background-image: url($baseurl/$picture)\">
						$cropname
					</a>
				</div>";
			} else {
				echo "	<div class=\"product\">
					<a href=\"$baseurl/prod/$prodid/$seoname/\">
						<img src=\"$baseurl/img/blank.gif\" style=\"background-image: url($baseurl/$picture)\">
						$cropname
					</a>
				</div>";
				}
			}
            }
        }   
    }
}

function showSubCatProducts($array){
    global $mysqli;
    global $baseurl;
        krsort($array);
        foreach($array as $prodgroup => $products){
            krsort($array[$prodgroup]);
            
            foreach($array[$prodgroup] as $id){
                $query = $mysqli->query("SELECT * FROM `products` where id = '$id'");
                $row2 = $query->fetch_object();
        
                $prodid = $row2->id;
			$name = utf8_decodeAlt($row2->name);
			$name = str_replace('&quot;', '"', $name);
			$cropname = croptxt($name, 40);
			$seoname = seoName($name);
			$pictureglob = glob("./imgpr/$prodid/*.*");
			$picture = './img/nophoto.png';
			$stock = $row2->stock;
			if(count($pictureglob) > 0){
				$picture = utf8_encode(str_replace(' ', '%20', $pictureglob[0]));
			}
		if($stock >=1){
			if($row2->new == 1){
			echo "	<div class=\"product newproduct\">
					<a href=\"$baseurl/prod/$prodid/$seoname/\">
						<img src=\"$baseurl/img/blank.gif\" style=\"background-image: url($baseurl/$picture)\">
						$cropname
					</a>
				</div>";
			} else {
				echo "	<div class=\"product\">
					<a href=\"$baseurl/prod/$prodid/$seoname/\">
						<img src=\"$baseurl/img/blank.gif\" style=\"background-image: url($baseurl/$picture)\">
						$cropname
					</a>
				</div>";
				}
			}
            }
        }
}
function getSubcats($cat){
    global $mysqli;
    $cat_subcats = $mysqli->query("SELECT * FROM `cat` where parent = '$cat'");
    $subcats = array();
    while($cat = $cat_subcats->fetch_object()){array_push($subcats, $cat->id);}
    
    return($subcats);
}
function getAllCatProducts($cat){
    global $mysqli;
    
    $subcat_prods = array();
    $subcat_prods_groups = array();
    
    $cat_subcats = $mysqli->query("SELECT * FROM `cat` where parent = '$cat'");
    $subcats = array();
    while($cat = $cat_subcats->fetch_object()){array_push($subcats, $cat->id);}
    
    foreach($subcats as $key=>$id){
        $id2 = ' '.$id.', ';
        $idprods = $mysqli->query("SELECT * FROM `products` WHERE `cat` = $id OR `cat` LIKE concat('%', '$id2', '%') ORDER BY `id` DESC");
        while($prod = $idprods->fetch_object()){
            $prodid = $prod->id;
            $prodgroup = (empty($prod->group) ? 'zzzzzzzzzzzzzzzzzzzz' : $prod->group);
            
            $subcat_prods[$id][$prodid] = $prodgroup;
            
        }
    }
    
    foreach($subcat_prods as $subcatid => $subcatprods){
        foreach($subcatprods as $prodid => $prodgroup){
            if (!array_key_exists($prodgroup, $subcat_prods_groups)) {
                $subcat_prods_groups[$prodgroup] = array();
            }
            
            $subcat_prods_groups[$prodgroup][$prodid] = $prodid;
        }
    }
    
    asort($subcat_prods_groups);
    return($subcat_prods_groups);
}

function getSubCatProducts($cat){
    global $mysqli;
    
    $prods = array();
    
    $id = $cat;
    $id2 = ' '.$id.', ';
    $idprods = $mysqli->query("SELECT * FROM `products` WHERE `cat` = $id OR `cat` LIKE concat('%', '$id2', '%') ORDER BY `id` DESC");
    
    while($prod = $idprods->fetch_object()){
        $prodid = $prod->id;
        $prodgroup = (empty($prod->group) ? 'zzzzzzzzzzzzzzzzzzzz' : $prod->group);
            
        $prods[$prodgroup][$prodid] = $prodid;
            
    }
    
    asort($prods);
    return($prods);
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
function getPrice($id){
    global $preciosredondos;
    $cost = getProdInfo(cost, $id);
    $cost = ($preciosredondos ? floor($cost) : $cost);
    return($cost);
}
function isLiq($id){
    $cat = getProdInfo(cat, $id);
    if(strpos($cat, ' 50, ') !== false){
        return('30%');
    } elseif(strpos($cat, ' 7, ') !== false){
        return('50%');
    } else {
        return(false);
    }
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
    global $preciosredondos;
	foreach($cart as $prodid => $prodqt){
		if($prodid != 'dummyval'){
			$query = "SELECT * FROM `products` WHERE `id` = $prodid";
			$result = $mysqli->query($query);
			$result = $result->fetch_object();

			$name = utf8_decodeAlt($result->name);
			$seoname = seoName($name);
			$cost = $result->cost;
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
			switch($_SESSION['descuento']){
				case 'DESC10JU':
				if(getTotalCost($cart) >= 30){
					/*$okcat = array(4, 25, 27, 29, 31, 32);*/
					$nocat = array(7, 50, 62);
					$descok = true;
					foreach($nocat as $cat){
						if(strpos($result->cat, ' '.$cat.',') !== false){
							$descok = false;
						}
					}
					if($descok == true){
						$cost = $cost * 0.9;
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
            $trespordos_disc = $_SESSION['3x2_p'][$prodid] * $cost;
            $cost = $cost * $prodqt;
            $cost = $cost - $trespordos_disc;
			$cost = twoDecimals($cost);
            $cost = ($preciosredondos ? floor($cost) : $cost);
			$cost = dotToComma($cost);
            
            if($trespordos_disc > 0){$trespordos = ' - Promo 3x2: '.$_SESSION['3x2_p'][$prodid].' ud. gratis :)';}
            
			echo "<div class=\"cartproduct\">
							<div>$prodid</div><div><a href=\"$baseurl/prod/$prodid/$seoname/\">$name $trespordos</a></div><div>$prodqt • <a class=\"icon\" href=\"$baseurl/cart/?add=$prodid\">Más</a> • <a class=\"icon\" href=\"$baseurl/cart/?remove=$prodid\">Menos</a></div><div>$cost €</div>
						</div>";
		}
	}
}
function trespordos_total(){
    $trespordos_disc = 0;
    foreach($_SESSION['3x2_p'] as $prod => $cant){
        $price = getPrice($prod);
        if(isLiq($prod) == '50%'){$price = $price * 0.7;}elseif(isLiq($prod) == '30%'){$price = $price * 0.7;};
        $price = $price * $cant;
        
        $trespordos_disc = $trespordos_disc + $price;
    }
    return($trespordos_disc);
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
	setcookie('ckt_shoppingcart', serialize($cart), time()+259200, '/', 'localhost');
}
function addToCart($id){
	global $cart;
	if(!empty($cart[$id])){
		$proposedstock = $cart[$id] + 1;
		if(getProdInfo('stock', $id) > $proposedstock && $_SESSION['testuser'] != 'OK'){
			$cart[$id] = $proposedstock;
		} else {
			echo '<script>alert("No tenemos taaaanto stock de ese producto :( ¡Lo sentimos!");</script>';
		}
	} else {
		$cart[$id] = 1;
	}
	setcookie('ckt_shoppingcart', serialize($cart), time()+259200, '/', 'localhost');
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
function applyDiscount(){
	global $mysqli;
	global $totalcost;
	global $cart;
	switch($_SESSION['descuento']){
		case 'DESC10JU':
			if($totalcost >= 30){
				$totalcost = 0.00;
				foreach($cart as $prodid => $prodqt){
					if($prodid != 'dummyval'){
						$query = "SELECT * FROM `products` WHERE `id` = $prodid";
						$result = $mysqli->query($query);
						$result = $result->fetch_object();

						$cost = $result->cost;
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
						$nocat = array(7, 50, 62);
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
    $return = round($val, 2);
	return($return);
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
function trespordos(){
    global $cart;
    global $trespordos_on;
    if($trespordos_on != false){
    $_SESSION['3x2_p'] = array();
    if(countProducts($cart) >= 3){
        $liqcount = 0;
        foreach($cart as $prodid => $prodqt){
            if($prodid != 'dummyval'){
                if(isLiq($prodid)){
                    $liqcount = $liqcount + 1;
                }
            }
        }
        $freecount = countProducts($cart) - $liqcount;
        $freecount = floor($freecount / 3);
        $prods = $cart;
        unset($prods['dummyval']);
        $freeprodids = array_keys($prods);
        $freeprodids_2 = array();
        foreach($freeprodids as $key => $id){
            $price = getPrice($id);
            $freeprodids_2[$id] = $price;
        }
        asort($freeprodids_2, SORT_NUMERIC);
        while(count($freeprodids_2) > $freecount){
            array_pop($freeprodids_2);
        }
        foreach ($freeprodids_2 as $id => $price){
            if($freecount > 0){
                $cant = $cart[$id];
                if($freecount > $cant){
                    $paycant = 0;
                    $freecount = $freecount - $cant;
                } else {
                    $paycant = $cant - $freecount;
                    $freecount = 0;
                }
                $_SESSION['3x2_p'][$id] = $cant - $paycant;
            } else {
                unset($freeprodids_2[$id]);
            }
        }
    }
    }
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
		$shippingcost = ($preciosredondos ? 2 : 2.9);
	} elseif($weight > 500 && $weight <= 3000){
		$shippingcost = ($preciosredondos ? 6 : 6.9);
	} elseif($weight > 3000 && $weight <= 10000){
		$shippingcost = ($preciosredondos ? 8 : 8.9);
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
    if($vat_desc = true && $totalcostWOshipment >= 30){$VAT = 0;}
	$totalcost = $totalcost + $shippingcost;

	if($_SESSION['descuento'] == 'DESC14A' && $totalcost >= 50 && $_COOKIE['DESC14AUSED'] != 'yes'){
		$totalcost = $totalcost - 5;
	}
    
    
    trespordos();
    
    $_SESSION['3x2_rcost'] = $totalcost;
    $_SESSION['3x2_disc'] = trespordos_total();
    
    $totalcost = $totalcost - trespordos_total();
    $_SESSION['vatdesc_total'] = $totalcostWOshipment;
    if($vat_desc = true && $totalcostWOshipment >= 30){$totalcost = $totalcostWOvat + $shippingcost; $totalcostWOshipment = $totalcostWOvat;}
}
?>
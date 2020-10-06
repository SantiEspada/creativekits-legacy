<?php
session_start();
include('inc.php');
$error = '';
$client_id = 'AbYtWxABFVG6akRtiXGJbws7NtSViJsS3SeRuOl0N3gUVKgMiHFkqcf2gc9G';    // paypal client id
$client_secret = 'EJgviRApav6WqrtrwlZbTVsECeLyKiPS4Cy9PZK-kCbKs6Hn6SaW4V3q10TS'; // client secret

$code = $_GET["code"];

if($code && $_GET['processPPlogin'] != 'OK'){?>
    <script>window.opener.location.href="<?=$baseurl."/account/login?code=$code&processPPlogin=OK"?>";self.close();</script>
<?}

if($_GET['processPPlogin'] == 'OK'){
    /* GET Access TOKEN */
    $token_url = "https://api.paypal.com/v1/identity/openidconnect/tokenservice?";    
    $postvals = "client_id=".$client_id
            ."&client_secret=".$client_secret
            ."&grant_type=authorization_code"
            ."&code=".$code;
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $token_url);

    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postvals);
    
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($ch, CURLOPT_CAINFO, "./Stripe/data/ca-certificates.crt");

    $resp = curl_exec($ch);
        
    curl_close($ch);
    
    $atoken = json_decode($resp);

    /* GET PROFILE DETAILS */
    $profile_url = "https://api.paypal.com/v1/identity/openidconnect/userinfo?schema=openid&access_token=".$atoken->access_token;

    $ch2 = curl_init();
    curl_setopt($ch2, CURLOPT_URL, $profile_url);
    
    curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);

    
    curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, true);
    curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($ch2, CURLOPT_CAINFO, "./Stripe/data/ca-certificates.crt");
    
    curl_setopt($ch2, CURLOPT_HTTPHEADER, array('Authorization: '));

    $resp2 = curl_exec($ch2);
    
    curl_close($ch2);
    
    $profile = json_decode($resp2);
    $address = $profile->address;
    
}
if($_GET['updateAddress']){
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $adress = $_POST['adress'];
    $zip = $_POST['zip'];
    $city = $_POST['city'];
    $region = $_POST['region'];
    $id = $_SESSION['userid'];
    
    $query = "update users set name = '$name', surname = '$surname', surname2 = '', zip = '$zip', adress = '$adress', city = '$city', region = '$region' where id = $id";
    
    if($mysqli->query($query)){
        $resp = "{'updated' : true, 'name' : '$name', 'surname' : '$surname', 'zip' : '$zip', 'adress' : '$adress', 'city' : '$city', 'region' : '$region'}";
        $resp = str_replace("'", '"', $resp);
        die($resp);
    } else {
        $error = $mysqli->error;
        $resp = "{'updated' : false, 'error' : '$error'}";
        $resp = str_replace("'", '"', $resp);
        die($resp);
    }
}
if($_POST){
	if($_POST['action']  == 'register'){
		$mail = $_POST['mail'];
		$pass = md5($_POST['pass']);
		$name = $_POST['name'];
		$surname = $_POST['surname'];
		$adress = $_POST['adress'];
		$zip = $_POST['zip'];
		$city = $_POST['city'];
		$region = $_POST['region'];
		$query = "INSERT INTO `users` (`id`, `email`, `password`, `name`, `surname`, `adress`, `zip`, `city`, `region`) VALUES (NULL, '$mail', '$pass', '$name', '$surname', '$adress', '$zip', '$city', '$region')";
		if($mysqli->query($query)){
			$_SESSION['isLoggedIn'] = true;
			$_SESSION['userid'] = $mysqli->insert_id;
		} else {
			die($mysqli->error);
		}
	} elseif($_POST['action'] == 'login'){
		$mail = $_POST['mail'];
		$pass = $_POST['pass'];
		$query = "SELECT * FROM `users` WHERE `email` LIKE '$mail'";
		$result = $mysqli->query($query);
		$result = $result->fetch_object();
		if($result->password == md5($pass)){
			$_SESSION['isLoggedIn'] = true;
			$_SESSION['userid'] = $result->id;
            header("Location: $baseurl/placeorder.php");
		} else {
			$error = '<span style="color:red">El correo o la contraseña son incorrectos</span>';
		}
	}
}
if($_SESSION['isLoggedIn']){
	header("Location: $baseurl/placeorder.php");
}
?>
<!DOCTYPE html>
<html lang=es>
	<head>
		<meta charset="utf-8">
		<?=$keywords?>
		<title>CreativeKits • Acceder</title>
		<meta property="og:image" content="<?=$baseurl?>/img/facebookpic.jpg"/>
		<meta property="og:title" content="CreativeKits • Scrapbooking, kits creativos, regalos originales y mucho más ;)" />
		
		<link rel="stylesheet" href="<?php echo $baseurl ?>/css/main.css">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script src="<?php echo $baseurl ?>/js/main.js"></script>
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
		<div class="header">
			<div class="content">
				Acceder
			</div>
            
		</div>
		<div class="header header2">
			<div class="content">
				<a href="javascript:history.back();">&laquo; Volver atrás</a>
			</div>
		</div>
		<div class="fulltextbody">
			<div class="content twocols_page">
                <section class="right">
                    <h1>Iniciar sesión</h1>
                    ¡Bienvenido/a de nuevo! Ya te echábamos de menos... :)
                    <hr>
                    <form action="<?=$baseurl.'/account/login'?>" method=post>
                    <div class="t">
                    <p><label for="email">Correo electrónico:</label>
                        <input type="email" name="mail" required></p>
                    
                    <p><label for="pass">Contraseña:</label>
                    <input type="password" name="pass" required></p>
                    </div>
                    <hr>
                    <input type="hidden" name="action" value="login">
                    <?=$error?>
                    <button class="button" type="send">Entrar</button>
                    </form>
                </section>
                
                <section class="left">
                    <h1>Registro</h1>
                    ¿Aún no tienes cuenta en CreativeKits? Arreglemos eso :)
                    <hr><span id="paypal_login"></span><hr>
                    <form action="<?=$baseurl.'/account/login'?>" method=post>
                    <div class="t">
                    <p><label for="email">Correo electrónico: <strong>*</strong></label>
                        <input type="email" name="mail" required value="<?=$profile->email?>"></p>
                    
                    <p><label for="pass">Contraseña: <strong>*</strong></label>
                    <input type="password" name="pass" required></p>
                    
                    <p><label for="name">Nombre: <strong>*</strong></label>
                    <input type="text" name="name" required value="<?=$profile->given_name?>"></p>
                    
                    <p><label for="surname">Apellidos: <strong>*</strong></label>
                    <input type="text" name="surname" required value="<?=$profile->family_name?>"></p>
                    
                    <p><label for="adress" style="vertical-align: top;">Dirección: <strong>*</strong></label>
                    <textarea name="adress" rows="2" required><?=$address->street_address?></textarea></p>
                    
                    <p><label for="zip">Código postal: <strong>*</strong></label>
                    <input type="text" name="zip" required value="<?=$address->postal_code?>"></p>
                    
                    <p><label for="city">Ciudad: <strong>*</strong></label>
                    <input type="text" name="city" required value="<?=$address->locality?>"></p>
                    
                    <p><label for="region">Provincia: <strong>*</strong></label>
                    <input type="text" name="region" required value="<?=$address->region?>"></p>
                    
                    <p><label for="country">País: <strong>*</strong></label>
                    <input type="text" name="country" value="España" disabled required></p>
                    </div>
                    <hr>
                    <input type="hidden" name="action" value="register">
                    <button class="button" type="send">Registrarme</button>
                    </form>
                </section>
                <div style="clear: both;"></div>
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
<script src="https://www.paypalobjects.com/js/external/api.js"></script>
<script>
paypal.use( ["login"], function(login) {
  login.render ({
    "appid": "<?=$client_id?>",
    "scopes": "profile email address phone https://uri.paypal.com/services/paypalattributes",
    "containerid": "paypal_login",
    "locale": "en-us",
    "returnurl": "http://test.creativekits.es/account/login"
  });
$('span#paypal_login button b').html('Completar formulario con mis datos de PayPal');
});
</script>
<link rel="stylesheet" href="<?php echo $baseurl ?>/css/main.css">
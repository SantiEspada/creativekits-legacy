<?php
session_start();
include('inc.php');
$error = '';
if($_POST){
	if($_POST['action']  == 'register'){
		$mail = $_POST['mail'];
		$pass = md5($_POST['pass']);
		$name = $_POST['name'];
		$surname = $_POST['surname'];
		$surname2 = $_POST['surname2'];
		$adress = $_POST['adress'];
		$zip = $_POST['zip'];
		$city = $_POST['city'];
		$region = $_POST['region'];
		$query = "INSERT INTO `users` (`id`, `email`, `password`, `name`, `surname`, `surname2`, `adress`, `zip`, `city`, `region`) VALUES (NULL, '$mail', '$pass', '$name', '$surname', '$surname2', '$adress', '$zip', '$city', '$region')";
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
<html lang=es style="background: #FFF;">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="<?php echo $baseurl ?>/css/reset.css">
		<link rel="stylesheet" href="<?php echo $baseurl ?>/css/main.css">
	</head>
	<body class="frame">
		<header>Registro o inicio de sesión</header>
		<form action="" method="post">
			<strong>¿Ya tienes una cuenta?</strong>
			<hr>
			Correo electrónico:<br>
			<input type="email" name="mail"><br><br>
			Contraseña:<br>
			<input type="password" name="pass"><br>
			<hr>
			<input type="hidden" name="action" value="login">
			<button class="button" type="send">Entrar</button>
			<?=$error?>
		</form>
		<form action="" method="post">
			<strong>¿Aún no te has registrado?</strong>
			<hr>
			Correo electrónico: <strong>*</strong><br>
			<input type="email" name="mail"><br><br>
			Contraseña: <strong>*</strong><br>
			<input type="password" name="pass"><br><br>
			Nombre: <strong>*</strong><br>
			<input type="text" name="name"><br><br>
			Primer apellido: <strong>*</strong><br>
			<input type="text" name="surname"><br><br>
			Segundo apellido:<br>
			<input type="text" name="surname2"><br><br>
			Dirección: <strong>*</strong><br>
			<textarea name="adress" rows="2"></textarea><br><br>
			Código postal: <strong>*</strong><br>
			<input type="text" name="zip"><br><br>
			Ciudad: <strong>*</strong><br>
			<input type="text" name="city"><br><br>
			Provincia: <strong>*</strong><br>
			<input type="text" name="region"><br><br>
			País: <strong>*</strong><br>
			<input type="text" name="country" value="España" disabled><br>
			<hr>
			<input type="hidden" name="action" value="register">
			<button class="button" type="send">Registrarme</button>
			<span style="font-size: 10px; color: rgba(000,000,000,0.4);">Al registrarte aceptas las condiciones de uso y la política de privacidad del sitio web.</span>
		</form>
	</body>
</html>
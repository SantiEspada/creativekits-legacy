<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
function alert($string){
	echo "<script>alert('$string');</script>";
}
include('inc.php');
if($_POST){
	$name = htmlspecialchars($_POST['name']);
	$descr = htmlspecialchars($_POST['descr']);
	$cost = $_POST['cost'];
	$stock = $_POST['stock'];
	$barcode = $_POST['barcode'];
	$weight = $_POST['weight'];
	$lenght = $_POST['lenght'];
	$width = $_POST['width'];
	$height = $_POST['height'];
	$cat = ' '.$_POST['cat'].', ';
    $grupo = $_POST['grupo'];

	$query = "INSERT INTO `products` (`id`, `cat`, `group`, `name`, `descr`, `cost`, `stock`, `barcode`, `weight`) VALUES (NULL, '$cat', '$grupo', '$name', '$descr', '$cost', '$stock', '$barcode', '$weight');";
	$mysqli->query($query);

	mkdir('./imgpr/'.$mysqli->insert_id);

	$directory='./imgpr/'.$mysqli->insert_id.'/';
	$a=0;
	foreach ($_FILES['file']['name'] as $nameFile) {
		if(is_uploaded_file($_FILES['file']['tmp_name'][$a])){
			move_uploaded_file($_FILES['file']['tmp_name'][$a], $directory.$_FILES['file']['name'][$a]);
		}
	$a++;
	}
	echo '<script type="text/javascript">alert("Producto insertado. ID:'.$mysqli->insert_id.'");</script>';
}

?>
<!DOCTYPE html>
<html lang=es style="background: #FFF;">
	<head>
		<meta charset="utf-8">
		<title>CreativeKits • Insertar artículo (provisional)</title>
		<link rel="stylesheet" href="css/reset.css">
		<link rel="stylesheet" href="css/main.css">
		<script src="js/jquery.min.js"></script>
		<script src="js/main.js"></script>
	</head>
	<body style="background: rgba(000,000,000,0.1) !important;">
		<header>
			<div class="content" style="max-width: 460px !important;">
				<a href="<?=$baseurl?>"><div class="logo"></div></a>
			</div>
		</header>
		<div style="float: right; width: 300px; text-align: right; font-size: 14px; color: rgba(000,000,000,0.5); text-shadow: 0 1px 0 rgba(255,255,255,0.3); padding: 20px;">
				<?php showCats2(); ?>
				</div>
		<div class="content addprodbox">
			<strong>AÑADIR ARTÍCULO</strong>
			<hr>
			<form action="#" method="post" enctype="multipart/form-data">
				Categoría:<br>
				<input type="text" name="cat">
				<br>
				Nombre:<br>
				<input type="text" name="name"><br>
				<br>
                Grupo:<br>
				<input type="text" name="grupo">
				<br>
				Descripción:<br>
				<textarea name="descr"></textarea><br>
				<br>
				Precio:<br>
				<input type="text" name="cost"><br>
				<br>
				Cantidad:<br>
				<input type="text" name="stock"><br>
				<br>
				Peso aproximado:<br>
				<input type="text" name="weight"><br>
				<br>
				Imágenes:<br>
				<input type="file" name="file[]" multiple><br>
				<br>
				<button type="send">Añadir producto</button>
			</form>
		</div>
		<br>
		<br>
		<br>
	</body>
</html>
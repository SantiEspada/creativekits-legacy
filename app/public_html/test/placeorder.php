<?php
session_start();
include('inc.php');
if($_SESSION['isLoggedIn'] != true){
	header("Location: $baseurl/login.php");
}
$id = $_SESSION['userid'];

$query = $mysqli->query("select * from users where id = $id");
$user = $query->fetch_object();

$uname = $user->name;
$usurname = $user->surname . $user->surname2;
$uzip = $user->zip;
$uadress = $user->adress;
$ucity = $user->city;
$uregion = $user->region;

$user_fulladress = "{'name' : '$uname', 'surname' : '$usurname', 'zip' : '$uzip', 'adress' : '$uadress', 'city' : '$ucity', 'region' : '$uregion'}";


if($_POST){
	$items = serialize($cart);
    $cost = $_POST['cost'];
    if($trespordos_on != false){
	   $cost = $_SESSION['3x2_rcost'] - $_POST['shippingcost'];
    } elseif($vat_desc == true && $totalcost >= 30){
        $cost = $_SESSION['vatdesc_total'];
    }
	$shippingcost = $_POST['shippingcost'];
	$shippingadress = $_POST['shippingadress'];
	$shippingzip = $_POST['shippingzip'];
	$shippingcity = $_POST['shippingcity'];
	$shippingregion = $_POST['shippingregion'];
	$userid = $_POST['userid'];
	$payment = $_POST['payment'];
	$comments = $_SESSION['comments'];
	$discount = $_SESSION['descuento'];
	$telf = $_POST['telf'];
	$date = date("d/m/Y H:i");
    $discountprice = 0;
    if($trespordos_on != false){
	   $discountprice = $_SESSION['3x2_disc'];
    } elseif($vat_desc == true && $totalcost >= 30){
        $totalcostWOvat = removeVAT($_SESSION['vatdesc_total']);
        $VAT = $_SESSION['vatdesc_total'] - $totalcostWOvat;
        $discountprice = $VAT;
    }
	if($payment == 'Contrareembolso'){
		$cost = $cost + 2.9;
		$items = unserialize($items);
		$items['470'] = 1;
		$items = serialize($items);
	}
	if($_POST['savetelf'] == true){
		$mysqli->query("update `users` set `telf` = '$telf' where `id` = $userid");
	}
	$query = "INSERT INTO `orders` (`id`, `status`, `items`, `cost`, `shippingcost`, `shippingadress`, `shippingzip`, `shippingcity`, `shippingregion`, `userid`, `payment`, `comments`, `discount`, `telf`, `date`, `discountprice`) VALUES (NULL, '0', '$items', '$cost', '$shippingcost', '$shippingadress', '$shippingzip', '$shippingcity', '$shippingregion', '$userid', '$payment', '$comments', '$discount', '$telf', '$date', '$discountprice');";
	if($mysqli->query($query)){
		$_SESSION['orderid'] = $mysqli->insert_id;
	} else {
		die($mysqli->error);
	}
}
if($_SESSION['orderid']){
	header("Location: $baseurl/orderplaced.php");
}
?>
<!DOCTYPE html>
<html lang=es>
	<head>
		<meta charset="utf-8">
		<?=$keywords?>
		<title>CreativeKits • Realizar pedido</title>
		<meta property="og:image" content="<?=$baseurl?>/img/facebookpic.jpg"/>
		<meta property="og:title" content="CreativeKits • Scrapbooking, kits creativos, regalos originales y mucho más ;)" />
		
		<link rel="stylesheet" href="<?php echo $baseurl ?>/css/main.css">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script src="<?php echo $baseurl ?>/js/main.js"></script>
        
        <script>
        var $ =jQuery.noConflict();
        $(document).ready(function () {
    		$("input[name=payment]:radio").change(function () {
        		var ordervalue = $('#ordervalue').attr('data-originalval');
				if($('input[name=payment]:checked').val() == 'Contra reembolso'){
					ordervalue = ordervalue.replace(',', '.');
					ordervalue = parseFloat(ordervalue) + 2.90;
					ordervalue = ordervalue.toFixed(2);
					ordervalue = ordervalue.replace('.', ',');
					$('#ordervalue').html(ordervalue);
				} else {
					$('#ordervalue').html(ordervalue);
				}
                switch($('input[name=payment]:checked').val()){
                    case 'Tarjeta de crédito/débito':
                        $('#payment_moreinfo').html('<form action="javascript:doTransaction();" method="POST" id="payment-form"><div>Número de tarjeta<br><input type="text" size="20" maxlength="20" autocomplete="off" class="card-number" /></div><div>CVV (<a href="javascript:alert(\'El CVV es un código de seguridad de tres cifras situado normalmente en la parte trasera de la tarjeta, junto a la firma. /\n/\nEn las tarjetas American Express&trade; este código es de 4 cifras y se sitúa en la parte delantera.\');">?</a>)<br><input type="text" size="3" maxlength="3" autocomplete="off" class="card-cvc" /></div><div>Fecha de expiración<br><input type="text" size="2" maxlength="2" class="card-expiry-month"/><span> / </span><input type="text" size="4" maxlength="4" class="card-expiry-year"/></div></form><div style="clear:both;"></div>');
                        break;
                    
                    case 'PayPal':
                        $('#payment_moreinfo').html('Al hacer clic en el botón "Confirmar pedido" serás redirigido a PayPal para completar tu pago.');
                        break;
                        
                    case 'Contra reembolso':
                        $('#payment_moreinfo').html('Podrás pagar tu pedido en efectivo al recibirlo en tu domicilio. Es recomendable que tengas preparado el importe exacto en el momento de la recepción.<br><br>Este modo de pago conlleva unos gastos de gestión de 2,9€.');
                        break;
                        
                    case 'Transferencia':
                        $('#payment_moreinfo').html('Recibirás en unos minutos un correo electrónico con los datos para realizar la transferencia bancaria.<br><br>Si pasados 15 días lectivos no se ha recibido la transferencia bancaria, el pedido se dará por cancelado.');
                        break;
                }
    		});
            $("#confirm_order").click(function(){$("form#orderinfo").submit();});
		});
            
        function showAddressUpdateBox(){
            var userdata = $('#shippingbox').attr('data-fulladress');
            var userdata = userdata.replace(/'/g, '"');
            var user = $.parseJSON(userdata);
            
            var name = user.name;
            var surname = user.surname;
            var adress = user.adress;
            var zip = user.zip;
            var city = user.city;
            var region = user.region;
            
            $('#shippingbox').html('<form><a href="javascript:updateAddress();" id="editbutton">Guardar cambios</a><input type="text" name="name" value="' + name +'"><input type="text" name="surname" value="' + surname +'"><textarea name="adress">' + adress +'</textarea><input type="text" name="zip" value="' + zip +'"><input type="text" name="city" value="' + city +'"><input type="text" name="region" value="' + region +'"></form>');
        }
        function updateAdressBox(res){
            var user = $.parseJSON(res);
            if(user.updated = true){
                var esp = ' ';
                var br = '\n<br>';
                var button = '<a href="javascript:showAddressUpdateBox();" id="editbutton">Editar dirección</a>\n';
                $('#shippingbox').html(button + '<strong>' + user.name + esp + user.surname + '</strong>' + br + user.adress + br + user.zip + br + user.city + esp + '(' + user.region + ')');
                
                var res2 = res.replace(/"/g, "'");
                $('#shippingbox').attr('data-fulladress', res2);
            } else {
                alert(user.error);
            }
        }
            
        function updateAddress(){
            var name = $('div#shippingbox form input[name=name]').val();
            var surname = $('div#shippingbox form input[name=surname]').val();
            var adress = $('div#shippingbox form textarea').val();
            var zip = $('div#shippingbox form input[name=zip]').val();
            var city = $('div#shippingbox form input[name=city]').val();
            var region = $('div#shippingbox form input[name=region]').val();
            
            var data = {name: name, surname: surname, adress: adress, zip: zip, city: city, region: region};
            
            $.post("<?=$baseurl?>/account/login?updateAddress=true", data, function(res){updateAdressBox(res)});
            
        }
        </script>
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
				Realizar pedido
			</div>
            
		</div>
		<div class="header header2">
			<div class="content">
				<a href="<?=$baseurl?>/cart">&laquo; Volver a la cesta de la compra</a>
			</div>
		</div>
		<div class="fulltextbody">
			<div class="content twocols_page">
                <section class="right">
                    <h1>Forma de pago</h1>
                    <hr>
                    Así es como nos pagarás los <span id="ordervalue" data-originalval="<?=dotToComma(twoDecimals($totalcost))?>"><?=dotToComma(twoDecimals($totalcost))?></span>€:<br><br>
                        <form action="" method="post" id="orderinfo">
                            <input type="radio" name="payment" value="Tarjeta de crédito/débito" checked> Tarjeta de débito/crédito<br>
                            <input type="radio" name="payment" value="PayPal"> Paypal<br>
                            <input type="radio" name="payment" value="Contra reembolso"> Contra reembolso (+2,9€ de gastos de gestión)<br>
                            <input type="radio" name="payment" value="Transferencia"> Transferencia bancaria<br>
                            <input type="hidden" name="items" value="<?=serialize($cart)?>">
                            <input type="hidden" name="cost" value="<?=$totalcostWOshipment?>">
                            <input type="hidden" name="shippingcost" value="<?=$shippingcost?>">
                            <input type="hidden" name="shippingadress" value="<?=utf8_decodeAlt(getUserInfo('adress', $id))?>">
                            <input type="hidden" name="shippingcity" value="<?=utf8_decodeAlt(getUserInfo('city', $id))?>">
                            <input type="hidden" name="shippingzip" value="<?=utf8_decodeAlt(getUserInfo('zip', $id))?>">
                            <input type="hidden" name="shippingregion" value="<?=utf8_decodeAlt(getUserInfo('region', $id))?>">
                            <input type="hidden" name="userid" value="<?=$id?>">
                        </form>
                        <div id="payment_moreinfo" class="shippingbox">
                            <form action="javascript:doTransaction();" method="POST" id="payment-form">
                                <div>Número de tarjeta<br><input type="text" size="20" maxlength="20" autocomplete="off" class="card-number" /></div>
                                
                                <div>CVV (<a href="javascript:alert('El CVV es un código de seguridad de tres cifras situado normalmente en la parte trasera de la tarjeta, junto a la firma. \n\nEn las tarjetas American Express&trade; este código es de 4 cifras y se sitúa en la parte delantera.');">?</a>)<br><input type="text" size="3" maxlength="3" autocomplete="off" class="card-cvc" /></div>
                                
                                <div>Fecha de expiración<br><input type="text" size="2" maxlength="2" class="card-expiry-month"/><span> / </span><input type="text" size="4" maxlength="4" class="card-expiry-year"/></div>
                            </form>
                            <div style="clear:both;"></div>
                        </div>
                        <hr>
                        <button type="submit" class="button" id="confirm_order">Confirmar pedido</button>
                </section>
                
                <section class="left">
                    <h1>Datos personales</h1>
                    <hr>
                    Esta es la dirección a la que se enviará tu pedido:<br>
                    <div class="shippingbox" id="shippingbox" data-fulladress="<?=$user_fulladress?>">
                        <a href="javascript:showAddressUpdateBox();" id="editbutton">Editar dirección</a>
                        <strong><?=$uname.' '.$usurname?></strong><br>
                        <?=$uadress?><br>
                        C.P. <?=$uzip?><br>
                        <?=$ucity?> (<?=$uregion?>)
                    </div>
                    
                    <h2 style="margin-top: 20px; margin-bottom: 3px;">Número de teléfono</h3>
                    <hr>
                        Necesitamos un teléfono móvil. Lo usaremos para avisarte sobre el estado de tu pedido y contactar contigo en caso de que surja cualquier problema.<br><br>
                        <input type="text" name="telf" size="9" style="background: #FFF; margin-bottom: 5px; width: 90px;" value="<?=getUserInfo('telf', $id)?>" required>
                        <input type="hidden" name="savetelf" value="true">
                        <input type="checkbox" name="moreconsent" checked> Avisadme también ofertas y promociones.
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
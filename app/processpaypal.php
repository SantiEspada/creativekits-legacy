<?php
session_start();
include('inc.php');
if(empty($_SESSION['orderid']) && empty($_GET['id'])){
	header("Location: $baseurl/placeorder.php");
}
if(!empty($_GET['id'])){
	$_SESSION['orderid'] = $_GET['id'];
}
$id = $_SESSION['orderid'];
$aditionalprice = getOrderInfo('aditionalprice', $id);
$discountprice = getOrderInfo('discountprice', $id);
$price = getOrderInfo('cost', $id);
$price = $price - $discountprice;
$price = $price + $aditionalprice;
$shippingprice = getOrderInfo('shippingcost', $id);
$totalprice = twoDecimals($price + $shippingprice);
?>
<body onload="document.getElementById('paypal').submit();">
<div style="text-align: center; font-size: 16px; font-family: 'Helvetica', 'Arial', sans-serif; color: rgba(000,000,000,0.8);">
	<img src="<?=$baseurl?>/img/loader.gif" style="margin: 2%;"><br>
	Conectando con PayPal...
</div>
	<form action="https://secure.paypal.com/es/cgi-bin/webscr" method="post" name="paypal" id="paypal">
		<input type="hidden" name="amount" value="<?=$totalprice?>">
		<input type="hidden" name="custom" value="<?=$id?>">
		<input type="hidden" name="item_name" value="Pedido <?=$id?>">
		<input type="hidden" name="cmd" value="_xclick">
		<input type="hidden" name="business" value="paypal@creativekits.es">
		<input type="hidden" name="cbt" value="Volver a CreativeKits">
		<input type="hidden" name="currency_code" value="EUR">
		<input type="hidden" name="return" value="http://www.creativekits.es/paypalok.php">
		<input type="hidden" name="cancel_return" value="http://www.creativekits.es/paypalerror.php">
	</form>
</body>
<?php
unset($_SESSION['orderid']);
?>
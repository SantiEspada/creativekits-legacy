<?php
$amount = $_POST['totalPrice'] * 100;
$card = $_POST['stripeToken'];
$order = $_POST['orderID'];

echo "Cantidad: $amount \n Tarjeta: $card \n Pedido: $order \n \n Estado:";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.stripe.com/v1/charges");

curl_setopt($ch, CURLOPT_USERPWD, "sk_test_YTO6MeSkMNAds3kmxmE3GGH5:");

curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "amount=$amount&currency=eur&card=$card&metadata[order-id]=$order");

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_CAINFO, "./Stripe/data/ca-certificates.crt");

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$resp = curl_exec($ch);

curl_close($ch);
if($resp){
    $payment = json_decode($resp);
    
    if(empty($payment->failure_code)){
        if($payment->paid){
            if($payment->amount == $amount){
                if($payment->metadata->order-id == $order){
                    die('OK');
                } else {
                    die('err_orderid_noequal');
                }
            } else {
                die('err_amount_noequal');
            }
        } else {
            die('err_order_nopaid');
        }
    } else {
        die($payment->failure_code . ': ' . $payment->failure_message);
    }
}
?>
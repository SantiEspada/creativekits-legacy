<?php
include('../inc.php');

$id = $_GET['id'];
$cart = unserialize(getOrderInfo('items', $id));

if(processOrder($cart)) {
    echo '<div style="display: none;"> Order #'.$id.' processed! </div>';
} else {
    echo '<div style="display: none;">Error processing order #'.$id.'</div>';
}
include('../404.php');
?>
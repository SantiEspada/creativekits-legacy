<?php
include('inc.php');

$query = $mysqli->query('SELECT * FROM products');
$count = 0;
while($prod = $query->fetch_object()){
    $prodid = $prod->id;
    $stock = $prod->stock;
    $name = $prod->name;
    if(!file_exists("./imgpr/$prodid/") && $stock > 0){echo "<a href=\"http://www.creativekits.es/prod/$prodid/prod/\" target=\"_blank\">$prodid -> $name</a><br>"; $count = $count + 1;}
}
echo "<br><br>Total de productos que faltan foto: $count";
?>
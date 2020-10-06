<?php
$max = 7; 
$filename = "%s"; 

$rndnum = rand(1, $max); 
$file = sprintf($filename, $rndnum); 
header ( "Content-type: image/png" ); 
readfile ( $file . ".png"); 

exit;
?>
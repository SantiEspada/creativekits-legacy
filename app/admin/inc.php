<?php
error_reporting(E_ERROR | E_PARSE);
header('Content-Type: text/html; charset=utf-8');
$mysqli = new mysqli('mysql', 'creativekits', '12345678', 'creativekits');
$mysqli->set_charset("utf8");
$baseurl = 'http://www.creativekits.es';


?>
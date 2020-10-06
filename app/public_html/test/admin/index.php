<?php
session_start();
include('inc.php');

if($_COOKIE['CK_ADMIN'] != 'TRUE'){
	include('../404.php');
	die();
}

?>
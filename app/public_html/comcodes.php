<?php
include('inc.php');
session_start();
if($_POST){
	if($_POST['action'] == 'checkcode'){
		$desc = $_POST['input'];
		$desc = explode('DESC', $desc);
		$desc = 'DESC'.$desc[1];
		switch($desc){
			case 'DESC10JU':
				$_SESSION['descuento'] = 'DESC10JU';
				echo 'codeok';
			break;
			case 'DESC14A':
				$_SESSION['descuento'] = 'DESC14A';
				echo 'codeok';
			break;
			case 'DESCNULL':
				$_SESSION['descuento'] = '';
				echo 'codeok';
			default:
			break;
		}
	} elseif($_POST['action'] == 'savecomments'){
		$com = explode('DESC', $_POST['input']);
		$com = $com[0];
		$_SESSION['comments'] = addslashes($com);
	}
}
?>
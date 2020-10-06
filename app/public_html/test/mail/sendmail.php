<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
function alert($string){
	echo "<script>alert('$string');</script>";
}
include('../inc.php');
if($_POST){
    $users = array();
    $message = $_POST['message'];
    $finalmsg = array();
    $subject = $_POST['subject'];
	$query = $mysqli->query('select * from users where email_subscription = 1');
    while($user = $query->fetch_object()){
        $userid = $user->id;
        $username = $user->name;
        $fullname = $username.' '.$user->surname.' '.$user->surname2;
        $useremail = $user->email;
        $users[$userid] = array(
            'name' => $username,
            'fullname' => $fullname,
            'email' => $useremail
        );
    }
    foreach($users as $id => $data){        
        $rep1 = array('%ID%', '%NAME%', '%FULLNAME%', '%EMAIL%');
        $rep2 = array($id, $data['name'], $data['fullname'], $data['email']);
        
        $finalmsg[$id] = str_replace($rep1, $rep2, $message);
        $finalsubject[$id] = str_replace($rep1, $rep2, $subject);
        
        $headers = "From: " . strip_tags('noresponder@creativekits.es') . "\r\n";
        $headers .= "Reply-To: ". strip_tags('contacto@creativekits.es') . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        $email = $data['email'];
        
        mail($email, $finalsubject[$id], $finalmsg[$id], $headers);
    }
    echo "<script>alert('Emails enviados :)');</script>";
}

?>
<!DOCTYPE html>
<html lang=es style="background: #FFF;">
	<head>
		<meta charset="utf-8">
		<title>CreativeKits • Enviar correos (provisional)</title>
		<link rel="stylesheet" href="../css/reset.css">
		<link rel="stylesheet" href="../css/main.css">
	</head>
	<body style="background: rgba(000,000,000,0.1) !important;">
		<header>
			<div class="content" style="max-width: 460px !important;">
				<a href="<?=$baseurl?>"><div class="logo"></div></a>
			</div>
		</header>
		<div class="content addprodbox">
			<strong>ENVIAR CORREOS</strong>
			<hr>
			<form action="#" method="post" enctype="multipart/form-data">
				Asunto:<br>
				<input type="text" name="subject"><br>
				<br>
                Cuerpo del mensaje (HTML, completo)<br><span style="font-size: 10px; text-transform: uppercase;">Puedes usar %name% y %fullname% para sustituir por el nombre de esa persona</span><br>
				<textarea name="message"></textarea><br>
				<br>
				<button type="send">Enviar correo</button>
			</form>
		</div>
		<br>
		<br>
		<br>
	</body>
</html>
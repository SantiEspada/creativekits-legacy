<?php
/*************************************
 * Autor: mgp25                      *
 * Github: https://github.com/mgp25  *
 *************************************/
require_once '../src/whatsprot.class.php';
//Change the time zone if you are in a different country
date_default_timezone_set('Europe/Madrid');
error_reporting( E_ALL & ~E_NOTICE & ~E_STRICT);

echo "####################################\n";
echo "#                                  #\n";
echo "#           WA CLI CLIENT          #\n";
echo "#                                  #\n";
echo "####################################\n\n";
echo "====================================\n";

////////////////CONFIGURATION///////////////////////
$debug = false; 
$username = "34644246942";                      // Telephone number including the country code without '+' or '00'.       
$password = "F9rSfqEPqMlnihXqN14U8xuDPM4=";     // A server generated Password you received from WhatsApp. This can NOT be manually created
$identity = "f%7c%fd%18%eeg%19%b4%f3m%272%81%fc%91r%f6%c3%b7%fe"; // Obtained during registration with this API or using MissVenom (https://github.com/shirioko/MissVenom) to sniff from your phone.    
$nickname = "CreativeKits";                          // This is the username (or nickname) displayed by WhatsApp clients.                       
/////////////////////////////////////////////////////
if ($_SERVER['argv'][1] == null) {
    echo "USO: php ".$_SERVER['argv'][0]." <numero> \n\nEj: php cliente.php 34123456789\n\n";
    exit(1);
}
$target = $_SERVER['argv'][1];
function fgets_u($pStdn)
{
    $pArr = array($pStdn);

    if (false === ($num_changed_streams = stream_select($pArr, $write = NULL, $except = NULL, 0))) {
        print("\$ 001 Socket Error : UNABLE TO WATCH STDIN.\n");

        return FALSE;
    } elseif ($num_changed_streams > 0) {
        return trim(fgets($pStdn, 1024));
    }
    return null;
}

function onPresenceReceived($username, $from, $type)
{
	$dFrom = str_replace(array("@s.whatsapp.net","@g.us"), "", $from);
		if($type == "available")
    		echo "<$dFrom se ha conectado>\n\n";
    	else
    		echo "<$dFrom se ha desconectado>\n\n";
}

echo "[] Iniciando sesion como '$nickname' ($username)\n";
$w = new WhatsProt($username, $identity, $nickname, false);

$w->eventManager()->bind("onPresence", "onPresenceReceived");

$w->connect(); // Nos conectamos a la red de WhatsApp
$w->loginWithPassword($password); // Iniciamos sesion con nuestra contraseña
echo "[*]Conectado a WhatsApp\n\n";
$w->sendGetServerProperties(); // Obtenemos las propiedades del servidor
$w->sendClientConfig(); // Enviamos nuestra configuración al servidor
$sync = array($target);
$w->sendSync($sync); // Sincronizamos el contacto
$w->pollMessages(); // Volvemos a poner en cola mensajes
$w->sendPresenceSubscription($target); // Nos suscribimos a la presencia del usuario

$pn = new ProcessNode($w, $target);
$w->setNewMessageBind($pn);

    while (1) {
    $w->pollMessages();
    $msgs = $w->getMessages();
    foreach ($msgs as $m) {
        # process inbound messages
        //print($m->NodeString("") . "\n");
    }
        $line = fgets_u(STDIN);
        if ($line != "") {
            if (strrchr($line, " ")) {
                $command = trim(strstr($line, ' ', TRUE));
            } else {
                $command = $line;
            }
            switch ($command) {
                case "/query":
                    $dst = trim(strstr($line, ' ', FALSE));
                    echo "[] Conversacion interactiva con $contact:\n";
                    break;
                case "/lastseen":
                    echo "[] Ultima vez en linea de $target: ";
                    $w->sendGetRequestLastSeen($target);
                    break;
                default:
                    $w->sendMessage($target , $line);
                    break;
            }
        }
}

class ProcessNode
{
    protected $wp = false;
    protected $target = false;

    public function __construct($wp, $target)
    {
        $this->wp = $wp;
        $this->target = $target;
    }

    public function process($node)
    {
        $text = $node->getChild('body');
        $text = $text->getData();
        $notify = $node->getAttribute("notify");

		echo "\n- ".$notify.": ".$text."    ".date('H:i')."\n";

	}
}  
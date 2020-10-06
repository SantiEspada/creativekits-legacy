<?php
session_start(); include('inc.php');
$tipotxt = $_GET['texto'];
$texto = '';
$titulo = '';
switch($tipotxt){
	case 'condiciones':
		$titulo = 'Términos y condiciones';
		$texto = '<h2>Forma de comprar</h2>
<div class="p">Nuestro sitio web sigue un sistema muy sencillo de compra. Simplemente hay que añadir los productos deseados a la cesta de compra y seguir los pasos indicados para confirmar el pedido. Si el cliente no tiene una cuenta previamente creada, será necesario introducir cierta información para efectuar el primer pedido. Esta información será guardada en nuestra base de datos, que sigue las condiciones explicadas en nuestra <strong>Política de privacidad.</strong></div>
<div class="p">La cesta permite escribir comentarios que consideres oportunos sobre el pedido (como por ejemplo, el color de un artículo) usar códigos promocionales antes de confirmar el pedido. También permite la posibilidad de modificar la dirección de envío <strong>siempre que el pedido no haya sido marcado ya como enviado.</strong></div>
<br>
<h2 id="envios">Envíos:</h2>
<div class="p">Realizamos envíos nacionales (excluyendo las islas Canarias, Ceuta y Melilla) y a otros países dentro del territorio aduanero de la Unión Europea.</div>
<div class="p">Enviamos los pedidos en un máximo de <strong>48 horas laborables desde</strong> el momento de <strong>la confirmación del pago</strong>. De todas formas, recibirás un correo electrónico de confirmación para indicar que tu pedido ya ha sido enviado.</div>
<div class="p noball">
	<h3>Gastos de envío</h3>
	Dependen del peso del artículo, y se calcularán automáticamente en la cesta de compra. Hay tres tramos de precios:
	<div class="p"><strong>Menos de 500g:</strong> 2,90€ - Se envía por correo ordinario y tarda aproximadamente una semana desde que lo enviamos.</div>
	<div class="p"><strong>Entre 500g y 3kg:</strong> 6,90€ - Se envía por agencia privada y tarda aproximadamente 48 horas desde que lo enviamos.</div>
	<div class="p"><strong>Entre 3kg y 10kg:</strong> 8,90€ - Se envía por agencia privada y tarda aproximadamente 48 horas desde que lo enviamos.</div>
	<div class="p"><strong>Más de 10kg:</strong> Actualmente no tenemos una tarifa fija para estos pedidos. Puedes fraccionar tu compra en varios pedidos o consultarnos por nuestras vías de contacto para que te demos unos gastos de envío personalizados.</div>
	<br><br>
	<h3>PROMOCIONES EN LOS ENVÍOS</h3>
	Si el valor total del pedido supera los 100€ en artículos (es decir, sin contar los gastos de envío ya calculados) los gastos de envío pasarán a ser gratuitos, independientemente del peso de los mismos.
	<br><br><h3>ÁMBITO</h3>
	Las anteriores tarifas y promociones solo son válidas para pedidos con destino a España peninsular o islas Baleares. Realizamos también envíos a otros países del territorio aduanero de la Unión Europea, previo pago y con tarifas que varían según el país. Puede consultar una lista de tarifas <strong>orientativas</strong> haciendo clic <a href="javascript:popUp(\'http://www.creativekits.es/envios_internacionales.php\')">aquí.</a> <br><br>
	Para realizar un pedido con destino internacional, contacta con nosotros mediante correo electrónico a contacto@creativekits.es.
</div>
<br>
<h2>Pagos:</h2>
<div class="p noball">Disponemos de dos métodos principales de pago:
	<div class="p noball">
		<h3>PayPal</h3>
		Ofrecemos la opción de pago por PayPal, los <strong>líderes en transacciones online en el mundo</strong>: con millones de usuarios, <strong>es un sistema de toda confianza</strong> y comodidad.<br><br>
		Si no tienes cuenta en PayPal, no pasa nada; en el momento del pago podrás crear una o simplemente <strong>pagar con tu tarjeta de débito/crédito al instante</strong> y sin compliaciones.
		<br>
		<br>
		<h3>Transferencia bancaria</h3>
		Después de la confirmación del pedido recibirás un correo electrónico con los datos con los que tienes que realizar la transferencia. <strong>Los productos se enviarán una vez recibamos el ingreso</strong>, informándote de ello.
        <br>
		<br>
        <h3>Contrareembolso</h3>
		Otro método de pago que ofrecemos es el contrareembolso, con el que pagarás tu pedido cómodamente en efectivo al recibirlo en tu domicilio.<br><br>
		Esta forma de pago conlleva unos gastos de gestión de 2,90€; y el importe del pedido debe ser igual o superior a 20€, excluyendo estos gastos de gestión y los de envío. 
	</div>
</div>
<br>
<h2>Devoluciones</h2>
<div class="">Todos los artículos se envían revisados y libres de defectos. No obstante, si en el momento de la recepción se encontrara alguno; puedes solicitar una devolución por nuestras vías de contacto. Después de recibir el producto, valoraremos si es necesaria una devolución y responderemos con una decisión antes de 48 horas laborables. <strong>Los gastos de envío y vuelta correrían, en todo caso, a cargo del cliente</strong></div>
<br>
<br>
<strong>Estas condiciones fueron actualizadas por última vez el 1 de julio de 2014.</strong>';
	break;

	case 'privacidad':
		$titulo = 'Política de privacidad';
		$texto = '<div class="p"><strong>CreativeKits</strong> cumple con las directrices de la <span style="font-style: italic">Ley Orgánica 15/1999 de 13 de diciembre</span> de Protección de Datos de Carácter Personal, y el <span style="font-style: italic">Real Decreto 1720/2007 de 21 de diciembre</span> por el que se aprueba el Reglamento de desarrollo de la Ley Orgánica y demás normativa vigente en cada momento, y vela por garantizar un correcto uso y tratamiento de los datos personales del usuario. Para ello, junto a cada formulario de recabo de datos de carácter personal, en los servicios que el usuario pueda solicitar a CreativeKits, hará saber al usuario de la existencia y aceptación de las condiciones particulares del tratamiento de sus datos en cada caso, informándole de la responsabilidad del fichero creado, la dirección del responsable, la posibilidad de ejercer sus derechos de acceso, rectificación, cancelación u oposición, la finalidad del tratamiento y las comunicaciones de datos a terceros en su caso. Asimismo, <strong>CreativeKits</strong> informa que da cumplimiento a la <span style="font-style: italic">Ley 34/2002 de 11 de julio, de Servicios de la Sociedad de la Información y el Comercio Electrónico</span> y le solicitará su consentimiento al tratamiento de su correo electrónico con fines comerciales en cada momento.</div>
		<br><h2 id="#cookies">Política de Cookies</h2>
		<strong>¿Qué tipos de cookies utiliza esta página web?</strong>
<div class="p"><strong>Cookies técnicas:</strong> Son aquellas creadas y gestionadas unicamente por nosotros, y permiten al usuario la navegación a través de nuestra página web y la utilización de las diferentes opciones o servicios de CreativeKits como, por ejemplo, identificar la sesión, filtrar o personalizar información, acceder a partes de acceso restringido o gestionar tu pedido.</div>
<div class="p"><strong>Cookies de análisis:</strong> Son aquellas que bien tratadas por nosotros o por terceros, nos permiten cuantificar el número de usuarios y así realizar la medición y análisis estadístico de la utilización de nuestra web. Para conseguirlo se analiza tu navegación en CreativeKits con el fin de mejorar nuestras funcionalidades.</div>
<div class="p"><strong>CreativeKits</strong> muestra un aviso indicando al usuario que se han instalado cookies en su equipo, junto con instrucciones sobre como borrarlas.</div>';
	break;

	case 'avisolegal':
		$titulo = 'Aviso legal';
		$texto = '<div class="p">En cumplimiento con el deber de información recogido en artículo 10 de la Ley 34/2002, de 11 de julio, de Servicios de la Sociedad de la Información y del Comercio Electrónico, a continuación se reflejan los siguientes datos: la persona titular de www.creativekit.es es Susana Escolar Izquierdo (en adelante CreativeKits), con domicilio a estos efectos en Calle Panadés, 9, 5º 3 en Leganés 28915 (Madrid) con NIF 08945145P; correo electrónico de contacto: contacto@creativekit.es</div> 
<br>
<h2>Condiciones de uso</h2>
<div class="p"><strong>USUARIOS:</strong> El acceso y/o uso de este portal de CreativeKits atribuye la condición de USUARIO, que acepta, desde dicho acceso y/o uso, las Condiciones Generales de Uso aquí reflejadas. Las citadas Condiciones serán de aplicación independientemente de las Condiciones Generales de Contratación que en su caso resulten de obligado cumplimiento. 
<div class="p"><strong>USO DEL PORTAL:</strong> www.creativekits.es proporciona el acceso a multitud de informaciones, servicios, programas o datos (en adelante, "los contenidos") en Internet pertenecientes a CreativeKits o a sus licenciantes a los que el USUARIO pueda tener acceso. El USUARIO asume la responsabilidad del uso del portal. Dicha responsabilidad se extiende al registro que fuese necesario para acceder a determinados servicios o contenidos. En dicho registro el USUARIO será responsable de aportar información veraz y lícita. Como consecuencia de este registro, al USUARIO se le puede proporcionar una contraseña de la que será responsable, comprometiéndose a hacer un uso diligente y confidencial de la misma. El USUARIO se compromete a hacer un uso adecuado de los contenidos y servicios que en su momento puede haber (como por ejemplo servicios de chat, foros de discusión o grupos de noticias) que CreativeKits ofrece a través de su portal y con carácter enunciativo pero no limitativo, a no emplearlos para (i) incurrir en actividades ilícitas, ilegales o contrarias a la buena fe y al orden público; (ii) difundir contenidos o propaganda de carácter racista, xenófobo, pornográfico-ilegal, de apología del terrorismo o atentatorio contra los derechos humanos; (iii) provocar daños en los sistemas físicos y lógicos de CreativeKits , de sus proveedores o de terceras personas, introducir o difundir en la red virus informáticos o cualesquiera otros sistemas físicos o lógicos que sean susceptibles de provocar los daños anteriormente mencionados; (iv) intentar acceder y, en su caso, utilizar las cuentas de correo electrónico de otros usuarios y modificar o manipular sus mensajes. CreativeKits se reserva el derecho de retirar todos aquellos comentarios y aportaciones que vulneren el respeto a la dignidad de la persona, que sean discriminatorios, xenófobos, racistas, pornográficos, que atenten contra la juventud o la infancia, el orden o la seguridad pública o que, a su juicio, no resultaran adecuados para su publicación. En cualquier caso, CreativeKits no será responsable de las opiniones vertidas por los usuarios a través de los foros, chats, u otras herramientas de participación.</div>  

<div class="p"><strong>PROPIEDAD INTELECTUAL E INDUSTRIAL:</strong> CreativeKits por sí o como cesionaria, es titular de todos los derechos de propiedad intelectual e industrial de su página web, así como de los elementos contenidos en la misma (a título enunciativo, imágenes, sonido, audio, vídeo, software o textos; marcas o logotipos, combinaciones de colores, estructura y diseño, selección de materiales usados, programas de ordenador necesarios para su funcionamiento, acceso y uso, etc.), titularidad de CreativeKits o bien de sus licenciantes. Todos los derechos reservados. En virtud de lo dispuesto en los artículos 8 y 32.1, párrafo segundo, de la Ley de Propiedad Intelectual, quedan expresamente prohibidas la reproducción, la distribución y la comunicación pública, incluida su modalidad de puesta a disposición, de la totalidad o parte de los contenidos de esta página web, con fines comerciales, en cualquier soporte y por cualquier medio técnico, sin la autorización de CreativeKits. El USUARIO se compromete a respetar los derechos de Propiedad Intelectual e Industrial titularidad de CreativeKits. Podrá visualizar los elementos del portal e incluso imprimirlos, copiarlos y almacenarlos en el disco duro de su ordenador o en cualquier otro soporte físico siempre y cuando sea, única y exclusivamente, para su uso personal y privado. El USUARIO deberá abstenerse de suprimir, alterar, eludir o manipular cualquier dispositivo de protección o sistema de seguridad que estuviera instalado en el las páginas de CreativeKits. </div>

<div class="p"><strong>EXCLUSIÓN DE GARANTÍAS Y RESPONSABILIDAD:</strong> CreativeKits no se hace responsable, en ningún caso, de los daños y perjuicios de cualquier naturaleza que pudieran ocasionar, a título enunciativo: errores u omisiones en los contenidos, falta de disponibilidad del portal o la transmisión de virus o programas maliciosos o lesivos en los contenidos, a pesar de haber adoptado todas las medidas tecnológicas necesarias para evitarlo. </div>

<div class="p"><strong>MODIFICACIONES:</strong> CreativeKits se reserva el derecho de efectuar sin previo aviso las modificaciones que considere oportunas en su portal, pudiendo cambiar, suprimir o añadir tanto los contenidos y servicios que se presten a través de la misma como la forma en la que éstos aparezcan presentados o localizados en su portal. </div>

<div class="p"><strong>ENLACES:</strong> En el caso de que en www.creativekit.es se dispusiesen enlaces o hipervínculos hacía otros sitios de Internet, CreativeKits no ejercerá ningún tipo de control sobre dichos sitios y contenidos. En ningún caso CreativeKits asumirá responsabilidad alguna por los contenidos de algún enlace perteneciente a un sitio web ajeno, ni garantizará la disponibilidad técnica, calidad, fiabilidad, exactitud, amplitud, veracidad, validez y constitucionalidad de cualquier material o información contenida en ninguno de dichos hipervínculos u otros sitios de Internet. Igualmente la inclusión de estas conexiones externas no implicará ningún tipo de asociación, fusión o participación con las entidades conectadas.</div> 

<div class="p"><strong>DERECHO DE EXCLUSIÓN:</strong> CreativeKits se reserva el derecho a denegar o retirar el acceso a portal y/o los servicios ofrecidos sin necesidad de preaviso, a instancia propia o de un tercero, a aquellos usuarios que incumplan las presentes Condiciones Generales de Uso. </div>

<div class="p"><strong>GENERALIDADES:</strong> CreativeKits perseguirá el incumplimiento de las presentes condiciones así como cualquier utilización indebida de su portal ejerciendo todas las acciones civiles y penales que le puedan corresponder en derecho. </div>

<div class="p"><strong>MODIFICACIÓN DE LAS PRESENTES CONDICIONES Y DURACIÓN:</strong> CreativeKits podrá modificar en cualquier momento las condiciones aquí determinadas, siendo debidamente publicadas como aquí aparecen. La vigencia de las citadas condiciones irá en función de su exposición y estarán vigentes hasta que sean modificadas por otras debidamente publicadas.</div>

<div class="p"><strong>LEGISLACIÓN APLICABLE Y JURISDICCIÓN:</strong> La relación entre CreativeKits y el USUARIO se regirá por la normativa española vigente y cualquier controversia se someterá a los Juzgados y tribunales de la ciudad de Madrid.</div><br><br>';
	break;
}
?>
<!DOCTYPE html>
<html lang=es>
	<head>
		<meta charset="utf-8">
		<?=$keywords?>
		<meta property="og:image" content="<?=$baseurl?>/img/facebookpic.jpg"/>
		<meta property="og:title" content="CreativeKits • <?=$titulo?>" />
		<title>CreativeKits • <?=$titulo?></title>
		<script>
 // Add a script element as a child of the body
 function downloadJSAtOnload() {
 var element = document.createElement("script");
 element.src = "<?=$baseurl?>/js/main.js";
 document.body.appendChild(element);
 }

 // Check for browser support of event handling capability
 if (window.addEventListener)
 window.addEventListener("load", downloadJSAtOnload, false);
 else if (window.attachEvent)
 window.attachEvent("onload", downloadJSAtOnload);
 else window.onload = downloadJSAtOnload;

 function popUp(URL) {
day = new Date();
id = day.getTime();
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=450,height=600');");
}
</script>
	</head>
	<body onload="cookieLaw('CreativeKits');">
	<?=$discount?>
	<?=$analytics?>
		<header>
			<div class="content">
				<div class="shoppingcart">
					<div class="icon">
						&#59197;
					</div>
					<a href="<?=$baseurl?>/cart/">Cesta de la compra</a>
					<?=countProducts($cart)?> artículo(s) - <?=dotToComma(twoDecimals($totalcostWOshipment))?>€
				</div>
				<a href="<?=$baseurl?>"><div class="logo"></div></a>
			</div>
		</header>
		<nav class="main">
			<div class="content">
				<?php showCats() ?>
			</div>
		</nav>
		<div class="header">
			<div class="content">
				<?=$titulo?>
			</div>
		</div>
		<div class="fulltextbody">
			<div class="content">
				<?=$texto?>
			</div>
		</div></div></div>
		<div class="footer">
			<div class="content">
				<div class="right">
					Todos los precios incluyen IVA
				</div>
				<a href="<?php echo $baseurl ?>/legal/condiciones#envios">Envíos y formas de pago</a> • 
				<a href="<?php echo $baseurl ?>/legal/avisolegal">Aviso legal</a> • 
				<a href="<?php echo $baseurl ?>/legal/privacidad">Política de privacidad y cookies</a> • 
				<a href="<?php echo $baseurl ?>/legal/condiciones">Términos y condiciones</a>
			</div>
		</div>
		<div class="footer footer2">
			<div class="content">
				<div class="right">
					<?=$socialLinks?>
				</div>
				&copy; 2013 CreativeKits
			</div>
		</div>
	</body>
</html>

<link rel="stylesheet" href="<?php echo $baseurl ?>/css/main.css">
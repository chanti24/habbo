<?php
/* 
*
*                  Yeezy IV
*  Todos los derechos reservados a su respectivo dueño
* 
*          @Author: Forbi <based Totix>
*
*/

require_once("engine/core.cms.php");

if(Loged == TRUE)
{
	header("Location: me");
	exit;
}
if(MANTENIMIENTO == '1') 
{
    header("Location: mantenimiento");
	exit;
}

## Hacemos el registro.
if(isset($_POST['Usuario']) && isset($_POST['Mail']) && isset($_POST['Contrasena']) && isset($_POST['RContrasena']) && isset($_POST['DD']) && isset($_POST['MM']) && isset($_POST['AAAA']))
{   

	# Definimos el cumpleaños como variables para que puedan ser introducidos a la base de datos con caracteres especiales "/"
    $dia = $_POST['DD'];
	$mes = $_POST['MM'];
	$ano = $_POST['AAAA'];
	
	# Seleccionamos el nombre introducido para que no se registren users con el mismo nombre
	$Getnombre = mysql_query("SELECT * FROM users WHERE username = '". $_POST['Usuario'] ."'");
	# Seleccionamos el email introducido para que no se registren users con el mismo email
	$Getmail = mysql_query("SELECT * FROM users WHERE mail = '". $_POST['Mail'] ."'");

	## Si estan vacios los campos, salta error
	if(empty($_POST['Usuario']) || empty($_POST['Mail']) || empty($_POST['Contrasena']) || empty($_POST['RContrasena']) || empty($dia) || empty($mes) || empty($ano))
	{
		$regerror = '<p style="color: rgba(231, 76, 60, 1.0);" align="center">No dejes los campos vacios</p>';
	}
	## Si el nombre existe, lanza error.
	elseif(mysql_num_rows($Getnombre) > 0)
	{
		$regerror = '<p style="color: rgba(231, 76, 60, 1.0);" align="center">El nombre de usuario ya esta en uso, pon otro</p>';
	}
	## Si el email existe, lanza error.
	elseif(mysql_num_rows($Getmail) > 0)
	{
		$regerror = '<p style="color: rgba(231, 76, 60, 1.0);" align="center">El email ya esta en uso, pon otro</p>';
	}
	## Si las contraseñas no coinciden, lanza error.
	elseif($_POST['Contrasena'] !== $_POST['RContrasena'])
	{
		$regerror = '<p style="color: rgba(231, 76, 60, 1.0);" align="center">Las contraseñas no coinciden</p>';
	}
    elseif (strlen($_POST['Usuario']) > 12 || strlen($_POST['Usuario']) < 4) 
	{
        $regerror = '<p style="color: rgba(231, 76, 60, 1.0);" align="center">El nombre de usuario debe de tener entre 4 y 12 caracteres</p>';
	} 
	elseif (strrpos($_POST['Usuario'], "MOD-") !== false) 
	{
	    $regerror = '<p style="color: rgba(231, 76, 60, 1.0);" align="center">No puedes registrarte con el prefijo <i>MOD-</i></p>';
    } 
	elseif (strrpos($_POST['Usuario'], " ") || strrpos($_POST['Usuario'], " ") !== false) 
	{
	    $regerror = '<p style="color: rgba(231, 76, 60, 1.0);" align="center">Tu nombre no puede contener espacios</p>';
	} 
	elseif (strrpos($_POST['Usuario'], ".") || strrpos($_POST['Usuario'], ".") !== false) 
	{
	    $regerror = '<p style="color: rgba(231, 76, 60, 1.0);" align="center">Tu nombre no puede contener puntos</p>';
	} 
    elseif ($_POST['pregunta'] !== $_SESSION['resp']) 
    {
        $regerror = '<p style="color: rgba(231, 76, 60, 1.0);" align="center">La respuesta de seguridad no es válida</p>';
    }
	else
	{
		mysql_query("INSERT INTO users (username, password, mail, look, gender, motto, ip_reg, monedas, photo_perfil, portada, date_created, birth) VALUES ('". filtro($_POST['Usuario']) ."', '".md5($_POST['Contrasena'])."', '". filtro($_POST['Mail']) ."', '". filtro($_POST['LOOK']) ."', '". filtro($_POST['Gender']) ."', '". $Holo['mision'] ."', '". $ip ."', '". $Holo['monedas'] ."', '". $Holo['foto_p'] ."', '". $Holo['portada'] ."', '" . time() ."', '$dia/$mes/$ano')");
		$_SESSION['Username'] = $_POST['Usuario'];
		$_SESSION['Password'] = $_POST['Contrasena'];
		header("Location: me");
	}
}

$_GET['Usuario'] = $_POST['Usuario'];
$_GET['Mail'] = $_POST['Mail'];
$_GET['Contrasena'] = $_POST['Contrasena'];
$_GET['RContrasena'] = $_POST['RContrasena'];
$_GET['DD'] = $_POST['DD'];
$_GET['MM'] = $_POST['MM'];
$_GET['AAAA'] = $_POST['AAAA'];
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title><?php echo $Holo['name']; ?> > Registrate</title>
		
		<script src="public/public/jquery.min.js.descarga"></script>
		<script>
			$(function() {
				var interval = 4000;
				var intervalF = setInterval(slide, interval);
				
				$('.control').click(function() {
					$('.active').removeClass('active');
					$('div.item:eq(' + $(this).data('goto') + ')').addClass('active');
					$('li.control:eq(' + $(this).data('goto') + ')').addClass('active');

					clearInterval(intervalF);
					intervalF = setInterval(slide, interval);
				});
			  
				function slide() {
					if ($('.active').is('.item:last-child')) {
						$('.active').removeClass('active');
						$('div.item').first().addClass('active');
						$('li.control').first().addClass('active');            
					} else {  
						$('div.active').removeClass('active').next().addClass('active'); 
						$('li.active').removeClass('active').next().addClass('active'); 
					}
				}
			});
		</script>
		
		<link href="public/public/css" rel="stylesheet" type="text/css">
		<link type="text/css" href="public/public/YeezyHalloween.css" rel="stylesheet">
		<link rel="icon" href="favicon.ico" type="image/gif">
		
		

	</head>
	<body>
			<div id="header_top">
				<div id="start_width">
					<div id="header_logo">
						<div class="logo"></div>
						<div class="user_online">
							¡<b><?php echo Onlines(); ?></b> usuario(s) en línea!
						</div>
					</div>
					<div id="header_hbg">
						<div id="header_button">
							<a href="index">
										<button class="checkin_client" value="">
											Go Back!
										</button>
									</a>						</div>
					</div>
				</div>
			</div>
<div id="web_main">
    <div id="main">

<div style="height: 20px;"></div>

<div style="float: left; height: 625px; width: 600px;display: block;background-color: #1b5067;background-image: url(&#39;http://imgur.com/01o0OiR.png&#39;);background-repeat: no-repeat;">
<p style="font-size: 20px;margin-bottom: 0px;padding: 5px;margin-left: 40px;margin-top: 165px;width: 103px;border-radius: 3px;color: white;margin-left: 200px;background: rgba(0,0,0,0.5);text-shadow: 0px 1px 1px rgba(0, 0, 0, 0.4);"> 
¡Este eres tú! </p>
<img src="http://www.habbo.nl/habbo-imaging/avatarimage?figure=hr-115-1028.lg-280-81.ch-3030-92.sh-290-92.ca-1813-62.hd-180-7" style="float: left;margin-top: 30px;margin-left: 225px;">
<div style="font-size: 20px;border-radius: 3px;color:white;float: right;margin-right: 26px;width: 250;margin-top: 20px; padding: 8px;height: 30px;background: rgba(0,0,0,0.5);">
Créditos: 50000
</div>
<div style="height: 10px;"></div>
<div style="font-size: 20px;border-radius: 3px;color:white;float: right;margin-right: 26px;width: 250;margin-top: 20px; padding: 8px;height: 30px;background: rgba(0,0,0,0.5);">
Duckets: 5000	
</div>
<div style="height: 10px;"></div>
<div style="font-size: 20px;border-radius: 3px;color:white;float: right;margin-right: 26px;width: 250;margin-top: 20px; padding: 8px;height: 30px;background: rgba(0,0,0,0.5);">
HC infinito
</div>
<div style="height: 10px;"></div>
<div style="font-size: 20px;border-radius: 3px;color:white;float: right;margin-right: 26px;width: 250;margin-top: 20px; padding: 8px;height: 30px;margin-left: 20px;background: rgba(0,0,0,0.5);">
Estado: ¡Nuev@ en HOBB!
</div>
                </div>
				
 <div style="width: 360px;float: right;">


                <div id="ul_box">
<form action="" method="POST">
                    <div style="font-size: 28px;font-weight: 400;" id="title">Registro</div>
					    <?php echo $regerror; ?>

															<label style="float: left;font-size: 13px;font-weight: 700;color: rgba(0,0,0,0.9);margin: 0px 25px 10px 25px;">Usuario:</label>
<input style=" float: left;width: 280px;height: auto;line-height: 35px;font-size: 13px;color: rgba(0, 0, 0, 0.9);padding: 0px 0px 0px 15px;border-radius: 5px;margin: 0px 25px 10px 25px;border: 1px solid rgba(0,0,0,0.2);border-bottom: 2px solid rgba(0,0,0,0.2);box-shadow: 0px 0px 2px rgba(0,0,0,0.05);" class="textbox" type="text" name="Usuario" id="register" placeholder="Usuario" value="<?php echo $_GET['Usuario']; ?>" pattern="^[A-Za-z0-9]+$">
<br>
					<label style="float: left;font-size: 13px;font-weight: 700;color: rgba(0,0,0,0.9);margin: 0px 25px 10px 25px;">Email:</label>
<input style=" float: left;width: 280px;height: auto;line-height: 35px;font-size: 13px;color: rgba(0, 0, 0, 0.9);padding: 0px 0px 0px 15px;border-radius: 5px;margin: 0px 25px 10px 25px;border: 1px solid rgba(0,0,0,0.2);border-bottom: 2px solid rgba(0,0,0,0.2);box-shadow: 0px 0px 2px rgba(0,0,0,0.05);" type="text" name="Mail" id="register" placeholder="Correo electronico" value="<?php echo $_GET['Mail']; ?>" class="textbox">
<br>
					<label style="float: left;font-size: 13px;font-weight: 700;color: rgba(0,0,0,0.9);margin: 0px 25px 10px 25px;">Contraseña:</label>
<input style=" float: left;width: 280px;height: auto;line-height: 35px;font-size: 13px;color: rgba(0, 0, 0, 0.9);padding: 0px 0px 0px 15px;border-radius: 5px;margin: 0px 25px 10px 25px;border: 1px solid rgba(0,0,0,0.2);border-bottom: 2px solid rgba(0,0,0,0.2);box-shadow: 0px 0px 2px rgba(0,0,0,0.05);" type="password" name="Contrasena" id="register" placeholder="Contraseña" value="<?php echo $_GET['Contrasena']; ?>" class="textbox">
<br>
					<label style="float: left;font-size: 13px;font-weight: 700;color: rgba(0,0,0,0.9);margin: 0px 25px 10px 25px;">Repita la contraseña:</label>
<input style=" float: left;width: 280px;height: auto;line-height: 35px;font-size: 13px;color: rgba(0, 0, 0, 0.9);padding: 0px 0px 0px 15px;border-radius: 5px;margin: 0px 25px 10px 25px;border: 1px solid rgba(0,0,0,0.2);border-bottom: 2px solid rgba(0,0,0,0.2);box-shadow: 0px 0px 2px rgba(0,0,0,0.05);" type="password" name="RContrasena" id="register" placeholder="Repita la contraseña" value="<?php echo $_GET['RContrasena']; ?>" class="textbox">
	<center>
												<label style="float: left;font-size: 13px;font-weight: 700;color: rgba(0,0,0,0.9);margin: 0px 80px 10px 25px;">Fecha de nacimiento:</label>

				    <input 
					style=" float: left;width: 55px;height: auto;line-height: 35px;font-size: 13px;color: rgba(0, 0, 0, 0.9);padding: 0px 0px 0px 15px;border-radius: 5px;margin: 0px 25px 10px 25px;border: 1px solid rgba(0,0,0,0.2);border-bottom: 2px solid rgba(0,0,0,0.2);box-shadow: 0px 0px 2px rgba(0,0,0,0.05);"
					class="textbox" type="text" name="DD" placeholder="DD" maxlength="2" value="<?php echo $_GET['DD']; ?>" />
					
				    <input style=" float: left;width: 55px;height: auto;line-height: 35px;font-size: 13px;color: rgba(0, 0, 0, 0.9);padding: 0px 0px 0px 15px;border-radius: 5px;margin: 0px 25px 10px 25px;border: 1px solid rgba(0,0,0,0.2);border-bottom: 2px solid rgba(0,0,0,0.2);box-shadow: 0px 0px 2px rgba(0,0,0,0.05);"
					class="textbox" type="text" name="MM" placeholder="MM" maxlength="2" value="<?php echo $_GET['MM']; ?>" />
					
				    <input style=" float: left;width: 65px;height: auto;line-height: 35px;font-size: 13px;color: rgba(0, 0, 0, 0.9);padding: 0px 0px 0px 15px;border-radius: 5px;margin: 0px 25px 10px 25px;border: 1px solid rgba(0,0,0,0.2);border-bottom: 2px solid rgba(0,0,0,0.2);box-shadow: 0px 0px 2px rgba(0,0,0,0.05);"
					class="textbox" type="text" name="AAAA" placeholder="AAAA" maxlength="4" value="<?php echo $_GET['AAAA']; ?>" />
                </center>

<br><br><br><br>
	<label style="float: left;font-size: 13px;font-weight: 700;color: rgba(0,0,0,0.9);margin: 0px 80px 10px 25px;"><?php echo GenerarPregunta(); ?></label>
                        <input class="textbox" type="text" name="pregunta" placeholder="Resultado...">

					
<br>
<button style="width: 280px;height: 40px;margin-left: 25px;/* margin-top: 137px; */" class="tb_bonus" type="submit" name="register" id="button" value=""><span style="cursor: pointer">Register</span></button>
<br><p style="
    margin-top: 53px;
"><font color="#59666e">
Al registrarse, usted está de acuerdo con nuestros  <b><font color="#86a8b8"><label for="modal-1">Términos de Uso</label></font></b> acuerdo y confirmar que ha leído nuestra política de privacidad, incluyendo las reglas para el uso de cookies.</font></p>
                   
               </form>     

                </div></div>
<input class="modal-state" id="modal-1" type="checkbox">
<div class="modal">
  <label class="modal__bg" for="modal-1"></label>
  <div class="modal__inner">
    <label class="modal__close" for="modal-1"></label>
    <h2>Términos de Uso</h2><hr>
    <p></p><h3>1. Generales</h3><br>

Nuestra plataforma de Internet (en adelante, también referido como una comunidad) ofrece a sus usuarios registrados en un mundo virtual en el que tienes la oportunidad de pasar a través de un personaje creado por uno mismo en un hotel virtual, para hacer sus propias páginas web, y para comunicar con otros usuarios. Los usuarios pueden actualizar su propio perfil independiente, con contenidos como vídeos de YouTube, una sección acerca de mí, y medios sociales. El contenido proporcionado es el único responsiblility del usuario. Cada usuario está obligado a observar los principios de la communit; En particular, esto incluye cualquier contenido que es deliberadamente inexactos, un libility, o de cumplir otros delitos que la infrinja los derechos de terceros. Dicho sea de paso, se observan las reglas normales de conducta de Internet y están en su lugar para proteger las costumbres generales.<br><br>



<h3>2. Registro y acceso al sitio</h3><br>

1. Las principales áreas o características de nuestra comunidad pueden utilizarse por razones de seguridad después de la inscripción previa. <br><br>
2.Nuestra reserva el derecho de rechazar un nombre de usuario o para cambiar, sobre todo si ya está asignada o los Términos de Servicio (reglas) se violan. Un usuario no será entregado de nuevo después de la eliminación de la cuenta. <br><br>
3.Tú nombre de usuario, si se infringe los Términos de uso o contiene otros caracteres no válidos, será rechazada durante el registro. <br><br>
<h3>3. Mi contenido</h3><br>

1.Nuestra reserva el derecho de alterar los textos o datos, eliminar y amonestar al usuario, cerrar la cuenta si incluye cualquiera de los siguientes: <br><br>
✓ contenido glorificar la violencia, el racismo o la discriminación, promover, aprobar o restar importancia a <br>
✓ contenido nazi <br>
✓ sexista, pornográfico y de contenido no adecuado <br>
✓ contenido erótico, especialmente fotos que muestran a una persona que no haya alcanzado la edad de 18 años en el momento de la formación de la foto <br>
✓ Contenido para adultos <br>
✓ Los enlaces a los sitios de suscripción y los números de peaje <br>
✓ Contenido que viole alguna patente, en particular, los derechos de autor y los derechos personales (por ejemplo: información personal acerca de otro usuario o un tercero), perjudicando y comentarios despectivos u ofensivos <br>
✓ spam <br>
✓ Los datos que son adecuados, nos daña o inducir a terceros (tales como virus, troyanos, dialers) guía
✓ contenido con el que se promueven <br> sus intereses comerciales o financieros, o los de un tercero
✓ contenidos que violen la ley o el Código de Conducta o permiten o fomentan una infracción <br>
<br>
 2.Las posibles sanciones o medidas que puedan ser ejercidos en violación de nosotros contra usted:<br>
<br>
✓ Nosotros modificamos el contenido de modo que ya no infringe las condiciones de uso. <br>
✓ Borramos el contenido ilegal que has publicado / utilizado. <br>
✓ Usted no recibirá más autoridad, en charlas públicas / privadas y públicas para escribir durante un cierto periodo de tiempo o nosotros cancelamos el chat de forma indefinida para usted. <br>
✓ Su cuenta será bloqueada sin previo aviso durante un determinado período o para siempre por nuestros moderadores o administradores. <br><br>

<h3>4. Supresión de la cuenta</h3><br>


1. Si lo desea, puede pedir en cualquier momento debe ser eliminado o borrado de las bases de datos. Nos reservamos el derecho de citar a un periodo de borrado de un mes, como la eliminación de los datos de usuario de todas las bases de datos y servicios relacionados tarda mucho tiempo en completarse. <br><br>

  2. Después de que ha solicitado la eliminación, de forma automática se dará por terminado su cuenta. <br><br>

  3. Una solicitud de cancelación no se puede deshacer. <br><br>
<h3>5. Garantía</h3><br>

1.Nosotros no puedemos garantizar que el sitio estará disponible en todo momento sin interrupción y / o errores, incluyendo el mal funcionamiento de las obras libres. Debido a las circunstancias técnicas que no están dentro del control de la Compañía, que puede conducir a fallos; Por ejemplo: podría haber una indisponibilidad temporal del sitio en su totalidad. Esto también se aplica en el caso de mantenimiento y actualizaciones. Cualquier actualización o mantenimiento serán explicados en un plazo razonable antes de que suceda, y serán necesarios los impedimentos a los usuarios asociados a convenir en una medida razonable. <br>
<h3>6. Política de privacidad</h3><br>

1.any los datos solicitados por nosotros sobre usted mismo se impondrán de acuerdo con la política de privacidad y la ley de protección de datos. Se puede almacenar, procesar y / o eliminado. <br><br>
  2. Salvo que va a enlazar las políticas de privacidad que se han explicado en el contexto del acuerdo de registro, puede revocar en cualquier momento por e-mail con el consentimiento. <br>
<h3>7. Provisiones finales</h3><br>

1. La política de privacidad, el Código de Conducta ('reglas') también forman parte de estos Términos de Uso. <br><br>
2.Nuestra reserva el derecho a modificar las condiciones de uso en cualquier momento y le informará a su debido tiempo de los cambios. <br><br>
3.Se aplica la ley Inglés.<p></p><br>
  </div>
</div>
<div style="clear:both;"></div>
<div style="height:20px;"></div>
<div style="clear:both;"></div>
   <div style="width: 310px;margin-right: 15px;float: left;">
 <div id="ul_box">
 <div class="subimage1"></div>
  <p><?php echo $Holo['name']; ?> Hotel es un mundo virtual libre donde se puede conversar, caminar, y amigos pueden reunirse. También es posible disponer de su propia habitación.</p>
 </div>
 </div>
   <div style="width: 310px;margin-right: 15px;float: left;">
 <div id="ul_box">
<div class="subimage2"></div>
  <p>En <?php echo $Holo['name']; ?> Hotel se pueden hacer nuevos amigos. Chatear con ellos, jugar o construir su propia habitación. Usted será entretenido en <?php echo $Holo['name']; ?> Hotel!</p>
 </div>
 </div>
   <div style="width: 310px;margin-right: 0px;float: left;">
 <div id="ul_box">
<div class="subimage3"></div>
  <p>Construir su propia habitación, y participar en grandes competiciones! Convertido en uno de los más ricos en el hotel, unirse al resto y divertirse.</p>
 </div>
 </div>

    </div>
</div>

		<div style="clear:both; height:20px;"></div>
		<div style="position: absolute; width:100%;" class="footer">
            <div id="swidth">
               <center> <font size="2" color="white">
<p style="line-height: 1px;">© 2016 Creado por <a href="https://www.facebook.com/rickholos" style="float:font-size:20px;" target="_blank"><font color="#a7d8df"><b>Forbi</b></font></a> para <a href="#" style="color: inherit;text-decoration:none;"><?php echo $Holo['name']; ?></a>. Esto una copía de habbo, no tiene nada que ver con Sulake Corp Oy. - &copy; <b>Based Totix</b> </p>
					
				</font></center>
            </div>
        </div>
	
</body></html>
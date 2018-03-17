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

if(Loged == FALSE)
{
	header("Location: /");
	exit;
}
if(MANTENIMIENTO == '0') 
{
    header("Location: /");
	exit;
}
if(mysql_num_rows($chb) > 0) 
{
    header("Location: banned");
	exit;
}
?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="shortcut icon" href="<?php echo $Holo['url']; ?>/favicon.ico" type="image/vnd.microsoft.icon" />
        <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Maven+Pro' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Pinyon+Script' rel='stylesheet' type='text/css'>
        <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo $Holo['url']; ?>/assets/css/mantenimiento.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $Holo['url']; ?>/assets/fonts/style.css" />

            <title><?php echo $Holo['name']; ?> : Mantenimiento del hotel</title>

    </head>
<body>
    <center>
        <h1>¡El hotel <?php echo $Holo['name']; ?> se encuentra en mantenimiento! <?php if($myrow['rank'] >= $Holo['minhkr']) { ?><a href="<?php echo $Holo['url'] . '/' . $Holo['panel']; ?>">- Administración</a><?php } ?></h1>
	</center>	
		
    <p>Así es querido usuario, si estas en esta página es porque estamos trabajando para darte una mejor experiencia y estancia en el hotel, gracias por tu comprensión.</p>
	
	<div class="izquierda">El motivo de que el hotel este en mantenimiento es: 
	<br /><br />
	<?php echo $mantenimientoo['motivo']; ?>
	<br /><br />
	
	<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v2.6";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="fb-like" data-href="https://www.facebook.com/YeezyCMS" data-layout="standard" data-show-faces="true"></div>
    </div>

	<?php include("templates/add_facebook.php"); ?>
	
	<div class="footer"><center><?php echo $Holo['footer']; ?></center></div>
	
</body>
</html>
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
if(mysql_num_rows($chb) > 0) 
{
    header("Location: banned");
	exit;
}
if(MANTENIMIENTO == '1' && $myrow['rank'] < $Holo['maxrank']) 
{
    header("Location: mantenimiento");
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
        <link rel="stylesheet" type="text/css" href="<?php echo $Holo['url']; ?>/assets/css/general.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $Holo['url']; ?>/assets/fonts/style.css" />

            <title><?php echo $Holo['name']; ?> > Equipo Administrativo</title>

    </head>
<body>
    
    <!-- Header y nav -->
    <?php include_once("templates/header.php"); ?>

    <!-- Cuerpo -->
    <div id="cuerpo">
		
            <?php include("templates/equipo.php"); ?>
		
	
		
    </div>
	

	<!-- Footer de la web -->
	
	<div class="space"></div>
	
    	<?php echo $Holo['footer']; ?>

</body>
</html>
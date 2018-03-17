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

## Configuración del cliente

	$_config['client'] = array(
	'host' 					=> 'localhost',
	'port' 					=> '30000',
	'external_variables' 	=> 'http://localhost/swf/gamedata/external_variables.txt',
	'external_flash_texts' 	=> 'http://localhost/swf/gamedata/external_flash_texts.txt',
	'productdata' 			=> 'http://localhost/swf/gamedata/productdata.txt',
	'furnidata' 			=> 'http://localhost/swf/gamedata/furnidata.xml',	
	'flash_client_url' 		=> 'http://localhost/swf/gordon/PRODUCTION-201607262204-86871104/',
	'habbo_swf' 			=> 'Habbo.swf'
);


$ticket = time().sha1(rand(10000,99999));

mysql_query("UPDATE users SET auth_ticket = '', auth_ticket = '".$ticket."', ip_last = '', ip_last = '".$ip."' WHERE id = '".$myrow['id']."'") or die(mysql_error());
	
$ticketsql = mysql_query("SELECT * FROM users WHERE id = '".$myrow['id']."'") or die(mysql_error());
$ticketrow = mysql_fetch_assoc($ticketsql);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
<title><?php echo $Holo['name']; ?> - Juega con nosotros</title> 
 
<script type="text/javascript"> 
var andSoItBegins = (new Date()).getTime();
var ad_keywords = "";
document.habboLoggedIn = true;
var habboName = "<?php echo $myrow['username']; ?>";
var habboReqPath = "<?php echo $Holo['url']; ?>";
var habboStaticFilePath = "<?php echo $Holo['url']; ?>/web-gallery";
var habboImagerUrl = "https://www.habbo.nl/habbo-imaging/";
var habboPartner = "";
var habboDefaultClientPopupUrl = "<?php echo $Holo['url']; ?>/client";
window.name = "habboMain";
if (typeof HabboClient != "undefined") { HabboClient.windowName = "uberClientWnd"; }
</script> 
<link rel="shortcut icon" href="<?php echo $Holo['url']; ?>/web-gallery/v2/favicon.ico" type="image/vnd.microsoft.icon" />
<script src="<?php echo $Holo['url']; ?>/web-gallery/static/js/libs2.js" type="text/javascript"></script>
<script src="<?php echo $Holo['url']; ?>/web-gallery/static/js/visual.js" type="text/javascript"></script>
<script src="<?php echo $Holo['url']; ?>/web-gallery/static/js/libs.js" type="text/javascript"></script>
<script src="<?php echo $Holo['url']; ?>/web-gallery/static/js/common.js" type="text/javascript"></script>
<script src="<?php echo $Holo['url']; ?>/web-gallery/static/js/fullcontent.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?php echo $Holo['url']; ?>/web-gallery/styles/style.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $Holo['url']; ?>/web-gallery/styles/buttons.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $Holo['url']; ?>/web-gallery/styles/boxes.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $Holo['url']; ?>/web-gallery/styles/tooltips.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $Holo['url']; ?>/web-gallery/styles/habboclient.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $Holo['url']; ?>/web-gallery/styles/habboflashclient.css" type="text/css" />
<script src="<?php echo $Holo['url']; ?>/web-gallery/static/js/habboflashclient.js" type="text/javascript"></script>
 
<meta name="description" content="HabboCash is a virtual world where you can meet and make friends. Make friends, join the fun, get noticed!" />
<meta name="keywords" content="nillus, ragezone, retro, keep it real, private server, free, credits, habbo hotel , virtual, world, social network, free, community, avatar, chat, online, teen, roleplaying, join, social, groups, forums, safe, play, games, online, friends, teens, rares, rare furni, collecting, create, collect, connect, furni, furniture, pets , room design, sharing, expression, badges, hangout, music, celebrity, celebrity visits, celebrities, mmo, mmorpg, massively multiplayer" />
 
<!--[if IE 8]>
<link rel="stylesheet" href="<?php echo $Holo['url']; ?>/web-gallery/v2/styles/ie8.css" type="text/css" />
<![endif]-->
<!--[if lt IE 8]>
<link rel="stylesheet" href="<?php echo $Holo['url']; ?>/web-gallery/v2/styles/ie.css" type="text/css" />
<![endif]-->
<!--[if lt IE 7]>
<link rel="stylesheet" href="<?php echo $Holo['url']; ?>/web-gallery/v2/styles/ie6.css" type="text/css" />
<script src="<?php echo $Holo['url']; ?>/web-gallery/static/js/pngfix.js" type="text/javascript"></script>
<script type="text/javascript">
try { document.execCommand('BackgroundImageCache', false, true); } catch(e) {}
</script>
 
<style type="text/css">
body { behavior: url(https://www.habbo.nl/js/csshover.htc); }
</style>
<![endif]-->

<!DOCTYPE html>
<html lang="es_ES">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />


        <meta name="description" content="Diversión al limite!" />
        
        <script type="text/javascript" src="<?php echo $Holo['url']; ?>/libs2.js"></script>
        
        <style type="text/css"> 
            * { margin: 0; padding: 0; }
            html, #flash-container { height: 100%; text-align: left; background-color: black; }
            #flash-container { position: absolute; overflow: hidden; left: 0; top: 0; right: 0; bottom: 0; }
        </style>


        <script type="text/javascript">
    FlashExternalInterface.loginLogEnabled = false;
   
    FlashExternalInterface.logLoginStep("web.view.start");
   
    if (top == self) {
        FlashHabboClient.cacheCheck();
    }
        var flashvars = {
            "client.allow.cross.domain" : "0", 
            "client.notify.cross.domain" : "1", 
            "connection.info.host" : "<?php echo $_config['client']['host']; ?>", 
            "connection.info.port" : "<?php echo $_config['client']['port']; ?>", 
            "site.url" : "<?php echo $Holo['url']; ?>", 
            "url.prefix" : "<?php echo $Holo['url']; ?>", 
            "client.reload.url" : "<?php echo $Holo['url']; ?>/client", 
            "client.fatal.error.url" : "<?php echo $Holo['url']; ?>/client", 
            "client.connection.failed.url" : "<?php echo $Holo['url']; ?>/client", 
            "logout.url" : "<?php echo $Holo['url']; ?>/client", 
            "logout.disconnect.url" : "<?php echo $Holo['url']; ?>/client", 
            "external.variables.txt" : "<?php echo $_config['client']['external_variables']; ?>", 
            "external.texts.txt" : "<?php echo $_config['client']['external_flash_texts']; ?>",
            "productdata.load.url" : "<?php echo $_config['client']['productdata']; ?>", 
            "furnidata.load.url" : "<?php echo $_config['client']['furnidata']; ?>",  
            "processlog.enabled" : "1", 
            "account_id" : "<?php echo $myrow['id']; ?>",
            "client.starting" : "¡Por favor, espera <?php echo $myrow['username']; ?>! <?php echo $Holo['name']; ?> se está cargando", 
            "flash.client.url" : "<?php echo $_config['client']['flash_client_url']; ?>", 
            "sso.ticket" : "<?php echo $ticketrow['auth_ticket']; ?>",
            "user.hash" : "5690170255dbf26e0275377f436614c91d1a810d", 
            "has.identity" : "1", 
            "flash.client.origin" : "popup", 
            "nux.lobbies.enabled" : "false", 
            "country_code" : "DO" 
            };
 
    var params = {
        "base" : "<?php echo $_config['client']['flash_client_url']; ?>",
        "allowScriptAccess" : "always",
        "menu" : "false"                
    };
   
    if (!(HabbletLoader.needsFlashKbWorkaround())) {
        params["wmode"] = "opaque";
    }
    
    FlashExternalInterface.signoutUrl = "<?php echo $Holo['url']; ?>/me.php?action=logout";
 
    var clientUrl = "<?php echo $_config['client']['flash_client_url'] . $_config['client']['habbo_swf']; ?>";
    swfobject.embedSWF(clientUrl, "flash-container", "100%", "100%", "10.0.0", "<?php echo $Holo['url']; ?>/web-gallery/flash/expressInstall.swf", flashvars, params);
 
    window.onbeforeunload = unloading;
    function unloading() {
        var clientObject;
        if (navigator.appName.indexOf("Microsoft") != -1) {
            clientObject = window["flash-container"];
        } else {
            clientObject = document["flash-container"];
        }
        try {
            clientObject.unloading();
        } catch (e) {}
    }
	</script>

    </head>
    <body>
	echo"<script>alert('Antes de jugar suscribete al canal de AngelHolos para estar informado de cosas sobre holos, una vez hecho dale a aceptar')</script>";
        <div id="flash-container">
        </div>
    </body>
</html>
 </script>
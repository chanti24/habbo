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

if(isset($_GET['r']) && !empty($_GET['r']) {

	$r = mysql_real_escape_string($_GET['r']);

	$sql = mysql_query("SELECT * FROM users WHERE ip_last = '" . $ip . "'");
	$sql1 = mysql_query("SELECT * FROM users_referidos WHERE ip_referida = '". $ip ."'");
	$sql2 = mysql_query("SELECT * FROM users WHERE username = '". $r ."'");

	if(mysql_num_rows($sql) > 0) {
		header("Location: /");
		exit;
	} elseif(mysql_num_rows($sql1) > 0) {
        header("Location: /");
        exit;
	} elseif(mysql_num_rows($sql2) == 0) {
		header("Location: /");
		exit;
	} else {
	    mysql_query("INSERT INTO users_referidos (usuario, ip_referida, fecha) VALUES ('". $r ."', '". $ip ."', '". $date_normal ."')");
	    header("Location: registro");
	}
} else {
	header("Location: /");
	exit;
}
?>
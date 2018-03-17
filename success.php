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

if(isset($_GET['m'])) {
	if(!empty($_GET['m'])) {
		$m = mysql_real_escape_string($_GET['m']);

        if($m == '903ucd29n84377384tf6cbgauydgbu73w4i') {
        	mysql_query("UPDATE users SET monedas = monedas + 10 WHERE id = '". $myrow['id'] ."'");
        	header("Location: me.php");
        	exit;
        } 
        elseif($m == 'f3ofn87ched9cfn8wcro87fuhwnnc4rf') {
        	mysql_query("UPDATE users SET monedas = monedas + 25 WHERE id = '". $myrow['id'] ."'");
        	header("Location: me.php");
        	exit;
        } 
        elseif($m == 'dnhifx34xi2w47f6igw4rxnfgnwi2fon') { 
            mysql_query("UPDATE users SET monedas = monedas + 60 WHERE id = '". $myrow['id'] ."'");
            header("Location: me.php");
            exit;
        } 
        elseif($m == 'dh38endh2387n4gxhqinndu7y348n7nd') { 
            mysql_query("UPDATE users SET monedas = monedas + 100 WHERE id = '". $myrow['id'] ."'");
            header("Location: me.php");
            exit;
        } else {
        	echo 'Error: no se puedieron recargar las monedas, intentalo más tarde.';
        }

    } else { 
    	header("Location: /");
    }
} elseif(isset($_GET['b']) && !empty($_GET['b'])) {
    $b = mysql_real_escape_string($_GET['b']);

    $b_info_b = mysql_query("SELECT * FROM cms_badges WHERE badge_id = '". $b ."'");
    $b_info = mysql_fetch_assoc($b_info_b);

    if(mysql_num_rows($b_info_b) > 0) {
        if($myrow['vip_points'] >= $b_info['cost']) {
            if($b_info['b_limit'] > 0) {

                $sql_b = mysql_query("INSERT INTO user_badges (user_id, badge_id, badge_slot) VALUES ('". $myrow['id'] ."', '". $b_info['badge_id'] ."', '0')");
                $sql_b_c = mysql_query("UPDATE users SET vip_points = vip_points - '". $b_info['cost'] ."' WHERE id = '". $myrow['id'] ."'");
                $sql_b_l = mysql_query("UPDATE cms_badges SET b_limit = b_limit - 1 WHERE id = '". $b_info['id'] ."'");
        
                if($sql_b && $sql_b_c && $sql_b_l) {
                    header("Location: shop");
                    exit;
                } else {
                    $error = '<div id="error">Error: no se pudo dar la placa.</div>';
                }   
            } else {
                header("Location: shop");
                exit;
            }   
        } else { 
            header("Location: shop");
            exit;
        }
    } else {
        header("Location: shop");
        exit;
    }     
} else {
    header("Location: shop");
    exit;
}
?>
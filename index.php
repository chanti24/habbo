
<?php
/*
*
*                 
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
// Hacemos el Login
if(isset($_POST['Username']) && isset($_POST['Password']))
{
	// Seleccionamos al usuario introducido.
	$Getuser = mysql_query("SELECT * FROM users WHERE username = '". $_POST['Username'] ."' AND password = '". md5($_POST['Password']) ."'");
	// Si los campos estan vacios, lanza error
	if(empty($_POST['Username']) || empty($_POST['Password']))
	{
		$loginerror = '<div style="color:#fff;background-color:#c00;width: 100%;margin:0;height:35px;line-height: 32px;text-align:center;top:5px;">Debes llenar todos los campos</div>';
	}
	// Si el usuario no existe, lanza error
	elseif(mysql_num_rows($Getuser) == 0)
	{
		$loginerror = '<div style="color:#fff;background-color:#c00;width: 100%;margin:0;height:35px;line-height: 32px;text-align:center;top:5px;">El usuario no existe o la contraseña es incorrecta</div>
';
	}
	// Si no hubo ningún error, agarra la sesión del usuario
	else
	{
		if(mysql_num_rows($Getuser) > 0)
		{
			$_SESSION['Username'] = $_POST['Username'];
			$_SESSION['Password'] = $_POST['Password'];
			header("Location: me");
		}
	}
}
?>
<?php echo $loginerror; ?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<title><?php echo $Holo['hololatin']; ?> > Haz amig@s, crea salas, diviertete.</title>
		<link rel="shortcut icon" href="public/img/favicon.ico">
		<link type="text/css" href="public/css/habbo.css" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Ubuntu:300" rel="stylesheet" type="text/css">
		<script src="public/js/jquery.js"></script>
		<link type="text/css" href="public/css/bootstrap.css" rel="stylesheet">
		<script type="text/javascript" src="public/js/smoothscroll.js"></script>
	</head>
	<body>
		<div id='header-content' style='background:#'>
			<div style="background-image: url('public/img/top_gauche.png');position:absolute;float:left;height: 167px;width: 503px;"></div>
			<div style="background-image: url('public/img/top_droit.png');position:absolute;height: 167px;float: right;right: 0px;width: 337px;"></div>
			<div class='container_24'>
				<div class='grid_24'>
					<a href=''>
						<div class='habbologo'></div>
					</a>
					<div id="changeColorBox">
						<div newcolor="#55D1F9" class="color" style="background-color: #55D1F9"></div>
						<div newcolor="#4CAF50" class="color" style="background-color: #4CAF50"></div>
						<div newcolor="#e67e22" class="color" style="background-color: #e67e22"></div>
						<div newcolor="#D04336" class="color" style="background-color: #D04336"></div>
						<div newcolor="#00796B" class="color" style="background-color: #00796B"></div>
					</div>
					<div class='onlineBox'>
						<div class='arrow'></div>
						<div id="load_tweets"><b><?php echo Onlines(); ?></b> usuarios conectados</div>
					</div>
				</div>
			</div>
			<nav style="top: 87px; width: 100%; z-index: 100; " class="navbar navbar-default">
				<div style="" class="container-fluid">
					<div style="margin-left: auto; margin-right: auto;" class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						</button>

					</div>
					<div class="container">
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							<ul class="nav navbar-nav">
								<li style="margin-left: 80px;" class="dropdown">
									<a href="../index.php" class="dropdown-toggle"><span class="glyphicon glyphicon-home"></span> Inicio</a>
								</li>
								<li class="dropdown">
									<a href="registro" class="dropdown-toggle"><span class="glyphicon glyphicon-globe"></span> Registrarme</a>
								</li>
							</ul>
							<ul class="nav navbar-nav navbar-right">
								<a target="_blank" class="btn btn-success" href="<?php echo $Holo['fb']; ?>" style="background-color: #3b5998;">Facebook</a>
							</ul>
						</div>
					</div>
				</div>
			</nav>
		</div>
		<br>
		<br>
		<br>
		<br><style>.header{background-color:#34495e;background-image:url('./public/img/header.png');width:100%;height:155px;}.box-connexion{background-color:rgba(202,202,202,0.54);background-image:url('./public/img/index.png');background-repeat:no-repeat;width:960px;height:425px;margin-top:25px;border-bottom:4px groove #34495e;}.rideau{background-color:#444;width:960px;height:56px;opacity:0.9;}.triangle{width:0;height:0;border-style:solid;border-width:19px 19px 0 19px;border-color:#444444 transparent transparent transparent;margin-left:525px;}form{margin:7px -30px;display:flex;position:absolute;}input[type="text"],input[type="password"]{box-sizing:border-box;-webkit-box-sizing:border-box;margin:-2px 44px 68px;-moz-box-sizing:border-box;outline:none;width:30%;display:-webkit-inline-box;padding:7px;border:none;border-bottom:1px solid #ddd;background:transparent;margin-bottom:10px;font-size:20px;height:45px;cursor:text;color:#FFF;}a{text-decoration:none;}.content{position:relative;margin-left:auto;margin-right:auto;width:960px;}.arrow{border-style:solid;border-color:transparent #fff transparent transparent;position:absolute;border-width:17px;left:-30px;top:50%;margin-top:-16px;}.button.green{background-color:#4CAF50;color:#fff;}.button.raised{transition:box-shadow 0.2s cubic-bezier(0.4,0,0.2,1);transition-delay:0.2s;box-shadow:0 2px 5px 0 rgba(0,0,0,0.26);}.button{display:inline-block;position:relative;width:120px;height:32px;line-height:32px;border-radius:2px;font-size:14px;background:#fff;color:#646464;cursor:pointer;text-decoration:none;}.button.green:hover{background-color:#4FD455;}</style>
		<center>
		<div class="box-connexion">
			<div class="rideau">
				<form action="" method="POST">
					<input type="text" name="Username" placeholder="USUARIO"/>
					<input type="password" name="Password" placeholder="CONTRASEÑA"/>
					<button type="submit" name="login" class="btn btn-success" style="padding: 4px 24px; width: 200px; line-height: 10px; font-size: 21px; height: 40px;">ENTRAR</button>
				</form>
			</div>
			<div class="triangle">
			</div>
			<a href="registro" class="btn btn-success" id="checkInHeader" style="text-decoration:none;height: 115px;padding: 24px 47px;width: auto;font-size: 29px;line-height: 35px;position: relative;float: right;top: 55px;right: 80px;">REGISTRATE<br/>GRATIS</a>
		</div>
		</center>
		<div id="footer">
			<div class="sections">
				<div class="left">
					<p style="line-height: 50px;">© 2016 Creado por <a href="https://www.facebook.com/rickholos" style="color: inherit;text-decoration:none;" target="_blank">Forbi</a> para <a href="#" style="color: inherit;text-decoration:none;"><?php echo $Holo['name']; ?></a>. Esto una copía de habbo, no tiene nada que ver con Sulake Corp Oy. - &copy; <b>Based Totix</b><a href="https://www.facebook.com/rickholos" style="float:right;font-size:16px;" target="_blank">Forbi Holos</a></p>
				</div>
			</div>
		</div></body>
	</html>

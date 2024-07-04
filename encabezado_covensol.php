<?php 
session_start(); 

if((!array_key_exists("ls_database",$_SESSION))||(!array_key_exists("ls_hostname",$_SESSION))||(!array_key_exists("ls_gestor",$_SESSION))||(!array_key_exists("ls_login",$_SESSION))||(!array_key_exists("la_logusr",$_SESSION))||(!array_key_exists("la_empresa",$_SESSION)))
{
	print "<script language=JavaScript>";
	print "location.href='sigesp_inicio_sesion.php'";
	print "</script>";		
}
$ls_tipocontabilidad=$_SESSION["la_empresa"]["esttipcont"];

$ls_usuario=$_SESSION["la_codusu"];
$ls_clave=$_SESSION["la_pasusu"];

$ruta = '';
require_once($ruta."shared/class_folder/sigesp_include.php");
require_once($ruta."shared/class_folder/class_sql.php");
require_once($ruta."shared/class_folder/sigesp_c_seguridad.php");
require_once($ruta."shared/class_folder/sigesp_c_seguridad_modulos.php");
require_once($ruta."shared/class_folder/class_menu_ext.php");

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>M&oacute;dulos <?php print $_SESSION["ls_database"] ?> </title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="shared/css/tablas.css" rel="stylesheet" type="text/css">
<link href="shared/css/ventanas.css" rel="stylesheet" type="text/css">
<link href="shared/css/cabecera.css" rel="stylesheet" type="text/css">
<link href="shared/css/general.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body{color:#FFFFFF;font-family:Tahoma, Verdana, Arial;font-size:12px;margin:0px; background-image:url(shared/imagebank/degradadoazul.jpg)}
-->
</style>
</head>

<body>
<div align="left" style="float:left"><strong>Conexi&oacute;n:</strong> <?php echo $_SESSION["ls_database"] ?></div>
<div align="left" style="float:left"><strong>&nbsp;&nbsp;&nbsp;&nbsp;Usuario:</strong> <?php echo $_SESSION["la_codusu"] ?></div>
</body>
</html>
<script language="javascript">
</script>
<?php 

?>
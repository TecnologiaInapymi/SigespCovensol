<?php 
session_start();
require_once("sss/covensol_sss_c_login.php");
$objsss = new covensol_sss_c_login("");
require_once('shared/class_folder/JSON.php');
require_once("covensol_config.php");
$json = new JSON();
$objsss->config = $empresa;
$objsss->config = $empresa;
$objsss->io_conexiones->decodificar_post();
$opciones = $objsss->io_conexiones->asignar_post();

$resp = $objsss->Login($_POST['id_conf'],$_POST['codemp'],$_POST['codusu'],strtoupper(md5($_POST['pwdusu'])));
if($resp===false){session_destroy(); exit();}

$objsss->io_conexiones->ejecutar_js("ir_modulos");				

?>

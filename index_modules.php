<?php 
session_start(); 
$_SESSION['disable_trans']=0;
//print_r($_SESSION);
if((!array_key_exists("ls_database",$_SESSION))||(!array_key_exists("ls_hostname",$_SESSION))||(!array_key_exists("ls_gestor",$_SESSION))||(!array_key_exists("ls_login",$_SESSION))||(!array_key_exists("la_logusr",$_SESSION))||(!array_key_exists("la_empresa",$_SESSION)))
{
	print "<script language=JavaScript>";
	//print "parent.location.href='sigesp_inicio_sesion.php'";
	print "</script>";		
}
$ls_tipocontabilidad=$_SESSION["la_empresa"]["esttipcont"];

$ls_usuario=$_SESSION["la_codusu"];
$ls_clave=$_SESSION["la_pasusu"];

if(array_key_exists("operacion",$_POST))
{
	$ls_operacion=$_POST["operacion"];
}
else
{
	$ls_operacion="";
}

$ruta = '';
require_once($ruta."shared/class_folder/sigesp_include.php");
require_once($ruta."shared/class_folder/class_sql.php");
require_once($ruta."shared/class_folder/sigesp_c_seguridad.php");
require_once($ruta."shared/class_folder/sigesp_c_seguridad_modulos.php");
require_once($ruta."shared/class_folder/class_menu_ext.php");
require_once($ruta."shared/class_folder/covensol_c_validador.php");
$obj_menu = new menu;
$modulo = new seguridad_modulos;

$objval = new covensol_c_validador($propiedades);
$objval->ValidarExpiracion();
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
body{color:#DFE8F6;font-family:Tahoma, Verdana, Arial;font-size:11px;margin:0px;background-color:#DFE8F6;}
.fondo_modulos {
	background:url(shared/imagebank/modulos/modulos_covensol.jpg) no-repeat;
}
.titulo {
	font-family: Tahoma, Verdana, Arial;
	font-size: 16px;
	font-weight: bold;
	color: #666666;
}
.fondotab {	
	background-color: #666666;
}
.icono_mod{

	
	width:80px;
	

}
.icono_mod a:link, .icono_mod a:visited,.icono_mod a:hover ,.icono_mod a:active{
	font-size: 9px;
	font-family: Tahoma, Verdana, Arial;
	color:#000066;
	font-weight:normal;
	text-decoration: none;

}
.sigesp_icono{

	background:url(shared/imagebank/iconos/logo_inicio.gif) no-repeat;

}
.style1 {font-size: 12px}
.style6 {font-size: 16px}
.style7 {color: #FF0000}
.Estilo1 {
	font-size: 10px;
	color: #898989;
}
.salir{  
	background:url(shared/imagebank/iconos/salir.gif) no-repeat !important;
}
.manuales{  
	background:url(shared/imagebank/tools20/ayuda.gif) no-repeat !important;
}
.ocultar{
	display:none;
}   
-->
</style>

<link rel="stylesheet" type="text/css" href="base/librerias/js/ext4/resources/css/ext-all.css" />
<script type="text/javascript" src="base/librerias/js/ext4/adapter/ext/ext-base.js"></script>
<script type="text/javascript" src="base/librerias/js/ext4/ext-all-debug.js"></script>
<script type="text/javascript" src="base/librerias/js/ext4/locale/ext-lang-es.js"></script> 
<script type="text/javascript" src="shared/js/index_modules_covensol.js"></script>


<style type="text/css">
    .my-tabs .x-tab-active {
        background-color: Yellow;
        background-image: none;
    }
</style>
&nbsp;&nbsp;&nbsp;&nbsp;
<?php //echo $obj_menu->coloca_barra('MOD','',''); ?>
</head>

<body>
<?php 
	
	switch ($ls_operacion) 
	{
		case "CAMBIO_BD":
		   	
			/// validación del release necesario
			require_once("shared/class_folder/sigesp_release.php");
			$io_release= new sigesp_release();
			
			$lb_valido=$io_release->io_function_db->uf_select_column('sigesp_empresa','estcamemp');
			if($lb_valido==false)
			{
				?>
	           <script language="javascript">
			   alert("Debe Procesar Instala/Procesos/Mantenimiento/Release 2008_2_53 ");
			   close();
			   </script>
	          <?php	
			}
			else
			{
				require_once("shared/class_folder/sigesp_include.php");
				require_once("shared/class_folder/class_mensajes.php");
				require_once("shared/class_folder/class_sql.php");
				$in=new sigesp_include();
				$con=$in->uf_conectar();
				$msg=new class_mensajes();
				$io_sql=new class_sql($con);
				
				$ls_codemp= $_SESSION["la_empresa"]["codemp"];
				$ls_sql  =" SELECT estcamemp ".
						  " FROM sigesp_empresa".
						  " WHERE codemp = '".$ls_codemp."' ";
						 
				$rs_data=$io_sql->select($ls_sql);
				
				if ($rs_data===false) 
				{
				  ?>
				   <script language="javascript">
				   alert("No se puede efectuar la operacion");
				   close();
				   </script>
				  <?php
				  $lb_valido = false;
				} 
				else
				{
				  $li_numrows = $io_sql->num_rows($rs_data);
				  if ($li_numrows>0)
				  {
					   if($row=$io_sql->fetch_row($rs_data))
						{
						 
							  $ls_estcamemp = $row["estcamemp"];
							  if ($ls_estcamemp==0)
							  {
									?>
									<script language="javascript">
										document.form1.action="sigesp_conexion.php";
										document.form1.submit();
									</script>
								   <?php
							  }
							  else
							   {
									?>
									<script language="javascript">
									codusu=document.form1.hidusuario.value;
									codpas=document.form1.hidclave.value
									window.open("sigesp_cambio_db.php?codusu="+codusu+"&codpas="+codpas,"catalogo","menubar=no,toolbar=no,scrollbars=yes,width=518,height=440,left=50,top=50,location=no,resizable=yes");
									</script>
								   <?php
							  }		
						}
				 }
				 else
				 {?>
				   <script language="javascript">
				   alert("No se puede efectuar la operacion");
				   close();
				   </script>
				  <?php
				 }	
			}
		}// Fin del else que chequea el release
			
		break;
	}
	
	
?>


<div id="divgestion" align="center" style="display:none;">
<table width="200">
  <tr>
    <td height="17" align="center" valign="middle">&nbsp;</td>
    <td align="center" valign="middle">&nbsp;</td>
    <td align="center" valign="middle">&nbsp;</td>
    <td colspan="2" align="center" valign="middle">&nbsp;</td>
    <td align="center" valign="middle">&nbsp;</td>
    <td align="center" valign="middle">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" valign="middle">&nbsp;&nbsp;</td>
    <td align="center" valign="middle" class="icono_mod" onClick="abrir_modulo('sep/sigespwindow_blank.php',<?php echo $modulo->permiso_modulo('SEP'); ?>)"><div class="icono_mod"><a href="#"><img src="shared/imagebank/iconos/presupuestaria.gif" alt="SEP" width="40" height="40"></a></div>
        <div class="texto_icono"><a href="#">SEP/Pedidos</a></div></td>
    <td align="center" valign="middle" class="icono_mod" onClick="abrir_modulo('soc/sigespwindow_blank.php',<?php echo $modulo->permiso_modulo('SOC'); ?>)"><div class="icono_mod"><a href="#"><img src="shared/imagebank/iconos/compras.gif" alt="Compras" width="40" height="40"></a></div>
        <div class="texto_icono"><a href="#">Ordenes de Compra</a></div></td>
    <td align="center" valign="middle" class="icono_mod" onClick="abrir_modulo('cxp/sigespwindow_blank.php',<?php echo $modulo->permiso_modulo('CXP'); ?>)"><div class="icono_mod"><a href="#"><img src="shared/imagebank/iconos/pagar.gif" alt="Cuentas Por Pagar" width="40" height="40"></a></div>
        <div class="texto_icono"><a href="#">Cuentas por Pagar</a></div></td>
    <td align="center" valign="middle" class="icono_mod" onClick="abrir_modulo('scb/sigespwindow_blank.php',<?php echo $modulo->permiso_modulo('SCB'); ?>)"><div class="icono_mod"><a href="#"><img src="shared/imagebank/iconos/banco.gif" alt="Banco" width="40" height="40"></a></div>
        <div class="texto_icono"><a href="#">Caja y Bancos</a></div></td>
    <td align="center" valign="middle" class="icono_mod" onClick="abrir_modulo('rpc/sigespwindow_blank.php',<?php echo $modulo->permiso_modulo('RPC'); ?>)"><div class="icono_mod"><a href="#"><img src="shared/imagebank/iconos/proveedores.gif" alt="Proveedores" width="40" height="40"></a></div>
        <div class="texto_icono"><a href="#">Proveedores y Beneficiarios</a></div></td>
    <td align="center" valign="middle" class="icono_mod" onClick="abrir_modulo('siv/sigespwindow_blank.php',<?php echo $modulo->permiso_modulo('SIV'); ?>)"><div class="icono_mod"><a href="#"><img src="shared/imagebank/iconos/inventario_trans.gif" alt="Inventario" width="40" height="40"></a></div>
        <div class="texto_icono"><a href="#">Inventario</a></div></td>
    <td align="center" valign="middle" class="icono_mod" onClick="abrir_modulo('sno/sigespwindow_blank.php',<?php echo $modulo->permiso_modulo('SNO'); ?>)"><div class="icono_mod"><a href="#"><img src="shared/imagebank/iconos/nomina.gif" alt="N&oacute;mina" width="40" height="40"></a></div>
        <div class="texto_icono"><a href="#">N&oacute;mina</a></div></td>
    <td align="center" valign="middle" class="icono_mod" onClick="abrir_modulo('srh/pages/vistas/pantallas/sigespwindow_blank.php',<?php echo $modulo->permiso_modulo('SRH'); ?>)"><div class="icono_mod"><a href="#"><img src="shared/imagebank/iconos/rrhh.gif" alt="rrhh" width="40" height="40"></a></div>
        <div class="texto_icono"><a href="#">Recursos Humanos</a></div></td>
  </tr>
  <tr>
    <td align="center" valign="middle">&nbsp;</td>
        <td align="center" valign="middle" class="icono_mod" onClick="abrir_modulo('scv/sigespwindow_blank.php',<?php echo $modulo->permiso_modulo('SCV'); ?>)"><div class="icono_mod"><a href="#"><img src="shared/imagebank/iconos/viaticos.gif" alt="Viaticos" width="40" height="40"></a></div>
        <div class="texto_icono"><a href="#">Vi&aacute;ticos</a></div></td>
	<td align="center" valign="middle" class="icono_mod" onClick="abrir_modulo('cxc/index.php',<?php echo $modulo->permiso_modulo('CXC'); ?>)"><div class="icono_mod"><a href="#"><img src="shared/imagebank/iconos/ico_cxc.jpg" alt="Facturación" width="40" height="40"></a></div>
        <div class="texto_icono"><a href="#">Facturación</a></div></td>  
    <td align="center" valign="middle" class="icono_mod" onClick="abrir_modulo('scc/index.php',<?php echo $modulo->permiso_modulo('SCC'); ?>)"><div class="icono_mod"><a href="#"><img src="shared/imagebank/iconos/caja_chica.jpg" alt="Prestaciones Sociales" width="40" height="40"></a></div>
        <div class="texto_icono"><a href="#">Caja Chica</a></div></td>
    <td align="center" valign="middle" class="icono_mod" onClick="abrir_modulo('saf/sigespwindow_blank.php',<?php echo $modulo->permiso_modulo('SAF'); ?>)"><div class="icono_mod"><a href="#"><img src="shared/imagebank/iconos/activo_fijo.gif" alt="Activo Fijo" width="42" height="42"></a></div>
        <div class="texto_icono"><a href="#">Activos Fijos</a></div></td>
    <td align="center" valign="middle" class="icono_mod" onClick="abrir_modulo('sob/sigespwindow_blank.php',<?php echo $modulo->permiso_modulo('SOB'); ?>)"><div class="icono_mod"><a href="#"><img src="shared/imagebank/iconos/obras.gif" alt="Obras" width="40" height="40"></a></div>
        <div class="texto_icono"><a href="#">Obras</a></div></td>
    <td align="center" valign="middle" class="icono_mod" onClick="abrir_modulo('fop/index.php',<?php echo $modulo->permiso_modulo('FOP'); ?>)"><div class="icono_mod"><a href="#"><img src="shared/imagebank/iconos/formulacion.jpg" alt="Formulación POA" width="40" height="40"></a></div>
        <div class="texto_icono"><a href="#">Formulación POA</a></div></td>
	<td align="center" valign="middle" class="icono_mod" onClick="abrir_modulo('seg/covensol_seg_cat_provbene.php',1)"><div class="icono_mod"><a href="#"><img src="shared/imagebank/iconos/seg.gif" alt="Segumiento de Pagos" width="40" height="40"></a></div>
        <div class="texto_icono"><a href="#">Seguimiento</a></div></td>	
   <td align="center" valign="middle" class="icono_mod" onClick="abrir_modulo('mis/sigespwindow_blank.php',<?php echo $modulo->permiso_modulo('MIS'); ?>)"><div class="icono_mod"><a href="#"><img src="shared/imagebank/iconos/integrador.gif" alt="Integrador" width="40" height="40"></a></div>
        <div class="texto_icono"><a href="#">Integrador</a></div></td>
  
  </tr>
  <tr>
    <td align="center" valign="middle">&nbsp;</td> 
    <td align="center" valign="middle" class="icono_mod" onClick="abrir_modulo('cor/index.php',<?php echo $modulo->permiso_modulo('COR'); ?>)"><div class="icono_mod"><a href="#"><img src="shared/imagenes/carpetas.gif" alt="Integrador" width="40" height="40"></a></div>
        <div class="texto_icono"><a href="#">Trámites</a></div>
    </td>
    <td align="center" valign="middle" class="icono_mod" onClick="abrir_modulo('cre/index.php',<?php echo $modulo->permiso_modulo('CRE'); ?>)"><div class="icono_mod"><a href="#"><img src="shared/imagebank/cartera.jpg" alt="Cartera" width="40" height="40"></a></div>
        <div class="texto_icono"><a href="#">Cartera</a></div>
    </td>  
    <td align="center" valign="middle" class="icono_mod" onClick="abrir_modulo('bio/index.php',<?php echo $modulo->permiso_modulo('BIO'); ?>)"><div class="icono_mod"><a href="#"><img src="shared/imagebank/biometrico.jpg" alt="Biometrico" width="40" height="40"></a></div>
        <div class="texto_icono"><a href="#">Biométrico</a></div>
    </td>  
  </tr>
</table>
</div>
<div id="divadm" align="center" style="display:none;">
<table width="200" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="86">&nbsp;</td>
    <td align="center" valign="middle" class="icono_mod" onClick="abrir_modulo('cfg/index.php',<?php echo $modulo->permiso_modulo('CFG'); ?>)"><div class="icono_mod"><a href="#"><img src="shared/imagebank/iconos/instalar.gif" alt="Configuración" width="40" height="40"></a></div>
        <div class="texto_icono"><a href="#">Configuraci&oacute;n</a></div></td>
    <td align="center" valign="middle" class="icono_mod" onClick="abrir_modulo('cfg/covensol_cfg_f_menu_config.php',<?php echo $modulo->permiso_modulo('CFG'); ?>)"><div class="icono_mod"><a href="#"><img src="shared/imagebank/iconos/confadic.gif" alt="Config. Adicional" width="40" height="40"></a></div>
        <div class="texto_icono"><a href="#">Configuraciones Adicionales</a></div></td>
    <td align="center" valign="middle" class="icono_mod" onClick="abrir_modulo('sss/sigespwindow_blank.php',<?php echo $modulo->permiso_modulo('SSS'); ?>)"><div class="icono_mod"><a href="#"><img src="shared/imagebank/iconos/seguridad.gif" alt="Seguridad" width="40" height="40"></a></div>
        <div class="texto_icono"><a href="#">Seguridad</a></div></td>
    <td align="center" valign="middle" class="icono_mod" onClick="abrir_modulo('ins/sigespwindow_blank.php',<?php echo $modulo->permiso_modulo('INS'); ?>)"><div class="icono_mod"><a href="#"><img src="shared/imagebank/iconos/instalar2.gif" alt="Instala" width="40" height="40"></a></div>
        <div class="texto_icono"><a href="#">Instala</a></div></td>
    <td align="center" valign="middle" class="icono_mod" onClick="abrir_modulo('apr/sigesp_apr_conexion.php',<?php echo $modulo->permiso_modulo('APR'); ?>)"><div class="icono_mod"><a href="#"><img src="shared/imagebank/iconos/apertura.gif" alt="Apertura" width="40" height="40"></a></div>
        <div class="texto_icono"><a href="#">Apertura</a></div></td>
     <?php 
 		if($_SESSION["la_empresa"]['tipo_empresa']=='PRIVADA'){
		 ?> 
			<td align="center" valign="middle" class="icono_mod" onClick="abrir_modulo('ins/covensol_ins_p_licencia.php',1)"><div class="icono_mod"><a href="#"><img src="shared/imagebank/iconos/lock.jpg" alt="Integrador" width="40" height="40"></a></div>
				<div class="texto_icono"><a href="#">Licencia Y Soporte</a></div>
			</td>
         <?php    
		}
  ?> 
  </tr>
</table>
</div>

<div id="divcont" align="center" style="display:none;">
<table width="200" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
  	<td height="86">&nbsp;</td>
    <td align="center" valign="middle" class="icono_mod" onClick="abrir_modulo('spg/sigespwindow_blank.php',<?php echo $modulo->permiso_modulo('SPG'); ?>)"><div class="icono_mod"><a href="#"><img src="shared/imagebank/iconos/gastos.gif" alt="Gastos" width="40" height="40"></a></div>
        <div class="texto_icono"><a href="#">Contabilidad Presup. Gasto</a></div></td>
    <td align="center" valign="middle" class="icono_mod" onClick="abrir_modulo('spi/sigespwindow_blank.php',<?php echo $modulo->permiso_modulo('SPI'); ?>)"><div class="icono_mod"><a href="#"><img src="shared/imagebank/iconos/ingresos.gif" alt="Ingresos" width="40" height="40"></a></div>
        <div class="texto_icono"><a href="#">Contabilidad Presup. Ingreso</a></div></td>
    <td align="center" valign="middle" class="icono_mod" onClick="abrir_modulo('scg/sigespwindow_blank.php',<?php echo $modulo->permiso_modulo('SCG'); ?>)"><div class="icono_mod"><a href="#"><img src="shared/imagebank/iconos/contabilidad_trans.gif" alt="Contabilidad Patrimonial" width="40" height="40"></a></div>
        <div class="texto_icono"><a href="#">Contabilidad Patrimonial</a></div></td>
    <td align="center" valign="middle" class="icono_mod" onClick="abrir_modulo('scf/sigespwindow_blank.php',<?php echo $modulo->permiso_modulo('SCF'); ?>)"><div class="icono_mod"><a href="#"><img src="shared/imagebank/iconos/fiscal_trans.gif" alt="Contabilidad Fiscal" width="40" height="40"></a></div>
        <div class="texto_icono"><a href="#">Contabilidad Fiscal</a></div></td>
    <td align="center" valign="middle" class="icono_mod" onClick="abrir_modulo('mis/sigespwindow_blank.php',<?php echo $modulo->permiso_modulo('MIS'); ?>)"><div class="icono_mod"><a href="#"><img src="shared/imagebank/iconos/integrador.gif" alt="Integrador" width="40" height="40"></a></div>
        <div class="texto_icono"><a href="#">Integrador</a></div>
    </td> 
  </tr>
</table>
</div>

<div id="formulario" align="center"></div>
<p align="center" class="Estilo1">&nbsp;</p>
<div id="divresp" align="center"></div>
<input name="hpanelid"  type="hidden" id="hpanelid" value="<?php echo $_SESSION['panelid']?$_SESSION['panelid']:1; ?>" >
</body>
</html>
<script language="javascript">
function uf_abrir_help()
{
	window.open("hlp/index.php","Catalogo","menubar=no,toolbar=no,scrollbars=yes,width=800,height=600,left=50,top=50,location=no,resizable=yes");	
}
function cerrar(){window.close();}
function abrir(ubicacion){
   //Ext.MessageBox.alert('Permisos', ubicacion);
	window.location = ubicacion;
}
function abrir_ventana(direccion,ancho,alto,desplazamiento)
{
	if(ancho == '' || ancho == null ){ancho = 800}
	if(alto == '' || alto == null ){alto = 600}
	if(desplazamiento == '' || desplazamiento == null ){desplazamiento = 'no'}
	
	window.open(direccion,'','toolbar=no,directories=no,location=no, width=' + ancho + ', height=' + alto + ', scrollbars=' + desplazamiento + ', top=0, left=0, estatus=no');
}

function ayuda(){
	   Ext.MessageBox.show({
		   title: 'Ayuda de SIGESP',
		   msg: 'Aqui podrá encontrar la ayuda necesaria',
		   buttons: Ext.MessageBox.OK,										   										   
		   icon: 'sigesp_icono'
	   });
}
function abrir_modulo(ubicacion,permiso){

		if(permiso == 1){
					//Ext.MessageBox.alert('Permisos', ubicacion);
					 window.location = ubicacion; 
		}
		else{
			Ext.MessageBox.show({
			   title: 'Permisos',
			   msg: 'Ud. No tiene permisos para este módulo !',
			   buttons: Ext.MessageBox.OK,										   										   
			   icon: 'sigesp_icono'
			});
		}
}

//Ext.MessageBox.alert('Permisos', '<?php echo "Empresa: ".count($_SESSION["la_empresa"]['codemp']).'\n'.'\n'."Usuario: ".$_SESSION["la_logusr"]; ?>');

function cambio_bd()
{
    document.form1.operacion.value="CAMBIO_BD";
    document.form1.action="index_modules.php";
	document.form1.submit();

}

</script>
<?php 

/*
$configuracion_emp = 2;
$_SESSION["la_empresa"] = '0001';
$_SESSION["la_logusr"] = 'administrador';
require_once("cofiguracion_prueba.php");
*/

?>

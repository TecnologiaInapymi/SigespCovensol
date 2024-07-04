<?php 
session_destroy();
session_start();
$_SESSION = array();
session_destroy();
$operacion="";

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>ENTRADA AL SISTEMA</title>

<link rel="stylesheet" type="text/css" href="base/librerias/js/ext33/resources/css/ext-all.css" />
<script type="text/javascript" src="base/librerias/js/ext33/adapter/ext/ext-base.js"></script>
<script type="text/javascript" src="base/librerias/js/ext33/ext-all-debug.js"></script>
<script type="text/javascript" src="base/librerias/js/ext33/locale/ext-lang-es.js"></script>  
<link href="shared/css/tablas.css" rel="stylesheet" type="text/css">
<link href="shared/css/ventanas.css" rel="stylesheet" type="text/css">
<link href="shared/css/cabecera.css" rel="stylesheet" type="text/css">
<link href="shared/css/general.css" rel="stylesheet" type="text/css">
<link href="shared/css/catalogos.css" rel="stylesheet" type="text/css"> 
<link rel='stylesheet' type='text/css' href='base/css/sigesp_css_formulario.css'/>
<link href="shared/js/css_intra/datepickercontrol.css" rel="stylesheet" type="text/css">
<script src="base/librerias/js/jquery/jquery.js" type="text/javascript"></script>
<script src="base/librerias/js/jquery/jquery.ui.draggable.js" type="text/javascript"></script>
<script src="base/librerias/js/jquery/jquery.alerts.js" type="text/javascript"></script>
<link href="base/librerias/js/jquery/jquery.alerts.css" rel="stylesheet" type="text/css" media="screen" />
<script language="JavaScript" type="text/JavaScript" src="shared/js/js_ajax.js"></script>
<script language="JavaScript" src="shared/js/sigesp_js.js"></script>
<script language="javascript" src="shared/js/js_intra/datepickercontrol.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="shared/js/librerias_comunes_covensol_ext.js"></script>
<script type="text/javascript" src="shared/js/covensol_login.js"></script>

<style type="text/css">
<!--

.add-icon {	background-size: 10px; background-image:url(shared/imagebank/tools15/actualizar.gif) !important;}
.delete-icon { background-size: 10px; background-image:url(shared/imagebank/tools15/eliminar.gif) !important;}
.deshacer-icon { background-size: 10px; background-image:url(shared/imagebank/tools15/deshacer.gif) !important;}
.cajastexto{ font-size:10px;}
.align-right .x-form-item {
		    text-align: right;
		    padding-right:25px;
		}
.align-right label {
				    text-align: left;
}
.alinear-derecha  {
				    text-align: right;
}
.alinear-izquierda  {
				    text-align: left;
}
.fila-tamano-grande  {
		font-size:16px;
}
.alinear-centro  {
				    text-align: center;
					color:#990000;
}
.fondo_grid { 
 background-color:#FFFFCC;
}
.guardar {
    background-image:url(shared/imagenes/guardar_extjs.gif) !important;
}
.borrar {
    background-image:url(shared/imagenes/borrar_extjs.gif) !important;
}
.buscar {
    background-image:url(shared/imagenes/icono_lupa_web2.gif) !important;
}
.nuevo {
    background-image:url(shared/imagenes/empty.png) !important;
}
.imprimir {
    background-image:url(shared/imagebank/tools20/imprimir.gif) !important;
}
.imprimir_calc {
    background-image:url(shared/imagebank/tools20/excel.jpg) !important;
}
.seleccionar {
    background-image:url(shared/imagebank/tools20/aprobado_transp.gif) !important; 
}

	
-->
</style>
</head>
<body>
<form name="form1" method="post" action="">
<br><br><br><br>
<table width="760" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td ><div id="editor-grid" align="center"></div></td>
  </tr>
</table>
<div id="formulario" align="center"></div>
<div id="contenedorp"></div>
<div id="errores_ajax" align="center"></div>
<div id="e_ajax" align="center"></div>

<input name="hfechahoy"  type="hidden" id="hfechahoy"  value="<?php echo date('d/m/Y'); ?>">
<div id="resultados" align="center"></div>
<br><br>
</form>

</body>
</html>

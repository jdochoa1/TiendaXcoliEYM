<? 
session_start();
include ('../../fuerzaventas/sesion.php');
include ('../../fuerzaventas/conex.php');
date_default_timezone_set('America/Bogota');
$a = date("Y");$m = date("m");$d = date("d");$H = date("H");$i = date("i");$s = date("s");
$sql_cons = mysql_query("Select * FROM CLIENTES_DIR WHERE codigoC = '".$_SESSION['codigoC']."'") or die (MYSQL_ERROR());
$sql_datos = mysql_query("Select * FROM CLIENTES WHERE codigoC = '".$_SESSION['codigoC']."'") or die (MYSQL_ERROR());
$max_datos = mysql_fetch_array($sql_datos);
?>

<!DOCTYPE html>
<html lang = "es">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title> E&M EFECTIVO|E&M </title>
<link href="../../fuerzaventas/jquery-mobile/jquery.mobile-1.0.min.css" rel="stylesheet" type="text/css"/>
<script src="../../fuerzaventas/jquery-mobile/jquery-1.6.4.min.js" type="text/javascript"></script>
<script src="../../fuerzaventas/jquery-mobile/jquery.mobile-1.0.min.js" type="text/javascript"></script>

</head>
<style>
.ui-body-b {	
		font-size:11px;
	}	
</style>
<body>
<div data-role="page" id="page" data-theme = "b">
	<div data-role="header" data-id = "fijo">
		<h1>Datos Pedido</h1>
		<a href="Csesion.php" data-role="button" data-shadow="false" data-icon="delete" data-inline="true" class="ui-btn-right">Sesion</a>
		<a href="javascript:window.history.back();" data-icon="arrow-l" data-iconpos="notext" class="ui-btn-left"></a>
		<nav data-role="navbar">
			<ul>
				<li><a href = "#" data-transition = "pop"><? echo $_SESSION['codigoC']." ".$_SESSION['name'];?></a></li>
				<li><a href = "http://www.golty.com.co/catalogo/" target = "_blank">Catalogo</a></li>
				<li><a href = "calculadora.php?l=1" target = "_blank" data-transition = "back">Calculadora</a></li>
				<li><a href = "grafica.php?n=a&codT=<? echo $w; ?>" data-transition = "pop"> Total: $<? echo number_format($_SESSION['TOTAL'],2); ?></a></li>
			</ul>
		</nav>
	</div>

<div data-role="content" align="center">
<a href='calzado.php' data-role='button' data-inline='true' data-icon='arrow-l' data-iconpos='left'>volver</a>
<form method="post" action="valida.php"  enctype="multipart/form-data">
<div class="ui-grid-a">
	<div class="ui-block-a"><b>Direccion</b></div>
	<div class="ui-block-b"><b>Otra</b></div>
</div>
<div class="ui-grid-a">
	<div class="ui-block-a">
		<select id='direc' name='direc'>
		<? while ($max_cons = mysql_fetch_array($sql_cons)){ 
			$sql_dane = mysql_query("Select * FROM CLIENTES_DIR_DANE WHERE id= '".$max_cons['num2']."'") or die (MYSQL_ERROR());
			$row_dane = mysql_fetch_array($sql_dane);
		?>
			<option value = "<? echo $max_cons['num']." - ".$max_cons['direccionC']." ".$max_cons['barrio']." ".$row_dane['municipio']." ".$row_dane['dpto']."-ndi-".$row_dane['dias']; ?>"><? echo $max_cons['num']." - ".$max_cons['direccionC']." ".$max_cons['barrio']." ".$row_dane['municipio']." ".$row_dane['dpto']; ?></option>
		<? } ?>
		</select>
	</div>
	<div class="ui-block-b"><input type="text" name = "direc1" id = "direc1"/></div>
</div>
<div class="ui-grid-a">
	<div class="ui-block-a"><b>No. Orden</b></div>
	<div class="ui-block-b"><b>Recibe Parciales</b></div>
</div>
<div class="ui-grid-a">
	<div class="ui-block-a"><input type="text" name = "o_cliente" id = "o_cliente"/></div>
	<div class="ui-block-b">
		<select name = "recibe" id = "recibe">
			<option value="SI">SI</option>
			<option value="NO">NO</option>
		</select>
	</div>
</div>
<div class="ui-grid-a">
	<div class="ui-block-a"><b>Fecha Factura</b></div>
	<div class="ui-block-b"><b>Adjunto</b></div>
</div>
<div class="ui-grid-a">
	<div class="ui-block-a">
		<input type="text" name = "fechaP" id = "fechaP" value = "<? echo $m."/".$d."/".$a; ?>" required placeholder = "mm/dd/aaaa"/>
	</div>
	<div class="ui-block-b"><td><input type = "file" name = "archivo" id = "archivo" ></td></tr></div>
	<!--div class="ui-block-b">
		<input type="text" name = "fechaP" id = "fechaP" value = "<? //echo $m."/".$d."/".$a; ?>" readonly required placeholder = "mm/dd/aaaa"/>
	</div-->
</div>

<b>Observacion</b>
<input type="text" id = "obser" name = "obser"/>

<input type="submit" data-role="button" value="Enviar"/>
</form>
<div id = "listado"></div>
</div>
	<div data-role="footer" data-position = "fixed">
		<h4>www.eym.com.co</h4>
	</div>
</div>
</body>
</html>
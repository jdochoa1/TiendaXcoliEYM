<?php 
session_start();
error_reporting(E_ALL);
@ini_set('display_errors', '1');
if(isset($_SESSION['carro']))
$carro=$_SESSION['carro'];else $carro=false;
include ("../golty.php" );
include ('../eym.php');
$fec_sis = date ("Y-m-d H:i:s");

$sql_datos = mysql_query("Select * FROM CLIENTES WHERE codigoC = '".$_SESSION['codigoC']."'",$connection1) or die (MYSQL_ERROR());
$max_datos = mysql_fetch_array($sql_datos);

$num_promo = 0;
$sum_total_unitario=0;
$cod_dir = explode(" ",$_POST['direc']);
$fecha_ibes = $_POST['fechaP'];
$_SESSION['cod_dir'] = $cod_dir[0];
$_SESSION['fecha_ibes'] = $fecha_ibes;
$_SESSION['direc'] = $_POST['direc'];
$_SESSION['direc1'] = $_POST['direc1'];
$_SESSION['obser'] = $_POST['obser'];
$_SESSION['recibe'] = $_POST['recibe'];

$vector_fechas = $_SESSION['vector_fechas'];

$estado = 0;
$entrega = "";//cuando es otra dirección
// fecha en ibes

$comment1 = substr($_POST['obser'],0,30);
if($comment1==''){$comment1 = '-';}
$comment2 =  substr($_POST['obser'],30,60);
if($comment2==''){$comment2 = '-';}
$orden_cliente = $_POST['o_cliente'];
if($orden_cliente==''){$orden_cliente = '-';}

$tipo = '';
$archivo_nombre=$_FILES["archivo"]["name"]; 
$archivo_peso=$_FILES["archivo"]["size"]; 
$tipo = $HTTP_POST_FILES['archivo']['type'];
$tipo = explode("/",$tipo);
$archivo_temporal=$_FILES["archivo"]["tmp_name"];
if (@copy($archivo_temporal, $archivo_nombre)){ 
$destino = '/julian2' ; 
@move_uploaded_file( $_FILES [ "archivo"][ "tmp_name" ],$destino .'/'.$_FILES["archivo"]["name"]); 
$archivo=file($_FILES["archivo"]["name"]);
rename($_FILES["archivo"]["name"], $consecutivo.".".$tipo[1]);
}
?>
<!DOCTYPE html> 
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ORDEN DE COMPRA | EYM</title>

<style type="text/css">
<!--
.tit {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 13px;
	color: #FFFFFF;
}
.prod {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 13px;
	color: #333333;
}
h1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 20px;
	color: #990000;
}
h4 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 8px;
}
-->
table td:first-child {
	width: 100px;
}
table td:first-child(2) {
	width: 300px;
}
</style>
</head>
<body>
<div data-role="content" data-theme="d" align = "center">
<? 
if (!empty($_SESSION['vector'])){
?>
<div style='width:60%;padding: 30px; background: #E4EDF6;border:10px solid #000000;'>

<table width="100%" border="0" cellspacing="2" style = "table-layout: fixed" align="center">
	<tr><td><h3><? echo $_SESSION['codigoC']." ".$max_datos['nombreC'];?></h3></td></tr>
</table>
<table width="100%" border="0" cellspacing="2" style = "table-layout: fixed" align="center">
<tr class='prod'><td>Nit:</td><td><b><? echo $max_datos['nitC'];?></b></td><td>Zona:</td><td  colspan ="2"><b><? echo $max_datos['zonaC'];?><b></td><th bgcolor='FFF700'>Tiempo de Entrega</th></tr>
<tr class='prod'><td>Direccion:</td><td colspan ="4"><b>
<?
if($_POST['direc1'] != ''){
	$_POST['direc'] = explode ('-ndi-',$_POST['direc']);
	echo $_POST['direc1']."</b></td><td style='color:#FF0000;' align= 'center'></td></tr>";
	}else{
	$_POST['direc'] = explode ('-ndi-',$_POST['direc']);
	echo $_POST['direc'][0]."</b></td><td style='color:#FF0000;' align= 'center'>".$_POST['direc'][1]." dia(s)</td></tr>";
}?>

<tr class='prod'><td>Parciales: </td><td colspan ="5"><? echo " <b>".$_POST['recibe']."</b>"; ?></td></tr>
<tr class='prod'><td>Observaciones:</td><td colspan = "5" rowspan = "2"><? echo "<b>".$_POST['obser']."</b>"; ?></td></tr>
<tr class='prod'><td></td></tr>
<?
$entrega = 0;$suma_dias = 0;
$Total = 0;
echo "<tr bgcolor='#019AEC' class='tit' align='center'><th>Codigo</th><th>Nombre</th><th>Cantidad</th><th>Precio U</th><th>TOTAL</th><th bgcolor='FFF700'>Disponible el día</th></tr>";
for ($i=0; $i<count($_SESSION['vector']); $i++){
	if($_SESSION['vector_inv'][$i] > 0){
		$entrega = 0;
		$entrega= $entrega." days";
		$fecha = date_create($fec_sis);
		date_add($fecha, date_interval_create_from_date_string($entrega.' days'));	
		$vector_fechas[] .= date_format($fecha, 'm/d/Y');
	}else{
	$sql_tipo_item = mysql_query("select prioridad, tipo_inv from BASEITEM where item = '".$_SESSION['vector'][$i]."'", $connection);
	$row_tipo = mysql_fetch_array($sql_tipo_item);
	$sql_time_item = mysql_query("select TIEMPOND, TIEMPOID from PEDIDOS_TIEMPOS where clase = '".$row_tipo[0]."'", $connection1);
	$row_time = mysql_fetch_array($sql_time_item);
	if($row_tipo[1]=='STOCK'||$row_tipo[1]=='NO STOCK'){
		$entrega = $row_time[0];
		$entrega= $entrega." days";
		$fecha = date_create($fec_sis);
		date_add($fecha, date_interval_create_from_date_string($entrega.' days'));
		$suma_dias = $suma_dias + $entrega;
		$vector_fechas[] .= date_format($fecha, 'm/d/Y');
		}else{
			$entrega = $row_time[1];
			$entrega= $entrega." days";
			$fecha = date_create($fec_sis);
			date_add($fecha, date_interval_create_from_date_string($entrega.' days'));
			$suma_dias = $suma_dias + $entrega;
			$vector_fechas[] .= date_format($fecha, 'm/d/Y');
		}
	}
	echo "<tr><td>".$_SESSION['vector'][$i]."</td><td>".$_SESSION['vector_nom'][$i]."</td><td align = 'right'>".number_format($_SESSION['vector_cant'][$i],0)."</td><td align = 'right'>$".number_format($_SESSION['vector_desc'][$i],0)."</td><td align = 'right'>$".number_format($_SESSION['vector_tot'][$i],0)."</td><td style='color:#FF0000;' align = 'center'>".$vector_fechas[$i]."</td></tr>";
	
	if($_SESSION['vector_prom'][$i]	!= 0){
	echo "<tr bgcolor='FFF700'><td>".$_SESSION['vector'][$i]."</td><td>".$_SESSION['vector_nom'][$i]."</td><td align = 'right'>".number_format($_SESSION['vector_prom'][$i],0)."</td><td align = 'right'>$0</td><td align = 'right'>$0</td><td style='color:#FF0000;'>".$vector_fechas[$i]."</td></tr>";
    
	}
}
$_SESSION['vector_fechas'] = $vector_fechas;
echo "<tr><td colspan = '4' align = 'right'><b>SubTotal</b></td><td align = 'right'>$".number_format(array_sum($_SESSION['vector_tot']),0)."</td><td></td></tr>";

echo "<tr><td colspan = '4' align = 'right'><b>IVA</b></td><td align = 'right'>$".number_format($_SESSION['iva'],0)."</td><td></td></tr>";

echo "<tr><td colspan = '4' align = 'right'><b>TOTAL</b></td><td align = 'right'>$".number_format($_SESSION['TOTAL'],0)."</td><td></td></tr>";

//$suma_dias = echo max($vector_fechas);
$suma_dias= $suma_dias." days";
$fecha = date_create($fec_sis);
date_add($fecha, date_interval_create_from_date_string($suma_dias.' days'));
?>

<!--tr class='prod'><td style='color:#FF0000;' colspan = "6"><b>Su pedido se completa el dia <? // echo max($vector_fechas);//echo date_format($fecha, 'm/d/Y'); ?>.</b></td></tr-->
<tr class='prod'><td><img src = "modificarPedido.png" width = "60" height = "25"/></td><td style='color:#FF0000;' colspan = "4"></td><td><a href = "finalizar.php"><img src = "confirmarPedido.png" width = "60" height = "25"/></a></td></tr>
<?$cont_71 = 0;$cont_85 = 0;$cont_89 = 0;$cont_01 = 0;
$sum_pre_desc_71 = 0;$sum_pre_desc_85 = 0;$sum_pre_desc_89 = 0;$sum_pre_desc_01 = 0;
for ($i=0; $i<count($_SESSION['vector']); $i++){
$cant_real = $_SESSION['vector_cant'][$i] + $_SESSION['vector_prom'][$i]; 

}

?>
	<div class='text-border'>					
	</div> <!-- Cierro text-border -->
</div> <!-- Cierro derecha -->
	
<?php 

}else{ ?>
<p align="center"> <span class="prod">No hay productos seleccionados</span><a href="../clientes.php?v=tp"><img src="continuar.gif" width="13" height="13" border="0"></a> 
  <?php } ?>
</p>
</div>
	<div data-role="footer">
		<!--h4>www.eym.com.co</h4-->
	</div>
</div>
</body>
</html>
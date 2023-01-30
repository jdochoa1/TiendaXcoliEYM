<?php 
session_start();
error_reporting(E_ALL);
@ini_set('display_errors', '1');
if(isset($_SESSION['carro']))
$carro=$_SESSION['carro'];else $carro=false;
include ('../../fuerzaventas/conex.php');
require("../../fuerzaventas/class.phpmailer.php");
$sql_datos = mysql_query("Select * FROM CLIENTES WHERE codigoC = '".$_SESSION['codigoC']."'") or die (MYSQL_ERROR());
$max_datos = mysql_fetch_array($sql_datos);
$sql_cons = mysql_query("Select MAX(nOrden) FROM PEDIDOS_D") or die (MYSQL_ERROR());
$max_cons = mysql_fetch_array($sql_cons);
$consecutivo = $max_cons[0] + 1;
$num_promo = 0;
$sum_total_unitario=0;
$_POST['direc'] = $_SESSION['direc'];
$_POST['direc1'] = $_SESSION['direc1'];
$_POST['obser'] = $_SESSION['obser'];
$_POST['recibe'] = $_SESSION['recibe'];
//$cod_dir = explode(" ",$_POST['direc']);
$estado = 0;
$entrega = "";//cuando es otra dirección
// fecha en ibes

$comment1 = substr($_POST['obser'],0,30);
if($comment1==''){$comment1 = '-';}
$comment2 =  substr($_POST['obser'],30,60);
if($comment2==''){$comment2 = '-';}
$orden_cliente = $_POST['o_cliente'];
if($orden_cliente==''){$orden_cliente = '-';}

$fecha_ibes = $_POST['fechaP'];
/*$dia = substr($fecha_ibes, -2);
$mes   = substr($fecha_ibes, 5, 2);
$ano = substr($fecha_ibes, 0,4);
$fecha_ibes = $mes.'/'.$dia.'/'.$ano;*/

//Archivo adjunto

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

$query = mysql_query("SELECT * FROM ZONA WHERE codZona = '".$max_datos['zonaC']."'") or die (mysql_error());
		$nr = mysql_num_rows($query);
		$codigo = mysql_fetch_array($query);
		$as = $codigo['vendedor'];
$correoas = mysql_query("SELECT email FROM USUARIOS WHERE nombreUsuario = '".$as."'") or die (mysql_error());
		$row_correoas = mysql_fetch_array($correoas);
		$ascorreo = $row_correoas['email'];

/////
//$correo = "julian.camargo@eym.co";
$mail = new PHPMailer();
$mail->Host = "localhost";
$mail->From = "fuerzaventas@eym.com.co";
$mail->FromName = "ESCOBAR Y MARTINEZ";
$mail->Subject = "Pedido No ".$consecutivo."- ".$_SESSION['codigoC']." ".$max_datos['nombreC'];

$mail->AddAddress($ascorreo,"nombre");
$mail->AddBCC("serviclienteeym@gmail.com;julian.camargo@eym.co"); // Copia oculta
$body = "<div style='width:60%;padding: 100px; background: #E4EDF6;border:10px solid #000000;'>";
$body .= "<table width='80%' border='0' cellspacing='2' style = 'table-layout: fixed' align='center'>";
$body .= "<tr><td><h3>".$_SESSION['codigoC'].' '.$max_datos['nombreC']."</h3></td></tr></table>";
$body .= "<table width='80%' border='0' cellspacing='2' style = 'table-layout: fixed' align='center'>";
$body .= "<tr class='prod'><td>Nit:".$max_datos['nitC']."</td></tr>";
$body .= "<tr class='prod'><td>Zona:".$max_datos['zonaC']."</td></tr>";
if($_POST['direc1'] != ''){
	$body .= "<tr><td>Direccion de envio: ".$_POST['direc1']."</td></tr>";
}else{
	$body .= "<tr><td>Direccion de envio: ".$_POST['direc']."</td></tr>";
}
$body .= "</table>" ;
$body .= "<table width='80%' border='0' cellspacing='2' style = 'table-layout: fixed' align='center'>";
$body .= "<tr class='prod'><td>Cliente recibe parciales: <b>".$_POST['recibe']."</b></td></tr>";
$body .= "<tr class='prod'><td colspan = '2'>Observaciones:</td></tr>";
$body .= "<tr class='prod'><td colspan = '2'><b>".$_POST['obser']."</b></td></tr>";
$body .= "</table>";
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
</style>
</head>
<body>
<div data-role="content" data-theme="d" align = "center">
<? 
if (!empty($_SESSION['vector'])){
?>
<h1>Pedido registrado, revise su correo para ver la notificación.</h1>
			<? if($_SESSION["s_nombreUsuario"]=='carlos.martinez'){?>
				<a href="../clientesc.php?v=tp">Hacer otro pedido</a>o<a href="../Csesion.php">Cierre sesión</a>
			<? }else{?>
				<a href="../clientesc.php?v=tpd">Hacer otro pedido</a>o<a href="../Csesion.php">Cierre sesión</a>
			<? }?>
<div style='width:60%;padding: 30px; background: #E4EDF6;border:10px solid #000000;'>
<table width="80%" border="0" cellspacing="2" style = "table-layout: fixed" align="center">
<tr><td><h3>Consecutivo: # <? echo $consecutivo; ?></h3></td></tr>
<tr><td><h3><? echo $_SESSION['codigoC']." ".$max_datos['nombreC'];?></h3></td></tr>
</table>
<table width="80%" border="0" cellspacing="2" style = "table-layout: fixed" align="center">
<tr class='prod'><td>Nit:<? echo $max_datos['nitC'];?></td></tr>
<tr class='prod'><td>Zona:<? echo $max_datos['zonaC'];?></td></tr>
<tr class='prod'><td>Direccion:
<?
if($_POST['direc1'] != ''){
	echo $_POST['direc1']."</td></tr>";
	$entrega = $_POST['direc1'];
	}else{
	echo $_POST['direc']."</td></tr>";
	$entrega = "";
}?>
</table>

<table width="80%" border="0" cellspacing="2" style = "table-layout: fixed" align="center">
<tr class='prod'><td>Cliente recibe parciales: <? echo " <b>".$_POST['recibe']."</b>"; ?></td></tr>
<tr class='prod'><td colspan = "2">Observaciones:</td></tr>
<tr class='prod'><td colspan = "2"><? echo "<b>".$_POST['obser']."</b>"; ?></td></tr>
</table>

<?
$Total = 0;
echo "<table>";
$body .= "<table width='80%' border='0' cellspacing='2' style = 'table-layout: fixed' align='center'>";
echo "<tr bgcolor='#019AEC' class='tit' align='center'><th>Codigo</th><th>Nombre</th><th>Cantidad</th><th>Precio U</th><th>TOTAL</th></tr>";
$body .= "<tr bgcolor='#019AEC' class='tit' align='center'><th>Codigo</th><th>Nombre</th><th>Cantidad</th><th>Precio U</th><th>TOTAL</th></tr>";
for ($i=0; $i<count($_SESSION['vector']); $i++){
	echo "<tr><td>".$_SESSION['vector'][$i]."</td><td>".$_SESSION['vector_nom'][$i]."</td><td align = 'right'>".number_format($_SESSION['vector_cant'][$i],0)."</td><td align = 'right'>$".number_format($_SESSION['vector_desc'][$i],0)."</td><td align = 'right'>$".number_format($_SESSION['vector_tot'][$i],0)."</td></tr>";
	$body .= "<tr><td>".$_SESSION['vector'][$i]."</td><td>".$_SESSION['vector_nom'][$i]."</td><td align = 'right'>".number_format($_SESSION['vector_cant'][$i],0)."</td><td align = 'right'>$".number_format($_SESSION['vector_desc'][$i],0)."</td><td align = 'right'>$".number_format($_SESSION['vector_tot'][$i],0)."</td></tr>";
	if($_SESSION['vector_prom'][$i]	!= 0){
	echo "<tr bgcolor='FFF700'><td>".$_SESSION['vector'][$i]."</td><td>".$_SESSION['vector_nom'][$i]."</td><td align = 'right'>".number_format($_SESSION['vector_prom'][$i],0)."</td><td align = 'right'>$0</td><td align = 'right'>$0</td></tr>";
$body .= "<tr bgcolor='FFF700'><td>".$_SESSION['vector'][$i]."</td><td>".$_SESSION['vector_nom'][$i]."</td><td align = 'right'>".number_format($_SESSION['vector_prom'][$i],0)."</td><td align = 'right'>$0</td><td align = 'right'>$0</td></tr>"; 
	}
}
echo "<tr><td colspan = '4' >SubTotal</td><td align = 'right'>$".number_format(array_sum($_SESSION['vector_tot']),0)."</td></tr>";
$body .= "<tr><td colspan = '4' >SubTotal</td><td align = 'right'>$".number_format(array_sum($_SESSION['vector_tot']),0)."</td></tr>";
echo "<tr><td colspan = '4'>IVA</td><td align = 'right'>$".number_format($_SESSION['iva'],0)."</td></tr>";
$body .= "<tr><td colspan = '4'>IVA</td><td align = 'right'>$".number_format($_SESSION['iva'],0)."</td></tr>";
echo "<tr><td colspan = '4'>TOTAL</td><td align = 'right'>$".number_format($_SESSION['TOTAL'],0)."</td></tr>";
$body .= "<tr><td colspan = '4'>TOTAL</td><td align = 'right'>$".number_format($_SESSION['TOTAL'],0)."</td></tr>";
echo "</table>";
$body .= "</table>";

$cont_71 = 0;$cont_85 = 0;$cont_89 = 0;$cont_01 = 0;
$sum_pre_desc_71 = 0;$sum_pre_desc_85 = 0;$sum_pre_desc_89 = 0;$sum_pre_desc_01 = 0;
for ($i=0; $i<count($_SESSION['vector']); $i++){
$cant_real = $_SESSION['vector_cant'][$i] + $_SESSION['vector_prom'][$i]; 
$in_DETALLE = mysql_query ("INSERT INTO detallePEDIDOS_D VALUES ('','1','".$consecutivo."','".$_SESSION['codigoC']."','".$_SESSION['vector_fechas'][$i]."','".$_SESSION['vector'][$i]."','".$max_datos['zonaC']."','".$cant_real."','".$_SESSION['vector_desc'][$i]."','TA','-','-','-','0','-','-','-','-','".$max_datos['ivaC']."','','')") or die (mysql_error()); 

if($_SESSION['vector_prom'][$i]	!= 0){
$sql_div = mysql_query("Select division FROM PRODUCTOS where codigo = '".$_SESSION['vector'][$i]."'");
  $sql_div = mysql_fetch_array($sql_div);
  $div_prod = $sql_div[0];
  if ($div_prod == '71'){
  $cont_71 = $cont_71 + 1;
  $pre_desc_71 = $_SESSION['vector_desc'][$i] * $_SESSION['vector_prom'][$i];
  $sum_pre_desc_71 = $sum_pre_desc_71 + $pre_desc_71;
  }else{
	if ($div_prod == '85'){
  $cont_85 = $cont_85 + 1;
  $pre_desc_85 = $_SESSION['vector_desc'][$i] * $_SESSION['vector_prom'][$i];
  $sum_pre_desc_85 = $sum_pre_desc_85 + $pre_desc_85;
  }else{
	if ($div_prod == '89'){
  $cont_89 = $cont_89 + 1;
  $pre_desc_89 = $_SESSION['vector_desc'][$i] * $_SESSION['vector_prom'][$i];
  $sum_pre_desc_89 = $sum_pre_desc_89 + $pre_desc_89;
  }else{if ($div_prod == '01'){
  $cont_01 = $cont_01 + 1;
  $pre_desc_01 = $_SESSION['vector_desc'][$i] * $_SESSION['vector_prom'][$i];
  $sum_pre_desc_01 = $sum_pre_desc_01 + $pre_desc_01;
  }}}}
}
}
if($cont_71 > 0){
$in_DETALLE = mysql_query ("INSERT INTO detallePEDIDOS_D VALUES ('','1','".$consecutivo."','".$_SESSION['codigoC']."','".$_SESSION['fecha_ibes']."','V710001','".$max_datos['zonaC']."','1','-".$sum_pre_desc_71."','TA','-','-','-','0','-','-','-','-','".$max_datos['ivaC']."','','')") or die (mysql_error()); 
}
if($cont_85 > 0){
$in_DETALLE = mysql_query ("INSERT INTO detallePEDIDOS_D VALUES ('','1','".$consecutivo."','".$_SESSION['codigoC']."','".$_SESSION['fecha_ibes']."','V850001','".$max_datos['zonaC']."','1','-".$sum_pre_desc_85."','TA','-','-','-','0','-','-','-','-','".$max_datos['ivaC']."','','')") or die (mysql_error()); 
}
if($cont_89 > 0){
$in_DETALLE = mysql_query ("INSERT INTO detallePEDIDOS_D VALUES ('','1','".$consecutivo."','".$_SESSION['codigoC']."','".$_SESSION['fecha_ibes']."','V890001','".$max_datos['zonaC']."','1','-".$sum_pre_desc_89."','TA','-','-','-','0','-','-','-','-','".$max_datos['ivaC']."','','')") or die (mysql_error()); 
}
if($cont_01 > 0){
$in_DETALLE = mysql_query ("INSERT INTO detallePEDIDOS_D VALUES ('','1','".$consecutivo."','".$_SESSION['codigoC']."','".$_SESSION['fecha_ibes']."','V010001','".$max_datos['zonaC']."','1','-".$sum_pre_desc_01."','TA','-','-','-','0','-','-','-','-','".$max_datos['ivaC']."','','')") or die (mysql_error()); 
}
?>
	<h3>Hacer otro<a href="../clientesc.php?v=tpd"> pedido </a></h3>
	<div class='text-border'>					
	</div> <!-- Cierro text-border -->
</div> <!-- Cierro derecha -->
	
<?php 

$in_PEDIDOS= mysql_query ("INSERT INTO PEDIDOS_D VALUES ('','2','".$_SESSION['codigoC']."','".$max_datos['nombreC']."','".$_SESSION['fecha_ibes']."','-','-','0','0','-','".$_SESSION['cod_dir']."','-','01','3101','".$orden_cliente."','".$comment1."','".$comment2."','".$max_datos['plazoC']."','-',now(),'".$estado."','".$_SESSION['fecha_ibes']."','".$_POST['recibe']."','-','".$tipo[1]."','".$entrega." - ".$_POST['obser']."')") or die (mysql_error());

unset ($_SESSION['vector']); 
unset ($_SESSION['vector_nom']);
unset ($_SESSION['vector_inv']);
unset ($_SESSION['vector_cant']);
unset ($_SESSION['vector_pre']);
unset ($_SESSION['vector_desc']);
unset ($_SESSION['vector_desc1']);
unset ($_SESSION['vector_prom']);
unset ($_SESSION['vector_tot']);
unset ($_SESSION['vector_tot1']);
unset ($_SESSION['vector_borrar']);
unset ($_SESSION['vector_fechas']);

$body .= "</div><div style='width:100%;padding: 1px;border:1px solid #000000;'>";
$body.= "</div>* Este correo ha sido enviado a trav&eacute;s de <b>EYM S.A. - FUERZA DE VENTAS.</b>";
$mail->Body = $body;
$mail->AltBody = "\PHPMailer\n";
//$mail->AddAttachment('extracto.pdf', "extracto.pdf");
$mail->Send(); 

}else{ ?>
<p align="center"> <span class="prod">No hay productos seleccionados</span><a href="../clientes.php?v=tp"><img src="continuar.gif" width="13" height="13" border="0"></a> 
  <?php }
  ?>
</p>
</div>
	<div data-role="footer">
		<!--h4>www.eym.com.co</h4-->
	</div>
</div>
</body>
</html>
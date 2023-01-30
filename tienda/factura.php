<?php session_start(); 
include ('conex.php');
date_default_timezone_set('America/Bogota');
$a = date("Y");$m = date("m");$d = date("d");$H = date("H");$i = date("i");$s = date("s");
$VENTAS = "FERIA_DETAL";
$PRODUCTOS = "FERIA_PROD";
$sql = mysql_query("Select MAX(cons) from feria_detal") or die(mysql_error());
$cons = mysql_fetch_array($sql);
if ($_SESSION['bolsa'] == ''){$_SESSION['bolsa'] = 0; $numbolsa = 0;}
else{
$numbolsa = $_SESSION['bolsa'] / 30;}
$cons = $cons[0]+1;
$sql_cons = mysql_query("Select MAX(nOrden) FROM PEDIDOS") or die (MYSQL_ERROR());
$max_cons = mysql_fetch_array($sql_cons);
$consecutivo = $max_cons[0] + 1;
if(!empty($_SESSION['vector'])){
	for ($i=0; $i<count($_SESSION['vector']); $i++){
	$insert = mysql_query("insert into $VENTAS values ('','".$cons."','".$_SESSION['doc']."','".$_SESSION['nom']."',now(),'".$_SESSION['dire']."','".$_SESSION['tel']."','".$_SESSION['mail']."','".$_SESSION['tpago']."','".$_SESSION['vector'][$i]."','".$_SESSION['vector_nom'][$i]."','".$_SESSION['vector_cant'][$i]."','".$_SESSION['vector_pre'][$i]."','".$_SESSION['vector_tot'][$i]."','','".$_SESSION['vector_bod'][$i]."','','".$_SESSION['bolsa']."')");
	$cod = substr($_SESSION['vector'][$i],7,6);
	$cod = "T".$cod;
	$in_DETALLE = mysql_query ("INSERT INTO detallePEDIDOS VALUES ('','1','".$consecutivo."','41011','".$m."/".$d."/".$a."','".$cod."','D21','".$_SESSION['vector_cant'][$i]."','".$_SESSION['vector_pre'][$i]."','".$_SESSION['vector_bod'][$i]."','-','-','-','0','-','-','-','-','16','','')") or die (mysql_error()); 
	
	$sql_PROD = mysql_query("Select cant_real from $PRODUCTOS where (codigoP = '".$_SESSION['vector'][$i]."' and bod = '".$_SESSION['vector_bod'][$i]."')") or die(mysql_error());
	$cant_pro = mysql_fetch_array($sql_PROD);
	$cant_real = $cant_pro[0] - $_SESSION['vector_cant'][$i];
	$act = mysql_query("UPDATE $PRODUCTOS SET cant_real = '".$cant_real."' WHERE (codigoP = '".$_SESSION['vector'][$i]."' and bod = '".$_SESSION['vector_bod'][$i]."') ") or die(mysql_error());
}}
$in_PEDIDOS= mysql_query ("INSERT INTO PEDIDOS VALUES ('','2','41011','XCOLI','".$m."/".$d."/".$a."','-','-','0','0','-','41011','-','01','3101','-','-','-','W30','-',now(),'1','".$m."/".$d."/".$a."','NO','-','','-')") or die (mysql_error());
?>
<html>
<head>
<script type="text/javascript"> 

function imprimir() {
var cant = prompt("Con cuanto paga");
var u = document.getElementById("tot").value;
var z = cant - u;
alert ("DEVOLVER: " + z.toFixed());	
window.print();
goNow(); 
} 
</script>
<style>
</style>
</head>
<body align = "center" onload="imprimir();">
<?php
if(!empty($_SESSION['vector'])){ ?>
<b>CANCHAS Y ESCENAR DEPORT SAS</b><br>
Nit.: 900.262.921-7<br>
Cra. 68D No. 17-30/50 Tel.: 4110299<br>
IVA REGIMEN COMUN<br>
XCOLI-BOGOTA DC<br><br>

Nombre: <?php echo $_SESSION['nom'];?><br>
Doc.: <?php echo $_SESSION['doc'];?><br>

Autorizacion DIAN 18762008135099<br>
del 774 al 5000 Mayo 8 de 2018<br>

Factura de Venta # EX - <?php echo $cons;?><br>
<?php echo "Fecha: ".$d."/".$m."/".$a." ".$H.":".$i.":".$s; ?><br>
-------------------------------------------------------
<?php echo "<table width = '100%' align='center'>	
	<tr height = '20'>
		<th width='180'>Descripcion</th>
		<th width='30'>Cant.</th>
		<th width='60'>Total</th>		
	</tr>";
for ($i=0; $i<count($_SESSION['vector']); $i++){
		echo "<tr><td>".$_SESSION['vector'][$i]." ".$_SESSION['vector_nom'][$i]."</td><td align = 'right'>".number_format($_SESSION['vector_cant'][$i],0)."</td><td align = 'right'>$".number_format($_SESSION['vector_tot'][$i],0)."</td></tr>";
}
echo "<tr><td></td><td>Bolsas<b></b></td><td align = 'right'>".$numbolsa."</td><td></td></tr>";
echo "<tr><td></td><td><b>SubTotal</b></td><td align = 'right'>$".number_format(array_sum($_SESSION['vector_tot']),0)."</td><td></td></tr>";
echo "<tr><td></td><td><b>IVA</b></td><td align = 'right'>$".number_format($_SESSION['iva'],0)."</td><td></td></tr>";
echo "<tr><td>..</td><td><b>IMP. CONS. BOLSA PLAST</b></td><td align = 'right'>$".number_format($_SESSION['bolsa'],0)."</td><td></td></tr>";
echo "<tr><td></td><td><b>TOTAL</b></td><td align = 'right'>$".number_format($_SESSION['TOTAL'],0)."</td><td></td></tr>";
echo "</table>";
} ?>

<input type="hidden" id="tot" name="tot" size = "60" value = "<?php echo @$_SESSION['TOTAL'];?>"><br>
-------------------------------------------------------
<br>
<b>GRACIAS POR SU COMPRA</b><br>
*******************************************<br>
www.goltysports.com.co<br>
Devoluciones - indispensable presentar la factura<br>
*******************************************
<?php
unset ($_SESSION['vector']);
unset ($_SESSION['vector_nom']);
unset ($_SESSION['vector_inv']);
unset ($_SESSION['vector_cant']);
unset ($_SESSION['vector_pre']);
unset ($_SESSION['vector_tot']);
unset ($_SESSION['iva']);
unset ($_SESSION['TOTAL']);
unset ($_SESSION['nom']);  
unset ($_SESSION['doc']); 
unset ($_SESSION['dire']); 
unset ($_SESSION['tel']); 
unset ($_SESSION['mail']);
unset ($_SESSION['tpago']); 
?>
<meta HTTP-EQUIV="Refresh" CONTENT="0;url = calzado.php">
</body>
</html>
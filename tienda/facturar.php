<?php session_start(); 
include ('conex.php');
date_default_timezone_set('America/Bogota');
$a = date("Y");$m = date("m");$d = date("d");$H = date("H");$i = date("i");$s = date("s");
$sql = mysql_query("Select cons from feria_detal WHERE (LEFT(fecha, 10) = LEFT(now(),10)) group by cons order by cons") or die(mysql_error());
?>
<html>
<head>
<script type="text/javascript"> 
function imprimir() { 
window.print();
goNow(); 
} 
</script>
<style>
</style>
</head>
<body align = "center" onload="imprimir();">
<?php
$sub = 0;
while($row = mysql_fetch_array($sql)){?>
<b>CANCHAS Y ESCENAR DEPORT SAS</b><br>
Nit.: 900.262.921-7<br>
Cra. 68D No. 17-30/50 Tel.: 4110299<br>
IVA REGIMEN COMUN<br>
XCOLI-BOGOTA DC<br><br>

<?php $sql_head = mysql_query("select cliente, nombreC, fecha, tipoPago from feria_detal where cons = '".$row[0]."'"); 
$sql_h = mysql_fetch_array($sql_head);
?>

Nombre: <?php echo $sql_h[1];?><br>
Doc.: <?php echo $sql_h[0];?><br>

Autorizacion DIAN 18762008135099<br>
del 774 al 5000 Mayo 8 de 2018<br>

Factura de Venta # EX - <?php echo $row[0];?><br>
<?php echo "Fecha: ".$sql_h[2]; ?><br>
<?php echo "Tipo de Pago: ".$sql_h[3]; ?><br>
-------------------------------------------------------
<?php echo "<table width = '100%' align='center'>	
	<tr height = '20'>
		<th width='180'>Descripcion</th>
		<th width='30'>Cant.</th>
		<th width='60'>Total</th>	
		<th></th>		
	</tr>";
$sql_detal = mysql_query("select codigoP, nombreP, cantidad, valorT, obsv, foot from FERIA_DETAL where cons = '".$row[0]."'") or die(mysql_error());
while ($sql_d = mysql_fetch_array($sql_detal)){
	echo "<tr><td>".$sql_d[0]." ".$sql_d[1]."</td><td align = 'right'>".$sql_d[2]."</td><td align = 'right'>$".number_format($sql_d[3])."</td><td>".$sql_d[4]."</td></tr>";
$sub = $sub + $sql_d[3];
$bolsa = $sql_d[5];
}
$iva = $sub * 0.19;
$tot = $sub + $iva + $bolsa;

echo "<tr><td></td><td><b>Bolsas</b></td><td align = 'right'>".number_format($numbolsa)."</td><td></td></tr>";
echo "<tr><td></td><td><b>SubTotal</b></td><td align = 'right'>$".number_format($sub)."</td><td></td></tr>";
echo "<tr><td></td><td><b>IVA</b></td><td align = 'right'>$".number_format($iva)."</td><td></td></tr>";
echo "<tr><td>..</td><td><b>IMP. CONS. BOLSA PLAST</b></td><td align = 'right'>$".number_format($bolsa)."</td><td></td></tr>";
echo "<tr><td></td><td><b>TOTAL</b></td><td align = 'right'>$".number_format($tot)."</td><td></td></tr>";
echo "</table><br><br><br><br>";
$sub = 0;
?>
-------------------------------------------------------
<br>
<b>GRACIAS POR SU COMPRA</b><br>
*******************************************<br>
www.goltysports.com.co<br>
Devoluciones - indispensable presentar la factura<br>
*******************************************<br><br>
<?php }?>

<?php 
$sql_efe = mysql_query("select sum(valorT), sum(cantidad) from FERIA_DETAL WHERE (LEFT(fecha, 10) = LEFT(now(),10) AND tipoPago = 'Efectivo')");
//$sql_efe = mysql_query("select sum(valorT), sum(cantidad) from FERIA_DETAL WHERE (fecha LIKE '2017-02-12%' AND tipoPago = 'Efectivo')");
$efec = mysql_fetch_array($sql_efe);
$sql_trj = mysql_query("select sum(valorT), sum(cantidad) from FERIA_DETAL WHERE (LEFT(fecha, 10) = LEFT(now(),10) AND tipoPago = 'Tarjeta')");
//$sql_trj = mysql_query("select sum(valorT), sum(cantidad) from FERIA_DETAL WHERE (fecha LIKE '2017-02-12%' AND tipoPago = 'Tarjeta')");
$tarj = mysql_fetch_array($sql_trj);
$ventasE = $efec[0] + ($efec[0]*0.19);
$ventasT = $tarj[0] + ($tarj[0]*0.19);
?>
<b>CONSOLIDADO del Dia</b><br>
Ventas en Efectivo con IVA: <?php echo number_format($ventasE);?><br>
Unidades vendidas en Efectivo:<?php echo $efec[1];?><br>
Ventas con tarjeta con IVA: <?php echo number_format($ventasT);?><br>
Unidades vendidas con tarjeta:<?php echo $tarj[1];?><br>

<!--meta HTTP-EQUIV="Refresh" CONTENT="0;url = calzado.php"-->
</body>
</html>
<?php
session_start();
include ('conex.php');
@$cod = $_GET['c'];
$sql = mysql_query("Select * FROM feria_detal where cons = '$cod' ");
?>
<html>
<head>
</head>
<body>
<?php
IF(mysql_num_rows($sql) > 0){
echo "Se encontraron: ".mysql_num_rows($sql)." registros.";	
	?>
	<br>
	<table border = "1" width = '80%' cellspacing = "0"  cellpadding = "0" align='center'>
	<tr>
			<th>No</th>
			<th>Cliente</th>
			<th>Fecha</th>
			<th>Codigo</th>
			<th>Descripcion</th>
			<th>Cantidad</th>
			<th>P. Unitario</th>
			<th>P. Total</th>
	</td>
	</tr>	
<?php
 while($row = mysql_fetch_array($sql)){ ?>
		<tr>
		
			<td><?php echo $row[1];?></td>
			<td><?php echo $row[2];?></td>
			<td><?php echo $row[4];?></td>
			<td><?php echo $row[9];?></td>
			<td><?php echo $row[10];?></td>
			<td><?php echo number_format($row[11]);?></td>
			<td align = "right"><?php echo $row[12];?></td>
			<td align = "right"><?php echo $row[13];?></td>
	</td>	
	</tr>			
	<?php }?></table>
	
<?php }else{ ?>
	<table width = '60%' align='center'>
		<tr><td>
			<b>NO EXISTE FACTURA.</b>
		</td></tr>
	</table>
<?php }?>
<a href="cambiaestado.php?c=<?php echo $cod;?>">ANULAR FACTURA</a>
</body>
</html>
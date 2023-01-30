<?php
session_start();
include ('conex.php');
@$cod = $_GET['c'];
if ($cod !=''){
$sql = mysql_query("Select * FROM FERIA_PROD where codigoP = '".$cod."'");	
}else{
	$sql = mysql_query("Select * FROM FERIA_PROD ");
}
?>
<html>
<head>
</head>
<body>
<?php
IF(mysql_num_rows($sql) > 0){?>

	<table border = "1" width = '80%' cellspacing = "0"  cellpadding = "0" align='center'>
	<tr>
			<th>Codigo</th>
			<th>Nombre</th>
			<th>Precio</th>
			<th>Cantidad</th>
			<th>Bodega</th>
	</td>
	</tr>	
<?php
 while($row = mysql_fetch_array($sql)){ ?>
		<tr>
		
			<td><?php echo $row[1];?></td>
			<td width = "280"><?php echo $row[2];?></td>
			<td align = "right"><?php echo number_format($row[4]);?></td>
			<td align = "right"><?php echo $row[6];?></td>
			<td align = "right"><?php echo $row[5];?></td>
	</td>	
	</tr>			
	<?php }?></table>
	
<?php }else{ ?>
	<table width = '60%' align='center'>
		<tr><td>
			<b>NO EXISTE ITEM.</b>
		</td></tr>
	</table>
<?php }?>

</body>
</html>
<?php session_start();
include ('conex.php');
@$cod = $_POST['c'];
$VENTAS = "feria_detal";
$PRODUCTOS = "FERIA_PROD";
$fd = fopen("INVENTARIO.csv","w"); // lo que hago es crear un archivo de texto llamado archivo.txt	
	$l = "codigo P;nombre P;cantidad;precio;bod;cant_real;";
	fwrite ($fd, $l.''); //aqui estoy escribiendo en el archivo.txt el valor de la variable $l	
	$sqlfile = mysql_query("SELECT * from $PRODUCTOS");
	while($row = mysql_fetch_array($sqlfile)){	
	$l = "\n".$row[1].";". $row[2].";". $row[3].";". $row[4].";".$row[5].";".$row[6].";";
	fwrite ($fd, $l.'');
	}	
	fclose($fd); //aqui estoy cerrando el archivo.txt
$fd = fopen("VENTAS.csv","w"); // lo que hago es crear un archivo de texto llamado archivo.txt	
	$l = "CONSECUTIVO;CLIENTE;NOMBRE;FECHA;DIRECCION;TELEFONO;MAIL;TIPO PAGO;CODIGO P;NOMBRE P;CANTIDAD;VALOR U;VALOR T;BODEGA;";
	fwrite ($fd, $l.''); //aqui estoy escribiendo en el archivo.txt el valor de la variable $l	
	$sqlfile = mysql_query("SELECT * FROM $VENTAS") or die (mysql_error());
	while($row = mysql_fetch_array($sqlfile)){	
	$l = "\n".$row[1].";". $row[2].";". $row[3].";". $row[4].";".$row[5].";".$row[6].";".$row[7].";".$row[8].";".$row[9].";".$row[10].";".$row[11].";".$row[12].";".$row[13].";".$row[15].";";
	fwrite ($fd, $l.'');
	}	
	fclose($fd); //aqui estoy cerrando el archivo.txt
	
$fd = fopen("pedidos.csv","w");
$sqlfile = mysql_query("SELECT * FROM  PEDIDOS WHERE (estado = '1') ORDER BY nOrden");	

WHILE ($row_file = mysql_fetch_array($sqlfile)){

	$l = "1".$row_file[0]."|". $row_file[1]."|". $row_file[2]."|".$row_file[3]."|".$row_file[4]."|".$row_file[5]."|".$row_file[6]."|".$row_file[7]."|".$row_file[8]."|"
	.$row_file[9]."|". $row_file[10]."|". $row_file[11]."|".$row_file[12]."|".$row_file[13]."|".$row_file[14]."|". 
	$row_file[15]."|". $row_file[16]."|".$row_file[17]."|".$row_file[18]."|".$row_file[19]."|".$row_file[20]."|".$row_file[21]."|"
	.$row_file[22]."|".$row_file[23]."|".$row_file[24]."|".$row_file[25]."|"."\r\n";
	fwrite ($fd, $l.'');
	$sqlfichero = mysql_query("SELECT detallePEDIDOS.id, detallePEDIDOS.tipo, detallePEDIDOS.nOrden, detallePEDIDOS.codigoC, detallePEDIDOS.fechaP, detallePEDIDOS.codigoP, 
		detallePEDIDOS.zona, detallePEDIDOS.cantidad, detallePEDIDOS.precioU,
		detallePEDIDOS.bodega, detallePEDIDOS.direccionC, detallePEDIDOS.division, detallePEDIDOS.dpto, detallePEDIDOS.centroC, 
		detallePEDIDOS.ordenC, detallePEDIDOS.comment1, detallePEDIDOS.comment2, detallePEDIDOS.terminoP, detallePEDIDOS.ivaC
		FROM  detallePEDIDOS inner join PEDIDOS on PEDIDOS.nORden = detallePEDIDOS.nOrden
		WHERE (detallePEDIDOS.nOrden = '".$row_file[0]."' AND PEDIDOS.estado = '1')") or die (mysql_error());	
	while($row = mysql_fetch_array($sqlfichero)){	
	$l = "1".$row[0]."|". $row[1]."|1".$row[2]."|".$row[3]."|".trim($row[4])."|".$row[5]."|".$row[6]."|".$row[7]."|".$row[8]."|".
	$row[9]."|". $row[10]."|". $row[11]."|".$row[12]."|".$row[13]."|".$row[14]."|".$row[15]."|".$row[16]."|".
	$row[17]."|".$row[18]."|"."|"."|"."|"."|"."|"."|"."\r\n";
	fwrite ($fd, $l.'');
	}
}fclose($fd);	
				
?>

<!DOCTYPE html>
<html lang = "es">
<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title> E&M EFECTIVO|E&M </title>
<style>
.enlaceboton {    font-family: verdana, arial, sans-serif; 
   font-size: 10pt; 
   font-weight: bold; 
   padding: 4px; 
   background-color: #ffffcc; 
   color: #666666; 
   text-decoration: none; 
} 
.enlaceboton:link, 
.enlaceboton:visited { 
   border-top: 1px solid #cccccc; 
   border-bottom: 2px solid #666666; 
   border-left: 1px solid #cccccc; 
   border-right: 2px solid #666666; 
} 
.enlaceboton:hover { 
    border-bottom: 1px solid #cccccc; 
   border-top: 2px solid #666666; 
   border-right: 1px solid #cccccc; 
   border-left: 2px solid #666666; 
}
</style>
<script type="text/javascript">
function show_inv(str){
	var c = document.getElementById("ITEM").value;
	if(window.XMLHttpRequest)
	{
	xmlhttp = new XMLHttpRequest();
	}
	else
	{
	xmlhttp = ActiveXObject ("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
	if(xmlhttp.readyState==4 && xmlhttp.status == 200)
	{
	document.getElementById("list_inv").innerHTML=xmlhttp.responseText;
	}
	}
	xmlhttp.open("GET","inventario.php?c="+c,true);
	xmlhttp.send();
}
function show_inv2(str){
	var c = '';
	if(window.XMLHttpRequest)
	{
	xmlhttp = new XMLHttpRequest();
	}
	else
	{
	xmlhttp = ActiveXObject ("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
	if(xmlhttp.readyState==4 && xmlhttp.status == 200)
	{
	document.getElementById("list_inv").innerHTML=xmlhttp.responseText;
	}
	}
	//document.getElementById('cod').value = "";
	xmlhttp.open("GET","inventario.php?c="+c,true);
	xmlhttp.send();
}
</script>
</head>
<body>
<div id = "listado"></div>
<div id = "inventario">
	<table width = '60%' align='center'>
	<tr><th colspan = '7' height = '30' bgcolor = '000000' cellpadding = "0" cellspacing = "0"><p style='color: #FFFFFF'>CONSULTAR INVENTARIO</p></th></tr>
	<tr height = '90'>
		<td>			
			<b>ITEM</b>
		</td>
		<td colspan = '4'>
			<input type "text" id="ITEM" name="ITEM" size = "60" OnChange = "show_inv(this.value);" /><a href = "#" Onclick = "show_inv2(this.value)">TODOS</a><br>
		</td>
	</tr>
	<tr><td colspan = '7'><div id = "list_inv"></div></td></tr>
	<tr height = '10'><td bgcolor = '000000' colspan = '7'></td></tr>
	<tr><td colspan = "3"><a href = "#" onclick="window.location.href='download1.php?file=INVENTARIO.csv'">Generar Archivo Inventario</a></td>
		<td colspan = "2"><a href = "#" onclick="window.location.href='download1.php?file=VENTAS.csv'">Generar Archivo Ventas</a></td>
		<td colspan = "2"><iFRAME src = "boton_descarga.php" height = "45px" frameborder = "0"></iFRAME></td>
	</tr>
</table>	
</div>
<br><br>
<?php if(@$cod!=''){
	echo "item actualizado";
	mysql_query("update feria_prod set precio = '".$_POST['prec']."' where codigoP = '".$cod."'");
}
?>
</body>
</html>
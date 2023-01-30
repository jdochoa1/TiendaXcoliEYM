<? include ("../../fuerzaventas/conex.php" );

//$tem = '';
//$cont = 0;
$fd = fopen("PEDIDOS_P.txt","w");
	
	$sqlfile = mysql_query("SELECT tipoRegistro, nOrden, codigoCliente, fechaPedido, codigoP, zona, cantidadP, valor, 
		bodega, direccion, division, departamento, centroCostos, ordenCliente, comentario1, comentario2, plazoC, codigoI FROM  `PEDIDOS_P` WHERE (estado = '0') ORDER BY nOrden");	
	
	WHILE ($row_file = mysql_fetch_array($sqlfile)){
	
	/*if($tem != $row_file[16] and $cont > 0)
	{
	fclose($fd); break;//$fd = fopen("PEDIDOS_P_".$cont.".txt","w");
	}
	$cont = $cont + 1; */
	
	$l = $row_file[0]."|". $row_file[1]."|". $row_file[2]."|".$row_file[3]."|".$row_file[4]."|".$row_file[5]."|".$row_file[6]."|".$row_file[7]."|".$row_file[8]."|"
	.$row_file[9]."|". $row_file[10]."|". $row_file[11]."|".$row_file[12]."|".$row_file[13]."|".$row_file[14]."|". 
	$row_file[15]."|". $row_file[16]."|".$row_file[17]."|"."\r\n";
	fwrite ($fd, $l.'');
	
	$sqlfichero = mysql_query("SELECT detallePEDIDOS_P.tipo, detallePEDIDOS_P.nOrden, detallePEDIDOS_P.codigoC, detallePEDIDOS_P.fechaP, detallePEDIDOS_P.codigoP, 
		detallePEDIDOS_P.zona, detallePEDIDOS_P.cantidad, detallePEDIDOS_P.precioU,
		detallePEDIDOS_P.bodega, detallePEDIDOS_P.direccionC, detallePEDIDOS_P.division, detallePEDIDOS_P.dpto, detallePEDIDOS_P.centroC, 
		detallePEDIDOS_P.ordenC, detallePEDIDOS_P.comment1, detallePEDIDOS_P.comment2, detallePEDIDOS_P.terminoP, detallePEDIDOS_P.ivaC
		FROM  detallePEDIDOS_P inner join PEDIDOS_P on PEDIDOS_P.nORden = detallePEDIDOS_P.nOrden
		WHERE (detallePEDIDOS_P.nOrden = '".$row_file[1]."' AND PEDIDOS_P.estado = '0')") or die (mysql_error());	
	while($row = mysql_fetch_array($sqlfichero)){	
	$l = $row[0]."|". $row[1]."|".$row[2]."|".$row[3]."|".trim($row[4])."|".$row[5]."|".$row[6]."|".$row[7]."|".$row[8]."|".
	$row[9]."|". $row[10]."|". $row[11]."|".$row[12]."|".$row[13]."|".$row[14]."|".$row[15]."|".$row[16]."|".
	$row[17]."|"."\r\n";
	fwrite ($fd, $l.'');
	}
		
	//$tem = $row_file[16];	
	}
	fclose($fd); 

 ?>
<!DOCTYPE html> 
<html>
<head>
<META HTTP-EQUIV="REFRESH" CONTENT="180;URL= pedido_zona.php">
<meta  name="viewport" content="width=device-width, initial-scale=1">
<title>PEDIDOS_P</title>
<link href="../jquery-mobile/jquery.mobile-1.0.min.css" rel="stylesheet" type="text/css"/>
<script src="../jquery-mobile/jquery-1.6.4.min.js" type="text/javascript"></script>
<script src="../jquery-mobile/jquery.mobile-1.0.min.js" type="text/javascript"></script>
<script type = "text/javascript"> 
 function pedidoibes(str){
if(str=="")
{
document.getElementById("muestra").innerHTML="";
return;
}
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
document.getElementById("muestra").innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open("GET","consulta_pedido.php?ibes="+str,true);
xmlhttp.send();
} 
function pedidofv(str){
if(str=="")
{
document.getElementById("muestra").innerHTML="";
return;
}
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
document.getElementById("muestra").innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open("GET","consulta_pedido.php?fuerza="+str,true);
xmlhttp.send();
} 
function pedidofactura(str){
if(str=="")
{
document.getElementById("muestra").innerHTML="";
return;
}
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
document.getElementById("muestra").innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open("GET","consulta_pedido.php?factura="+str,true);
xmlhttp.send();
} 
function pedidocliente(str){
if(str=="")
{
document.getElementById("muestra").innerHTML="";
return;
}
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
document.getElementById("muestra").innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open("GET","consulta_pedido.php?cliente="+str,true);
xmlhttp.send();
} 
function pedidofecha(str){
 fecha1 = document.getElementById("fecha1").value;
 fecha2 = document.getElementById("fecha2").value;
 div = document.getElementById('error');

 if (fecha1 == ""){
 div.style.display = '';
 document.getElementById("fecha2").value = ""
 return false; 
 }
 if(str=="")
{
div.style.display = '';
document.getElementById("muestra").innerHTML="";
return;
}
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
document.getElementById("muestra").innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open("POST","consulta_pedido.php?fecha2="+str,true);
xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
xmlhttp.send('fecha1='+fecha1+'&fecha2='+fecha2);
}
function ocultar() {
div = document.getElementById('error');
div.style.display ='none';
}
</script>       
</head>
<body>
<div data-role="page" id="page">
	<div data-role="header">
		<h1><b>PEDIDOS_P POR ZONA</b></h1>
		<a href="lista.php" data-icon="home" data-iconpos="notext" class="ui-btn-right"></a>
		<a href="javascript:window.history.back();" data-icon="arrow-l" data-iconpos="notext" class="ui-btn-left"></a>
	</div>
	<div data-role="content" data-theme="b" align = "center">	
<br> <br>
<?php
 
	$fuerza=mysql_query("select fechaP, nOrden, codigoC, SUM(cantidad) as cant1 from detallePEDIDOS_P 
						where pedido_ibes = '0' 
						group by nOrden") or
						die("Problemas en el select:".mysql_error());
						
				
	 while ($fue=mysql_fetch_array($fuerza))
	{	
				$fecha1 = substr($fue[fechaP],0,2);
				$ibes=mysql_query("select fecha, factura, orden, codigoC, SUM(cantidad) as cant2 from INVLINE 
						where  codigoC = '$fue[codigoC]'
						group by orden order by cant2") or
						die("Problemas en el select:".mysql_error());

								
			while ($ibe=mysql_fetch_array($ibes))
				{
				$pedibes=mysql_query("select pedido_ibes, Factura_Ibes from detallePEDIDOS_P 
						where Factura_Ibes = '$ibe[factura]'
						and pedido_ibes = '$ibe[orden]'") or
						die("Problemas en el select:".mysql_error());
				
				if(mysql_num_rows($pedibes) == 0){
				$fecha2 = substr($ibe[fecha],5,2);
				if($ibe['cant2'] == $fue['cant1'] and $fecha1 == $fecha2 ){
				
					$estado=mysql_query("select estado from PEDIDOS_P 
						where nOrden = '$fue[nOrden]'") or
						die("Problemas en el select:".mysql_error());
					while ($est=mysql_fetch_array($estado)){
					if ($est['estado'] == '2'){
					
						
						$actualiza=mysql_query("UPDATE detallePEDIDOS_P
                         set pedido_ibes = '$ibe[orden]' , Factura_Ibes =  '$ibe[factura]'
                         where nOrden = '$fue[nOrden]'") or die(mysql_error()); 
						$estado=mysql_query("UPDATE PEDIDOS_P
                         set estado = '3'
                         where nOrden = '$fue[nOrden]'") or die(mysql_error());	}}	 
						 }
				}
				}
	}  						
	$descarga=mysql_query("SELECT DISTINCT PEDIDOS_P.nOrden, PEDIDOS_P.codigoCliente, PEDIDOS_P.fechaPedido, detallePEDIDOS_P.zona,
						PEDIDOS_P.ordenCliente, PEDIDOS_P.nombreC, PEDIDOS_P.comentario1, PEDIDOS_P.comentario2, PEDIDOS_P.estado, PEDIDOS_P.direccion,
						PEDIDOS_P.facturar, PEDIDOS_P.formato, detallePEDIDOS_P.fechaP
						FROM PEDIDOS_P inner join detallePEDIDOS_P
						on PEDIDOS_P.nORden = detallePEDIDOS_P.nOrden
						WHERE PEDIDOS_P.estado = '0' OR 
						PEDIDOS_P.estado = '1'") or
						die("Problemas en el select:".mysql_error());

	$descarga1=mysql_query("SELECT DISTINCT PEDIDOS_P.nOrden, PEDIDOS_P.codigoCliente, PEDIDOS_P.fechaPedido, detallePEDIDOS_P.zona,
						PEDIDOS_P.ordenCliente, PEDIDOS_P.nombreC, PEDIDOS_P.comentario1, PEDIDOS_P.comentario2, PEDIDOS_P.estado, PEDIDOS_P.direccion,
						PEDIDOS_P.facturar, PEDIDOS_P.formato, detallePEDIDOS_P.fechaP
						FROM PEDIDOS_P inner join detallePEDIDOS_P
						on PEDIDOS_P.nORden = detallePEDIDOS_P.nOrden
						WHERE PEDIDOS_P.estado = '0'") or
						die("Problemas en el select:".mysql_error());					

if (mysql_num_rows($descarga) > 0){

	echo "<b>Se encontraron ".mysql_num_rows($descarga)." PEDIDOS_P.</b> "; 

	if (mysql_num_rows($descarga1) > 0){
  ?>
  <br><br>

  <!--a href = "#" onclick="window.location.href='download.php?file=PEDIDOS_P.txt'"><img  SRC="imagenes\boton_descargar.png"></a-->
  <iFRAME src = "boton_descarga.php?tem=<? echo $tem; ?>" height = "45px"  frameborder = "0">
  <?php
	//include ('boton_descarga.php');
  } ?>
  </iFRAME>
   <table border = "3" align = "center">
	<tr style = "background: #A9D0F5;" >
		<th align="center">No. Orden</th>
		<th align="center">Codigo Cliente</th>
		<th align="center">Nombre Cliente</th>
		<th align="center">Zona</th>
		<th align="center">Fecha Despacho</th>
		<th align="center">Fecha Factura</th>
		<th align="center">Estado</th>
		<th align="center"></th>
	</tr>	
	<?php
  while ($ped=mysql_fetch_array($descarga))
{  
		$comentarios = $ped['comentario1'] ." ".$ped['comentario2'];
?>	
	<tr>
		<td align="center" ><a href = "pedzon_cons.php?e=<?php echo $ped['nOrden']; ?>" data-rel = "dialog"><?php echo $ped['nOrden']; ?></a></td>
		<td align="center"><?php echo $ped['codigoCliente']; ?></td>
		<td align="center"><?php echo $ped['nombreC']; ?></td>
		<td align="center"><?php echo $ped['zona']; ?></td>
		<td align="center"><?php echo $ped['fechaP'];?></td>
		<td align="center"><?php echo $ped['facturar'];?></td>
		<?php if ($ped['estado'] == '0'){?>
		<td align="center"><IMG  SRC="imagenes\ok.png" ALT = "Pedido Aprobado" height = "14px"></td>
		<?php if ($ped['formato'] != ''){?>
		<TD><a href = "#" onclick="window.location.href='download_anexo.php?file=<?php echo $ped['nOrden'].".".$ped['formato']; ?>'"><img  SRC="imagenes\boton_descargar.png"></a></TD>
		<?php }}else{
		?><td align="center"><IMG SRC="imagenes\x.png" ALT = "Pendiente por Direccion" height = "14px"></td><?php;}?>
	    
<?php
		
}
	}else{
	echo "No se encontraron PEDIDOS_P pendientes";
	}

?>					
</table>	

	<table cellspacing = "5px">
	<tr>
	<td><input type = "text" name = "ibes" id= "ibes"  OnChange = "pedidoibes(this.value);"><b>Pedido Ibes</b></td>
	<td><input type = "text" name = "fuerza" id= "fuerza" OnChange = "pedidofv(this.value);"><b>Pedido FV</b></td>
	<td><input type = "text" name = "factura" id= "factura" OnChange = "pedidofactura(this.value);"><b>Factura</b></td>
	<td><input type = "text" name = "cliente" id= "cliente" OnChange = "pedidocliente(this.value);"><b>Codigo Cliente</b></td>
	</tr>
	<tr>
	<td><input type="date" name="fecha1" id = "fecha1" required onChange = "ocultar(this.value)"><b>Fecha Inicial</b></td>
	<td><input type="date" name="fecha2" id = "fecha2" required OnChange = "pedidofecha(this.value);"><b>Fecha Final</b></td>
	<td><div id = "error" style = "display:none"><font color = "#FF0000">Seleccione la Fecha Inicial</font></div>
	</tr>
	<table>	
<div id = "muestra"></div>
</div>
	<div data-role="footer" data-position = "fixed">
		<h4>www.eym.com.co</h4>
	</div>
</div>
</body>
</html>

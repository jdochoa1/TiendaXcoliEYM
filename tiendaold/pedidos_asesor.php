<!DOCTYPE html> 
<html>
<head>
<!--META HTTP-EQUIV="REFRESH" CONTENT="180;URL= pedido_zona.php"-->
<meta  name="viewport" content="width=device-width, initial-scale=1">
<title>Consulta PEDIDOS_P</title>
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
<body>
<?php
include ("../../fuerzaventas/conex.php" ); 
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
				$fecha2 = substr($ibe[fecha],5,2);	
				if($ibe['cant2'] == $fue['cant1'] and $fecha1 == $fecha2){
				$estado=mysql_query("select estado from PEDIDOS_P 
						where nOrden = '$fue[nOrden]'") or
						die("Problemas en el select:".mysql_error());
					while ($est=mysql_fetch_array($ibes)){
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

?>

<div data-role="page" id="page">
	<div data-role="header">
		<h1><b>PEDIDOS_P POR ZONA</b></h1>
		<a href="lista.php" data-icon="home" data-iconpos="notext" class="ui-btn-right"></a>
		<a href="javascript:window.history.back();" data-icon="arrow-l" data-iconpos="notext" class="ui-btn-left"></a>
	</div>
	<div data-role="content" data-theme="b" align = "center">	
<br> <br>

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
	
<?php session_start();
//include ('../../fuerzaventas/conex.php');
$vector = array();
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

<script src="datosCliente.min.js" type="text/javascript"></script>

	<script>
	$(document).ready(function(){
	
		// generamos un evento cada vez que se pulse una tecla
		$("#doc").keyup(function(){
		
			// enviamos una petición al servidor mediante AJAX enviando el id
			// introducido por el usuario mediante POST
			$.post("datosCliente.php", {"doc":$("#doc").val()}, function(data){
			
				// Si devuelve un nombre lo mostramos, si no, vaciamos la casilla
				if(data.nom)
					$("#nom").val(data.nom);
				else
					$("#nom").val("");
				// Si devuelve una direccion lo mostramos, si no, vaciamos la casilla
				if(data.dire)
					$("#dire").val(data.dire);
				else
					$("#dire").val("");
				// Si devuelve un telefono lo mostramos, si no, vaciamos la casilla
				if(data.tel)
					$("#tel").val(data.tel);
				else
					$("#tel").val("");
				// Si devuelve un mail lo mostramos, si no, vaciamos la casilla
				if(data.mail)
					$("#mail").val(data.mail);
				else
					$("#mail").val("");
					
				

			},"json");
		});
	});
	</script>
<script type="text/javascript">	
	
	function show(str){
	var c = document.getElementById("cod").value;
	var u = document.getElementById("nom").value;
	var v = document.getElementById("doc").value;
	var x = document.getElementById("dire").value;
	var y = document.getElementById("tel").value;
	var z = document.getElementById("mail").value;
	var a = document.getElementById("tpago").value;	
	if(u==''||v==''||x==''||y==''||z==''||a==''){
		alert ('Por favor diligencie primero el encabezado completo');
		document.getElementById('cod').value = "";
		return false;
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
	document.getElementById("listado").innerHTML=xmlhttp.responseText;
	}
	}
	document.getElementById('cod').value = "";
	div1 = document.getElementById('listado1');
	div2 = document.getElementById('listado2');
	div1.style.display ='none';
	div2.style.display ='none';
	xmlhttp.open("GET","filtro.php?c="+c+"&u="+u+"&v="+v+"&x="+x+"&y="+y+"&z="+z+"&a="+a,true);
	xmlhttp.send();
}
	function showDesc(str){
	var desc = document.getElementById("desc").value;	
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
	document.getElementById("listado").innerHTML=xmlhttp.responseText;
	}
	}
	document.getElementById('desc').value = "";
	div1 = document.getElementById('listado1');
	div2 = document.getElementById('listado2');
	div1.style.display ='none';
	div2.style.display ='none';
	xmlhttp.open("GET","desc.php?desc="+desc,true);
	xmlhttp.send();
}
function factura(str){
	var u = document.getElementById("nom").value;
	var v = document.getElementById("doc").value;
	var x = document.getElementById("dire").value;
	var y = document.getElementById("tel").value;
	var z = document.getElementById("mail").value;	
	var a = document.getElementById("tpago").value;
	if(u==''||v==''||x==''||y==''||z==''||a==''){
		alert ('campos vacios');
		return false;
	}else{
		document.location.href="factura.php";
	}
}
</script>
</head>
<body><?php
if(@$_GET['n']=='1'){ ?>
<meta HTTP-EQUIV="Refresh" CONTENT="0;url = calzado.php">
<?php }  ?>
<table width = '70%' align='center'>
	<tr><td height = '30' align = "right">
	<!--a href="calzado.php" class="enlaceboton">Facturar</a-->
	<a href="facturar.php"  class="enlaceboton" target = "blank_">Generar Facturacion</a>
	<a href="consulta.php" class="enlaceboton" target = "blank_">Consultas</a>
	<a href="upload.php" class="enlaceboton" target = "blank_">Cargar Inventario</a>
	<a href="Csesion.php" class="enlaceboton" >Borrar todo</a>
	</td></tr>
</table>
<?php
if(!empty($_SESSION['vector'])){
@$id = $_POST['id'];
@$nom = $_POST['nom'];
@$inv = $_POST['inv'];
@$cant = $_POST['cant'];
@$pre = $_POST['pre'];
@$prom = $_POST['prom'];
$_SESSION['iva'] = 0;
$Total = 0;

$vector = $_SESSION['vector'];
$vector_nom = $_SESSION['vector_nom'];
$vector_inv = $_SESSION['vector_inv'];
$vector_cant = $_SESSION['vector_cant'];
$vector_bod = $_SESSION['vector_bod'];
$vector_concatena = $_SESSION['vector_concatena'];
$vector_pre = $_SESSION['vector_pre'];
$vector_tot = $_SESSION['vector_tot'];
$vector_borrar = $_SESSION['vector_borrar'];

for ($j=0; $j<count($id); $j++){
	if ($cant[$j] > 0){
	if (in_array($id[$j], $vector, true)) {
    $aviso = $id[$j].' Producto agregado anteriormente. Por favor Revise.<br>';
}else{
	$vector[] .= $id[$j]; 
	$vector_inv[] .= $inv[$j];
	$vector_cant[] .= $cant[$j]; 
	$vector_pre[] .= $pre[$j];
	$vector_desc[] .= $pre[$j]-($pre[$j]*$_SESSION['desc']/100);
	$vector_desc1[] .= $pre[$j]-($pre[$j]*$_SESSION['desc']/100);
	$vector_prom[] .= $prom[$j];
	$vector_nom[] .= $nom[$j];	
	$vector_tot[] .= ($pre[$j]-($pre[$j]*$_SESSION['desc']/100))*$cant[$j];
	$vector_tot1[] .= ($pre[$j]-($pre[$j]*$_SESSION['desc']/100))*$cant[$j];
	$vector_borrar[] .= "<img src='delete.png'/>";
	$_SESSION['key_borrar'] = $_SESSION['key_borrar']++;$tem_desc = 0;}
}}

if (isset($_POST['dA']))
{
if ($_POST['dA']==0){
	$vector_desc = $vector_desc1;
	$vector_tot = $vector_tot1;
}else{
 foreach ($vector_desc as &$valor) {
	$valor = $valor - ($valor *$_POST['dA']/100);
}
foreach ($vector_tot as &$valor) {
	$valor = $valor - ($valor *$_POST['dA']/100);
}
}
}

$vector = array_values($vector);
$vector_nom = array_values($vector_nom);
$vector_inv = array_values($vector_inv);
$vector_cant = array_values($vector_cant);
$vector_pre = array_values($vector_pre);
$vector_bod = array_values($vector_bod);
$vector_concatena = array_values($vector_concatena);
$vector_tot = array_values($vector_tot);
$vector_borrar = array_values($vector_borrar);

$_SESSION['vector']=$vector; 
$_SESSION['vector_nom']=$vector_nom; 
$_SESSION['vector_inv']=$vector_inv;
$_SESSION['vector_cant']=$vector_cant;
$_SESSION['vector_bod']=$vector_bod;
$_SESSION['vector_concatena']=$vector_concatena;
$_SESSION['vector_pre']=$vector_pre;
$_SESSION['vector_tot']=$vector_tot;
$_SESSION['vector_borrar']=$vector_borrar;  

$_SESSION['iva'] = (array_sum($_SESSION['vector_tot'])*19)/100;
$_SESSION['TOTAL'] = array_sum($_SESSION['vector_tot']) + $_SESSION['iva']; 

}?>
<div id = "facturar" style = "display:block">
<div id = "listado1">
<?php
if(@$_POST['l'] != '1'){ ?>
<form id="miFormulario" name="miFormulario">
<table width = '70%' align='center'>
	<tr><th colspan = '7' height = '30' bgcolor = '000000' cellpadding = "0" cellspacing = "0"><p style='color: #FFFFFF'>FACTURAR</p></th></tr>
	<tr height = '90'>
		<td>
			<b>Cedula:</b><br>
			<b>Nombre:</b><br>			
			<b>Direccion:</b><br>
			<b>Telefono:</b><br>
			<b>Correo:</b><br>
			<b>Forma_Pago:</b><br>
		</td>
		<td colspan = '4'>
			<input type "text" id="doc" name="doc" size = "60" placeholder = "NO UTILICE CARACTERES ESPECIALES (#,/,&,%,\,otros)" value = "<?php echo @$_SESSION['doc'];?>"><br>
			<input type "text" id="nom" name="nom" size = "60" placeholder = "NO UTILICE CARACTERES ESPECIALES (#,/,&,%,\,otros)" value = "<?php echo @$_SESSION['nom'];?>"><br>			
			<input type "text" id="dire" name="dire" size = "60" placeholder = "NO UTILICE CARACTERES ESPECIALES (#,/,&,%,\,otros)" value = "<?php echo @$_SESSION['dire'];?>"><br>
			<input type "text" id="tel" name="tel" size = "60" placeholder = "NO UTILICE CARACTERES ESPECIALES (#,/,&,%,\,otros)" value = "<?php echo @$_SESSION['tel'];?>"><br>
			<input type "text" id="mail" name="mail" size = "60" placeholder = "NO UTILICE CARACTERES ESPECIALES (#,/,&,%,\,otros)" value = "<?php echo @$_SESSION['mail'];?>"><br>
			<select id="tpago" name="tpago">
				<option value = "<?php echo @$_SESSION['tpago'];?>"><?php echo @$_SESSION['tpago'];?></option>
				<option value = "Efectivo">Efectivo</option>
				<option value = "Tarjeta">Tarjeta</option>
			</select>
		</td>
		<td colspan = '2'>
			<?php if(!empty($_SESSION['vector'])){ ?>
			<a href = "#" OnClick = "factura();"><img src = "facturar.png"></img></a>
			<?php } ?>
		</td>
	</tr>
	<tr height = '10'><td colspan = '7'></td></tr>
</table></form>
</div>
<table border = '1' width = '70%' align='center'>
	<tr>
		<td><input type = "text" id="cod" name="cod" OnChange = "show(this.value);" placeholder = "codigo producto"></td>
		<td><input type = "text" id="desc" name="desc" OnChange = "showDesc(this.value);" placeholder = "Descuento en porcentaje"></td>
	</tr>
</table>
<div id = "listado2">
<table border = '1' width = '70%' align='center'>	
	<tr bgcolor = '000000' height = '20'>
		<th width='30'><p style='color: #FFFFFF'>Id</p></th>
		<th width='80'><p style='color: #FFFFFF'>Item</p></th>
		<th width='180'><p style='color: #FFFFFF'>Descripcion</p></th>
		<th width='30'><p style='color: #FFFFFF'>Cantidad</p></th>
		<th width='30'><p style='color: #FFFFFF'>Bodega</p></th>
		<th width='60'><p style='color: #FFFFFF'>Precio U</p></th>		
		<th width='60'><p style='color: #FFFFFF'>Total</p></th>
		<th width='10'><p style='color: #FFFFFF'>Borrar</p></th>
	</tr>
<?php
for ($i=0; $i<count(@$_SESSION['vector']); $i++){
		echo "<tr><td>".$i."</td><td>".$_SESSION['vector'][$i]."</td><td>".$_SESSION['vector_nom'][$i]."</td><td align = 'right'>".number_format($_SESSION['vector_cant'][$i],0)."</td><td align = 'right'>".$_SESSION['vector_bod'][$i]."</td><td align = 'right'>$".number_format($_SESSION['vector_pre'][$i],0)."</td><td align = 'right'>$".number_format($_SESSION['vector_tot'][$i],0)."</td><td align = 'center'><a href='borracar.php?i=".$i."'>".$_SESSION['vector_borrar'][$i]."</a></td></tr>";
}
echo "<tr height = '20'><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
echo "<tr height = '20'><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
echo "<tr height = '20'><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
echo "<tr height = '20'><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
echo "<tr><td colspan = '5' ></td><td><b>SubTotal</b></td><td align = 'right'>$".@number_format(array_sum($_SESSION['vector_tot']),0)."</td><td></td></tr>";
echo "<tr><td colspan = '5'></td><td><b>IVA</b></td><td align = 'right'>$".@number_format($_SESSION['iva'],0)."</td><td></td></tr>";
echo "<tr><td colspan = '5'></td><td><b>TOTAL</b></td><td align = 'right'>$".@number_format($_SESSION['TOTAL'],0)."</td><td></td></tr>";
echo "</table>";
} 
?>
</div>
</div><!--factura-->
<div id = "listado"></div>
</body>
</html>
<?php
session_start();
include ('conex.php');
$CATEGORIAS = "FERIA_PROD";
$desc = $_GET['desc'];
?>
<html>
<head>
<script type="text/javascript">
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
<body>
<?php
$vector = $_SESSION['vector'];
$vector_nom = $_SESSION['vector_nom'];
$vector_inv = $_SESSION['vector_inv'];
$vector_cant = $_SESSION['vector_cant'];
$vector_bod = $_SESSION['vector_bod'];
$vector_concatena = $_SESSION['vector_concatena'];
$vector_pre = $_SESSION['vector_pre'];
$vector_tot = $_SESSION['vector_tot'];
$vector_borrar = $_SESSION['vector_borrar'];

for ($i=0; $i<count($_SESSION['vector']); $i++){
	$vector_tot[$i] = $vector_tot[$i] -($vector_tot[$i] *$desc)/100;
}
$vector = array_values($vector);
$vector_nom = array_values($vector_nom);
$vector_inv = array_values($vector_inv);
$vector_cant = array_values($vector_cant);
$vector_bod = array_values($vector_bod);
$vector_concatena = array_values($vector_concatena);
$vector_pre = array_values($vector_pre);
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

if(@$_POST['id'] != '' || !empty($_SESSION['vector'])){
?>
<table width = '70%' align='center'>
	<tr><td colspan = '7' height = '30' bgcolor = '000000'></td></tr>
	<tr height = '90'>
		<td>
			<b>Nombre:</b><br>
			<b>Cedula:</b><br>
			<b>Direccion:</b><br>
			<b>Telefono:</b><br>
			<b>Correo:</b><br>
			<b>Forma_Pago:</b><br>
		</td>
		<td colspan = '4'>
			<input type "text" size = "60" value = "<?php echo $_SESSION['nom'];?>"><br>
			<input type "text" size = "60" value = "<?php echo $_SESSION['doc'];?>"><br>
			<input type "text" size = "60" value = "<?php echo $_SESSION['dire'];?>"><br>
			<input type "text" size = "60" value = "<?php echo $_SESSION['tel'];?>"><br>
			<input type "text" size = "60" value = "<?php echo $_SESSION['mail'];?>"><br>
			<input type "text" size = "60" value = "<?php echo $_SESSION['tpago'];?>">
		</td>
		<td colspan = '2'>
			<?php if(!empty($_SESSION['vector'])){ ?>
			<a href = "#" OnClick = "factura();"><img src = "facturar.png"></img></a>
			<?php } ?>
		</td>
	</tr>
	<tr height = '10'><td colspan = '7'></td></tr>
</table>
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
for ($i=0; $i<count($_SESSION['vector']); $i++){
		echo "<tr><td>".$i."</td><td>".$_SESSION['vector'][$i]."</td><td>".$_SESSION['vector_nom'][$i]."</td><td align = 'right'>".number_format($_SESSION['vector_cant'][$i],0)."</td><td align = 'right'>".$_SESSION['vector_bod'][$i]."</td><td align = 'right'>$".number_format($_SESSION['vector_pre'][$i],0)."</td><td align = 'right'>$".number_format($_SESSION['vector_tot'][$i],0)."</td><td align = 'center'><a href='borracar.php?i=".$i."'>".$_SESSION['vector_borrar'][$i]."</a></td></tr>";
}
echo "<tr height = '20'><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
echo "<tr height = '20'><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
echo "<tr height = '20'><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
echo "<tr height = '20'><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
echo "<tr><td colspan = '5' ></td><td><b>SubTotal</b></td><td align = 'right'>$".number_format(array_sum($_SESSION['vector_tot']),0)."</td><td></td></tr>";
echo "<tr height = '10'><td colspan = '5'></td><td><b>IVA</b></td><td align = 'right'>$".number_format($_SESSION['iva'],0)."</td><td></td></tr>";
echo "<tr height = '5'><td colspan = '5'></td><td><b>TOTAL</b></td><td align = 'right'>$".number_format($_SESSION['TOTAL'],0)."</td><td></td></tr>";
echo "</table><br>";
}
?>
</body>
</html>
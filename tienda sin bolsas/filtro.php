<?php
session_start();
include ('conex.php');
$PRODUCTOS = "FERIA_PROD";
$ITEMS = "BASEITEM";

$cod = $_GET['c'];
$_SESSION['tpago'] = $_GET['a'];
$_SESSION['tel'] = $_GET['y'];
$_SESSION['mail'] = $_GET['z'];
$_SESSION['nom'] = $_GET['u'];
$_SESSION['doc'] = $_GET['v'];
$_SESSION['dire'] = $_GET['x'];


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
$sql = mysql_query("Select codigoP, nombreP, cant_real, precio, bod FROM $PRODUCTOS where codigoP = '".$cod."'");

$sql1 = mysql_query("Select codigoP, nombreP, cant_real, precio, bod FROM $ITEMS where codigoP = '".$cod."'");

IF(mysql_num_rows($sql) > 0){

@$id = $_POST['id'];
@$nom = $_POST['nom'];
@$inv = $_POST['inv'];
@$cant = $_POST['cant'];
@$bod = $_POST['bod'];
@$pre = $_POST['pre'];
@$prom = $_POST['prom'];
$_SESSION['iva'] = 0;
$Total = 0;

@$vector = $_SESSION['vector'];
@$vector_nom = $_SESSION['vector_nom'];
@$vector_inv = $_SESSION['vector_inv'];
@$vector_cant = $_SESSION['vector_cant'];
@$vector_bod = $_SESSION['vector_bod'];
@$vector_concatena = $_SESSION['vector_concatena'];
@$vector_pre = $_SESSION['vector_pre'];
@$vector_tot = $_SESSION['vector_tot'];

@$vector_borrar = $_SESSION['vector_borrar'];
	while($row = mysql_fetch_array($sql)){
		
		
	if (@in_array($row[0].$row[4], @$vector_concatena, true)){
		for ($i=0; $i<count(@$_SESSION['vector']); $i++){
			
			if($_SESSION['vector'][$i] == $row[0] && $_SESSION['vector_bod'][$i] == $row[4]){
				$_SESSION['vector_cant'][$i] = $_SESSION['vector_cant'][$i] +1;
				$_SESSION['vector_tot'][$i] = $_SESSION['vector_cant'][$i]*$_SESSION['vector_pre'][$i];
			}/*else{
				if($_SESSION['vector'][$i] == $row[0]&&$_SESSION['vector_bod'][$i] != $row[4]){
				$_SESSION['vector_cant'][$i] = $_SESSION['vector_cant'][$i] +1;
				$_SESSION['vector_tot'][$i] = $_SESSION['vector_cant'][$i]*$_SESSION['vector_pre'][$i];
			}				
			}*/
		}
	}else{
	if ($row[2] > 0){
	
	$vector[] .= $row[0]; 
	$vector_inv[] .= $row[2];
	$vector_cant[] .= 1; 
	$vector_bod[] .= $row[4];
	$vector_concatena[] .= $row[0].$row[4];
	$vector_pre[] .= $row[3];
	$vector_nom[] .= $row[1];	
	$vector_tot[] .= ($row[3]*1);
	$vector_borrar[] .= "<img src='delete.png'/>";
	@$_SESSION['key_borrar'] = $_SESSION['key_borrar']++;$tem_desc = 0;
	

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

}else{
		echo "<table width = '60%' align='center'>
			<tr><td>NO hay inventario</td></tr>
			</table>";
	}}
@$_SESSION['iva'] = (array_sum(@$_SESSION['vector_tot'])*19)/100;
@$_SESSION['TOTAL'] = array_sum(@$_SESSION['vector_tot']) + @$_SESSION['iva']; 	
}
}else if (mysql_num_rows($sql1) > 0){
	
@$id = $_POST['id'];
@$nom = $_POST['nom'];
@$inv = $_POST['inv'];
@$cant = $_POST['cant'];
@$bod = $_POST['bod'];
@$pre = $_POST['pre'];
@$prom = $_POST['prom'];
$_SESSION['iva'] = 0;
$Total = 0;

@$vector = $_SESSION['vector'];
@$vector_nom = $_SESSION['vector_nom'];
@$vector_inv = $_SESSION['vector_inv'];
@$vector_cant = $_SESSION['vector_cant'];
@$vector_bod = $_SESSION['vector_bod'];
@$vector_concatena = $_SESSION['vector_concatena'];
@$vector_pre = $_SESSION['vector_pre'];
@$vector_tot = $_SESSION['vector_tot'];

@$vector_borrar = $_SESSION['vector_borrar'];
	while($row = mysql_fetch_array($sql1)){
		
		
	if (@in_array($row[0].$row[4], @$vector_concatena, true)){
		for ($i=0; $i<count(@$_SESSION['vector']); $i++){
			
			if($_SESSION['vector'][$i] == $row[0] && $_SESSION['vector_bod'][$i] == $row[4]){
				$_SESSION['vector_cant'][$i] = $_SESSION['vector_cant'][$i] +1;
				$_SESSION['vector_tot'][$i] = $_SESSION['vector_cant'][$i]*$_SESSION['vector_pre'][$i];
			}/*else{
				if($_SESSION['vector'][$i] == $row[0]&&$_SESSION['vector_bod'][$i] != $row[4]){
				$_SESSION['vector_cant'][$i] = $_SESSION['vector_cant'][$i] +1;
				$_SESSION['vector_tot'][$i] = $_SESSION['vector_cant'][$i]*$_SESSION['vector_pre'][$i];
			}				
			}*/
		}
	}else{
	if ($row[2] > 0){
	
	$vector[] .= $row[0]; 
	$vector_inv[] .= $row[2];
	$vector_cant[] .= 1; 
	$vector_bod[] .= $row[4];
	$vector_concatena[] .= $row[0].$row[4];
	$vector_pre[] .= $row[3];
	$vector_nom[] .= $row[1];	
	$vector_tot[] .= ($row[3]*1);
	$vector_borrar[] .= "<img src='delete.png'/>";
	@$_SESSION['key_borrar'] = $_SESSION['key_borrar']++;$tem_desc = 0;
	

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

}else{
		echo "<table width = '60%' align='center'>
			<tr><td>NO hay inventario</td></tr>
			</table>";
	}}
@$_SESSION['iva'] = (array_sum(@$_SESSION['vector_tot'])*19)/100;
@$_SESSION['TOTAL'] = array_sum(@$_SESSION['vector_tot']) + @$_SESSION['iva']; 	
}	
}else{ ?>
	<table width = '70%' align='center'>
		<tr><td>
			<b>NO EXISTE ITEM.</b>
		</td></tr>
	</table>
<?php }?>

<?php
if(@$_POST['id'] != '' || !empty($_SESSION['vector'])){?>
<table width = '70%' align='center'>
	<tr><td colspan = '7' height = '30' bgcolor = '000000'></td></tr>
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
			<input type "text" size = "60" value = "<?php echo @$_SESSION['doc'];?>"><br>
			<input type "text" size = "60" value = "<?php echo @$_SESSION['nom'];?>"><br>
			<input type "text" size = "60" value = "<?php echo @$_SESSION['dire'];?>"><br>
			<input type "text" size = "60" value = "<?php echo @$_SESSION['tel'];?>"><br>
			<input type "text" size = "60" value = "<?php echo @$_SESSION['mail'];?>"><br>
			<input type "text" size = "60" value = "<?php echo @$_SESSION['tpago'];?>">
			<!--select id="tpago" name="tpago">
				<option value = "<? //echo $_SESSION['tpago'];?>"><? //echo $_SESSION['tpago'];?></option>
				<option value = "Efectivo">Efectivo</option>
				<option value = "Tarjeta">Tarjeta</option>
			</select-->
		</td>
		<td colspan = '2'>
			<? if(!empty($_SESSION['vector'])){ ?>
			<a href = "#" OnClick = "factura();"><img src = "facturar.png"></img></a>
			<? } ?>
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
echo "</table>";
}
?>
</body>
</html>
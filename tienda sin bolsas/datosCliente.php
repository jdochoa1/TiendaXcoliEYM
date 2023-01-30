<?php
# Esta página recibe por post el id del formulario.
#
# Para nuestro ejemplo, devolvemos un valor para el id 10, pero aqui se tendria
# que realizar la busqueda en la base de datos en busca del registro.
#
include('conex.php');
if($_POST["doc"]!="")
	
	
{
	$sql = mysql_query("Select nombreC, direccionC, telC, mailC FROM feria_detal where cliente = '".$_POST["doc"]."'");
	$row = mysql_fetch_array($sql);
	echo json_encode(array("nom"=>$row[0], "dire"=>$row[1], "tel"=>$row[2], "mail"=>$row[3]));
	//echo json_encode(array("nom"=>$row[0]));
}else{
	//echo json_encode(array("nombre"=>"", "apellidos"=>""));
	//echo json_encode(array("nombre"=>""));
}
?>

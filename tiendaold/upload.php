<?php
include ('conex.php');
date_default_timezone_set('America/Bogota');
$a = date("Y");$m = date("m");$d = date("d");$H = date("H");$i = date("i");$s = date("s");
$VENTAS = "feria_detal";
$PRODUCTOS = "FERIA_PROD";
?>
<html>
<head>
<title>::CARGA DE ARCHIVOS::</title>
<style>

table,td
{
	border               : 1px solid #CCC;
	border-collapse      : collapse;
  font                 : small/1.0 "Tahoma", "Bitstream Vera Sans", Verdana, Helvetica, sans-serif;
}
table
{
	border                :none;
	border                :1px solid #CCC;
}
thead th,
tbody th
{
	background            : #FFF url(th_bck.gif) repeat-x;
	color                 : #666;  
	padding               : 5px 10px;
  border-left           : 1px solid #CCC;
}
tbody th
{
  background            : #fafafb;
  border-top            : 1px solid #CCC;
  text-align            : left;
  font-weight           : normal;
}
tbody tr td
{
	padding               : 5px 10px;
	color                 : #666;
}
tbody tr:hover
{
  background            : #FFF url(tr_bck.gif) repeat;
}

tbody tr:hover td
{
  color                 : #454545;
}
tfoot td,
tfoot th
{
  border-left           : none;
  border-top            : 1px solid #CCC;
	padding               : 4px;
   background            : #FFF url(foot_bck.gif) repeat;
  color                 : #666;
}
caption
{
	text-align            : left;
	font-size             : 120%;
	padding               : 10px 0;
	color                 : #666;
}cra 15 # 72
table a:link
{
	color                 : #666;
}
table a:visited
{
	color                 : #666;
}
table a:hover
{
	color                 : #D5EDB3;
	text-decoration       : none;
}
table a:active
{
	color                 : #003366;
}
</style>
</head>
<body>
	<table border="0" cellspacing="0" cellpadding="0" width="305">
        <tr>
          <td class="pageName">FORMULARIO DE ACTUALIZACION</td><p>
		</tr>
		<tr>
          <td class="bodyText"><p>Por favor seleccione el archivo de su disco local, en el formato ya establecido.</p>
			<form method="POST" action="upload.php" enctype="multipart/form-data"> 
				<table style="text-align: center; width: 100%;">
					<tbody>
						<tr>
							<td bgcolor = "#D5EDB3"><input type="file" name="archivo"></td>
						</tr>
						<tr>
							<td><input type="submit" value="Subir"></td>
						</tr>
					</tbody>	
				</table>
			</form>
			</td>
		</tr>
</table>
<?php 
@$archivo_nombre=$_FILES["archivo"]["name"]; 
@$archivo_peso=$_FILES["archivo"]["size"]; 
@$archivo_temporal=$_FILES["archivo"]["tmp_name"];
if (@copy($archivo_temporal, $archivo_nombre)){ 
$destino = '/julian2' ; 
@move_uploaded_file( $_FILES [ "archivo"][ "tmp_name" ],$destino .'/'.$_FILES["archivo"]["name"]); 
$archivo=file($_FILES["archivo"]["name"]);
			
			if ($_FILES["archivo"]["name"]=='productos.csv'){
			$orden="TRUNCATE $PRODUCTOS";	
			mysql_query($orden);}
    foreach($archivo as $linea){
	if ($_FILES["archivo"]["name"]=='productos.csv' ){	
	if($_FILES["archivo"]["name"]=='productos.csv'){
		$linea= str_replace("'",'"', $linea);
		$linea= str_replace('"',"", $linea);
		$col=explode(";",$linea);
		$orden1="INSERT INTO $PRODUCTOS VALUES ('','".$col[0]."','".$col[1]."','".$col[2]."','".$col[3]."','".$col[4]."','".$col[5]."')";
		}					
	mysql_query($orden1);
	}else {echo "Archivo invalido. No ha sido posible actualizar la tabla de productos.";break;}
	}
	//if(mysql_query($orden1)){echo "El archivo " .$_FILES["archivo"]["name"]." fue cargado correctamente. La tabla de productos ha sido actualizada.  ";}  
}?>
</body>
</html>
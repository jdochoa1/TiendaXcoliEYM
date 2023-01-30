<html>
<head>
</head>
<body>
<?php
session_start();
include ('conex.php');
@$cod = $_GET['c'];
$sql = mysql_query("update feria_detal set obsv = 'FACTURA ANULADA' where cons = '$cod' ");

echo "FACTURA ANULADA EXITOSAMENTE!!!"
?>
<input name="button" type="button" onclick="window.close();" value="Cerrar esta ventana" /> 
</body>
</html>
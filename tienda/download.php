<?php
$file = $_GET['file'];
header("Content-disposition: attachment; filename=$file");
header("Content-type: application/octet-stream");
readfile($file);

include ('conex.php');

$estados=mysql_query("UPDATE PEDIDOS
                         set estado='2' , fecha_descarga = now()
                         where estado='1'") or  die(mysql_error());     
?>
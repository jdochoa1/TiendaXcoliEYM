
<?php
if ($_REQUEST['ibes'] != ''){
include ("../../fuerzaventas/conex.php" ); 
	$PEDIDOS_P=mysql_query("SELECT DISTINCT PEDIDOS_P.nOrden, PEDIDOS_P.codigoCliente, PEDIDOS_P.fechaPedido, detallePEDIDOS_P.zona,
						PEDIDOS_P.ordenCliente, PEDIDOS_P.nombreC, PEDIDOS_P.comentario1, PEDIDOS_P.comentario2, PEDIDOS_P.estado, PEDIDOS_P.direccion,
						PEDIDOS_P.facturar, PEDIDOS_P.parciales, detallePEDIDOS_P.Pedido_Ibes, detallePEDIDOS_P.Factura_Ibes, PEDIDOS_P.formato, PEDIDOS_P.comentario
						FROM PEDIDOS_P inner join detallePEDIDOS_P
						on PEDIDOS_P.nORden = detallePEDIDOS_P.nOrden
						WHERE detallePEDIDOS_P.Pedido_Ibes = '$_REQUEST[ibes]'") or
						die("Problemas en el select:".mysql_error());
						
if (mysql_num_rows($PEDIDOS_P) > 0){

	?>
   <table border = "3" align = "center">
	<tr style = "background: #A9D0F5;" >
		<th align="center">No.FV</th>
		<th align="center">No.Ibes</th>
		<th align="center">Factura</th>
		<th align="center">Codigo Cliente</th>
		<th align="center">Nombre Cliente</th>
		<th align="center">Zona</th>
		<th align="center">Fecha Despacho</th>   
		<th align="center">Fecha Factura</th>
		<th align="center">Despacho</th>
		<th align="center"></th>
	</tr>	
	<?php
  while ($ped=mysql_fetch_array($PEDIDOS_P))
{  
		$comentarios = $ped['comentario1'] ." ".$ped['comentario2'];
		
		$despachos=mysql_query("SELECT DISTINCT max(DESPACHOS.guiaOrdenCargue) as despacho
						FROM DESPACHOS inner join detallePEDIDOS_P
						on DESPACHOS.pedidoNumero = detallePEDIDOS_P.Pedido_Ibes
						WHERE DESPACHOS.pedidoNumero = '$ped[Pedido_Ibes]'") or
						die("Problemas en el select:".mysql_error());
						
		$backorder=mysql_query("SELECT DISTINCT BACKORDER.PEDIDO
						FROM BACKORDER inner join detallePEDIDOS_P
						on BACKORDER.PEDIDO = detallePEDIDOS_P.Pedido_Ibes
						WHERE BACKORDER.PEDIDO = '$ped[Pedido_Ibes]'") or
						die("Problemas en el select:".mysql_error());				
		
?>	
	<tr>
		<td align="center"><a href = "pedzon_cons.php?e=<?php echo $ped['nOrden']; ?>" data-rel = "dialog"><?php echo $ped['nOrden']; ?></a></td>
		<td align="center"><?php echo $ped['Pedido_Ibes'];?></td>
		<td align="center"><a href = "../url.php?ft=<?php echo $ped['Factura_Ibes']; ?>&codT=<?php echo $ped['codigoCliente']; ?>&pd=<?php echo $ped['Pedido_Ibes'];?>" target = "_blank"><?php echo $ped['Factura_Ibes'];?></a></td>	
		<td align="center"><?php echo $ped['codigoCliente']; ?></td>
		<td align="center"><?php echo $ped['nombreC']; ?></td>
		<td align="center"><?php echo $ped['zona']; ?></td>
		<td align="center"><?php echo $ped['fechaPedido'];?></td>
		<td align="center"><?php echo $ped['facturar'];?></td>
		<?php 
		
			if ($ped['Pedido_Ibes'] == 0 or $ped['Factura_Ibes'] == 0){
			?><td align="center" border = "0">No</td>
			<?php } else { ?><td align="center"><a href = "detalledes2.php?e=<?php echo $ped['Pedido_Ibes']; ?>" data-rel = "dialog">Ver</a></td>
		
												
<?php
			}
		if ($ped['formato'] != ''){?>
		<TD><a href = "#" onclick="window.location.href='download_anexo.php?file=<?php echo $ped['nOrden'].".".$ped['formato']; ?>'"><img  SRC="imagenes\boton_descargar.png"></a></TD>
		<?php }
												
	
																							
}
	}else{
	echo "<b>No se encontraron PEDIDOS_P</b>";
	}

?>					
</table> <?php }
else if ($_REQUEST['fuerza'] != ''){

include ("../../fuerzaventas/conex.php" ); 
	$PEDIDOS_P=mysql_query("SELECT DISTINCT PEDIDOS_P.nOrden, PEDIDOS_P.codigoCliente, PEDIDOS_P.fechaPedido, detallePEDIDOS_P.zona,
						PEDIDOS_P.ordenCliente, PEDIDOS_P.nombreC, PEDIDOS_P.comentario1, PEDIDOS_P.comentario2, PEDIDOS_P.estado, PEDIDOS_P.direccion,
						PEDIDOS_P.facturar, PEDIDOS_P.parciales, detallePEDIDOS_P.Pedido_Ibes, detallePEDIDOS_P.Factura_Ibes, PEDIDOS_P.formato
						FROM PEDIDOS_P inner join detallePEDIDOS_P
						on PEDIDOS_P.nORden = detallePEDIDOS_P.nOrden
						WHERE PEDIDOS_P.nOrden = '$_REQUEST[fuerza]'") or
						die("Problemas en el select:".mysql_error());
			
						
if (mysql_num_rows($PEDIDOS_P) > 0){

	?>
   <table border = "3" align = "center">
	<tr style = "background: #A9D0F5;" >
		<th align="center">No.FV</th>
		<th align="center">No.Ibes</th>
		<th align="center">Factura</th>
		<th align="center">Codigo Cliente</th>
		<th align="center">Nombre Cliente</th>
		<th align="center">Zona</th>
		<th align="center">Fecha Despacho</th>
		<th align="center">Fecha Factura</th>
		<th align="center">Despacho</th>
		<th align="center"></th>
	</tr>	
	<?php
  while ($ped=mysql_fetch_array($PEDIDOS_P))
{  
		$comentarios = $ped['comentario1'] ." ".$ped['comentario2'];
		
		$despachos=mysql_query("SELECT DISTINCT max(DESPACHOS.guiaOrdenCargue) as despacho
						FROM DESPACHOS inner join detallePEDIDOS_P
						on DESPACHOS.pedidoNumero = detallePEDIDOS_P.Pedido_Ibes
						WHERE DESPACHOS.pedidoNumero = '$ped[Pedido_Ibes]'") or
						die("Problemas en el select:".mysql_error());
						
	
?>		
	<tr>
		<td align="center"><a href = "pedzon_cons.php?e=<?php echo $ped['nOrden']; ?>" data-rel = "dialog"><?php echo $ped['nOrden']; ?></a></td>
		<td align="center"><?php echo $ped['Pedido_Ibes'];?></td>
		<td align="center"><a href = "../url.php?ft=<?php echo $ped['Factura_Ibes']; ?>&codT=<?php echo $ped['codigoCliente']; ?>&pd=<?php echo $ped['Pedido_Ibes'];?>" target = "_blank"><?php echo $ped['Factura_Ibes'];?></a></td>	
		<td align="center"><?php echo $ped['codigoCliente']; ?></td>
		<td align="center"><?php echo $ped['nombreC']; ?></td>
		<td align="center"><?php echo $ped['zona']; ?></td>
		<td align="center"><?php echo $ped['fechaPedido'];?></td>
		<td align="center"><?php echo $ped['facturar'];?></td>
		<?php 
		
			if ($ped['Pedido_Ibes'] == 0 or $ped['Factura_Ibes'] == 0){
			?><td align="center" border = "0">No</td>
			<?php } else { ?><td align="center"><a href = "detalledes2.php?e=<?php echo $ped['Pedido_Ibes']; ?>" data-rel = "dialog">Ver</a></td>
	    	
<?php
		}
		if ($ped['formato'] != ''){?>
		<TD><a href = "#" onclick="window.location.href='download_anexo.php?file=<?php echo $ped['nOrden'].".".$ped['formato']; ?>'"><img  SRC="imagenes\boton_descargar.png"></a></TD>
		<?php }	
												
}
	}else{
	echo "<b>No se encontraron PEDIDOS_P</b>";
	}

?>					
</table>	<?php }
else if ($_REQUEST['factura'] != ''){

include ("../../fuerzaventas/conex.php" ); 
	$PEDIDOS_P=mysql_query("SELECT DISTINCT PEDIDOS_P.nOrden, PEDIDOS_P.codigoCliente, PEDIDOS_P.fechaPedido, detallePEDIDOS_P.zona,
						PEDIDOS_P.ordenCliente, PEDIDOS_P.nombreC, PEDIDOS_P.comentario1, PEDIDOS_P.comentario2, PEDIDOS_P.estado, PEDIDOS_P.direccion,
						PEDIDOS_P.facturar, PEDIDOS_P.parciales, detallePEDIDOS_P.Pedido_Ibes, detallePEDIDOS_P.Factura_Ibes, PEDIDOS_P.formato
						FROM PEDIDOS_P inner join detallePEDIDOS_P
						on PEDIDOS_P.nORden = detallePEDIDOS_P.nOrden
						WHERE detallePEDIDOS_P.Factura_Ibes = '$_REQUEST[factura]'") or
						die("Problemas en el select:".mysql_error());
						
if (mysql_num_rows($PEDIDOS_P) > 0){

	?>
   <table border = "3" align = "center">
	<tr style = "background: #A9D0F5;" >
		<th align="center">No.FV</th>
		<th align="center">No.Ibes</th>
		<th align="center">Factura</th>
		<th align="center">Codigo Cliente</th>
		<th align="center">Nombre Cliente</th>
		<th align="center">Zona</th>
		<th align="center">Fecha Despacho</th>
		<th align="center">Fecha Factura</th>
		<th align="center">Despacho</th>
		<th align="center"></th>
	</tr>	
	<?php
  while ($ped=mysql_fetch_array($PEDIDOS_P))
{  
		$comentarios = $ped['comentario1'] ." ".$ped['comentario2'];
		
		$despachos=mysql_query("SELECT DISTINCT max(DESPACHOS.guiaOrdenCargue) as despacho
						FROM DESPACHOS inner join detallePEDIDOS_P
						on DESPACHOS.pedidoNumero = detallePEDIDOS_P.Pedido_Ibes
						WHERE DESPACHOS.pedidoNumero = '$ped[Pedido_Ibes]'") or
						die("Problemas en el select:".mysql_error());
						
		
?>	
	<tr>
		<td align="center"><a href = "pedzon_cons.php?e=<?php echo $ped['nOrden']; ?>" data-rel = "dialog"><?php echo $ped['nOrden']; ?></a></td>
		<td align="center"><?php echo $ped['Pedido_Ibes'];?></td>
		<td align="center"><a href = "ped_detalle_factura.php?e=<?php echo $ped['Factura_Ibes']; ?>" data-rel = "dialog"><?php echo $ped['Factura_Ibes'];?></a></td>		
		<td align="center"><?php echo $ped['codigoCliente']; ?></td>
		<td align="center"><?php echo $ped['nombreC']; ?></td>
		<td align="center"><?php echo $ped['zona']; ?></td>
		<td align="center"><?php echo $ped['fechaPedido'];?></td>
		<td align="center"><?php echo $ped['facturar'];?></td>
		<?php 
		
			if ($ped['Pedido_Ibes'] == 0 or $ped['Factura_Ibes'] == 0){
			?><td align="center" border = "0">No</td>
			<?php } else { ?><td align="center"><a href = "detalledes2.php?e=<?php echo $ped['Pedido_Ibes']; ?>" data-rel = "dialog">Ver</a></td>
	    	
<?php
		}
		if ($ped['formato'] != ''){?>
		<TD><a href = "#" onclick="window.location.href='download_anexo.php?file=<?php echo $ped['nOrden'].".".$ped['formato']; ?>'"><img  SRC="imagenes\boton_descargar.png"></a></TD>
		<?php }
												
				
}
	}else{
	echo "<b>No se encontraron PEDIDOS_P</b>";
	}

?>					
</table>	<?php }
else if ($_REQUEST['cliente'] != ''){

include ("../../fuerzaventas/conex.php" ); 
	$PEDIDOS_P=mysql_query("SELECT DISTINCT PEDIDOS_P.nOrden, PEDIDOS_P.codigoCliente, PEDIDOS_P.fechaPedido, detallePEDIDOS_P.zona, 
						PEDIDOS_P.nombreC, PEDIDOS_P.estado, PEDIDOS_P.direccion, detallePEDIDOS_P.Factura_Ibes, PEDIDOS_P.facturar,PEDIDOS_P.formato,
						detallePEDIDOS_P.Pedido_Ibes
						FROM PEDIDOS_P inner join detallePEDIDOS_P
						on PEDIDOS_P.nORden = detallePEDIDOS_P.nOrden
						WHERE PEDIDOS_P.codigoCliente = '$_REQUEST[cliente]'") or
						die("Problemas en el select:".mysql_error());
						
if (mysql_num_rows($PEDIDOS_P) > 0){

	?>
   <table border = "3" align = "center">
	<tr style = "background: #A9D0F5;" >
		<th align="center">No.FV</th>
		<th align="center">No.Ibes</th>
		<th align="center">Factura</th>
		<th align="center">Codigo Cliente</th>
		<th align="center">Nombre Cliente</th>
		<th align="center">Zona</th>
		<th align="center">Fecha Despacho</th>
		<th align="center">Fecha Factura</th>
		<th align="center">Despacho</th>
		<th align="center"></th>
	
	</tr>	
	<?php
  while ($ped=mysql_fetch_array($PEDIDOS_P))
{  
		$comentarios = $ped['comentario1'] ." ".$ped['comentario2'];
				$despachos=mysql_query("SELECT DISTINCT max(DESPACHOS.guiaOrdenCargue) as despacho
						FROM DESPACHOS inner join detallePEDIDOS_P
						on DESPACHOS.pedidoNumero = detallePEDIDOS_P.Pedido_Ibes
						WHERE DESPACHOS.pedidoNumero = '$ped[Pedido_Ibes]'") or
						die("Problemas en el select:".mysql_error());
						
	
//		switch ($ped['estado']){
//		case '0' : $estado = "#FE642E"; break;
//		case '1' : $estado = "#FF0000"; break;
//		case '2' : $estado = "#F7FE2E";break;
//		case '3' : $estado = "#2EFE2E";break;
//		}

?>		
	<tr>
		<td align="center"><a href = "pedzon_cons.php?e=<?php echo $ped['nOrden']; ?>" data-rel = "dialog"><?php echo $ped['nOrden']; ?></a></td>
		<td align="center"><?php echo $ped['Pedido_Ibes'];?></td>
		<td align="center"><a href = "ped_detalle_factura.php?e=<?php echo $ped['Factura_Ibes']; ?>" data-rel = "dialog"><?php echo $ped['Factura_Ibes'];?></a></td>		
		<td align="center"><?php echo $ped['codigoCliente']; ?></td>
		<td align="center"><?php echo $ped['nombreC']; ?></td>
		<td align="center"><?php echo $ped['zona']; ?></td>
		<td align="center"><?php echo $ped['fechaPedido'];?></td>
		<td align="center"><?php echo $ped['facturar'];?></td>
	<!--	<td bgcolor = "<?php //echo $estado;?>"></td> -->
	<?php
		
			if ($ped['Pedido_Ibes'] == 0 or $ped['Factura_Ibes'] == 0){
			?><td align="center" border = "0">No</td>
			<?php } else { ?><td align="center"><a href = "detalledes2.php?e=<?php echo $ped['Pedido_Ibes']; ?>" data-rel = "dialog">Ver</a></td>
	    	    	
<?php
		}
		if ($ped['formato'] != ''){?>
		<TD><a href = "#" onclick="window.location.href='download_anexo.php?file=<?php echo $ped['nOrden'].".".$ped['formato']; ?>'"><img  SRC="imagenes\boton_descargar.png"></a></TD>
		<?php }
												
			
}
	}else{
	echo "<b>No se encontraron PEDIDOS_P</b>";
	}

?>					
</table>	<?php }
else if ($_REQUEST['fecha1'] != ''){

$fecha1= explode ("-",$_REQUEST['fecha1']);
$fecha2= explode ("-",$_REQUEST['fecha2']);
$fec1 = $fecha1[2]."/".$fecha1[1]."/".$fecha1[0];
$fec2 = $fecha2[2]."/".$fecha2[1]."/".$fecha2[0];
include ("../../fuerzaventas/conex.php" ); 
	$PEDIDOS_P=mysql_query("SELECT DISTINCT PEDIDOS_P.nOrden, PEDIDOS_P.codigoCliente, PEDIDOS_P.fechaPedido, detallePEDIDOS_P.zona,PEDIDOS_P.formato,
						PEDIDOS_P.ordenCliente, PEDIDOS_P.nombreC, PEDIDOS_P.comentario1, PEDIDOS_P.comentario2, PEDIDOS_P.estado, PEDIDOS_P.direccion,
						PEDIDOS_P.facturar, PEDIDOS_P.parciales, detallePEDIDOS_P.Pedido_Ibes, detallePEDIDOS_P.Factura_Ibes, detallePEDIDOS_P.fechaP
						FROM PEDIDOS_P inner join detallePEDIDOS_P
						on PEDIDOS_P.nORden = detallePEDIDOS_P.nOrden
						WHERE detallePEDIDOS_P.fechaP BETWEEN  '$fec1' AND  '$fec2'") or
						die("Problemas en el select:".mysql_error());
						
if (mysql_num_rows($PEDIDOS_P) > 0){

	?>
   <table border = "3" align = "center">
	<tr style = "background: #A9D0F5;" >
		<th align="center">No.FV</th>
		<th align="center">No.Ibes</th>
		<th align="center">Factura</th>
		<th align="center">Codigo Cliente</th>
		<th align="center">Nombre Cliente</th>
		<th align="center">Zona</th>
		<th align="center">Fecha Despacho</th>
		<th align="center">Fecha Factura</th>
		<th align="center">Despacho</th>
		<th align="center"></th>		
	</tr>	
	<?php
  while ($ped=mysql_fetch_array($PEDIDOS_P))
{  
		$comentarios = $ped['comentario1'] ." ".$ped['comentario2'];
		
					$despachos=mysql_query("SELECT DISTINCT max(DESPACHOS.guiaOrdenCargue) as despacho
						FROM DESPACHOS inner join detallePEDIDOS_P
						on DESPACHOS.pedidoNumero = detallePEDIDOS_P.Pedido_Ibes
						WHERE DESPACHOS.pedidoNumero = '$ped[Pedido_Ibes]'") or
						die("Problemas en el select:".mysql_error());
						

?>	
	<tr>
		<td align="center"><a href = "pedzon_cons.php?e=<?php echo $ped['nOrden']; ?>" data-rel = "dialog"><?php echo $ped['nOrden']; ?></a></td>
		<td align="center"><?php echo $ped['Pedido_Ibes'];?></td>
		<td align="center"><a href = "ped_detalle_factura.php?e=<?php echo $ped['Factura_Ibes']; ?>" data-rel = "dialog"><?php echo $ped['Factura_Ibes'];?></a></td>		
		<td align="center"><?php echo $ped['codigoCliente']; ?></td>
		<td align="center"><?php echo $ped['nombreC']; ?></td>
		<td align="center"><?php echo $ped['zona']; ?></td>
		<td align="center"><?php echo $ped['fechaP'];?></td>
		<td align="center"><?php echo $ped['facturar'];?></td>
		<?php if ($ped['Pedido_Ibes'] == 0 or $ped['Factura_Ibes'] == 0){
			?><td align="center" border = "0">No</td>
			<?php } else { ?><td align="center"><a href = "detalledes2.php?e=<?php echo $ped['Pedido_Ibes']; ?>" data-rel = "dialog">Ver</a></td>
	    		
	    	
<?php
							}

		if ($ped['formato'] != ''){?>
		<TD><a href = "#" onclick="window.location.href='download_anexo.php?file=<?php echo $ped['nOrden'].".".$ped['formato']; ?>'"><img  SRC="imagenes\boton_descargar.png"></a></TD>
		<?php }												
		
}		

	}else{
	echo "<b>No se encontraron PEDIDOS_P</b>";
	}

?>					
</table>	<?php } ?>		
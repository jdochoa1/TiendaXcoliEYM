<?php
	include('../../fuerzaventas/sesion.php');
	include('../../fuerzaventas/conex.php');
	$_SESSION['codigoC'] = $_GET['codT'];
	$_SESSION['name'] = $_GET['name'];
	$_SESSION['v'] = '';
	
	$sql_cartera = mysql_query("SELECT diaretraso FROM NOTAS WHERE (diaretraso > 0 AND CODIGO = '".$_SESSION['codigoC']."')");
	if(mysql_num_rows($sql_cartera) ==0){
		?><meta HTTP-EQUIV="Refresh" CONTENT="0;url = calzado.php"><?
	}else{
	
	
	$sql = mysql_query("SELECT * FROM VENCIMIENTOS WHERE codigo = '".$_SESSION['codigoC']."'") or die (mysql_error());
	$nr = mysql_num_rows($sql);

$act = mysql_query("SELECT fecha, hora FROM actualizaciones WHERE numeroTabla = '7'");
$act = mysql_fetch_array($act);
$fecha = $act[0];
$hora = $act[1];	
$compromiso = 0;
$valpend = mysql_query("Select cupo, bloqueo FROM CLIENTES WHERE codigoC = '".$_SESSION['codigoC']."'");
$row_valpend = mysql_fetch_array($valpend); 
$bvp = $row_valpend[0];$bvp1 = $row_valpend[1];$suma = 0;

?>

<!DOCTYPE html> 
<html lang="es">
<head>
<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
<title>Cartera</title>
<link href="../../fuerzaventas/jquery-mobile/jquery.mobile-1.0.min.css" rel="stylesheet" type="text/css"/>
<script src="../../fuerzaventas/jquery-mobile/jquery-1.6.4.min.js" type="text/javascript"></script>
<script src="../../fuerzaventas/jquery-mobile/jquery.mobile-1.0.min.js" type="text/javascript"></script>
<script>
$(document).ready(function(){
$.mobile.pageLoadErrorMessage = 'No se encuentra la pagina, por favor comuniquelo a E&M';
$.mobile.fixedToolbars.show(true);
//$.mobile.defaultDialogTransition='slideup';
$("#mostrar").click(function(e){
    $.mobile.loadingMessage = "Por favor espere...";
$.mobile.showPageLoadingMsg('');
});

$("#ocultar").click(function(e){
$.mobile.hidePageLoadingMsg();
});
});
</script>
</head> 
<body> 

<div data-role="page" id="page">
	<div data-role="header">
		<h1>EXTRACTO</h1>
		<a href="../lista.php" data-icon="home" data-iconpos="notext" class="ui-btn-right"></a>
		<a href="javascript:window.history.back();" data-icon="arrow-l" data-iconpos="notext" class="ui-btn-left"></a>
	</div>
	<div data-role="content" align="center">
	<div class="ui-block-a"><div class="ui-bar ui-bar-c">
     <? echo $_SESSION['codigoC']."  ".$name ?><? echo " - actualizado: ".$fecha." ".$hora.""; ?></div></div><br><br><br><br>
	<?php
		if($nr > 0){
		while( $fila = mysql_fetch_array($sql) )
		{
        ?>
		<div class="ui-grid-a">
	<div class="ui-block-a"><div class="ui-bar ui-bar-b" style="height:30px"><a href = "detallecliente.php?codT=<?php echo $_SESSION['codigoC']; ?>&name=<?php echo $name; ?>&v=c">Corriente</a></div></div>
	<div class="ui-block-b"><div class="ui-bar ui-bar-c" style="height:30px">$<?php echo number_format($fila['corriente']); ?></div></div>
    <div class="ui-block-a"><div class="ui-bar ui-bar-b" style="height:30px"><a href = "detallecliente.php?codT=<?php echo $_SESSION['codigoC']; ?>&name=<?php echo $name; ?>&v=m">1-30 dias</a></div></div>
	<div class="ui-block-b"><div class="ui-bar ui-bar-c" style="height:30px">$<?php echo number_format($fila['mes']); ?></div></div>
    <div class="ui-block-a"><div class="ui-bar ui-bar-b" style="height:30px"><a href = "detallecliente.php?codT=<?php echo $_SESSION['codigoC']; ?>&name=<?php echo $name; ?>&v=b">31-60 dias</a></div></div>
    <div class="ui-block-b"><div class="ui-bar ui-bar-c" style="height:30px">$<?php echo number_format($fila['dosmeses']); ?></div></div>
	<div class="ui-block-a"><div class="ui-bar ui-bar-b" style="height:30px"><a href = "detallecliente.php?codT=<?php echo $_SESSION['codigoC']; ?>&name=<?php echo $name; ?>&v=t">61-90 dias</a></div></div>
    <div class="ui-block-b"><div class="ui-bar ui-bar-c" style="height:30px">$<?php echo number_format($fila['tresmeses']); ?></div></div>
	<div class="ui-block-a"><div class="ui-bar ui-bar-b" style="height:30px"><a href = "detallecliente.php?codT=<?php echo $_SESSION['codigoC']; ?>&name=<?php echo $name; ?>&v=4">mas de 90</a></div></div>
	<div class="ui-block-b"><div class="ui-bar ui-bar-c" style="height:30px">$<?php echo number_format($fila['mas90dias']); ?></div></div>
    <div class="ui-block-a"><div class="ui-bar ui-bar-b" style="height:30px;font-size:12px">TOTAL CARTERA</div></div>
	<div class="ui-block-b"><div class="ui-bar ui-bar-c" style="height:30px">$<?php echo number_format($fila['valorpendiente']); ?></div></div>
	 <? $suma = $fila['mes'] + $fila['dosmeses'] + $fila['tresmeses'] + $fila['mas90dias'];
	 if($bvp1 == 'Y'){?>
	<div class="ui-block-a"><div class="ui-bar ui-bar-b" style="height:30px">Bloqueado por sistema</div></div>
	<div class="ui-block-b"><div class="ui-bar ui-bar-c" style="height:30px;background:#CCCCCC" ><?php echo $bvp1; ?></div></div>
	<? } ?>
	<? if($suma > $bvp){$bvpT = $suma - $bvp;?>
	<div class="ui-block-a"><div class="ui-bar ui-bar-b" style="height:30px">Bloqueado por exceder cupo</div></div>
	<div class="ui-block-b"><div class="ui-bar ui-bar-c" style="height:30px;background:#CCCCCC" >$<?php echo $bvpT."-".number_format($suma); ?></div></div>
	<? } ?>
	<? if($fila['mes'] > 0 || $fila['dosmeses'] > 0 || $fila['tresmeses'] > 0 || $fila['mas90dias'] > 0){$compromiso = 1;?>	
	<div class="ui-block-a"><div class="ui-bar ui-bar-b" style="height:30px">Bloqueado por mora</div></div>
	<div class="ui-block-b"><div class="ui-bar ui-bar-c" style="height:30px;background:#CCCCCC" >$<?php echo number_format($suma); ?></div></div>
	<? } ?>
</div>

        <?php 
		} }else{ ?>
		<div class="ui-grid-a">		
			<div class="ui-block-a"><div class="ui-bar ui-bar-b" style="height:30px;font-size:12px">TOTAL A DEBER</div></div>
			<div class="ui-block-b"><div class="ui-bar ui-bar-c" style="height:30px">$ 0</div></div>
		</div>
		<? }
		if($bvp1 == 'Y' || $suma > $bvp || $compromiso = 1){?>
		<br><br><div class="ui-block-c"><div class="ui-bar ui-bar-c">
			Actualmente se encuentra bloqueado, para continuar indiquenos un 
			<a href="dialogo1.php?codT=<? echo $_SESSION['codigoC'];?>&name=<? echo $_SESSION['name'];?>" data-role="button" data-rel="dialog">Compromiso de pago</a>Gracias.
		</div></div>
				
		<? }else{ ?>
			<div class="ui-grid-a">		
			<div class="ui-block-a"><div class="ui-bar ui-bar-b" style="height:30px;font-size:12px">
				No presenta cartera vencida. Continuemos. 
			</div></div>
		</div>	
	<? }?>
	</div>
	<div data-role="footer">
		<h4>www.eym.com.co</h4>
	</div>
</div>

</body>
</html>
<? }?>
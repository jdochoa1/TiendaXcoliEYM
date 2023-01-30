<? include ('sesion.php');
include 'conex.php';
$s = $_GET['s'];//sesion tipo usuario 4
if($s != ''){
	$_SESSION["s_zona"] = $s;
	if($_SESSION["s_zona"][0]=='C'){$_SESSION["s_dpto"]='02';}else{if($_SESSION["s_zona"][0]=='D'){$_SESSION["s_dpto"]='01';}else{$_SESSION["s_dpto"]='11';}}
	$query = mysql_query("SELECT * FROM ZONA WHERE codZona = '".$_SESSION["s_zona"]."' ") or die (mysql_error());
	$row = mysql_fetch_array($query);
	$myIdT = $row[0];
	$name = $row[1];
	echo $row[0]." ".$row[1];
	$_SESSION["s_nombreUsuario"] = $row[1]; }

?>
<!DOCTYPE html> 
<html>
<head>
<meta charset="iso-8859-1" name="viewport" content="width=device-width, initial-scale=1">
<title>FUERZA DE VENTAS EYM | MOVIL</title>
<link href="jquery-mobile/jquery.mobile-1.0.min.css" rel="stylesheet" type="text/css"/>
<script src="jquery-mobile/jquery-1.6.4.min.js" type="text/javascript"></script>
<script src="jquery-mobile/jquery.mobile-1.0.min.js" type="text/javascript"></script>
</head> 
<body> 
<div data-role="collapsible-set" data-inset="true">
	<div data-role="header">
		<h1>Menu Principal</h1>
		<a href="chat/index.html" data-role="button" data-shadow="false" data-icon="info" data-inline="true" class="ui-btn-left" target = "_blank">soporte</a>
		<a href="Csesion.php" data-role="button" data-shadow="false" data-icon="delete" data-inline="true" class="ui-btn-right">Sesion</a>
		<? if($_SESSION["s_tipoUsuario"]==5 || $_SESSION["s_tipoUsuario"][0]=='L'||$_SESSION["s_tipoUsuario"]==1){ 
			echo $_SESSION["s_zona"];
			echo $_SESSION["s_nombreUsuario"];
			?>
			<nav data-role="navbar">
				<ul>
					<li><a href = "zonas.php?z=d" data-rel = "dialog">Deportiva</a></li>
					<li><a href = "zonas.php?z=C" data-rel = "dialog">Insumos</a></li>
					<li><a href = "zonas.php?z=G" data-rel = "dialog">Tecnicos</a></li>
					<li><a href = "zonas.php?z=L" data-rel = "dialog">Licitaciones</a></li>
				</ul>
			</nav>
		<? } ?>
		</div>
	<? if($_SESSION["s_tipoUsuario"]!=1){?>
	<div data-role="collapsible" data-collapsed="true" data-theme="b" data-inset="true">               
        <h3>Productos</h3>               
		<ul data-role="listview" data-theme="c" data-inset="true">       
	<? if($_SESSION["s_dpto"] == '01'){?>
            <li><a href="productosc.php?v=TA" data-ajax="false">Inventario TA<p>Obtenga informacion detallada de cada producto.</p></a></li>
			<li><a href="productosc.php?v=TI" data-ajax="false">Almacenaje externo TI<p>Productos con inventario.</p></a></li>			
			<li><a href="productosc.php?v=TN" data-ajax="false">Almacenaje externo TN<p>Productos con inventario.</p></a></li>
			<!--li><a href="productosc.php?v=TX" data-ajax="false">Ofertas y promociones<p>Encuentre las mejores promociones. <br>Productos en liquidacion.</p></a></li>			
			<li><a href="productosc.php?v=TV" data-ajax="false">Colecciones anteriores<p>Productos con descuentos.</p></a></li-->
			<li><a href="catalogo.php" data-ajax="false">Catalogo de productos</a></li>
	<? }else { if($_SESSION["s_dpto"] == '02') { ?> 
			<li><a href="productosc.php?v=TA" data-ajax="false">Inventario<p>Obtenga informacion detallada de cada producto.</p></a></li>
			<li><a href="productosc.php?v=s" data-ajax="false">Segundas<p>Obtenga informacion detallada de cada producto.</p></a></li>
			<li><a href="productosc.php?v=TCA" data-ajax="false">Reservados<p>Inventario productos - bodega TCA.</p></a></li>
			<li><a href="productosc.php?v=TO" data-ajax="false">Cueros y diseños<p>bodega - TO.</p></a></li>
			<li><a href="productosc.php?v=TFS" data-ajax="false">Ind. Nortecaucanas<p>bodega TFS.</p></a></li>
			<li><a href="productosc.php?v=TFT" data-ajax="false">Espumas plasticas<p>bodega TFT.</p></a></li>
		<?}else { ?>
			<li><a href="productosc.php?v=TA" data-ajax="false">Inventario<p>Obtenga informacion detallada de cada producto.</p></a></li>
			<li><a href="productosc.php?v=TF" data-ajax="false">Productos en consignacion<p> Inventario - bodegas en consignacion.</p></a></li>						
			<li><a href="productosc.php?v=s" data-ajax="false">Segundas<p>Obtenga informacion detallada de cada producto.</p></a></li>
		<? }} ?>
        </ul> 			
	</div>
	<? }?>
	<? if(strlen($_SESSION['s_zona'] ) > 1){?>
	<? if($_SESSION["s_tipoUsuario"]!='L'){?>
	<div data-role="collapsible" data-collapsed="true" data-theme="b" data-inset="true">               
        <h3>Documentacion</h3>               
			<ul data-role="listview" data-theme="c" data-inset="true" data-corners="false">                       
				<li><a href="clientes.php?v=i" data-ajax="false">Informacion basica cliente<p>Datos personales y de contacto para determinado cliente.</p></a></li>
				<li><a href="clientes.php?v=e" data-ajax="false">Extracto cliente<p>Consolidado de cartera para determinado cliente.</p></a></li>
				<li><a href="clientes.php?v=n" data-ajax="false">Notas credito aplicadas<p>Historico 12 meses.</p></a></li>			
				<li><a href="clientes.php?v=r" data-ajax="false">Recibos de caja aplicados<p>Historico 12 meses.</p></a></li>			
				<li><a href="consolidadozona.php" data-ajax="false">Extracto zona<p>Consolidado de cartera para su zona.</p></a></li>	
	<? if($_SESSION["s_tipoUsuario"]==1){?>
				<li data-theme = 'e'><a href="clientes-crea.php?u=c" data-ajax="false">Creación de clientes<p>Lista de clientes por aprobar.</p></a></li>				
	<? }?>	
			</ul>
    </div>
	<? } ?>
	<? if($_SESSION["s_tipoUsuario"]!=1){?>
	<div data-role="collapsible" data-collapsed="true" data-theme="b">               
        <h3>Servicio al cliente</h3>               
		<ul data-role="listview" data-theme="c" data-inset="true">                       
            
				<div data-role="collapsible" data-collapsed="true" data-theme="b" data-inset="true">               
					<h3>Despachos</h3>               
					<ul data-role="listview" data-theme="c" data-inset="true">   	
						<li><a href="desline.php" data-ajax="false">Despachos con facturas.<p></p></a></li>
						<li><a href="remision.php" data-ajax="false">Despachos por remisiones.<p></p></a></li>
						<li><a href="clientes.php?v=d" data-ajax="false">Despachos por cliente<p>Consulta general de los despachos detallado por cliente.</p></a></li>
					</ul>
				</div>
				<div data-role="collapsible" data-collapsed="true" data-theme="b" data-inset="true">               
					<h3>Back-Order</h3>               
					<ul data-role="listview" data-theme="c" data-inset="true">   	
						<li data-theme = "e"><a href="backordercod.php" target = "_blank" data-ajax="false">Back-Order Consolidado<p>Generar reporte.</p></a></li>
						<li><a href="clientes.php?v=b" data-ajax="false">Back-Order por cliente<p>Consulta general de backorder detallado por cliente.</p></a></li>
					</ul>
				</div>
				<div data-role="collapsible" data-collapsed="true" data-theme="b" data-inset="true">               
					<h3>E&M Efectivo</h3>               
					<ul data-role="listview" data-theme="c" data-inset="true">   	
						<li><a href="devoluciones.php" data-ajax="false" target = "blank_">E&M Consolidado<p>Generar reporte</p></a></li>
					</ul>
				</div>
			</ul>
    </div>
	<div data-role="collapsible" data-collapsed="true" data-theme="b" data-inset="true">               
        <h3>Formularios</h3> 
	<ul data-role="listview" data-theme="c" data-inset="true">                       
            <li><a href="clientes.php?v=f1" data-ajax="false">Formato E&M efectivo<p>Programa de satisfaccion total</p></a></li>
			<!--li data-theme = 'e'><a href="crea_cl.php" data-ajax="false">Formulario creación clientes.</a></li-->
	</ul>
	</div>
	
<? if($_SESSION["s_dpto"] == '02'||$_SESSION["s_dpto"] == '11'||$_SESSION["s_dpto"] == '01'){ ?>
	<div data-role="collapsible" data-collapsed="true" data-theme="e" data-inset="true">               
        <h3>Pedidos</h3> 
	<ul data-role="listview" data-theme="c" data-inset="true">   
	<? if($_SESSION["s_dpto"] == '902'){ ?>
        <li><a href="clientesc.php?v=tp" data-ajax="false">Realizar Pedido</p></a></li>
	<? }else{ if($_SESSION["s_dpto"] == '11'){?>
		<li><a href="clientesc.php?v=tpt" data-ajax="false">Realizar Pedido</p></a></li>	
	<? }else{ if($_SESSION["s_dpto"] == '01'){?>
		<li><a href="clientesc.php?v=tpd" data-ajax="false">Realizar Pedido</p></a></li>	
	<? }}}?>
	<li><a href="insumos/pedidos_asesor.php" data-ajax="false">Consultar Pedidos</p></a></li>		
	</ul>
	</div>
	<? }?>
	<ul data-role="listview" data-theme="b" >                       
            <li><a href="grafica.php?n=1" data-ajax="false">Presupuesto<p>Ejecucion de presupuesto diario, <br> detallado por mes o el consolidado 2013</p></a></li>				
    </ul>
	
	<?} }else{//DR. ?>
	<? if($_SESSION["s_tipoUsuario"][0]!='L'||$_SESSION["s_tipoUsuario"][0]!=1){?>
	<div data-role="collapsible" data-collapsed="true" data-theme="b" data-inset="true">               
        <h3>Documentacion</h3>               
			<ul data-role="listview" data-theme="c" data-inset="true" data-corners="false">                       
				<li><a href="clientes.php?v=i" data-ajax="false">Informacion basica cliente<p>Datos personales y de contacto para determinado cliente.</p></a></li>
				<li><a href="clientesc.php?v=e" data-ajax="false">Extracto cliente<p>Consolidado de cartera para determinado cliente.</p></a></li>
				<li><a href="clientesc.php?v=n" data-ajax="false">Notas credito aplicadas<p>Historico 12 meses</p></a></li>			
				<li><a href="clientesc.php?v=r" data-ajax="false">Recibos de caja aplicados<p>Historico 12 meses.</p></a></li>				
			</ul>
    </div>
	<? } ?>
	<? if($_SESSION["s_tipoUsuario"]!=1){?>
	 <div data-role="collapsible" data-collapsed="true" data-theme="b" data-inset="true">               
        <h3>Seguimiento</h3>               
		<ul data-role="listview" data-theme="c" data-inset="true">                       
       		<li><a href="consolidadoline.php" data-ajax="false">Extracto linea de negocio<p>Consolidado de cartera por linea.</p></a></li>	
			<li><a href="asesores.php?v=ea" data-ajax="false">Extracto Asesor<p>Consolidado de cartera para determinado asesor.</p></a></li>		
			<li><a href="backline.php" data-ajax="false">Back-order de linea<p>Consolidado del back-order por linea.</p></a></li>	
			<li><a href="devline.php" data-ajax="false">Devoluciones de linea<p>Consolidado de las devoluciones por linea.</p></a></li>
			<li><a href="desline.php" data-ajax="false">Despachos de linea<p>Consolidado de los despachos por linea.</p></a></li>
			<li><a href="logUsuarios.php" data-ajax="false">Frecuencia de visitas<p>Fecha y hora del ultimo ingreso al sistema.</p></a></li>			
		</ul>
    </div>
	<div data-role="collapsible" data-collapsed="true" data-theme="b" data-inset="true">               
        <h3>Presupuesto</h3> 
	<ul data-role="listview" data-theme="c" data-inset="true">  
		<? if($_SESSION["s_nombreUsuario"]=='carlos.martinez'){?>
			<li><a href="asesores.php?v=g" data-ajax="false">Presupuesto por zona<p>Ejecucion de presupuesto diario <br> detallado por mes o el consolidado anual</p></a></li>				
		<? }else{ ?>
            <li><a href="grafica.php?n=1" data-ajax="false">Presupuesto de Linea<p>Ejecucion de presupuesto diario <br> detallado por mes o el consolidado anual</p></a></li>
			<li><a href="asesores.php?v=g" data-ajax="false">Presupuesto por zona<p>Ejecucion de presupuesto diario <br> detallado por mes o el consolidado anual</p></a></li>				
		<? }?>	
	</ul>
	</div>
	<? if($_SESSION["s_dpto"] == '02'||$_SESSION["s_dpto"] == '11'||$_SESSION["s_dpto"] == '01'){ ?>
	<div data-role="collapsible" data-collapsed="true" data-theme="e" data-inset="true">               
        <h3>Pedidos</h3> 
	<ul data-role="listview" data-theme="c" data-inset="true">   
	<? if($_SESSION["s_dpto"] == '902'){ ?>
        <li><a href="clientesc.php?v=tp" data-ajax="false">Realizar Pedido</p></a></li>
	<? }else{ if($_SESSION["s_dpto"] == '11'){?>
		<li><a href="clientesc.php?v=tpt" data-ajax="false">Realizar Pedido</p></a></li>	
	<? }else{ if($_SESSION["s_dpto"] == '01'){?>
		<li><a href="clientesc.php?v=tpd" data-ajax="false">Realizar Pedido</p></a></li>	
	<? }}}?>
	<li><a href="insumos/pedidos_asesor.php" data-ajax="false">Consultar Pedidos</p></a></li>		
	</ul>
	</div>
	<? }?>
	<div data-role="collapsible" data-collapsed="true" data-theme="b" data-inset="true">               
        <h3>Formularios</h3> 
	<ul data-role="listview" data-theme="c" data-inset="true">                       
            <li><a href="clientesc.php?v=y" data-ajax="false">Formato E&M efectivo<p>Programa de satisfaccion total</p></a></li>
	</ul>
	</div>
	
	<? }} ?>
	<? if($_SESSION["s_tipoUsuario"]==5||$_SESSION["s_tipoUsuario"][0]=='L'||$_SESSION["s_tipoUsuario"][0]==1){ ?>
	<div data-role="collapsible" data-collapsed="true" data-theme="b" data-inset="true">               
        <h3>Cargar archivos</h3> 
		<iframe src="upload.php" width="50%" height = "200px" frameborder="0" scrolling="no">
		</iframe>
	</div>
	<? } ?>
	<? if($_SESSION["s_tipoUsuario"]==5){ ?>
	<div data-role="collapsible" data-collapsed="true" data-theme="b" data-inset="true">               
        <h3> Modulo Devoluciones</h3> 
		<ul data-role="listview" data-theme="c" data-inset="true">                       
            <li><a href="dev-cal.php" data-ajax="false">Prediagnosticos<p></p></a></li>
		</ul>
	</div>
	<? }else{if($_SESSION["s_tipoUsuario"]=='Ld'){ ?>
		<ul data-role="listview" data-theme="b" data-inset="true">                       
            <li><a href="detalledev.php" target = "_blank" data-ajax="false">Devoluciones<p></p></a></li>
			<li><a href="insumos/pedido_zona.php" target = "_blank" data-ajax="false">Pedidos<p></p></a></li>
		</ul>
	<? }else{if($_SESSION["s_tipoUsuario"]==1){ ?>
		<ul data-role="listview" data-theme="b" >                       
            <li><a href="devecon.php" target = "_blank" data-ajax="false">Devoluciones<p></p></a></li>
		</ul>
	<? }}} ?>
	<div data-role="footer" data-position = "fixed">
		<h4>www.eym.com.co</h4>
	</div>
	</div>
</div>
</body>
</html>
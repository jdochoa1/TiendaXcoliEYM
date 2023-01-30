<? if($_GET['l'] == 1){
	?><meta HTTP-EQUIV="Refresh" CONTENT="10;url = calculadora.php"><?
} ?>
<!DOCTYPE html>
<html lang = "es">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title> E&M EFECTIVO|E&M </title>
<link href="../../fuerzaventas/jquery-mobile/jquery.mobile-1.0.min.css" rel="stylesheet" type="text/css"/>
<script src="../../fuerzaventas/jquery-mobile/jquery-1.6.4.min.js" type="text/javascript"></script>
<script src="../../fuerzaventas/jquery-mobile/jquery.mobile-1.0.min.js" type="text/javascript"></script>
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<style>


#calculadora tr td
{
padding: 15px;
border: 1px solid #000000;
font-family: trebuchet, verdana, arial;
color: #000000;
background: #FFFFFF;
font-size: 18px;
}

#calculadora tr td:hover{
color: #FFFFFF;
background: #000000;
cursor: pointer;
}

#resultado_calculadora{
font-family: trebuchet, verdana, arial;
font-weight: bold;
}


.no-style
{
background: #FFFFFF;
border: 0;
}
.no-style:hover
{
background: #FFFFFF;
border: 0;
}
</style>

<script>
$(function(){

$("#calculadora tr td").click(function(){
if ($(this).text() != "C" && $(this).text() != "=")
{
$("#resultado_calculadora").append($(this).text());
}
if ($(this).text() == "=")
{
operacion = $("#resultado_calculadora").text().split("");
total = "";
for ( var index in operacion)
{
total = total + operacion[index];

}
$("#resultado_calculadora").text(eval(total));
}
if($(this).text() == "C")
{
$("#resultado_calculadora").text("");
}
});
});

</script>

<head>

<body>
<div data-role="page" id="page" data-theme = "b">
	<div data-role="header" data-id = "fijo">
		<h1>Pedido</h1>
		<a href="Csesion.php" data-role="button" data-shadow="false" data-icon="delete" data-inline="true" class="ui-btn-right">Sesion</a>
		<a href="javascript:window.history.back();" data-icon="arrow-l" data-iconpos="notext" class="ui-btn-left"></a>
		<nav data-role="navbar">
			<ul>
				<li><a href = "#" data-transition = "slide">Catalogo</a></li>
				<li><a href = "#" data-transition = "slide">Calculadora</a></li>
				<li><a href = "calzado.php" data-transition = "slide">Pedido</a></li>
				<li><a href = "#" data-transition = "slide"> Total: $<? echo number_format($_SESSION['TOTAL'],2); ?></a></li>
			</ul>
		</nav>
	</div>
<div data-role="content" align="center">

<div>
<center>
<div id="resultado_calculadora"></div>

<table id="calculadora">
<tr>
<td>7</td><td>8</td><td>9</td><td>/</td>
</tr>
<tr>
<td>4</td><td>5</td><td>6</td><td>*</td>
</tr>
<tr>
<td>1</td><td>2</td><td>3</td><td>-</td>
</tr>
<tr>
<td>0</td><td>C</td><td>.</td><td>+</td>
<tr>
<td></td><td></td><td></td><td>=</td>
</tr>
</tr>
</table>
</center>
</div>

</div>
<div data-role="footer" data-position = "fixed">
		<h4>www.eym.com.co</h4>
	</div>
</div>
</body>

</html>
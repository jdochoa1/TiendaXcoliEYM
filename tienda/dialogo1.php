<? 
session_start();
?>
<!DOCTYPE html> 
<html>
<head>
<meta charset="utf-8" name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1" />
<title>COMPROMISO DE PAGO | EYM</title>
<link href="jquery-mobile/jquery.mobile-1.0.min.css" rel="stylesheet" type="text/css"/>
<script src="jquery-mobile/jquery-1.6.4.min.js" type="text/javascript"></script>
<script src="jquery-mobile/jquery.mobile-1.0.min.js" type="text/javascript"></script>
</head> 
<body> 
<div data-role="page" id="dialogo" >
	<div data-role="header" data-position="fixed">
		<p align = 'center'>Compromiso de pago</p>
	</div>
	<div data-role="content">
		<form action = 'calzado.php' method = 'POST'>
			<input name = 'v' id = 'v' type = 'text' required value = "" placeholder = 'compromiso de pago...' />
			<input name = 'l' id = 'l' type = 'hidden' value = "1"/>
			<input name = 'codT' id = 'codT' type = 'hidden' value = "<? echo $_SESSION['codigoC'];?>"/>
			<input name = 'name' id = 'name' type = 'hidden' value = "<? echo $_GET['name'];?>"/>
			<button type="submit">Continuar</button>
		</form>
	</div>
	<div data-role="footer">
		<h4>www.eym.com.co</h4>
	</div>
</div>
</body>
</html>
<?php
session_start();

$vector = $_SESSION['vector'];
$vector_nom = $_SESSION['vector_nom'];
$vector_cant = $_SESSION['vector_cant'];
$vector_pre = $_SESSION['vector_pre'];
$vector_bod = $_SESSION['vector_bod'];
$vector_concatena = $_SESSION['vector_concatena'];
$vector_prom = $_SESSION['vector_prom'];
$vector_tot = $_SESSION['vector_tot'];
$vector_borrar = $_SESSION['vector_borrar'];

unset($vector[$_GET['i']]);
unset($vector_nom[$_GET['i']]);
unset($vector_cant[$_GET['i']]);
unset($vector_pre[$_GET['i']]);
unset($vector_bod[$_GET['i']]);
unset($vector_concatena[$_GET['i']]);
unset($vector_tot[$_GET['i']]);
unset($vector_borrar[$_GET['i']]);

$_SESSION['vector']=$vector; 
$_SESSION['vector_nom']=$vector_nom; 
$_SESSION['vector_cant']=$vector_cant;
$_SESSION['vector_pre']=$vector_pre;
$_SESSION['vector_bod']=$vector_bod;
$_SESSION['vector_concatena']=$vector_concatena;
$_SESSION['vector_tot']=$vector_tot; 
$_SESSION['vector_borrar']=$vector_borrar;

//la función unset borra el elemento de un array que le pasemos por parámetro. En este
//caso la usamos para borrar el elemento cuyo id le pasemos a la página por la url 
//$_SESSION['carro']=$carro;
//Finalmente, actualizamos la sessión, como hicimos cuando agregamos un producto y volvemos al catálogo
header("Location:calzado.php");
?>
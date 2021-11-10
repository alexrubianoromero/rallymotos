<?php
session_start();
//echo 'id_empresa '.$_SESSION['id_empresa'];
?>
<!DOCTYPE html>
<html lang="es"  class"no-js">
<head>
	<meta charset="UTF-8">
	<title>Muestre Ordenes</title>
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>
<? 
include("../empresa.php"); 
include('../valotablapc.php');
include('../funciones.php');
$sql_muestre_ordenes = "select id as No_Orden,
fecha,
placa,
id,
orden,
kilometraje,
estado
 from $tabla14  where id_empresa = '".$_SESSION['id_empresa']."' and tipo_orden < '2' and anulado = '0'  order by id desc";

$consulta_ordenes = mysql_query($sql_muestre_ordenes,$conexion);

?>
<Div id="contenidos">
		<header>
			<h2>CONSULTA ORDENES </h2>
		</header>
	
<?php
include('../colocar_links2.php');
echo '<table border= "1">';
	echo '<tr>';
	echo '<td><h3>No Orden<h3></td><td><h3>Fecha</h3></td><td><h3>Placa</h3></td><td><h3>Kilometraje</h3></td><td><h3>Estado</h3></td>
	<td><h3>Modificar</h3></td>
	<td><h3>Ficha Tecnica </h3></td><td><h3>Vista Impresion</h3></td>';
	
	
	if($_SESSION['id_empresa'] == '16' )
	
	     {echo '<td><h3>Vista Impresion</h3></td>'; }
		 
	if($_SESSION['id_empresa'] == '40' )
	
	     {echo '<td><h3>Vista Impresion Honda</h3></td>'; }
	
	echo '<tr>';
		while($ordenes = mysql_fetch_array($consulta_ordenes))
			{
				echo '<tr>';
				echo '<td><h3>'.$ordenes['4'].'</h3></td><td><h3>'.$ordenes['1'].'</h3></td><td><h3>'.$ordenes['2'].'</h3></td><td><h3>'.$ordenes['5'].'</h3></td>';
				
				if ($ordenes['6'] == 0)
				{
					$estado = 'En proceso';
				}
				else
				{
				   $estado = 'Finalizada';
				}
				echo '<td><h3>'.$estado.'</h3></td>';
				echo  '<td><h3>';
				echo '<a href="orden_modificar.php?idorden='.$ordenes['0'].'">Modificar</a>';
				echo '</h3></td>';
				
			
				
				echo  '<td><h3>';
				echo '<a href="orden_detallado_ficha.php?idorden='.$ordenes['0'].'"  target = "_blank">Ficha_Detalle</a>';
				echo '</h3></td>'; 
				echo  '<td><h3>';
				echo '<a href="orden_imprimir.php?idorden='.$ordenes['0'].'"  target = "_blank">Imprimir_Orden</a>';
				echo '</h3></td>'; 
				if($_SESSION['id_empresa'] == '16' )
				{						
					echo  '<td><h3>';
					echo '<a href="orden_imprimir_eurotec.php?idorden='.$ordenes['0'].'"  target = "_blank">Imprimir_Orden</a>';
					echo '</h3></td>'; 
				}
			
				echo '<tr>';
			}
echo '<table border= "1">';

?>
	</Div>
</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   

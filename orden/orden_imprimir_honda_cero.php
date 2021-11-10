<?php
session_start();
include('../valotablapc.php');
include('../funciones.php');
$ancho_tabla = '95%';

$sql_placas = "select cli.nombre as nombrecli,cli.identi,cli.direccion,cli.telefono,car.placa,car.marca,car.modelo,car.color,car.tipo,car.chasis,
 o.fecha,o.observaciones,o.radio,o.antena,o.repuesto,o.herramienta,o.otros,o.iva as iva ,o.orden,o.kilometraje,o.mecanico,o.id,
 e.identi,e.telefonos as telefonos_empresa ,e.direccion as direccion_empresa,o.kilometraje_cambio,e.tipo_taller,cli.email,e.condiciones_orden,
 o.fecha_entrega, o.fecha_salida , e.email_empresa,e.razon_social
from $tabla4 as car
inner join $tabla3 as cli on (cli.idcliente = car.propietario)
inner join $tabla14 as o  on (o.placa = car.placa)
inner join $tabla10 as e on  (e.id_empresa = o.id_empresa) 
 where o.id = '".$_REQUEST['idorden']."'   and   o.id_empresa = '".$_SESSION['id_empresa']."'   ";
 //echo '<br>'.$sql_placas.'<br>';
$datos = mysql_query($sql_placas,$conexion);
$filas = mysql_num_rows($datos); 
$datos_orden = mysql_fetch_assoc($datos);
/*
echo '<pre>';
print_r($datos_orden);
echo '</pre>';
*/

if($datos_orden['mecanico']== '')
	{
		$nombre_mecanico = 'MECANICO NO ASIGNADO';
	}
else {
        $sql_nombre_mecanico = "select * from $tabla21 where idcliente = '".$datos_orden['mecanico']."'";
		$consulta_mecanico = mysql_query($sql_nombre_mecanico,$conexion);
		$filas_mecanico = mysql_num_rows($consulta_mecanico);
					if($filas_mecanico > 0)
						{
							$datos_mecanico = mysql_fetch_assoc($consulta_mecanico);
							$nombre_mecanico = $datos_mecanico['nombre'];
						}
					else {  $nombre_mecanico = 'NO_REGISTRADO';}	
	}
?>
<!DOCTYPE html>
<html lang="es"  class"no-js">
<head>
	<!--<meta charset="UTF-8">-->
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	<title>Document</title>
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../css/style.css">
    <style type="text/css">
<!--

#Layer3 {
	position:relative;
	width:95%;
	height:89px;
	z-index:2;
}

-->
    </style>
</head>
<body>
<div = "contenidos">

<table width="<?php echo $ancho_tabla; ?>" border="0">
  <tr>
    <td width="40%" align = "center"><?php 
		echo $datos_orden['razon_social'].'<BR>NIT. '.$datos_orden['identi'];	 
  	?></td>
    <td width="4%"><img src="../imagenes/honda_orden/logo_honda.jpg" width="47" height="46"></td>
    <td width="11%"><img src="../imagenes/honda_orden/yamaha.jpg" width="95" height="16"></td>
    <td width="9%"><img src="../imagenes/honda_orden/zuzuki_logo.jpg" width="82" height="32"></td>
    <td width="35%" align="center"><?php  echo ' <h15>ORDEN DE ENTRADA<BR> 

CENTRO DE SERVICIO AUTORIZADO  HONDA</h15>'
?></td>
    <td width="3%" align="left"><h5>OT_</h5></td>
    <td width="10%" align="right"><h5><?php echo $datos_orden['orden']  ?></h5></td>
  </tr>
  </table>


<br>

<h80>
<table width="<?php echo $ancho_tabla; ?>" border="1">
  <tr>
    <td><strong>CLIENTE: </strong><?php echo $datos_orden['nombrecli']  ?></td>
    <td><strong>CC.o NIT: </strong><?php echo $datos_orden['identi']  ?></td>
    <td><strong>DIRECCION: </strong><?php echo $datos_orden['direccion']  ?></td>
    </tr>
  <tr>
    <td><strong>TELS: </strong><?php echo $datos_orden['telefono']  ?></td>
    <td><strong>EMAIL: </strong><?php echo $datos_orden['email']  ?></td>
    <td><strong>TECNICO: </strong><?php echo $nombre_mecanico ?></td>
    </tr>
  <tr>
    <td><strong>FECHA DE INGRESO: </strong> <?php echo $datos_orden['fecha']  ?></td>
    <td><strong>FECHA PROMETIDA: </strong> <?php echo $datos_orden['fecha_entrega']  ?></td>
    <td><strong>FECHA SALIDA:</strong> <?php echo $datos_orden['fecha_salida']  ?></td>
    </tr>
</table>

<table width="<?php echo $ancho_tabla; ?>" border="1">
  <tr>
    
    <td><strong>MARCA: </strong><?php echo $datos_orden['marca']  ?></td>
    <td><strong>MODELO: </strong><?php echo $datos_orden['modelo']  ?></td>
    <td><strong>CHASIS No: </strong> <?php echo $datos_orden['chasis']  ?></td>
    <td><strong>COLOR: </strong><?php echo $datos_orden['color']  ?></td>
    <td><strong>PLACA: </strong><?php echo $datos_orden['placa']  ?></td>
    </tr>
</table>
<br>
<div align="center">
<?php   
pintar_inventario_estado_vehiculo($tabla24,$tabla25,$_SESSION['id_empresa'],$_REQUEST['idorden'],$conexion,$ancho_tabla);
?>
</div>
<br>
<table width = "<?php echo $ancho_tabla; ?>" border="1">
  <tr>
    <td align="center"><strong>OBSERVACIONES</strong></td>
  </tr>
   <tr>
    <td><textarea name="descripcion"  id = "descripcion" cols="80" rows="4"> <?php  echo $datos_orden['observaciones']?>
    </textarea></td>
  </tr>
   <tr>
    <td><h81><?php   echo $datos_orden['condiciones_orden'] ?></h81></td>
  </tr>
</table>
<br>
<table width = "<?php echo $ancho_tabla; ?>" border="1">
<tr>
    <td colspan = "5"  align="center"><strong>PARTES Y RESPUESTOS</strong></td>
  </tr>
	
<tr>
    <td><strong>REFERENCIA</strong></td>
    <td><strong>DESCRIPCION</strong></td>
    <td><strong>CANTIDAD</strong></td>
    <td><strong>VALOR UN.</strong></td>
    <td><strong>TOTAL </strong></td>
  </tr>
 


<?php
$subtotal = muestre_items_local($_REQUEST['idorden'],$tabla15,$conexion,$_SESSION['id_empresa']);
echo '<tr><td colspan="3"></td><td><strong>TOTAL</strong></td><td align="right"><strong>'.$subtotal.'<strong></td> </tr>';
?>
</table>
<br>
<table width = "<?php echo $ancho_tabla; ?>" border="1">
  <tr>
    <td>&nbsp;</td>
    <td><strong>COTIZACION</strong></td>
    <td><strong>ABONO</strong></td>
    <td><strong>FECHA</strong></td>
    <td><strong>SALDO</strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>TOTAL</strong></td>
    <td align="right"><strong><?php echo $subtotal  ?></strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right"><strong><?php echo $subtotal  ?></strong></td>
  </tr>
</table>
<br>
<table width = "<?php echo $ancho_tabla; ?>" border="0">
  <tr>
    <td>RECIBIDO</td>
    <td>ENTREGADO</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>--------------</td>
    <td>-------------------</td>
  </tr>
  <tr>
    <td>TALLER</td>
    <td>CLIENTE</td>
  </tr>
</table>
<br>
<table width = "<?php echo $ancho_tabla; ?>" border="0">
  <tr>
   <td align = "center"><?php echo $datos_orden['direccion_empresa'].'-'.$datos_orden['telefonos_empresa'].'-'. $datos_orden['email_empresa']  ?> </td>
  </tr>
</table>

</h80>

</div>
 
<?php

//////////////////////////////
// esta funcion la utilizo cuando se va a facturar por esto ya tiene un formato predefinido para que cuadre al momento de mostrar la factura e imprimirla 
function muestre_items_local($orden,$tabla,$conexion,$id_empresa)
		{
				$subtotal = 0;
				//echo 'pasooooooooooooooooo3333333333333333333'.$orden;
				$sql_items_orden = "select * from  $tabla where no_factura = '".$orden."' and id_empresa = '".$id_empresa."'  order by id_item ";
				//echo '<br>'.$sql_items_orden.'<br>';
				$consulta_items = mysql_query($sql_items_orden,$conexion);
				$no_item = 0 ;
				

				
     while($items = mysql_fetch_array($consulta_items))
	 		 {
			 $i++;
	 			echo '<tr>
			     
                <td >'.$items['codigo'].'</td>
    			<td  > '.$items['descripcion'].'</td>
				<td align="center"> '.$items['cantidad'].'</td>
    			<td align="right">'.$items['valor_unitario'].'</td>
   			    <td align="right">'.$items['total_item'].'</td>
					</tr>
				';
				//<td width="34">'.$i.'</td>
				$subtotal = $subtotal + $items['total_item'];
			 }
			
			 return $subtotal; 
		}
///////////////////////////


?>
<br>
</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>  

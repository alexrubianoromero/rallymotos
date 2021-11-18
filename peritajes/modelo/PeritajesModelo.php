<?php
require_once('../valotablapc.php');
class PeritajesModelo{

    public function __construct()
    {
        echo $tabla3; 
    }

    public function traerPeritajes($conexion){
        $sql= "SELECT p.idperitaje as id, c.placa, 
        DATE_FORMAT(p.fecha,'%Y/%m/%d') as fecha,p.kilometraje as klm,p.observaciones as observ 
        
               FROM  peritajes p
               INNER JOIN  carros c ON c.idcarro = p.idcarro
               ORDER BY  idperitaje DESC";
            //    echo '<br>'.$sql;
        $consulta = mysql_query($sql,$conexion); 
        return $this->get_table_assoc($consulta);
    }

    public function get_table_assoc($datos)
		{
		 				$arreglo_assoc='';
							$i=0;	
							while($row = mysql_fetch_assoc($datos)){		
								$arreglo_assoc[$i] = $row;
								$i++;
							}
						return $arreglo_assoc;
		}

    public function buscarPlaca($conexion,$placa){
        $sql = "select * from carros where placa = '".$placa ."'  ";
        // echo '<br>'.$sql;
        // die();
        $consulta = mysql_query($sql,$conexion); 
        $filas = mysql_num_rows($consulta);
        $datos = $this->get_table_assoc($consulta);
        $respuesta['filas']= $filas;
        $respuesta['datos']=  $datos;  
        return $respuesta; 
    }    

    public function buscarCliente0Id($conexion,$id){
        $sql="select * from cliente0 where idcliente = '".$id."'  "; 
        // echo '<br>'.$sql;
        // die();
        $consulta = mysql_query($sql,$conexion); 
        $filas = mysql_num_rows($consulta);
        $datos = $this->get_table_assoc($consulta);
        $respuesta['filas']= $filas;
        $respuesta['datos']=  $datos;  
        return $respuesta; 
    }
    public function traerClientes0($conexion){
        $sql="SELECT * FROM cliente0 
              ORDER BY idcliente DESC  "; 
        // echo '<br>'.$sql;
        // die();
        $consulta = mysql_query($sql,$conexion); 
        $filas = mysql_num_rows($consulta);
        $datos = $this->get_table_assoc($consulta);
        return $datos; 
    }
    
    public function grabarPeritaje($conexion,$request){
        $sql = "INSERT INTO peritajes  (idcarro,fecha,kilometraje,observaciones,amortiguadores
                ,exosto,arrastre, llantas,sillin,velocimetro, frenos,luces,motor,tacometro)
                VALUES (
                '".$request['idcarro']."', 
                now(), 
                '".$request['kilometraje']."' 
                ,'".$request['observaciones']."'
                ,'".$request['amortiguadores']."'
                ,'".$request['exosto']."'
                ,'".$request['arrastre']."'
                ,'".$request['llantas']."'
                ,'".$request['sillin']."'
                ,'".$request['velocimetro']."'
                ,'".$request['frenos']."'
                ,'".$request['luces']."'
                ,'".$request['motor']."'
                ,'".$request['tacometro']."'
                )
        ";
        // echo '<br>'.$sql;
        // die(); 
        $consulta = mysql_query($sql,$conexion); 
    }

      public function traerPeritajeId($conexion,$id){
        $sql= "SELECT p.idperitaje as id, c.placa, p.fecha,kilometraje as klm,p.observaciones as observ,
        p.amortiguadores,p.exosto, p.arrastre, p.llantas, p.sillin, p.velocimetro, p.frenos,p.luces
        ,p.motor, p.tacometro 
               FROM  peritajes p
               INNER JOIN  carros c ON c.idcarro = p.idcarro
               WHERE p.idperitaje = ".$id."
               ORDER BY  idperitaje DESC";
            //    echo '<br>'.$sql;
            //    die();
        $consulta = mysql_query($sql,$conexion); 
        return $this->get_table_assoc($consulta);
    }
    public function actualizarPeritaje($conexion,$request){
        $sql = "UPDATE peritajes 
                        SET  amortiguadores = '".$request['amortiguadores']."'
                        ,exosto = '".$request['exosto']."'
                        ,arrastre = '".$request['arrastre']."'
                        ,llantas = '".$request['llantas']."'
                        ,sillin = '".$request['sillin']."'
                        ,velocimetro = '".$request['velocimetro']."'
                        ,frenos = '".$request['frenos']."'
                        ,luces = '".$request['luces']."'
                        ,motor = '".$request['motor']."'
                        ,tacometro = '".$request['tacometro']."'
                WHERE idperitaje =  '".$request['id']."'
                        ";
            // echo '<br>'.$sql; 
            // die();
            $consulta = mysql_query($sql,$conexion);    
    }
    public function grabarPropietario($conexion,$request){
        $existeIdentidad = $this->validarPropietario($conexion,$request['identi']);
        $sql = "INSERT INTO cliente0 (identi,nombre,telefono,direccion,observaci) 
                VALUES('".$request['identi']."','".$request['nombre']."',
                '".$request['telefono']."','".$request['direccion']."','".$request['observaciones']."')";
        $consulta = mysql_query($sql,$conexion);   
        $maxId = $this->traerMaxIdCLiente0($conexion);
        return $maxId;   
    }
    
    public function traerMaxIdCLiente0($conexion){
        $sqlId = "SELECT MAX(idcliente)as maxId FROM cliente0 "; 
        // echo  '<br>'.$sqlId;
        // die();
        $consultaId = mysql_query($sqlId,$conexion); 
        $consultaId = mysql_fetch_assoc($consultaId);
        return $consultaId['maxId'];
    } 
    public function grabarVehiculo($conexion,$request){
        $sql = "INSERT INTO carros (placa,propietario,marca,tipo,modelo, color,vencisoat,revision,chasis,motor ) 
                VALUES('".$request['placa']."','".$request['propietario']."',
                '".$request['marca']."','".$request['linea']."','".$request['modelo']."',
                '".$request['color']."','".$request['vencisoat']."','".$request['revision']."',
                '".$request['chasis']."','".$request['motor']."')";
                $consulta = mysql_query($sql,$conexion);   
                $maxId = $this->traerMaxIdCarros($conexion);
                // echo '<br>'.$maxId;
                // die();
                return  $maxId;
            }
            
    public function traerMaxIdCarros($conexion){
        $sqlId = "SELECT MAX(idcarro)as maxId FROM carros "; 
        // echo  '<br>'.$sqlId;
        // die();
        $consultaId = mysql_query($sqlId,$conexion); 
        $consultaId = mysql_fetch_assoc($consultaId);
        return $consultaId['maxId'];
    } 
    public function validarPropietario($conexion,$identi){
        $sql = "SELECT * FROM cliente0 WHERE identi = '".$identi."'   ";
        $consulta = mysql_query($sql,$conexion); 
        $filas = mysql_num_rows($consulta);
        // echo $filas;
        // die();
        return $filas;
    }
            
}
        
        
        ?>
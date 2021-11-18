<?php
require_once('../funciones/funciones.class.php');

class PeritajesVista{

    public function pantallaInicial($peritajes){
        ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="../css/bootstrap.min.css">  
                <link rel="stylesheet" href="../peritajes/css/peritajes.css">  
                <script src="https://kit.fontawesome.com/6f07c5d6ff.js" crossorigin="anonymous"></script>
                <title>Document</title>
            </head>
            <body bgcolor = "#c0c0c0">
                <div id="div_peritajes" align="center" class="container linea " >
                    <br><br>
                    <div id="div_botones_peritaje" class="linea1">
                        <button onclick="nuevoPeritaje();" class="btn btn-primary">NUEVO</button>
                        <button onclick="consultaPeritaje();" class="btn btn-primary">PERITAJES</button>
                        <!-- <button onclick="enviarMenuPrincipal();" class="btn btn-primary">PRINCIPAL</button> -->
                        <a href=../menu_principal.php   class="btn btn-primary" role="button" class="btn btn-primary" >MENU PRINCIPAL</a>
                    </div>
                    <br>
                    <div id="div_resultados_peritajes">
                        <?php $this->mostrarPeritajes($peritajes);?>
                    </div>
                </div>
                <?php  $this->modal(); ?>
                <?php  $this->modal1(); ?>
                <?php  $this->modal3(); ?>
            </body>
            </html>

            <script src = "../js/jquery-2.1.1.js"> </script>    
            <script src="../js/bootstrap.min.js"></script>
            <script src="js/peritajes.js"></script>
        <?php
    }

     

    public function mostrarPeritajes($peritajes){

        echo '<table class="table table-striped">';
            echo '<thead>';
                // $this->ponerTitulos($peritajes); 
            echo '<tr>';
            echo '<th>Id</th>'; 
            echo '<th><i class="fas fa-edit"></i></th>'; 
               
            echo '<th>Placa</th>';    
            echo '<th>Fecha</th>';    
            echo '<th>Klm</th>';    
            // echo '<th>Observ</th>';    
            echo '</tr>';    
            echo '</thead>';
            echo '<tbody>';
                foreach($peritajes as $peri){
                    echo '<tr>';
                    echo '<td><button  onclick="muestreDetallePeritaje('.$peri['id'].')" id="btnverperitaje" class="btn btn-primary" data-toggle="modal" data-target="#myModal2">'.$peri['id'].'</button></td>';
                    echo '<td><button  onclick="editarPeritaje('.$peri['id'].')"><i class="fas fa-edit" data-toggle="modal" data-target="#myModal1"></i></button></td>'; 
                    echo '<td>'.$peri['placa'].'</td>'; 
                    echo '<td>'.$peri['fecha'] .'</td>'; 
                    echo '<td>'.$peri['klm'].'</td>'; 
                    // echo '<td>'.$peri['observ'].'</td>'; 
                    echo '</tr>';
                }
            echo '</tbody>';
        echo '</table>';

    }

    public function modal (){
        ?>
         <!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal2">
         Launch demo modal
         </button> -->
          <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">Detalle Peritaje</h4>
                  </div>
                  <div id="cuerpoModal" class="modal-body">
                      
                      
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                      <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                  </div>
                  </div>
              </div>
          </div>
        <?php
    }
    public function modal1 (){
        ?>
         <!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal2">
         Launch demo modal
         </button> -->
          <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel1">Edicion Peritaje</h4>
                  </div>
                  <div id="cuerpoModal1" class="modal-body">
                      
                      
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                      <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                  </div>
                  </div>
              </div>
          </div>
        <?php
    }
    public function modal3 (){
        ?>
         <!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal2">
         Launch demo modal
         </button> -->
          <div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel1">Propietario</h4>
                  </div>
                  <div id="cuerpoModal3" class="modal-body">
                      
                      
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                      <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                  </div>
                  </div>
              </div>
          </div>
        <?php
    }
    public function nuevoPeritaje(){
        ?><div id="divPregunteDatos">
            <div id="divPreguntePlaca">
                <label>Placa</label>
                <input type="text" id="placaPeritaje" size="8" value="">
                <button onclick="buscarPlacaPeritaje();" id="btnBuscarPlaca">
                Verificar Placa
                <!-- <i class="fas fa-search"></i> -->
                </button>
            </div>
            <div id="divResultadobusqueda">

            </div>
        </div>

        <?
    }

    public function mostrarDatosPlaca($datosPlaca,$datosCliente0){
        ?>
        <div class="row" class="linea">
            <div class=" col-lg-6 col-md-6 col-sm-6 col-xs-12 linea">
               
                <table class="table">
                <tr>
                    <td>
                    <input type="hidden" id="idCarroPeritaje" value = "<?php  echo $datosPlaca[0]['idcarro']; ?>">
                        Propietario:
                    </td>
                    <td><?php   echo $datosCliente0[0]['nombre']; ?></td>
                </tr>    
                <tr>
                    <td><label>Marca:</label></td>
                    <td><?php   echo $datosPlaca[0]['marca']; ?></td>
                </tr>    
                <tr>
                    <td><label>Color:</label></td>
                    <td><?php   echo $datosPlaca[0]['color']; ?></td>
                </tr>    
                <tr>
                    <td><label>VenciSoat:</label></td>
                    <td><?php   echo $datosPlaca[0]['vencisoat']; ?></td>
                </tr>    
                
            </table>
            </div>
            <div class=" col-lg-6 col-md-6 col-sm-6 col-xs-12 linea">
            <table class="table">
            <tr>
                <td><label>Modelo:</label></td>
                <td><?php   echo $datosPlaca[0]['modelo']; ?></td>
            </tr>    
            <tr>
                <td><label>PLaca:</label></td>
                <td><?php   echo $datosPlaca[0]['placa']; ?></td>
            </tr>    
            <tr>
                <td><label>Kilometraje:</label></td>
                <td><input type="text" id="kilometrajeperitaje" size="8px" ></td>
            </tr>    
            </table>
            </div>
        </div>

        <div class="row">
             <div class=" col-lg-6 col-md-6 col-sm-6 col-xs-12 linea">
                <table class="table">
                <tr>
                    <td><label>Amortiguadores:</label></td>
                    <td><?php $this->selectPeritaje('amortiguadores') ?></td>
                </tr>    
                <tr>
                    <td><label>Exosto:</label></td>
                    <td><?php $this->selectPeritaje('exosto') ?></td>
                </tr>    
                <tr>
                    <td><label>Kit de Arrastre:</label></td>
                    <td><?php $this->selectPeritaje('arrastre') ?></td>
                </tr>    
                <tr>
                    <td><label>Llantas:</label></td>
                    <td><?php $this->selectPeritaje('llantas') ?></td>
                </tr>    
                <tr>
                    <td><label>Sillin:</label></td>
                    <td><?php $this->selectPeritaje('sillin') ?></td>
                </tr>    
                <tr>
                    <td><label>Velocimetro:</label></td>
                    <td><?php $this->selectPeritaje('velocimetro') ?></td>
                </tr>    
                </table>
            </div>  
        <!-- </div>
        <div class="row"> -->
            <div class=" col-lg-6 col-md-6 col-sm-6 col-xs-12 linea">
                <table class="table">
                <tr>
                    <td><label>Frenos:</label></td>
                    <td><?php $this->selectPeritaje('frenos') ?></td>
                </tr>    
                <tr>
                    <td><label>Luces:</label></td>
                    <td><?php $this->selectPeritaje('luces') ?></td>
                </tr>    
                <tr>
                    <td><label>Motor:</label></td>
                    <td><?php $this->selectPeritaje('motor') ?></td>
                </tr>    
                <tr>
                    <td><label>Tacometro:</label></td>
                    <td><?php $this->selectPeritaje('tacometro') ?></td>
                </tr>    
                 
                </table>
            </div>  
        </div>
        <div class="row">
            <div class="col-xs-12">
                <table class="table">
                <tr>
                    <td><label>Observaciones:</label></td>
                </tr> 
                <tr>
                    <td><textarea class="form-control" id="observacionesPeritaje" cols="70%" rows="6"></textarea></td>
                </tr> 
                </table>
            </div>
       </div>   
        <div class="row">
            <!-- <button onclick="prueba();" class="btn btn-primary">Prueba</button> -->
            <button onclick="grabarPeritaje();" id="btnGrabarperitaje" class="btn btn-primary btn-block btn-lg">Grabar_Peritaje</button>
        </div>
        <br><br>
        <?php
    }
   
    public function selectPeritaje($idSelect){
        echo'<select id="'.$idSelect.'" class="form-control">';
        echo '<option value="0"> Seleccionar...</option>';
        echo '<option value="bueno"> Bueno</option>';
        echo '<option value="regular"> regular</option>';
        echo '<option value="malo"> malo</option>';
        echo'</select>';
    }

    public function ponerTitulos($datos){
        $titulos = array_keys($datos[0]);
        echo '<tr>';
        foreach   ($titulos as $d ) { 
            echo "<td>".strtoupper($d)."</TD>"; 
        } 
        echo '</tr>';
    }

    public function draw_table($datos)
    {
                echo '<table class="table" border = "1">';
                    $titulos = array_keys($datos[0]);
                        echo '<tr>';
                        foreach   ($titulos as $d ) { 
                            echo "<td>".strtoupper($d)."</TD>"; 
                        } 
                        echo '</tr>';

                        foreach   ($datos as $d ) {   
                            echo '<tr>';
                            foreach   ($d as $r ) {
                            echo "<td>$r</TD>";
                            }
                        
                            echo '</tr>';		
                        }
                        echo '</table>';

    
    }
  public function pantallaDatosPeritajeId($datosPeritaje,$datosPlaca,$datosCliente0){
      $datosPlaca = $datosPlaca['datos'];
    //   $datosPeritaje = $datosPeritaje['datos'];
    //   echo '<pre>';
    //   print_r($datosPeritaje);
    //   echo '</pre>';
    //   die();
        ?>
         <div class="row">
            <div class=" col-lg-6 col-md-6 col-sm-6 col-xs-12 linea">
               
                <table class="table">
                <tr>
                    <td>
                    <input type="hidden" id="idCarroPeritaje" value = "<?php  echo $datosPlaca[0]['idcarro']; ?>">
                        <label>Propietario:</label>
                    </td>
                    <td><?php   echo $datosCliente0['datos'][0]['nombre']; ?></td>
                </tr>    
                <tr>
                    <td><label>Marca:</label></td>
                    <td><?php   echo $datosPlaca[0]['marca']; ?></td>
                </tr>    
                <tr>
                    <td><label>Color:</label></td>
                    <td><?php   echo $datosPlaca[0]['color']; ?></td>
                </tr>    
                <tr>
                    <td><label>VenciSoat:</label></td>
                    <td><?php   echo $datosPlaca[0]['vencisoat']; ?></td>
                </tr>    
                
            </table>
            </div>
            <div class=" col-lg-6 col-md-6 col-sm-6 col-xs-12 linea">
            <table class="table">
            <tr>
                <td><label>Modelo:</label></td>
                <td><?php   echo $datosPlaca[0]['modelo']; ?></td>
            </tr>    
            <tr>
                <td><label>PLaca:</label></td>
                <td><?php   echo $datosPlaca[0]['placa']; ?></td>
            </tr>    
            <tr>
                <td><label>Kilometraje:</label></td>
                <td><?php   echo $datosPeritaje[0]['klm']; ?></td>
            </tr>    
            </table>
            </div>
        </div>

        <div class="row" id="div_puntos_peritaje">
            <div class=" col-lg-6 col-md-6 col-sm-6 col-xs-12 linea">
                <table class="table">
                <tr>
                    <td><label>Amortiguadores:</label></td>
                    <td><?php echo  $datosPeritaje[0]['amortiguadores']; ?></td>
                </tr>    
                <tr>
                    <td><label>Exosto:</label></td>
                    <td><?php echo  $datosPeritaje[0]['exosto']; ?></td>
                </tr>    
                <tr>
                    <td><label>Kit de Arrastre:</label></td>
                    <td><?php echo  $datosPeritaje[0]['arrastre'];?></td>
                </tr>    
                <tr>
                    <td><label>Llantas:</label></td>
                    <td><?php echo  $datosPeritaje[0]['llantas'];?></td>
                </tr>    
                <tr>
                    <td><label>Sillin:</label></td>
                    <td><?php echo  $datosPeritaje[0]['sillin'];?></td>
                </tr>    
                <tr>
                    <td><label>Velocimetro:</label></td>
                    <td><?php echo  $datosPeritaje[0]['velocimetro'];?></td>
                </tr>    
                </table>
            </div>  
            <!-- </div>
            <div class="row"> -->
            <div class=" col-lg-6 col-md-6 col-sm-6 col-xs-12 linea">
                <table class="table">
                <tr>
                    <td><label>Frenos:</label></td>
                    <td><?php echo  $datosPeritaje[0]['frenos'];?></td>
                </tr>    
                <tr>
                    <td><label>Luces:</label></td>
                    <td><?php echo  $datosPeritaje[0]['luces'];?></td>
                </tr>    
                <tr>
                    <td><label>Motor:</label></td>
                    <td><?php echo  $datosPeritaje[0]['motor'];?></td>
                </tr>    
                <tr>
                    <td><label>Tacometro:</label></td>
                    <td><?php echo  $datosPeritaje[0]['tacometro'];?></td>
                </tr>    
                 
                </table>
            </div>  
        </div>
        <div class="row">
            <div class="col-xs-12">
                <table class="table">
                <tr>
                    <td><label>Observaciones:</label></td>
                </tr> 
                <tr>
                    <td><textarea class="form-control" id="observacionesPeritaje" cols="70%" rows="6">
                        <?php echo $datosPeritaje[0]['observ']?>
                    </textarea></td>
                </tr> 
                </table>
            </div>
       </div>   
        <div class="row" align="center">
            <!-- <button onclick="editarPeritaje(<?php  echo $datosPeritaje[0]['id'] ?>);" id="btnEditarPeritaje" class="btn btn-primary  btn-lg"  data-toggle="modal" data-target="#myModal1">Editar_Peritaje</button> -->
        </div>

        <?php
  }
    
  public function pantallaEditarPeritajeId($datosPeritaje){
        //  echo '<pre>';
        // print_r($datosPeritaje);
        // echo '</pre>';
        // die();
        echo '<table class="table">'; 
        $this->pintarPuntosperitajeModificacion($datosPeritaje);
        echo '<tr>';
        echo '</tr>';
        echo '<tr>';
        echo '</tr>';
        echo '<td colspan= "2"><button data-dismiss="modal" onclick= "actualizarDatosPeritaje('.$datosPeritaje[0]['id'].');" class="btn btn-primary btn-block">ACTUALIZAR</button></td>';
        echo '</table>';  
        ?>
      
      <?php
    
}
public function pintarPuntosperitajeModificacion($datosPeritaje)
{
        $nombresSelect = $this->nombresSelect();
        $opciones = $this->opciones();
        for ($i=0;$i<count($nombresSelect);$i++)
        {
            $nombre = $nombresSelect[$i];
            echo '<tr>';
            echo '<td>'.$nombresSelect[$i].'</td>'; 
            echo '<td>';
            echo '<select class="form-control" id="'.$nombre.'">';
            for ($j=0 ; $j < count($opciones);$j++)
            {
                if($datosPeritaje[0][$nombre]==$opciones[$j])
                { echo '<option value = "'.$opciones[$j].'"  selected >'.$opciones[$j].'</option>';   
                }else{
                    echo '<option value = "'.$opciones[$j].'"  >'.$opciones[$j].'</option>';   
                }
            }
            echo '</select>';   
            echo '</td>'; 
            echo '</tr>';
        }
    }
    public function nombresSelect(){
        $nombresSelect[0]= 'amortiguadores'; 
        $nombresSelect[1]= 'exosto'; 
        $nombresSelect[2]= 'arrastre';
        $nombresSelect[3]= 'llantas';
        $nombresSelect[4]= 'sillin';
        $nombresSelect[5]= 'velocimetro';
        $nombresSelect[6]= 'frenos';
        $nombresSelect[7]= 'luces';
        $nombresSelect[8]= 'motor';
        $nombresSelect[9]= 'tacometro';
        return $nombresSelect;
    }

    public function opciones(){
        $opciones[0]= 'bueno';
        $opciones[1]= 'regular';
        $opciones[2]= 'malo';
        return $opciones;
    }
    public function preguntarDatosPlaca($placa,$propietarios){
        ?>
        <div class= "row" id="div_pregunte_datos_placa">
            <div class=" col-lg-6 col-md-6 col-sm-6 col-xs-12 linea">
                <table class="table">
                    <tr>
                        <td><label>Placa</label></td>
                        <td><?php echo $placa  ?>
                            <input type="hidden" id="placa" value = "<?php echo $placa ?>">
                    
                        </td>
                    </tr>
                    <tr>
                        <td><label>Propietario</label></td>
                        <td>
                            <select name="selectPropietario" id="selectPropietario">
                            <?php  funciones::select_general($propietarios,'idcliente','nombre'); ?>
                            </select>
                            <button data-toggle="modal" data-target="#myModal3" onclick= "btnNuevoPropietario();" class="btn btn-primary"><i class="fas fa-plus-square"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Marca</label></td>
                        <td> <input type="text" id="marca"></td>
                    </tr>
                    <tr>
                        <td><label>Linea</label></td>
                        <td> <input type="text" id="linea"></td>
                    </tr>
                    <tr>
                        <td><label>Modelo</label></td>
                        <td> <input type="text" id="modelo"></td>
                    </tr>
                
                </table>
            </div>
            <div class=" col-lg-6 col-md-6 col-sm-6 col-xs-12 linea">
                <table class="table">
                    <tr>
                        <td><label>Color</label></td>
                        <td> <input type="text" id="color"></td>
                    </tr>
                    <tr>
                        <td><label>Venci Soat</label></td>
                        <td> <input type="date" id="vencisoat"></td>
                    </tr>
                    <tr>
                        <td><label>Venci Tecno</label></td>
                        <td> <input type="date" id="revision"></td>
                    </tr>
                    <tr>
                        <td><label>Chasis</label></td>
                        <td> <input type="text" id="chasis"></td>
                    </tr>
                
                    <tr>
                        <td><label>Motor</label></td>
                        <td> <input type="text" id="motor"></td>
                    </tr>
                
                </table>
            </div>
            <div>
                <button class = "btn btn-primary btn-block btn-lg" onclick="grabarVehiculo();" >Grabar </button>
            </div>
        </div>
        <?php
    }
public function nuevoPropietario(){
    ?>
       <div id="div_pregunte_datos_propietario">
           <div id="infoVerificaciones"></div>
        <table class="table">
            <tr>
                <td><label>Identidad</label></td>
                <td> <input type="text" id="identi" onchange="validarIdentidad(this.value)"></td>
            </tr>
            <tr>
                <td><label>Nombre</label></td>
                <td> <input type="text" id="nombre"></td>
            </tr>
            <tr>
                <td><label>Telefono</label></td>
                <td> <input type="text" id="telefono"></td>
            </tr>
            <tr>
                <td><label>Direccion</label></td>
                <td> <input type="text" id="direccion"></td>
            </tr>
            <tr>
                <td><label>Observaciones</label></td>
                <td> <input type="text" id="observaciones"></td>
            </tr>
            <tr>
                <td colspan="2"> <button onclick="grabarPrpietario();"class="btn btn-primary btn-block btn-lg" ">GRABAR PROPIETARIO</button></td>
            </tr>
        </table>
        </div>
    <?php
}    
    
public function propietarioGrabado(){
    echo 'La informacion del propietario se guardo de forma exitosa';
}
}

?>
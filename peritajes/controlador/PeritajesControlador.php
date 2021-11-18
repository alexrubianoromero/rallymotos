<?php
require_once('vista/PeritajesVista.php');
require_once('modelo/PeritajesModelo.php');
require_once('../funciones/funciones.class.php');
class PeritajesControlador{
    private $vista; 
    private $modelo;
    private $conexion;
   
    public function __construct($conexion){
        $this->conexion = $conexion;
        $this->vista = new peritajesVista();
        $this->modelo = new peritajesModelo();

        if(!isset($_REQUEST['opcion']) || $_REQUEST['opcion']=='consultar'){
            $this->pantallaInicial($this->conexion);
        }
        if($_REQUEST['opcion']=='nuevo'){

            $this->vista->nuevoPeritaje();
        } 
        if($_REQUEST['opcion']=='buscarPlaca'){

            $this->buscarPlaca($this->conexion,$_REQUEST['placa']);
        } 
        if($_REQUEST['opcion']=='grabar'){
        //          echo '<pre>';
        // print_r($_REQUEST);
        // echo '</pre>';
        // die();  
            $this->grabarPeritaje($this->conexion,$_REQUEST);
        } 
        if($_REQUEST['opcion']=='consultaPeritajeId'){
            $this->consultaPeritajeId($conexion,$_REQUEST['id']);
        } 
        if($_REQUEST['opcion']=='editarPeritajeId'){
            $this->editarPeritajeId($this->conexion,$_REQUEST['id']);
        } 
        if($_REQUEST['opcion']=='actualizarPeritaje'){
                $this->actualizarPeritaje($this->conexion,$_REQUEST);
        }
        if($_REQUEST['opcion']=='nuevoPropietario'){
                $this->nuevoPropietario($this->conexion);
        }
        if($_REQUEST['opcion']=='grabarPropietario'){
                $this->grabarPropietario($this->conexion,$_REQUEST);
        }
        if($_REQUEST['opcion']=='cargarUltimoPropietario'){
                $this->cargarUltimoPropietario($this->conexion);
        }
        if($_REQUEST['opcion']=='grabarVehiculo1'){
                $this->grabarVehiculo($this->conexion,$_REQUEST);
        }
        if($_REQUEST['opcion']=='validarIdenti'){
                $this->validarIdenti($this->conexion,$_REQUEST['identi']);
        }

    }  
    
    public function pantallaInicial($conexion){
        $peritajes = $this->modelo->traerPeritajes($conexion);
        $this->vista->pantallaInicial($peritajes);
    }
        
    public function buscarPlaca($conexion,$placa){
        $datosPlaca = $this->modelo->buscarPlaca($conexion,$placa);
        if($datosPlaca['filas']>0){
            $datosCliente0 = $this->modelo->buscarCliente0Id($conexion,$datosPlaca['datos'][0]['propietario']);
            $this->vista->mostrarDatosPlaca($datosPlaca['datos'],$datosCliente0['datos']);
        }
        else{
            $propietarios = $this->modelo->traerClientes0($conexion);
            $this->vista->preguntarDatosPlaca($placa,$propietarios);
        }
    }
    public function grabarPeritaje($conexion,$request){
        $this->modelo->grabarPeritaje($conexion,$request);
        $this->pantallaInicial($conexion);
    }

    public function consultaPeritajeId($conexion,$id){
        $datosPeritaje =  $this->modelo->traerPeritajeId($conexion,$id);
        $datosPlaca = $this->modelo->buscarPlaca($conexion,$datosPeritaje[0]['placa']);
        $datosCliente0 = $this->modelo->buscarCliente0Id($conexion,$datosPlaca['datos'][0]['propietario']);
        $this->vista->pantallaDatosPeritajeId($datosPeritaje,$datosPlaca,$datosCliente0);
    }
    
    public function editarPeritajeId($conexion,$id){
        $datosPeritaje =  $this->modelo->traerPeritajeId($conexion,$id);
        $this->vista->pantallaEditarPeritajeId($datosPeritaje);
    }
    
    public function actualizarPeritaje($conexion,$request){
        $datosPlaca = $this->modelo->actualizarPeritaje($conexion,$request);
        echo 'PERITAJE ACTUALIZADO EXITOSAMENTE';
        // echo '<pre>';
        // print_r($request);
        // echo '</pre>';
        // die();  
    }
    public function nuevoPropietario(){
        $this->vista->nuevoPropietario();
    }
    public function grabarPropietario($conexion,$request){
        $id = $this->modelo->grabarPropietario($conexion,$request);
        $this->vista->propietarioGrabado();
        // echo 'CLIENTE NUEVO  GRABADO';
        // echo '<br>'.$id; 
    }
    public function cargarUltimoPropietario($conexion){
        $maxId = $this->modelo->traerMaxIdCLiente0($conexion);
        funciones::select_general_condicion('cliente0',$conexion,'idcliente','nombre' , $maxId);
    }
    public function grabarVehiculo($conexion,$request){
        // echo '<pre>';
        // print_r($request);
        // echo '</pre>';
        // die();  
        $idNuevoCarro = $this->modelo->grabarVehiculo($conexion,$request);
        $this->buscarPlaca($conexion,$request['placa']);
        
    }
    public function validarIdenti($conexion,$identi){
        $validacion = $this->modelo->validarPropietario($conexion,$identi);
        if($validacion >0){
            echo '<p class="alerta1">Esta identidad ya existe en la base de datos</p> ';
        }
    }
}


?>
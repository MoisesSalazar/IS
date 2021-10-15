<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$evento_id = (isset($_POST['evento_id'])) ? $_POST['evento_id'] : '';

$evento_id = (isset($_POST['evento_id'])) ? $_POST['evento_id'] : '';
$titulo = (isset($_POST['titulo'])) ? $_POST['titulo'] : '';
$descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : '';
$categoria = (isset($_POST['categoria'])) ? $_POST['categoria'] : '';
$fecha = (isset($_POST['fecha'])) ? $_POST['fecha'] : '';
$tipo = (isset($_POST['tipo'])) ? $_POST['tipo'] : '';


switch($opcion){
    case 1:
        $consulta = "INSERT INTO EVENTOS (titulo,descripcion,categoria,fecha,tipo) 
        VALUES('$titulo','$descripcion','$categoria','$fecha','$tipo')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        
        $consulta = "SELECT * FROM EVENTOS ORDER BY evento_id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);    
        break;    
    case 2:        
        $consulta = "UPDATE EVENTOS SET titulo='$titulo', descripcion='$descripcion', categoria='$categoria', fecha='$fecha', tipo='$tipo'
                                        WHERE evento_id='$evento_id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT * FROM EVENTOS WHERE evento_id='$evento_id' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3:        
        $consulta = "DELETE FROM EVENTOS WHERE evento_id='$evento_id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;
    case 4:    
        $consulta = "SELECT * FROM EVENTOS";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$conexion=null;
<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$ambiente_id = (isset($_POST['ambiente_id'])) ? $_POST['ambiente_id'] : '';

$ambiente_id = (isset($_POST['ambiente_id'])) ? $_POST['ambiente_id'] : '';
$tipo = (isset($_POST['tipo'])) ? $_POST['tipo'] : '';
$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$hora = (isset($_POST['hora'])) ? $_POST['hora'] : '';
$fecha = (isset($_POST['fecha'])) ? $_POST['fecha'] : '';
$ubicacion = (isset($_POST['ubicacion'])) ? $_POST['ubicacion'] : '';
$capacidad = (isset($_POST['capacidad'])) ? $_POST['capacidad'] : '';
$actividad = (isset($_POST['actividad'])) ? $_POST['actividad'] : '';


switch($opcion){
    case 1:
        $consulta = "INSERT INTO AMBIENTES (tipo,nombre,hora,fecha,ubicacion,capacidad,actividad) 
        VALUES('$tipo','$nombre','$hora','$fecha','$ubicacion','$capacidad','$actividad')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        
        $consulta = "SELECT * FROM AMBIENTES ORDER BY ambiente_id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);    
        break;    
    case 2:        
        $consulta = "UPDATE AMBIENTES SET tipo='$tipo', nombre='$nombre', hora='$hora', fecha='$fecha', ubicacion='$ubicacion', capacidad='$capacidad', actividad='$actividad'
                                        WHERE ambiente_id='$ambiente_id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT * FROM AMBIENTES WHERE ambiente_id='$ambiente_id' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3:        
        $consulta = "DELETE FROM AMBIENTES WHERE ambiente_id='$ambiente_id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;
    case 4:    
        $consulta = "SELECT * FROM AMBIENTES";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$conexion=null;
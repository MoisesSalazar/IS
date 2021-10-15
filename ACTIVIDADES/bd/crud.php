<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$actividad_id = (isset($_POST['actividad_id'])) ? $_POST['actividad_id'] : '';

$actividad_id = (isset($_POST['actividad_id'])) ? $_POST['actividad_id'] : '';
$tipo = (isset($_POST['tipo'])) ? $_POST['tipo'] : '';
$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$hora = (isset($_POST['hora'])) ? $_POST['hora'] : '';
$fecha = (isset($_POST['fecha'])) ? $_POST['fecha'] : '';
$expositor = (isset($_POST['expositor'])) ? $_POST['expositor'] : '';
$ambiente = (isset($_POST['ambiente'])) ? $_POST['ambiente'] : '';


switch($opcion){
    case 1:
        $consulta = "INSERT INTO ACTIVIDADES (tipo,nombre,hora,fecha,expositor,ambiente) 
        VALUES('$tipo','$nombre','$hora','$fecha','$expositor','$ambiente')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        
        $consulta = "SELECT * FROM ACTIVIDADES ORDER BY actividad_id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);    
        break;    
    case 2:        
        $consulta = "UPDATE ACTIVIDADES SET tipo='$tipo', nombre='$nombre', hora='$hora', fecha='$fecha', expositor='$expositor', ambiente='$ambiente'
                                        WHERE actividad_id='$actividad_id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();    
        
        $consulta = "SELECT * FROM ACTIVIDADES WHERE actividad_id='$actividad_id' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3:        
        $consulta = "DELETE FROM ACTIVIDADES WHERE actividad_id='$actividad_id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;
    case 4:    
        $consulta = "SELECT * FROM ACTIVIDADES";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$conexion=null;
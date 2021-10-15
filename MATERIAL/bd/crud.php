<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$material_id = (isset($_POST['material_id'])) ? $_POST['material_id'] : '';

$material_id = (isset($_POST['material_id'])) ? $_POST['material_id'] : '';
$tipo = (isset($_POST['tipo'])) ? $_POST['tipo'] : '';
$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$actividad = (isset($_POST['actividad'])) ? $_POST['actividad'] : '';
$cantidad = (isset($_POST['cantidad'])) ? $_POST['cantidad'] : '';
$costo = (isset($_POST['costo'])) ? $_POST['costo'] : '';
$costoT = (isset($_POST['costoT'])) ? $_POST['costoT'] : '';
$dirigido = (isset($_POST['dirigido'])) ? $_POST['dirigido'] : '';


switch($opcion){
    case 1:
        $consulta = "INSERT INTO MATERIALES (tipo,nombre,actividad,cantidad,costo,dirigido) 
        VALUES('$tipo','$nombre','$actividad','$cantidad','$costo','$dirigido')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        
        $consulta = "SELECT * FROM MATERIALES ORDER BY material_id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);    
        break;    
    case 2:        
        $consulta = "UPDATE MATERIALES SET tipo='$tipo', nombre='$nombre', actividad='$actividad', cantidad='$cantidad', costo='$costo', costoT='$costoT', dirigido='$dirigido'
                                        WHERE material_id='$material_id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT * FROM MATERIALES WHERE material_id='$material_id' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3:        
        $consulta = "DELETE FROM MATERIALES WHERE material_id='$material_id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;
    case 4:    
        $consulta = "SELECT * FROM MATERIALES";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$conexion=null;
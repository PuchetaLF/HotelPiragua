<?php 

 

include_once 'Conexion.php'; 

 

class ServicioDB {
     public static function getServiciosAleatorios($cant) {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = 'SELECT s.id, h.habitacion, detalles, i.nombre_archivo as imagen, existencia, 
                        precio, estado, s.creado, s.modificado 
                        FROM servicio s 
                        JOIN habitacion h ON h.id = s.fk_habitacion 
                        JOIN imagen i ON i.id = s.fk_imagen 
                        ORDER BY RAND() LIMIT ?';
                
            $stmt = $dbh->prepare($consulta);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                
                // Es vital forzar el tipo a entero para que LIMIT funcione correctamente en PDO
            $stmt->bindValue(1, (int)$cant, PDO::PARAM_INT);
            $stmt->execute();
                
            $Servicios = $stmt->fetchAll();
            $dbh = null; 
                
            return $Servicios;
                
        } catch (PDOException $e) {
            print($e->getMessage());
            return array();
        }
    }

    


    public static function getServiciosPorhabitacionId($idhabitacion) { 
    $conexion = Conexion::getInstancia(); 
    $dbh = $conexion->getDbh(); 
    try { 
        $consulta = 'SELECT s.id, h.habitacion, detalles, i.nombre_archivo as imagen, existencia,  
            precio, estado, creado, modificado  
            FROM servicio s  
            JOIN habitacion h ON h.id = s.fk_habitacion  
            JOIN imagen i ON i.id = s.fk_imagen  
            WHERE h.id = ? 
            ORDER BY h.habitacion ASC'; 
        $stmt = $dbh->prepare($consulta); 
        $stmt->setFetchMode(PDO::FETCH_ASSOC); 
        $stmt->bindParam(1, $idHabitacion); 
        $stmt->execute(); 
        $servicios = $stmt->fetchAll(); 
        $dbh = null; // cierra la conexion 
    } catch (PDOException $e) { 
        echo $e->getMessage(); 
    } 
    return $servicios; 
} 

 
    public static function modificaServicioConImagen($arreglo, $idImagen) { 
    $conexion = Conexion::getInstancia(); 
    $dbh = $conexion->getDbh(); 
    try { 
        $consulta = 'UPDATE servicio  
            SET fk_habitacion=?, detalles=?, fk_imagen=?, existencia=?, precio=?, estado=?, modificado=now()  
            WHERE id=?'; 
        $stmt = $dbh->prepare($consulta); 
        $stmt->bindParam(1, $arreglo['habitacion']); 
        $stmt->bindParam(2, $arreglo['detalles']);
        $stmt->bindParam(3, $idImagen);
        $stmt->bindParam(4, $arreglo['existencia']); 
        $stmt->bindParam(5, $arreglo['precio']);
        $stmt->bindParam(6, $arreglo['checkActivo']); 
        $stmt->bindParam(7, $arreglo['id']); 
        $renglones = $stmt->execute(); 
        $dbh = null; // cierra la conexion 
    } catch (PDOException $e) { 
        echo $e->getMessage(); 
    } 
    if (isset($renglones)) { 
        return $renglones; 
    } 
} 



    public static function modificaServiciosinImagen($arreglo) { 
    $conexion = Conexion::getInstancia(); 
    $dbh = $conexion->getDbh(); 
    try { 
        $consulta = 'UPDATE servicio  
            SET fk_habitacion=?, detalles=?, existencia=?, precio=?, estado=?, modificado=now()  
            WHERE id=?'; 
        $stmt = $dbh->prepare($consulta); 
        $stmt->bindParam(1, $arreglo['habitacion']); 
        $stmt->bindParam(2, $arreglo['detalles']); 
        $stmt->bindParam(3, $arreglo['existencia']); 
        $stmt->bindParam(4, $arreglo['precio']); 
        $stmt->bindParam(5, $arreglo['checkActivo']); 
        $stmt->bindParam(6, $arreglo['id']); 
        $renglones = $stmt->execute(); 
        $dbh = null; // cierra la conexion 
    } catch (PDOException $e) { 
        echo $e->getMessage(); 
    } 
    if (isset($renglones)) { 
        return $renglones; 
    } 
} 



    
    public static function getServicioPorId($id) { 
    $conexion = Conexion::getInstancia(); 
    $dbh = $conexion->getDbh(); 
    try { 
        $consulta = 'SELECT s.id, fk_habitacion, detalles, i.nombre_archivo as imagen, existencia,  
            precio, estado, creado, modificado FROM servicio s  
            JOIN habitacion h ON h.id = s.fk_habitacion  
            JOIN imagen i ON i.id = s.fk_imagen  
            WHERE s.id=?'; 
        $stmt = $dbh->prepare($consulta); 
        $stmt->setFetchMode(PDO::FETCH_ASSOC); 
        $stmt->bindValue(1, $id); 
        $stmt->execute(); 
        $servicio = $stmt->fetch(); 
        $dbh = null; // cierra la conexion 
    } catch (PDOException $e) { 
        echo $e->getMessage(); 
    } 
    return $servicio; 
} 



   public static function getServicios() { 
$conexion = Conexion::getInstancia(); 
    $dbh = $conexion->getDbh(); 
    try { 
            $consulta = 'SELECT s.id, fk_habitacion, detalles, i.nombre_archivo as imagen, existencia, ' 
                .' precio, estado, creado, modificado '             
. 'FROM servicio s ' 
            . 'JOIN habitacion h ON h.id = s.fk_habitacion ' 
            . 'JOIN imagen i ON i.id = s.fk_imagen ' 
            . 'ORDER BY h.habitacion ASC'; 
        $stmt = $dbh->prepare($consulta); 
        $stmt->setFetchMode(PDO::FETCH_ASSOC); 
        $stmt->execute(); 
        $servicios = $stmt->fetchAll(); 
        $dbh = null; // cierra la conexion 
    } catch (PDOException $e) { 
        echo $e->getMessage(); 
    } 
    return $servicios; 
} 


    public static function insertaServicio($arreglo, $idImagen) { 
        $conexion = Conexion::getInstancia(); 
        $dbh = $conexion->getDbh(); 
        try { 
            $consulta = 'INSERT INTO servicio (fk_habitacion, detalles, existencia, precio, estado, fk_imagen, creado) VALUES (?,?,?,?,?,?,now())'; 
            $stmt = $dbh->prepare($consulta); 
            $stmt->bindParam(1, $arreglo['fk_habitacion']); 
            $stmt->bindParam(2, $arreglo['detalles']); 
            $stmt->bindParam(3, $arreglo['existencia']); 
            $stmt->bindParam(4, $arreglo['precio']); 
            $stmt->bindParam(5, $arreglo['checkActivo']);
            $stmt->bindParam(6, $idImagen); 
            $renglones = $stmt->execute(); 
            $dbh = null; // cierra la conexion 
        } catch (PDOException $e) { 
            echo $e->getMessage(); 
        } 
        if (isset($renglones)){
            return $renglones; 
        } 
    }
} 

 
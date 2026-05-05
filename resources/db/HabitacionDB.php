<?php 

 

include_once 'Conexion.php'; 

 

class HabitacionDB { 

    public static function getHabitacions() { 

        $conexion = Conexion::getInstancia(); 

        $dbh = $conexion->getDbh(); 

        try { 

            $consulta = 'SELECT * FROM habitacion ORDER BY habitacion ASC'; 

            $stmt = $dbh->prepare($consulta); 

            $stmt->setFetchMode(PDO::FETCH_BOTH); 

            $stmt->execute(); 

            $colores = $stmt->fetchAll(); 

            $dbh = null; // cierra la conexion 

        } catch (PDOException $e) { 

            echo $e->getMessage(); 

        } 

        return $colores; 

    } 

} 

<?php

include_once 'Conexion.php';

class ItemPedidoDB {

    public static function insertaOrden($idOrden, $idServicio, $cantidad) {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = 'INSERT INTO item_pedido (fk_orden, fk_servicio, cantidad) VALUES (?,?,?)';
            $stmt = $dbh->prepare($consulta);
            $stmt->bindParam(1, $idOrden);
            $stmt->bindParam(2, $idServicio);
            $stmt->bindParam(3, $cantidad);
            $resultado = $stmt->execute();
            $dbh = null; // cierra la conexion
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }

    public static function getDatosItemsOrdenPorIdOrden($idOrden) {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = 'SELECT io.*, s.fk_habitacion, s.precio, i.nombre_archivo  
                FROM item_pedido io
                JOIN pedido o ON o.id = io.fk_orden 
                JOIN servicio s  ON s.id = io.fk_servicio 
                JOIN imagen i ON i.id = s.fk_imagen 
                WHERE o.id = ?';
            $stmt = $dbh->prepare($consulta);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->bindParam(1, $idOrden);
            $stmt->execute();
            $resultado = $stmt->fetchAll();
            $dbh = null; // cierra la conexion
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }

}

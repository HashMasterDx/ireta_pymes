<?php
/* Clase para ejecutar las consultas a la Base de Datos*/
class ejecutarSQL {
    public static function conectar(){
        if(!$con =  new PDO(DSN, USER, PASS)){
            die("Error en el servidor, verifique sus datos");
        }
        return $con;  
    }
    public static function consultar($query) {
        if (!$consul = ejecutarSQL::conectar()->prepare($query)) {
            die('Error en la consulta SQL ejecutada');
        }
        $consul->setFetchMode(PDO::FETCH_NUM);
        $consul->execute();
        $res = $consul->fetchAll();
        return $res;
    }  
}
/* Clase para hacer las consultas Insertar, Eliminar y Actualizar */
class consultasSQL{
    public static function InsertSQL($tabla, $campos, $valores) {
        $consul = ejecutarSQL::conectar()->prepare("insert into $tabla ($campos) VALUES($valores)");
        if (!$consul->execute()) {
            die("Ha ocurrido un error al insertar los datos en la tabla $tabla");
        }
        return $consul;
    }
    public static function DeleteSQL($tabla, $condicion) {
        if (!$consul = ejecutarSQL::consultar("delete from $tabla where $condicion")) {
            die("Ha ocurrido un error al eliminar los registros en la tabla $tabla");
        }
        return $consul;
    }
    public static function UpdateSQL($tabla, $campos, $condicion) {
        if (!$consul = ejecutarSQL::consultar("update $tabla set $campos where $condicion")) {
            die("Ha ocurrido un error al actualizar los datos en la tabla $tabla");
        }
        return $consul;
    }
}
?>
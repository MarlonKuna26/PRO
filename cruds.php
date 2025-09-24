<?php
class CRUD {

    public function selectProductos(){
        include_once 'conexion.php';
        $objetoConexion  = new conexion();
        $conn = $objetoConexion->conectar();
        // Consulta para listar todos los productos
        $sql = "SELECT codigo, nombre, stock FROM productos"; 
        $resultado = $conn->prepare($sql);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);
    }

    public static function deleteProducto(){
        include_once 'conexion.php';
        $objetoConexion  = new conexion();
        $conn = $objetoConexion->conectar();
        // Usaremos 'codigo' como identificador único
        $codigo = $_GET['codigo']; 
        $sqldelete = "DELETE FROM productos WHERE codigo = :codigo";
        $resultado = $conn->prepare($sqldelete);
        $resultado->bindParam(':codigo', $codigo, PDO::PARAM_STR);
        $resultado->execute();
        $data = "Producto eliminado correctamente";
        echo json_encode($data);
    }


    public function insertProducto(){
   
        include_once 'conexion.php';
        $objetoConexion  = new conexion();
        $conn = $objetoConexion->conectar();
        $codigo = $_POST['codigo'];
        $nombre = $_POST['nombre'];
        $stock = $_POST['stock'];
        
        // Asumiendo que la tabla productos tiene (codigo, nombre, stock)
        $sqlinsert = "INSERT INTO productos (codigo, nombre, stock) VALUES (:codigo, :nombre, :stock)";
        $resultado = $conn->prepare($sqlinsert);
        $resultado->bindParam(':codigo', $codigo, PDO::PARAM_STR);
        $resultado->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $resultado->bindParam(':stock', $stock, PDO::PARAM_INT);
        $resultado->execute();
        $data = "Producto insertado correctamente";
        echo json_encode($data);
    }
    
    // Función para aumentar o disminuir el stock
    public function ajustarStock(){
   
        include_once 'conexion.php';
        $objetoConexion  = new conexion();
        $conn = $objetoConexion->conectar();
        
        // Obtener datos por POST (más seguro y adecuado para una acción de actualización)
        $codigo = $_POST['codigo'];
        $cantidad = $_POST['cantidad']; // Puede ser positivo (agregar) o negativo (retirar)
        
        // Consulta para actualizar el stock sumando la cantidad actual + la cantidad proporcionada
        $sqlUpdate = "UPDATE productos SET stock = stock + :cantidad WHERE codigo = :codigo";
        $resultado = $conn->prepare($sqlUpdate);
        $resultado->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
        $resultado->bindParam(':codigo', $codigo, PDO::PARAM_STR);
        $resultado->execute();
        
        $data = "Stock actualizado correctamente por " . ($cantidad > 0 ? "adición" : "retiro");
        echo json_encode($data);
    }
}
?>
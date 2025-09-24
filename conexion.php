<?php
class Conexion{
    public function conectar(){
        $server="localhost";
        $user="root";
        $pass="64470308";
        $database="soaa"; // Asumiendo que usas la misma base de datos 'soa'
    try{
    $conn= new PDO("mysql:host=$server;dbname=$database",$user,$pass);
    }
    catch(Exception $e){
        die("Error: ". $e->getMessage());
    }
    return $conn;

}
// Se elimina la función deleteEstudiante ya que no es necesaria en la clase de conexión
}

?>
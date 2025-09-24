<?php
include_once "cruds.php";
$opc=$_SERVER['REQUEST_METHOD'];
$crud = new CRUD();

switch($opc){
    case 'GET':
        $crud->selectProductos();
        break;
    
    case 'POST':
        // Si la solicitud POST tiene el parámetro 'accion=ajustarStock', llamamos a la función de stock
        if(isset($_POST['accion']) && $_POST['accion'] === 'ajustarStock'){
            $crud->ajustarStock();
        } else {
            // Si no tiene el parámetro de acción, se asume que es una inserción de producto
            $crud->insertProducto();
        }
        break;
        
    case 'DELETE':
        CRUD::deleteProducto();
        break;
    
    // Eliminamos el caso 'PUT' ya que la lógica de actualización se manejará en POST con el ajuste de stock
}
?>
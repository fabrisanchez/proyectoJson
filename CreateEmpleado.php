<?php 

   header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


include_once 'Database.php'; 
include_once 'Empleados.php';  
 
$database = new Database();
$db = $database->getConnection();
  
$item = new Empleados($db); 

$data = json_decode(file_get_contents("php://input"));

if(isset($data))
{
	$item->nombres = $data->nombres;
	$item->apellidos = $data->apellidos;
	$item->telefono = $data->telefono;
	$item->direccion = $data->direccion;
	$item->fechanac = $data->fechanac;
    $item->foto = $data->foto;

     if($item->createEmpleado())
     {
     	echo  json_encode
     	( 
     		array("codigo" => "00",
     	          "message" => "Empleado ingresado con exito")
     	);
     }
     else
	{
	    echo json_encode
     	( 
     		array("codigo" => "01",
     	          "message" => "Empleado no se pudo crear")
     	);	
	}
}
else
{
	echo json_encode
     	( 
     		array("codigo" => "02",
     	          "message" => "Sin informacion por procesar")
     	);
}

?>
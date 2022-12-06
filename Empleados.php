<?php 

class Empleados 
{
		// Objeto de conexion 
		private $conexion;

		// Tabla 
		private $dbtabla = "empleados";
		//Columnas de la table empleados
		public $id;
		public $nombres;
		public $apellidos;
		public $telefono;
		public $direccion;
		public $fechanac;
        public $foto;

		public function __construct($db)
		{
			$this->conexion = $db;
		}
        
        // Create
        public function createEmpleado()
        {
        	$consulta = "INSERT INTO ".
        	            $this->dbtabla . 
        	            "
        	            SET 
        	            nombres   = :nombres,
        	            apellidos = :apellidos,
        	            telefono  = :telefono,
        	            direccion = :direccion,
        	            fechanac  = :fechanac,
                        foto      = :foto";

        	$stmt = $this->conexion->prepare($consulta);
            
            // sanitizacion
            $this->nombres = htmlspecialchars(strip_tags($this->nombres));
            $this->apellidos = htmlspecialchars(strip_tags($this->apellidos));
            $this->telefono = htmlspecialchars(strip_tags($this->telefono));
            $this->direccion = htmlspecialchars(strip_tags($this->direccion));
            $this->fechanac = htmlspecialchars(strip_tags($this->fechanac)); 
            $this->foto = htmlspecialchars(strip_tags($this->foto));

            $stmt->bindParam(":nombres",$this->nombres);
            $stmt->bindParam(":apellidos",$this->apellidos);
            $stmt->bindParam(":telefono",$this->telefono);
            $stmt->bindParam(":direccion",$this->direccion);
            $stmt->bindParam(":fechanac",$this->fechanac);
            $stmt->bindParam(":foto",$this->foto);

            if($stmt->execute())
            {
            	return true;
            }
            return false;
        }


        // Read
		public function getEmpleados()
		{
			$consulta = "SELECT id, nombres, apellidos, telefono, direccion, fechanac, foto FROM " . $this->dbtabla . "";
		    
		    $stmt = $this->conexion->prepare($consulta);
		    $stmt->execute();
		    return $stmt;
		}

        // update

        public function updateEmpleado()
        {
            $consulta = "UPDATE ".
                        $this->dbtabla . 
                        "
                        SET 
                        nombres = :nombres,
                        apellidos = :apellidos,
                        telefono = :telefono,
                        direccion = :direccion,
                        fechanac = :fechanac,
                        foto  = :foto
                        where id = :id";

            $stmt = $this->conexion->prepare($consulta);
            
            // sanitizacion
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->nombres = htmlspecialchars(strip_tags($this->nombres));
            $this->apellidos = htmlspecialchars(strip_tags($this->apellidos));
            $this->telefono = htmlspecialchars(strip_tags($this->telefono));
            $this->direccion = htmlspecialchars(strip_tags($this->direccion));
            $this->fechanac = htmlspecialchars(strip_tags($this->fechanac)); 
            $this->foto = htmlspecialchars(strip_tags($this->foto)); 


            $stmt->bindParam(":id",$this->id);
            $stmt->bindParam(":nombres",$this->nombres);
            $stmt->bindParam(":apellidos",$this->apellidos);
            $stmt->bindParam(":telefono",$this->telefono);
            $stmt->bindParam(":direccion",$this->direccion);
            $stmt->bindParam(":fechanac",$this->fechanac);
            $stmt->bindParam(":foto",$this->foto);

            if($stmt->execute())
            {
                return true;
            }
            return false;
        }


        public function deleteEmpleado()
        {
            $consulta = "DELETE FROM ".$this->dbtabla . " where id = :id";
            
            $stmt = $this->conexion->prepare($consulta);
            
            // sanitizacion
            $this->id = htmlspecialchars(strip_tags($this->id));

            $stmt->bindParam(":id",$this->id);

             if($stmt->execute())
            {
                return true;
            }
            return false;
        }
}



?>
<?php 
class Modelo {
	//Variables utlizadas para las conexiones a la base de datos	
	private static $bdHost = 'localhost';
	private static $bdUsuario = 'root';
	private static $bdPass = 'root';
	private static $bdNombre = 'Agenda'; 
	private $conn;
	protected $query;
	//Variables	para manejar informacion
	protected $Controlador;
	protected $mensajes;
	protected $rows;
	#Se almacena el resultado de la query
	private $resultado;
	//Contructor
	function Modelo(){
		//Se inicializa la variable de mensajes
		$this->mensajes=array();
		$this->datos= array();
	}
	private function abrir_conexion() {
		$this -> conn = new mysqli(self::$bdHost, self::$bdUsuario, self::$bdPass, self::$bdNombre);
	}

	# Desconectar la base de datos
	private function cerrar_conexion() {
		$this -> conn -> close();
	}

	//Funcion utilizada para poder ejecutar una query
	protected function ejecutarQuery() {
		
			$this -> abrir_conexion();
			$this->resultado =  $this -> conn -> query($this -> query);
			$this -> cerrar_conexion();
		
	}
	# Traer resultados de una consulta en un Array
	protected function obtener_resultado() {
		$this -> abrir_conexion();
		$result = $this -> conn -> query($this -> query);
		while ($this -> rows[] = $result -> fetch_assoc());
		$result -> close();
		$this -> cerrar_conexion();
		array_pop($this -> rows);
		return $this->MapearData($this->rows);
	}
	
	private function ObtenerCampos(){
		$array = $this->configCampos();
		return array_merge((array)$array["pKey"],(array)$array["campos"]);
	}
	private function MapearData($array){
		$campos = $this->ObtenerCampos();
		$returnModelo = array();
		$className = get_class($this);
		foreach ($array as $row) {
			$modelo = new $className();
			foreach ($campos as $campo) {
				if(array_key_exists($campo,$row)){
					$modelo->$campo = $row[$campo];
				}
			}
			array_push($returnModelo, $modelo);
		}
		return $returnModelo;
	}
	/**
	*proc_alm_parametro
	* 
	*Funcion que ejecuta un procedimiento almacenado
	*
	*@return Result del procedimiento
	*/
	# Funcion para poder obtener lo que es un parametro de retorno de una ejecucion de un procedimiento almacenado
	protected function proc_alm_parametro() {
		#Se abre la conexion
		$this -> abrir_conexion();
		#se ejecutan multiples querys
		#de esta forma se puede obtener el resultado solicitado
		$this -> conn -> multi_query($this -> query);
		#nos pasamos a la siguiente query que deseamos conocer que seria el retorno de nuestra respuesta
		$this->conn->next_result();
		#Se  obtiene el segundo resultado de la consulta realizada
		$result = $this->conn->store_result();
		#se realiza para poder obtener el dato que deseamos
		$row = $result->fetch_row();
		#se libera la memoria
		$result->free();
		$this->cerrar_conexion();
		#una vez se obtiene se retorna
		return $row[0];
	}
	#Funciones que se sobre escribiran para obtener los parametros necesrios para 
	#La creacion dinamica de campos
	public function configCampos(){}
	public function nombreTabla(){}
	public function mapeoData(){}

	private function GenerarInsertQuery(){
		#Se ejecuta la funcion para obtener los valores de la
		$campo = $this->configCampos();
		$campo = $campo["campos"];
		$insert = "INSERT INTO ".$this->nombreTabla()."(";
		$values = "VALUES(";
		$count 	= count($campo);
		for($i =0; $i< $count; $i++){
			$insert .= $campo[$i];
			$values .= "'".$this->$campo[$i]."'";
			if($count -1 != $i){
				$insert.=",";	
				$values.=",";
			} 
		}
		$this->query = $insert.") ".$values.")";
	}

	private function GenerarUpdateQuery(){
		$campo = $this->configCampos();
		$pKey = $campo["pKey"];
		$campo = $campo["campos"];
		$update = "UPDATE ".$this->nombreTabla(). " SET ";
		$count 	= count($campo);
		for($i =0; $i< $count; $i++){
			$update .= $campo[$i]. " = '".$this->$campo[$i]."'";
			if($count -1 != $i){
				$update.=",";	
			} 
		}
		$this->query = $update." WHERE ".$pKey." = '".$this->$pKey."'";
	}

	private function GenerarDeleteQuery(){
		$campo = $this->configCampos();
		$pKey = $campo['pKey'];
		$this->query = "DELETE FROM ".$this->nombreTabla()." WHERE ".$pKey." = '".$this->$pKey."'";
	}

	public function Guardar(){	
	$campo = $this->configCampos();
	//Se verifica si la llave foranea existe de ser asi sera una actualizacion
	if(!$this->$campo['pKey']){	
		$this->GenerarInsertQuery();
	}else{
		$this->GenerarUpdateQuery();
	}
		$this->ejecutarQuery();
		return $this->resultado;
	}

	public function Eliminar(){
	$campo = $this->configCampos();
		if($this->$campo['pKey']){	
			$this->GenerarDeleteQuery();
		    $this->ejecutarQuery();
		    return $this->resultado;
		}
	}

	public function Data($array){
		$Datos = $this->mapeoData();
		foreach ($Datos as $key => $value) {
			if(array_key_exists($value,$array)){
				$this->$key = $array[$value];
			}
		}
	}

	public function ContruirObjetos(){
		$objeto =  new stdClass();

	}
	public function Encontrar($variables = array()){
		$tabla = $this->nombreTabla();
		$query = "Select * From ".$tabla." Where";
		$i = 0;
		foreach ($variables as $key => $value) {
			if($i>0) $query.= " And ";
			$query.=" $key = '$value'";
			$i++;
		}
		$this->query = $query;
		return $this->obtener_resultado();

	}
}
?>
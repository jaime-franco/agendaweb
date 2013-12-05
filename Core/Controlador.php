<?php
//---------------------------------------------------------------------
//Clase principal de los controladores
//De esta clase heredaran todos los controles
//--------------------------------------------------------------------- 
class Controlador {
	//Variables internas utilizadas para manejar datos dentro del controlador
	//Variables que obtiene los datos sobre los datos de tipo POST y GET
	protected $datosPost;
	protected $datosGet;
	//Se guardar la uri utilizada en la peticion hecha
	protected $uri;
	//Se tiene el nombre de la clase 
	protected $nombre;
	//Se poseen las posibles peticiones que se pueden realizar sobre la pagina
	protected $peticiones;
	//Se tiene el nombre de la peticion que se realizo
	public $peticion;
	//Se hace referencia hacia el modelo que se creo
	public $modelo;
	//Se hace referencia hacia un conjunto de variables que se encuentran disponibles
	public $variables  = array();
	//Utilizados para obtener la informacion acerca de la jerarquia de carpetas 
	public $urlBase='';
	public $rutaBase='';
	public $directorio='';
	public $autentificacion;
	//Constructor de la clase 
	function Controlador(){
		//Se carga la clase de autentificacion
		$this->autentificacion = new Autentificacion;
		//Se obtiene el nombre de la clase
		$this->nombre= get_class($this);
		$this->ObtenerRutaBase();	
		$this->ObtenerURLBase();
		//Se obtiene la Uri
		$this->ObtenerUri();
		//Se otbiene los parametros Get y Post si es que hay
		$this->CargarDatosGet();
		$this->CargarDatosPost();
	}
	

	function ObtenerURLBase(){
		$url = $_SERVER["REQUEST_URI"];
		$charCount = strpos($url, "MVC");
		$this->urlBase = substr($url, 0,$charCount);
		$this->directorio="/".basename(dirname($_SERVER['PHP_SELF']));
	}

	function ObtenerRutaBase(){
		//Se obtiene la ruta completa desde el servidor del archivo
		$ruta = getcwd();
		$charCount = strpos($ruta, "MVC");
		$this->rutaBase = substr($ruta, 0,$charCount);
			
	}
	//Funcion para obtener datos de las variables cargadas en el controlador
	function ObtenerVariable($variable = ''){
		if(key_exists($variable, $this->variables)){
			return $this->variables[$variable];	
		}
		return '';
	}
	//Clases utilizadas dentro del controlador
	function CargarDatosPost(){
		//Se crea un array para contener los datos
		$this->datosPost = array();
		//Se verifica si es un post
		if($_POST){	
			foreach($_POST as $llave=>$valor){
				
				//Se pasa el valor a la variable
				$this->datosPost[$llave] = $valor;
			}//Fin foreach
		}//fin if($_POST)
	}//Fin ObtenerDatosPost
	
	
	function CargarDatosGet(){
		//Se crea un array para contener los datos
		$this->datosGet = array();
		//Se verifica si es un post
		if($_GET){
			foreach($_GET as $llave=>$valor){
				//Se pasa el valor a la variable
				$this->datosGet[$llave] = $valor;
			}//Fin foreach
		}//fin if($_GET)
	}//Fin ObtenerDatosGet
	
	
	function ObtenerUri(){
		//Se pide la URI del server
		$this->uri = $_SERVER['REQUEST_URI'];
	}
	function Redireccionar($url){
		header("Location: $url");
		die();
	}
	//Funcion para cargar una vista basada en una clase en esta caso esta 
	//debe estar en la ruta "/MVC/Nombre_controlador"
	function ObtenerObjetoVista($vista=''){
		$objetoVista= NULL;
		//Si pasa un parametro de vista	
		if(isset( $vista)){
			include_once($vista.".php");
			//Se crea el objeto de tipo vista que se llama
			$objetoVista = new $vista();
			//Se le pasan los datos del controlador para tener acceso a ellos
			$objetoVista->Controlador = $this;
		}//Fin if $vista
		return $objetoVista;
	}//Fin funcion ObtenerVista
	//Funcion para cargar o incluir un plugin
	function CargarPlugin($plugin =''){
		if(isset($plugin)){
			$ruta = $this->rutaBase."Plugin/".$plugin.".php";
			if(file_exists($ruta)){
				include_once($ruta);
			}else
				{
					echo "El plugin $plugin no existe";
				}
		}
	}
	//Funcion para cargar una vista de un archivo .php que se debe encontrar
	//En el directorio "/PHP/Nombre_controlador/"
	function CargarVistaPhp($vista=''){
		//Si pas un parametro de vista valido
		if(isset($vista)){
			$ruta= $this->rutaBase."PHP".$this->directorio."/".$vista.".php";
			//Se incluye el archivo php que se utilizara para mostrar la vista
			//Hecha en php
			if(file_exists($ruta)){
				include_once($ruta);
			}
			else{
				echo "El achivo ".$vista.".php no se encontro en la ruta $ruta";
			}
		}
	}
	//Funcion para cargar una plantilla base 
	function CargarPlantillaPhp($vista=''){
		//Si pas un parametro de vista valido
		if(isset($vista)){
			//Se carga desde la ruta de la carpeta indicada
			$ruta= $this->rutaBase."PHP/Plantilla/".$vista.".php";
			//Se incluye el archivo php que se utilizara para mostrar la vista
			//Hecha en php
			if (file_exists($ruta)){
				include_once($ruta);
			}else{
				echo "El archivo : ".$vista.".php no se encontro en la ruta $ruta";
			}
		}
	}
	function ObtenerNombre(){
		return $this->nombre;
	}//Fin ObtenerNombre
	
		
		
	function CargarModelo($modelo='',$modulo=''){
		$objetoModelo = NULL;
		if( $modulo != ''){
			include_once("../$modulo/$modelo.php");
				//Se crea el modelo
			$objetoModelo = new $modelo();
			//Se asigna el controlador
			$this->modelo= $objetoModelo;
		}else if(isset($modelo)){
			//Se incluye la clase del modelo que se necesita
			include_once($modelo.".php");
			//Se crea el modelo
			$objetoModelo = new $modelo();
			//Se asigna el controlador
			$this->modelo= $objetoModelo;
		}
	//Se retorna el objeto
		return $objetoModelo;
	}
	
	function ObtenerPost($dato = ''){
		//Se verifica si el dato pedido existe de lo contrario se 
		//retorna un dato null
		if(array_key_exists($dato, $this->datosPost)){
			return $this->datosPost[$dato];
		}
		return '';
	}
	
	function ObtenerGet($dato = ''){
		//Se verifica si el dato pedido existe de lo contrario se 
		//retorna un dato null
		if(array_key_exists($dato, $this->datosGet)){
			return $this->datosGet[$dato];
		}
		return '';
	}
	
	function VerificarUri(){
		//Se toma por defecto la primera peticion encontrada de no
		//Haber ninguna que coincida

		if(isset($this->peticiones)){
			$this->peticion = $funtionPeticion = $this->peticiones[0];
			//Se recorren todas las peticiones posibles
			foreach ($this->peticiones as $peticion) {
				//Se crea una Uri para comprobar la validez de la Uri
				$uri_peticion = $this->nombre."/".$peticion;
				//Se pasa a Mayusculas para hacer una mejor comparacion
				$uri = strtoupper($this->uri);
				$uri_peticion = strtoupper($uri_peticion);
				if (strpos($uri, $uri_peticion) == true) {
					#Se retorna la peticions
					$funtionPeticion = $peticion;
					$this->peticion= $peticion;
					break;
				}
			}//Fin Foreach
			$this->$funtionPeticion();
		}
		return;
	}

}
?>
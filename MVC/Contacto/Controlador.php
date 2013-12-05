<?php 
//Se incluye el archivo maestro que permite incluir todos los archivos 
//Que se utilizaran dentro del framework :D
include_once("../MasterInclude.php");

//Es importante destacar que la clase que herede del controlador
//Debe tener el nombre de las carpetas y el modulo que representa
//ya que el framework lo utilizara para encontrar todos los archivos
class Contacto extends  Controlador{
	//Funcion de inicio de la clase 
	public $User;
	public function Iniciar(){
		$this->User = $User = $this->autentificacion->getUser();
	//En este caso se hace la asignacion de las posibles peticiones
		$this->peticiones = array('Mostrar','Agregar','Eliminar','Modificar');
	//Luego se verifica la peticion y se llama a la funcion con la que 
	//concuerde la peticion
		$this->VerificarUri();
	}	

	public function Mostrar(){
		$modelo = $this->CargarModelo('DBContacto');
		$this->variables['TituloHTML'] = "Contactos";
		$this->variables['Titulo']= "Contactos";
		//Obteniendo todos los contactos pertenecientes al usuario logeado 
		$this->variables['modelos']= $modelo->Encontrar(array("id_usuario"=>$this->User->id));;
		//Cargando la plantilla basica
		$this->CargarPlantillaPhp('plantilla_basica_tabla');

	} 
	public function Agregar(){
		$modelo = $this->variables['modelo'] = $this->CargarModelo('DBContacto');
		$this->variables['Titulo'] = "Agregar Contacto";
		$this->variables['TituloHTML'] = "Agregar Contacto";
		if($_POST){
			$modelo->Data($_POST);
			$user = $this->autentificacion->getUser();
			$modelo->id_usuario = $user->id;
			if($modelo->Guardar()){
			//	echo 'Guardado';
			//	exit;
			}
			//echo $modelo->Guardar();
			//exit;
		}

		$this->CargarPlantillaPhp('Plantilla_basica_in');
	}
	public function Eliminar(){
		//Cargando el modelo y guardandolo en una variable
		$modelo = $this->CargarModelo('DBContacto');
		//Colocando el encabezado y el valor del boton 
		$this->variables['Titulo'] = "Eliminar Contacto";
		$this->variables['TituloHTML'] = "Eliminar Contacto";
		$this->variables['accion']=  "Eliminar Contacto";
		//Verificando si es un POST	
		if($_POST){
			//Si es un post con un id_busqueda solo se muestra el formulario con los datos
			if(array_key_exists('id_busqueda', $_POST)){
				$modelo->id_contacto = $_POST['id_busqueda'];
				$modelo->Eliminar();
				$this->CargarPlugin('Mensajes');
				$mensaje = new Mensajes;
				$this->variables['mensaje'] = $mensaje->Confirmacion(1);
			}
		}
		$this->variables['modelos']= $modelo->Encontrar(array("id_usuario"=>$this->User->id));
		
		$this->variables['modelo'] = $modelo;
		$this->CargarPlantillaPhp('Plantilla_basica_in');
	}
	public function Modificar(){
		//Cargando el modelo y guardandolo en una variable
		$modelo = $this->CargarModelo('DBContacto');
		//Colocando el encabezado y el valor del boton 
		$this->variables['Titulo'] = "Modificar Contacto";
		$this->variables['TituloHTML'] = "Modificar Contacto";
		$this->variables['accion']="Modificar Contacto";
		$this->variables['formulario']=true;
		//Verificando si es un POST	
		if($_POST){
			//Si es un post con un id_busqueda solo se muestra el formulario con los datos
			if(array_key_exists('id_busqueda', $_POST)){
				$modelos = $modelo->Encontrar(array("id_contacto"=>$_POST['id_busqueda']));
				$modelo = $modelos[0];
			}else{
				//Si es un post y no hay un id_busqueda quiere decir que se guardaran los datos
				$modelo->Data($_POST);
				//Se añade el id del usuario
				$modelo->id_usuario = $this->User->id;
				$modelo->Guardar();
			}
		}else if(array_key_exists("id", $_GET)){
			$modelos = $modelo->Encontrar(array("id_contacto"=>$_GET['id']));
			if(count($modelos)>0){
				$modelo = $modelos[0];
			}else{
				$this->CargarPlugin('Mensajes');
				$mensaje = new Mensajes;
				$this->variables['mensaje'] = $mensaje->CustomAlerta("No se encontro usuario con id = ".$_GET['id']);
				$this->variables['modelos']= $modelo->Encontrar(array("id_usuario"=>$this->User->id));
				$this->variables['formulario'] = false;
			}
		}
		else{
			//Si no es un POST se cargan los datos que se mostraran en el combobox
				$this->variables['modelos']= $modelo->Encontrar(array("id_usuario"=>$this->User->id));
				$this->variables['formulario'] = false;
		}
		$this->variables['modelo'] = $modelo;
		$this->CargarPlantillaPhp('Plantilla_basica_in');
	}
}//Fin Clase Login
//Se crea un objeto de tipo controlador para poder utilizar el controlador
$controlador = new Contacto();
//Se inicia el comportamiento del controlador
$controlador->Iniciar();
?>
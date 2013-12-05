<?php 
//Se incluye el archivo maestro que permite incluir todos los archivos 
//Que se utilizaran dentro del framework :D
include_once("../MasterInclude.php");

//Es importante destacar que la clase que herede del controlador
//Debe tener el nombre de las carpetas y el modulo que representa
//ya que el framework lo utilizara para encontrar todos los archivos
class Login extends  Controlador{
	//Funcion de inicio de la clase 
	
	function Iniciar(){
	//En este caso se hace la asignacion de las posibles peticiones
		$this->peticiones = array('Mostrar','Ingresar');
	//Luego se verifica la peticion y se llama a la funcion con la que 
	//concuerde la peticion
		$this->VerificarUri();
	}	

	function Mostrar(){
		//Se Coloca el titulo
		$this->variables['Titulo']= "Inicio de Sesión";
		$this->variables['TituloHTML'] = "Login Agenda";
		//Se carga el modelo DBLogin y se pasa a la plantilla
		$modelo = $this->CargarModelo('BDLogin');
		$this->variables['modelo'] = $modelo;
		//Se carga la plantilla basica
		$this->CargarPlantillaPhp('Plantilla_basica');	
	}
	
	function Ingresar(){
		//Se carga el modelo para realizar el login
		$modelo = $this->CargarModelo('BDLogin');
		$modelo->Data($this->datosPost);
		if(	$modelo->verificarLogin()){
			$this->autentificacion->iniciarSesion($modelo);
			$this->Redireccionar('/Contacto/');
		}else{
			$this->CargarPlugin('Mensajes');
			$mensaje = new Mensajes;
			$this->variables['mensaje'] = $mensaje->Alerta(0);
			$htis->variables['TituloHTML'] = "Login Agenda";
			$this->peticion = "Mostrar";
			$this->Mostrar();	
		}
	}
}//Fin Clase Login
//Se crea un objeto de tipo controlador para poder utilizar el controlador
$login = new Login();
//Se inicia el comportamiento del controlador
$login->Iniciar();
?>
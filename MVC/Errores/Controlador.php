<?php 
//Se incluye el archivo maestro que permite incluir todos los archivos 
//Que se utilizaran dentro del framework :D
include_once("../MasterInclude.php");

//Es importante destacar que la clase que herede del controlador
//Debe tener el nombre de las carpetas y el modulo que representa
//ya que el framework lo utilizara para encontrar todos los archivos
class Errores extends  Controlador{
	//Funcion de inicio de la clase 
	
	function Iniciar(){
	//En este caso se hace la asignacion de las posibles peticiones
		$this->peticiones = array('Error404');
	//Luego se verifica la peticion y se llama a la funcion con la que 
	//concuerde la peticion
		$this->VerificarUri();
	}	

	function Error404(){
		//Se Coloca el titulo
		$this->variables['Titulo']= "Pagina no Encontrada";
		$this->variables['TituloHTML'] = "Pagina no  Encontrada";
		//Se carga la plantilla basica
		$this->CargarPlantillaPhp('Plantilla_basica');	
	}
	
}//Fin Clase Errores
//Se crea un objeto de tipo controlador para poder utilizar el controlador
$errores = new Errores();
//Se inicia el comportamiento del controlador
$errores->Iniciar();
?>
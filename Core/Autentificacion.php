<?php
	//Se inicia la sesion
	session_start();
	//Funciones para realizar las operaciones dentro de las sesiones
	class Autentificacion {
	function Autentificacion (){
		
	}
	function iniciarSesion($modelo=""){
		//Se crea una nueva clase para almacenar la informacion
		$user = new StdClass();
		$user->id = 1;//$modelo->id_usuario;
		$user->tipo = 1;//$modelo->tipo;
		$user->nombre = "Administrador";//$modelo->nombre;
		$user->estado = 1;//$modelo->estado;

		$_SESSION["User"]= $user;
		
	}

	function getUser(){
		$this->iniciarSesion();
		return $_SESSION["User"];
	}

	function autentificar($tipo){
		if(array_key_exists("tipo",$_SESSION)){
			if($_SESSION['tipo']=="ambos") return;
			switch ($tipo) {
				case 'administrador':
					if($_SESSION['tipo']!='administrador'){
						header("Location: ../../login");
					}
					break;
				case 'usuario':	
					if($_SESSION['tipo']!='usuario'){
						header("Location: ../../login");
					}
					break;
				default:
					header("Location: ../login");
					break;
			}
		}
		else{
				header("Location: ../login");
		}
	}
	
	function cerrarSesion(){
	#Se limpian las variables de sesion utilizadas
	unset(	$_SESSION['User']);
	#se destruye la sesion
	session_destroy();
	#se redirecciona a el login
	header("Location: /login");
	}
}
?>
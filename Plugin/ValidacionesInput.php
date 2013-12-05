<?php 
	class ValidacionesInput{
		public $mensaje;
		//Constructor de la funcion
		function __construct(){
		
		}
		//Se valida que se ha introducino un correo correctamente
		//El campo representa la informacion del campo
		function ValidarCorreo($campo,$mensaje){
			if(!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/",$email))
 			 {
				$this->mensaje.= $mensaje;
  			 }
		}
		//Funcion utilizada para validar una expresion regular ya sea 
		//Para validar numeros , o otro tipo de campos especiales
		function ValidarExpresion($campo,$patron,$mensaje)
		{
			if(!preg_match($patron, $campo)){
				$this->mensaje.= $mensaje;
			}
		}
		//Funcion para validar un grupo de campos de los cuales se requiere
		//Que exista almenos uno de ellos para poder ser validado
		function Requeridos($num,$campos,$mensaje){
			$conteo = 0;
			foreach ($campos as $key => $value) {
				if($value!=''){
					$conteo++;
				}
			}
			if($conteo<$num){
				$this->mensaje.=$mensaje;
			}
		}
		//Funcion utilizadad para validar que un elemento pasado a ella 
		//contenga datos ya que es requerido para el proceso
		function Requerido($campo,$mensaje){
			if(trim( $campo) ==''){
				$this->mensaje.=$mensaje;
			}
		}
	}
?>
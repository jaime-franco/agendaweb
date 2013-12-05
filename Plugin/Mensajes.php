<?php 
	class Mensajes{
		//Mensajes de alerta
		private $_alertas = array(
			"0"=> "Los datos ingresados son Incorrectos.",
			);
		//Mensajes de confirmacion sobre acciones
		private $_confirmacion = array(
			"0"=> "Datos agregados correctamente.",
			"1"=> "El Contacto fue eliminado exitosamente."
			);
		
		public function Alerta ($id){
			return '<div class="alerta">'.$this->_alertas[$id].'</div>';
		}

		public function Confirmacion($id){
			return '<div class="confirmado">'.$this->_confirmacion[$id].'</div>';
		
		}
		
		public function CustomAlerta($mensaje){
			return '<div class="alerta">'.$mensaje.'</div>';
		}
		
		public function CustomConfirmacion($mensaje){
			return '<div class="confirmado">'.$mensaje.'</div>';
		}
	}
?>
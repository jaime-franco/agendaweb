<?php
	#Se crea la clase Login que nos permetira manejar el login
	class BDLogin extends Modelo{
	#Campos de la tabla a utilizar
		public $id_usuario;
		public $nombre;
		public $clave;
		public $salt;
		public $tipo;
		public $estado;
		#Funcion que devolvera los campos de la tabla en 
		#Un array separando los id de los campos normales
		public function configCampos(){
			return array(
				"pKey"=>"id_usuario",
				"campos"=>array(
					"nombre",
					"clave",
					"salt",
					"estado"
					),
				);
		}
		#Funcion que devolvera el nombre de la tabla
		public function nombreTabla(){
			return "Usuario";
		}
		#Funcion que devolvera la forma en que se mapeara la data
		public function mapeoData(){
			return array(
				"id_usuario"=>"id_user",
				"nombre"=>"usuario",
				"clave"=>"pass",
				"tipo"=>"rol",	
				"estadp"=>"estado",			
				);
		}
		#Funcion para verificar login y añadir data
		public function verificarLogin(){
			$modelos = $this->Encontrar(array("nombre"=>$this->nombre));
			foreach ($modelos as $modelo) {
				if(md5($this->nombre.$this->clave.$modelo->salt) == $modelo->clave) {
					$this->id_usuario = $modelo->id_usuario;
					$this->tipo = $modelo->tipo;
					$this->estado = $modelo->estado;
					return true;
				}
			}
			return false;
		}
	}
 ?>
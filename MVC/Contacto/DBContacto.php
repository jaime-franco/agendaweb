<?php
	#Se crea la clase Login que nos permetira manejar el login
	class DBContacto extends Modelo{
	#Campos de la tabla a utilizar
		public $id_contacto;
		public $id_usuario;
		public $nombres;
		public $apellidos;
		public $direccion;
		public $tel_trabajo;
		public $tel_movil;
		public $correo;
		#Funcion que devolvera los campos de la tabla en 
		#Un array separando los id de los campos normales
		public function configCampos(){
			return array(
				"pKey"=>"id_contacto",
				"campos"=>array(
					"id_usuario",
					"nombres",
					"apellidos",
					"direccion",
					"tel_trabajo",
					"tel_movil",
					"correo",
					),
				);
		}
		#Funcion que devolvera el nombre de la tabla
		public function nombreTabla(){
			return "Contacto";
		}
		#Funcion que devolvera la forma en que se mapeara la data
		public function mapeoData(){
			return array(
					"id_contacto"=>"id_contacto",
					"id_usuario"=>"id_usuario",
					"nombres"=>"nombres",
					"apellidos"=>"apellidos",
					"direccion"=>"direccion",
					"tel_trabajo"=>"tel_trabajo",
					"tel_movil"=>"tel_movil",
					"correo"=>"correo",	
				);
		}
	}
 ?>
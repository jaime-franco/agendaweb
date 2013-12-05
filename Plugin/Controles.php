<?php 
//Clase para poder utilizar ComboBox
	class Controles{
		//Controles para modelos
		public function Textbox($model,$field,$properties=array()){
			return $this->GenerateInput("text",$field,$properties,$model);
		}
		public function Email($model,$field,$properties=array()){
			return $this->GenerateInput("email",$field,$properties,$model);	
		}
		public function Hidden($model,$field,$properties=array()){
			return $this->GenerateInput("hidden",$field,$properties,$model);
		}
		public function Password($model,$field,$properties=array()){
			return $this->GenerateInput("password",$field,$properties,$model);
		}
		private function GenerateInput($type,$field,$properties,$model){
			$name = $model->mapeoData();
			$name = $name[$field];
			$value = $model->$field;
			$input = "<input type = \"$type\" name = \"$name\"  id = \"$name\" value = \"$value\"";
			foreach ($properties as $key => $value) {
				$input .= $key." = \"".$value."\"";
			}
			$input .= "/>";
			return $input;
		}

		public function DropDownList($model=null,$field,$properties=array(),$values=array()){
			if(is_null($model)){
				return $this->_DropDownList($field,$properties,$values);
			}
			$name = $model->mapeoData();
			$name = $name[$field];
			$valueField = $model->$field;
			$dropDown = "<select name=\"$name\" id = \"$name\">\n";
			foreach ($values as $key => $value) {
				if($key == $valueField)
					$dropDown.="<option value=\"$key\" selected>".$value."</option>\n";
				else
					$dropDown.="<option value=\"$key\">".$value."</option>\n";
			}
			$dropDown.="</select>";
			return $dropDown;
		}
		//Controles sin Modelo
		public function _DropDownList($field,$properties=array(),$values=array()){
			$dropDown = "<select  id=\"$field\" name=\"$field\">\n";
			foreach ($values as $key => $value) {
					$dropDown.="<option value=\"$key\">".$value."</option>\n";
			}
			$dropDown.="</select>";
			return $dropDown;
		}
	}

?>
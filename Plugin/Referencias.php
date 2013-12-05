<?php 
class Referencias {
	public $JavaScript;
	public $css;	
	public $urlBase;
	function referencias($urlBase=''){
		$this->urlBase=$urlBase;
	}
	function Imprimir(){
		$referencias ="";
		if(!empty( $this->JavaScript)){
			foreach($this->JavaScript as $script){
				$referencias.= "<script type='text/javascript' src='".$this->urlBase."JS/$script.js'></script>\n";
			}
			
		}
		if(!empty($this->css)){
			foreach($this->css as $css){
				$referencias.= "<link href='/CSS/$css.css' type='text/css' rel='stylesheet' />\n";
			}
		}
		print $referencias;
	}
}
?>
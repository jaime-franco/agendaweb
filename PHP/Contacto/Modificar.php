<?php 
if($this->ObtenerVariable('formulario'))
	$this->CargarVistaPhp('_form');
else
	$this->CargarVistaPhp('_dropdown');
?>
<?php 
	$this->CargarPlugin('Controles');
	$form = new Controles();
	$modelo = $this->ObtenerVariable('modelo');
	$bValue = $this->ObtenerVariable('accion');
	$modelos = $this->ObtenerVariable('modelos');
	$dValues =  array();
	foreach ($modelos as $value) {
		$dValues[$value->id_contacto] = $value->nombres ." ".$value->apellidos;
	}
?>
<?php echo $this->ObtenerVariable('mensaje') ?>
	<div class="section">
		<h1><?php echo $this->ObtenerVariable('Titulo'); ?></h1>	
	<form method="post" action=<?php echo "'".$this->peticion."'"?> class="formulario">
		<div class="columna">
			<label for="id_busqueda"> Nombre:</label> 
			<?php echo $form->DropDownList(null,"id_busqueda",array("required"=>''),$dValues);?>
			<input type="submit" value=<?echo "'".$bValue."'";?>/>
		</div>
		</form>
	</div>

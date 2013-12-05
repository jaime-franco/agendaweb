<?php 
	$this->CargarPlugin('Controles');
	$form = new Controles();
	$modelo = $this->ObtenerVariable('modelo');
	$bValue = ($modelo->id_contacto == "") ? "Guardar" : "Actualizar";
?>
<?php echo $this->ObtenerVariable('mensaje') ?>
	<div class="section">
		<h1><?php echo $this->ObtenerVariable('Titulo'); ?></h1>	
	<form method="post" action=<?php echo "'".$this->peticion."'"?> class="formulario">
		<div class="columna">
			<?php echo $form->Hidden($modelo,"id_contacto");?>
			<label for="nombres"> Nombre:</label> 
			<?php echo $form->Textbox($modelo,"nombres");?>
			<label for="apellidos"> Apellidos:</label>
			<?php echo $form->Textbox($modelo,"apellidos");?>
			<label for="direccion"> Dirección:</label>
			<?php echo $form->Textbox($modelo,"direccion");?>
			<label for="tel_trabajo"> Telefono Trabajo: </label>
			<?php echo $form->Textbox($modelo,"tel_trabajo");?>
			<label for="tel_movil"> Telefono Movil:</label>
			<?php echo $form->Textbox($modelo,"tel_movil");?>
			<label for="correo"> Correo:</label>
			<?php echo $form->Textbox($modelo,"correo");?>
			<input type="submit" value=<?echo "'".$bValue."'";?>/>
		</div>
		</form>
	</div>

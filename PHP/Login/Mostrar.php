<?php 
	echo $this->ObtenerVariable('mensaje');
	$this->CargarPlugin('Controles');
	$modelo =  $this->ObtenerVariable('modelo');
	$form = new Controles;

?>
	<div class="flotador" ></div>
	<div class="login-window">
		<h1>
		<?php echo $this->ObtenerVariable('Titulo'); ?>
		</h1>	
	<form method="post" action="Ingresar" class="formulario">
		<div class="columna">
			<label for="usuario">Usuario:</label>
			<? echo $form->Textbox($modelo,'nombre') ?>
			<label for="pass">Contrase&ntilde;a:</label>
			<? echo $form->Password($modelo,'clave') ?>
			<input type="submit" value="Iniciar Sesi&oacute;n"/>
		</div>
		</form>
	</div>
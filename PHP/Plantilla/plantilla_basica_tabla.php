<?php header('Content-type: text/html; charset=utf-8');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<title><?php echo $this->ObtenerVariable('TituloHTML')?></title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<?php 
			//Se carga el plugin de las referencias para colocarlas
			$this->CargarPlugin('Referencias');
			//Se coloca la url base para poder agregar lo que son las hojas de estilo en cascada
			$referencias = new Referencias($this->urlBase);
			$referencias->css = array('main','Formulario','navegacion','responsivetable');
			//Se imprimen las referencias de las hojas de estilo de cascada
			$referencias->Imprimir();
		?>
</head>

<body>
	<div class="header">
		
				<img src="/CSS/Imagenes/agenda.gif"  height="32" width="32" alt="Icono Agenda"/>
				<span class="nombreApp">Agenda Web</span>
		
	</div>
    <?php $this->CargarVistaPhp($this->peticion); 
    $this->CargarPlantillaPhp('footer');?>
</body>
</html>
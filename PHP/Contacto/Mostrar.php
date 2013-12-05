<?php 
	$modelos = $this->ObtenerVariable('modelos');
?>
<div class="section">
		<h1>
		<?php echo $this->ObtenerVariable('Titulo'); ?>
		</h1>	
<table>
	<tr class="headers">
		<th>Nombres</th>
		<th>Apellidos</th>
		<th>Dirección</th>
		<th>Telefono Trabajo</th>
		<th>Telefono Movil</th>
		<th>Email</th>
	</tr>
	<?php 
	foreach ($modelos as $modelo) {
		echo "<tr>"
			 ."<td>$modelo->nombres</td>"
			 ."<td>$modelo->apellidos</td>"
			 ."<td>$modelo->direccion</td>"
			 ."<td>$modelo->tel_trabajo</td>"
			 ."<td>$modelo->tel_movil</td>"
			 ."<td>$modelo->correo</td>"
			 ."</tr>";
	}
		?>
</table>
</div>
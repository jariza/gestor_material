<h1>Detalle de objeto</h1>
<?php
	echo "<p>\n\t<ul>\n";
	echo "\t\t<li>Id: {$objeto['Objeto']['id']}</li>\n";
	echo "\t\t<li>Descripción: {$objeto['Objeto']['descripcion']}</li>\n";
	echo "\t\t<li>Ubicación: {$objeto['Ubicacion']['nombre']}</li>\n";
	echo "\t\t<li>Fungible: ";
	if ($objeto['Objeto']['fungible']) {
		echo "si</li>\n";
		echo "\t\t<li>Cantidad: {$objeto['Objeto']['cantidad']}</li>\n";
	}
	else {
		echo "no";
	}
	$fechaentrega = $objeto['Objeto']['fechaentrega'];
	if ($fechaentrega != '0000-00-00 00:00:00') {
		echo "\t\t<li>Fecha de entrega: $fechaentrega</li>\n";
		echo "\t\t<li>Comentarios sobre la entrega: {$objeto['Objeto']['comentariosentrega']}</li>\n";
	}
	echo "\t\t<li>Comentarios: {$objeto['Objeto']['comentarios']}</li>\n";
	echo "\t\t<li>Creado: {$objeto['Objeto']['created']}</li>\n";
	echo "\t\t<li>Modificado: {$objeto['Objeto']['modified']}</li>\n";
	echo "\t</ul>\n</p>\n";
	echo "<p>".$this->Html->link('Volver al listado de objetos', array('action' => 'index'))."</p>";
?>

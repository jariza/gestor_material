<h1>Detalle de zona</h1>
<?php
	$zona['Zona'] = array_map('htmlspecialchars', $zona['Zona']);
	echo "\t<ul>\n";
	echo "\t\t<li>Id: {$zona['Zona']['id']}</li>\n";
	echo "\t\t<li>Nombre: {$zona['Zona']['nombre']}</li>\n";
	echo "\t\t<li>Creada: {$zona['Zona']['created']}</li>\n";
	echo "\t\t<li>Modificada: {$zona['Zona']['modified']}</li>\n";
	echo "<p>Descripción técnica:</p>\n";
	echo "<pre>{$zona['Zona']['desctecnica']}</pre>\n";
	echo "\t</ul>\n";
	echo "<p>".$this->Html->link('Volver al listado de zonas', array('action' => 'index'))."</p>";
?>

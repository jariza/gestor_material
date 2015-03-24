<h1>Detalle de la actividad</h1>

<?php
	$actividad['Actividad'] = array_map('htmlspecialchars', $actividad['Actividad']);
	echo "\t<ul>\n";
	echo "\t\t<li>Id: {$actividad['Actividad']['id']}</li>\n";
	echo "\t\t<li>Nombre: {$actividad['Actividad']['nombre']}</li>\n";
	echo "\t\t<li>Zona: {$actividad['Zona']['nombre']}</li>\n";
	echo "\t\t<li>Inicio: {$actividad['Actividad']['inicio']}</li>\n";
	echo "\t\t<li>Fin: {$actividad['Actividad']['fin']}</li>\n";
	echo "\t\t<li>Enlace web: ";
	$enlaceweb = $actividad['Actividad']['enlaceweb'];
	if ($enlaceweb== '') {
		echo 'No indicado';
	}
	else {
		echo "<a href=\"$enlaceweb\" target=\"_blank\">$enlaceweb</a>";
	}
	echo "</li>\n";
	echo "\t\t<li>Creado: {$actividad['Actividad']['created']}</li>\n";
	echo "\t\t<li>Modificado: {$actividad['Actividad']['modified']}</li>\n";
	echo "\t</ul>\n</p>\n";
	echo "<p>Descripción técnica:";
	echo "<pre>{$actividad['Actividad']['desctecnica']}</pre>\n";
	echo "<p>".$this->Html->link('Volver al listado de actividades', array('action' => 'index'))."</p>";
?>

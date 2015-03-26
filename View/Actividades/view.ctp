<h1>Detalle de la actividad</h1>

<?php
	$actividad['Actividad'] = array_map('htmlspecialchars', $actividad['Actividad']);
	echo "\t<ul>\n";
	echo "\t\t<li>Id: {$actividad['Actividad']['id']}</li>\n";
	echo "\t\t<li>Nombre: {$actividad['Actividad']['nombre']}</li>\n";
	echo "\t\t<li>Zona: {$actividad['Zona']['nombre']}</li>\n";
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
	echo "\t<h2>Horario</h2>\n\t<table>";
	echo "\t<tr><th>Inicio</th><th>Fin</th></tr>\n";
	foreach ($actividad['Horario'] as $v) {
		echo "\t\t<tr><td>";
		echo date('D, j/M/Y G:i:s', strtotime($v['inicio']));
		echo "</td><td>";
		echo date('D, j/M/Y G:i:s', strtotime($v['fin']));
		echo "</td></tr>\n";
	}
	echo "\t</table>\n";
	echo "\t<h2>Necesidades de la actividad</h2>\n\t<table>";
	echo "\t<tr><th>Id</th><th>Descripción</th><th>Cantidad</th><th>Objeto asignado</th></tr>\n";
	foreach ($actividad['Necesidadactividad'] as $v) {
		if (is_null($v['objeto_id'])) {
			$txtdescripcion = '';
		}
		else {
			$txtdescripcion = htmlspecialchars($v['Objeto']['descripcion']);
		}
		echo "\t\t<tr><td>{$v['id']}</td><td>".htmlspecialchars($v['descripcion'])."</td><td>{$v['cantidad']}</td><td>$txtdescripcion</td></tr>\n";
	}
	echo "\t</table>\n";
	echo "<p>".$this->Html->link('Volver al listado de actividades', array('action' => 'index'))."</p>";
?>

<h1>Detalle de zona</h1>
<?php
	$zona['Zona'] = array_map('htmlspecialchars', $zona['Zona']);
	echo "\t<ul>\n";
	echo "\t\t<li>Id: {$zona['Zona']['id']}</li>\n";
	echo "\t\t<li>Nombre: {$zona['Zona']['nombre']}</li>\n";
	if ($zona['Zona']['calendarioext'] != '0') {
		if ($zona['Zona']['sync_calext'] != '0000-00-00 00:00:00') {
			echo "\t\t<li>Calendario externo: Última sincronización {$zona['Zona']['sync_calext']}</li>\n";
		}
		else {
			echo "\t\t<li>Calendario externo: Utiliza pero está pendiente de sincronizar</li>\n";
		}
	}
	else {
		echo "\t\t<li>Calendario externo: No utiliza</li>\n";
	}
	echo "\t\t<li>Creada: {$zona['Zona']['created']}</li>\n";
	echo "\t\t<li>Modificada: {$zona['Zona']['modified']}</li>\n";
	echo "\t</ul>\n";
	echo "<p>Descripción técnica:</p>\n";
	echo "<pre>{$zona['Zona']['desctecnica']}</pre>\n";
	echo "\t<h2>Necesidades de la zona</h2>\n\t<table>";
	echo "\t<tr><th>Id</th><th>Descripción</th><th>Cantidad</th><th>Objeto asignado</th></tr>\n";
	foreach ($zona['Necesidadzona'] as $v) {
		echo "\t\t<tr><td>{$v['id']}</td><td>".htmlspecialchars($v['descripcion'])."</td><td>{$v['cantidad']}</td><td>".htmlspecialchars($v['Objeto']['descripcion'])."</td></tr>\n";
	}
	echo "\t</table>\n";
	echo "<p>".$this->Html->link('Volver al listado de zonas', array('action' => 'index'))."</p>";
?>

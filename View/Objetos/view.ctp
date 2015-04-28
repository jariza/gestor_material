<h1>Detalle de objeto</h1>
<?php
	$ubicaciones = array();
	foreach ($objeto['Ubicacion'] as $v) {
		$ubicaciones[] = $v['nombre'];
	}
	$objeto['Objeto'] = array_map('htmlspecialchars', $objeto['Objeto']);
	echo "\t<ul>\n";
	echo "\t\t<li>Id: {$objeto['Objeto']['id']}</li>\n";
	echo "\t\t<li>Descripción: {$objeto['Objeto']['descripcion']}</li>\n";
	echo "\t\t<li>Ubicación: ".htmlspecialchars(implode(', ', $ubicaciones))."</li>\n";
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
	$fechadevolucion = $objeto['Objeto']['fechadevolucion'];
	if ($fechadevolucion != '9999-12-31 23:59:59') {
		echo "\t\t<li>Fecha de devolución: $fechadevolucion</li>\n";
		echo "\t\t<li>Comentarios sobre la devolución: {$objeto['Objeto']['comentariosdevolucion']}</li>\n";
	}
	echo "\t\t<li>Comentarios: {$objeto['Objeto']['comentarios']}</li>\n";
	echo "\t\t<li>Creado: {$objeto['Objeto']['created']}</li>\n";
	echo "\t\t<li>Modificado: {$objeto['Objeto']['modified']}</li>\n";
	echo "\t</ul>\n";
	
	echo "<h2>Usado en</h2>\n";
	if ((count($usoactividades) == 0) && (count($usozonas) == 0)) {
		echo "<p>Sin uso</p>\n";
	}
	else {
		echo "<ul>\n";
		foreach ($usoactividades as $v) {
			if ($objeto['Objeto']['fungible']) {
				$txtinicial = "Usados {$v['Necesidadactividad']['cantidad']} en la actividad ";
			}
			else {
				$txtinicial = "Usado en la actividad ";
			}
			echo "<li>$txtinicial &laquo;".$this->Html->link($v['Actividad']['nombre'], array('controller' => 'Actividades', 'action' => 'view', $v['Actividad']['id']))."&raquo;.</li>\n";
		}
		foreach ($usozonas as $v) {
			if ($objeto['Objeto']['fungible']) {
				$txtinicial = "Usados {$v['Necesidadzona']['cantidad']} en la zona ";
			}
			else {
				$txtinicial = "Usado en la zona ";
			}
			echo "<li>$txtinicial &laquo;".$this->Html->link($v['Zona']['nombre'], array('controller' => 'Zonas', 'action' => 'view', $v['Zona']['id']))."&raquo;.</li>\n";
		}
		echo "</ul>\n";
	}
	
	echo "<p>".$this->Html->link('Volver al listado de objetos', array('action' => 'index'))."</p>";
?>

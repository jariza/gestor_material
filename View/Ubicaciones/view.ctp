<?php
	echo "<h1>Objetos en {$ubicacion['Ubicacion']['nombre']}</h1>\n";
	echo "<ul>\n";
	foreach ($ubicacion['Objeto'] as $v) {
		$linea = $v['descripcion'];
		if ($v['fungible']) {
			$linea = $v['cantidad'].' x '.$linea;
		}
		if ($v['fechadevolucion'] != '9999-12-31 23:59:59') {
			$linea = "[Préstamo] $linea";
		}
		echo "\t<li>".$this->Html->link($linea, array('action' => 'view', 'controller' => 'Objetos', $v['id']))."</li>\n";
	}
	echo "</ul>\n";
	echo "<p>".$this->Html->link('Volver al listado de ubicacion', array('action' => 'index'))."</p>";
?>

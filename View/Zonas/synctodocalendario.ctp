<h1>Sincronización de los calendarios de todas las zonas</h1>

<?php
foreach ($datoszonas as $idzona => $datozona) {
	echo "<h2>{$datozona['nombre']}</h2>\n";

	if ($datozona['ultimasync'] == '0000-00-00 00:00:00') {
		echo "<p>Esta sería la primera sincronización.</p>\n";
	}
	else {
		echo "<p>La última sincronización se realizó el {$datozona['ultimasync']}</p>\n";
	}

	if ($errores[$idzona] != '') {
		echo "<p>Error al sincronizar: {$errores[$idzona]}</p>\n";
	}
	else {
		if (count($faltanext[$idzona]) > 0) {
			echo "<p style=\"margin-bottom: 0px\">Faltan algunas actividades en el calendario externo:</p>\n<ul style=\"margin-bottom: 1em\">\n";
			foreach ($faltanext[$idzona] as $v) {
				echo '<li>'.$this->Html->link($v['nombre'], array($v['id'], 'action' => 'view', 'controller' => 'Actividades'), array('target' => '_blank'))."</li>\n";
			}
			echo "</ul>\n";
		}
		if (count($faltanlocal[$idzona]) > 0) {
			echo "<p style=\"margin-bottom: 0px\">Sobran algunas actividades en el calendario externo:</p>\n<ul style=\"margin-bottom: 1em\">\n";
			foreach ($faltanlocal[$idzona] as $k => $v) {
				echo "<li>$k</li>\n";
			}
			echo "</ul>\n";
		}
	}
}
echo "<p>".$this->Html->link('Volver al listado de zonas', array('action' => 'index'))."</p>";
?>

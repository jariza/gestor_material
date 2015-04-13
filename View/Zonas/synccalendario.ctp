<?php
echo "<h1>Sincronización del calendario de {$zona['Zona']['nombre']}</h1>\n";
if ($zona['Zona']['sync_calext'] == '0000-00-00 00:00:00') {
	echo "<p>Esta sería la primera sincronización.</p>\n";
}
else {
	echo "<p>La última sincronización se realizó el {$zona['Zona']['sync_calext']}</p>\n";
}

if (count($faltanext) > 0) {
	echo "<p style=\"margin-bottom: 0px\">Faltan algunas actividades en el calendario externo:</p>\n<ul style=\"margin-bottom: 1em\">\n";
	foreach ($faltanext as $v) {
		echo '<li>'.$this->Html->link($v['nombre'], array($v['id'], 'action' => 'view', 'controller' => 'Actividades'), array('target' => '_blank'))."</li>\n";
	}
	echo "</ul>\n";
}
if (count($faltanlocal) > 0) {
	echo "<p style=\"margin-bottom: 0px\">Sobran algunas actividades en el calendario externo:</p>\n<ul style=\"margin-bottom: 1em\">\n";
	foreach ($faltanlocal as $k => $v) {
		echo "<li>$k</li>\n";
	}
	echo "</ul>\n";
}
echo "<p>".$this->Html->link('Volver al listado de zonas', array('action' => 'index'))."</p>";
?>

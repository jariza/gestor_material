<h1 style="display: inline-block; width: 80%">Infraestructura necesaria</h1>
<p style="display: inline-block; width: 18%; text-align: right"><?php echo $this->Html->link('[Versión para imprimir]', array('?' => 'imprimir=1'), array('id' => 'avisoimprimir', 'target' => '_blank')); ?></p>

<h2>Infraestructura para zonas</h2>
<table>
	<tr><th>Zona</th><th>Necesidad</th><th>Cantidad</th></tr>
<?php
	foreach ($neczona as $v) {
		echo "\t<tr><td>".htmlspecialchars($v['Zona']['nombre']).'</td><td>'.htmlspecialchars($v['Necesidadzona']['descripcion']).'</td><td>'.htmlspecialchars($v['Necesidadzona']['cantidad'])."</td></tr>\n";
	}
?>
</table>

<h2>Infraestructura para actividades</h2>
<table>
	<tr><th>Actividad</th><th>Zona</th><th>Necesidad</th><th>Cantidad</th></tr>
<?php
	foreach($necactividad as $v) {
		echo "\t<tr><td>".htmlspecialchars($v['Actividad']['nombre']).'</td><td>'.htmlspecialchars($zonas[$v['Actividad']['zona_id']]).'</td><td>'.htmlspecialchars($v['Necesidadactividad']['descripcion']).'</td><td>'.htmlspecialchars($v['Necesidadactividad']['cantidad'])."</td></tr>\n";
	}
?>
</table>
<?php

	if (!$imprimir) {
		echo "<p>".$this->Html->link('Volver al listado de zonas', '/')."</p>";
	}
?>

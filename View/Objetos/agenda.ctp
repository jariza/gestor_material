<h1 style="display: inline-block; width: 80%">Agenda del objeto &laquo;<?php echo $objeto['Objeto']['descripcion']; ?>&raquo;</h1>
<p style="display: inline-block; width: 18%; text-align: right"><?php echo $this->Html->link('[Versión para imprimir]', array($objeto['Objeto']['id'], '?' => 'imprimir=1'), array('id' => 'avisoimprimir', 'target' => '_blank')); ?></p>

<?php
	if ($objeto['Objeto']['fungible']) {
		$sum = 0;
		foreach ($usozona as $v) {
			$sum += $v['Necesidadzona']['cantidad'];
		}
		foreach ($usoactividades as $v) {
			$sum += $v['Necesidadactividad']['cantidad'];
		}
		if ($sum > $objeto['Objeto']['cantidad']) {
			echo "<p class=\"erroruso\">Hay {$objeto['Objeto']['cantidad']} ítems disponibles pero se necesitan $sum.</p>\n";
		}
	}
	if (count($usozona) > 0) {
		echo "<h2>Usado en zona</h2>\n";
	}
	if ((!$objeto['Objeto']['fungible']) && (count($usozona) > 1)) {
		echo "<p class=\"erroruso\">El mismo objeto no fungible se usa en más de una zona.</p>\n";
	}
	foreach ($usozona as $v) {
		if ((!$objeto['Objeto']['fungible']) && ($v['Necesidadzona']['cantidad'] > 1)) {
			echo "<p class=\"erroruso\">Se ha asignado una cantidad superior a uno de un objeto no fungible.</p>\n";
		}
		echo "<p style=\"margin-left: 20px\">";
		echo $this->Html->link($v['Zona']['nombre'], array('controller' => 'Zonas', 'action' => 'view', $v['Zona']['id']));
		echo " cubriendo la necesidad &laquo;{$v['Necesidadzona']['descripcion']}&raquo;";
		if ($v['Necesidadzona']['cantidad'] > 1) {echo ", hay {$v['Necesidadzona']['cantidad']} utilizados";}
		if ($v['Necesidadzona']['infraestructura']) {echo ", forma parte de la infraestructura";}
		echo ".</p>\n";
	}

	if (count($usoactividades) > 0) {
		echo "<h2>Usado en actividades</h2>\n";
		echo "<table>\n";
		echo "<tr><th>Horario</th><th>Actividad</th><th>Cantidad</th><th>Necesidad cubierta</th></tr>\n";
		foreach ($horario as $v) {
			$errortxt = '';
			$txtinfraestructura = '';
			if ((!$objeto['Objeto']['fungible']) && ($v['cantidad'] > 1)) {
				$errortxt .= 'Cantidad superior a 1 en no fungible';
			}
			if ($v['solapado']) {
				$errortxt .= 'Solape';
			}
			if ($v['infraestructura']) {
				$txtinfraestructura = ' (infraestructura)';
			}
			if ($errortxt == '') {
				echo "<tr>";
			}
			else {
				echo "<tr class=\"erroruso\">";
				$errortxt .= '<br />';
			}
			echo "<td>$errortxt{$v['inicio']}<br />a<br />{$v['fin']}</td><td>".htmlspecialchars($v['actividad'])."</td><td>{$v['cantidad']}</td><td>".htmlspecialchars($v['necesidad'])."$txtinfraestructura</td></tr>\n";
		}
		echo "</table>\n";
	}
	
	if (!$imprimir) {
		echo "<p>".$this->Html->link('Volver al listado de objetos', array('action' => 'index'))."</p>";
	}
?>

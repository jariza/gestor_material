<?php
echo $this->Html->script('jquery');
?>

<h1>Verificación de estado</h1>

<h2 onclick="$('#nosatzona').toggle('slow')"><?php echo count($nosatzona); ?> necesidades de zona no satisfechas (+)</h2>
<div id="nosatzona">
	<table>
		<tr><th>Zona</th><th>Necesidad</th><th>Cantidad</th></tr>
<?php
	foreach ($nosatzona as $v) {
		echo "\t\t<tr><td>".$this->Html->link($v['Zona']['nombre'], array($v['Zona']['id'], 'action' => 'view', 'controller' => 'Zonas')).'</td><td>'.htmlspecialchars($v['Necesidadzona']['descripcion'])."</td><td>{$v['Necesidadzona']['cantidad']}</td></tr>\n";
	}
?>
	</table>
</div>

<h2 onclick="$('#nosatactividad').toggle('slow')"><?php echo count($nosatactividad); ?> necesidades de actividad no satisfechas (+)</h2>
<div id="nosatactividad">
	<table>
		<tr><th>Zona</th><th>Actividad</th><th>Necesidad</th><th>Cantidad</th></tr>
<?php
	foreach ($nosatactividad as $v) {
		echo "\t\t<tr><td>".$this->Html->link($v['Zona']['nombre'], array($v['Zona']['id'], 'action' => 'view', 'controller' => 'Zonas')).'</td><td>'.$this->Html->link($v['Actividad']['nombre'], array($v['Actividad']['id'], 'action' => 'view', 'controller' => 'Actividades')).'</td><td>'.htmlspecialchars($v['Necesidadactividad']['descripcion'])."</td><td>{$v['Necesidadactividad']['cantidad']}</td></tr>\n";
	}
?>
	</table>
</div>

<h2 onclick="$('#nosatdesc').toggle('slow')"><?php echo count($nosatdesc); ?> necesidades agrupadas por descripción (+)</h2>
<div id="nosatdesc">
	<table>
		<tr><th>Necesidad</th><th>Cantidad</th></tr>
<?php
	foreach ($nosatdesc as $k => $v) {
		echo "\t\t<tr><td>".htmlspecialchars($k)."</td><td>$v</td></tr>\n";
	}
?>
	</table>
</div>

<h2 onclick="$('#infraobjeto').toggle('slow')"><?php echo count($infraobjeto); ?> necesidades de infraestructura con objeto asignado (+)</h2>
<div id="infraobjeto">
	<table>
		<tr><th>Dónde</th><th>Necesidad</th><th>Cantidad</th><th>Objeto</th></tr>
<?php
	foreach ($infraobjeto as $v) {
		if ($v['idactividad'] == -1) {
			$donde = 'Zona: '.$this->Html->link($v['nomzona'], array($v['idzona'], 'action' => 'view', 'controller' => 'Zonas'));
		}
		else {
			$donde = 'Actividad: '.$this->Html->link($v['nomactividad'], array($v['idactividad'], 'action' => 'view', 'controller' => 'Actividades')).', en '.$this->Html->link($v['nomzona'], array($v['idzona'], 'action' => 'view', 'controller' => 'Zonas'));
		}
		echo "\t\t<tr><td>$donde</td><td>".htmlspecialchars($v['necesidad'])."</td><td>{$v['cantidad']}</td><td>".$this->Html->link($v['descobjeto'], array($v['idobjeto'], 'action' => 'view', 'controller' => 'Objetos'))."</td></tr>\n";
	}
?>
	</table>
</div>

<h2 onclick="$('#multiobjeto').toggle('slow')"><?php echo count($multiobjeto); ?> objetos no fungibles con asignación múltiple (+)</h2>
<div id="multiobjeto">
	<table>
		<tr><th>Dónde</th><th>Necesidad</th><th>Cantidad</th><th>Objeto</th></tr>
<?php
	foreach ($multiobjeto as $v) {
		if ($v['idactividad'] == -1) {
			$donde = 'Zona: '.$this->Html->link($v['nomzona'], array($v['idzona'], 'action' => 'view', 'controller' => 'Zonas'));
		}
		else {
			$donde = 'Actividad: '.$this->Html->link($v['nomactividad'], array($v['idactividad'], 'action' => 'view', 'controller' => 'Actividades')).', en '.$this->Html->link($v['nomzona'], array($v['idzona'], 'action' => 'view', 'controller' => 'Zonas'));
		}
		echo "\t\t<tr><td>$donde</td><td>".htmlspecialchars($v['necesidad'])."</td><td>{$v['cantidad']}</td><td>".$this->Html->link($v['descobjeto'], array($v['idobjeto'], 'action' => 'view', 'controller' => 'Objetos'))."</td></tr>\n";
	}
?>
	</table>
</div>

<h2 onclick="$('#sobreasignacion').toggle('slow')"><?php echo count($sobreasignacion); ?> objetos con sobreasignacion (+)</h2>
<div id="sobreasignacion">
	<table>
		<tr><th>Objeto</th><th>Disponibles</th><th>Necesarios</th></tr>
<?php
	foreach ($sobreasignacion as $v) {
		echo "\t\t<tr><td>".$this->Html->link($v['descobjeto'], array($v['idobjeto'], 'action' => 'view', 'controller' => 'Objetos'))."</td><td>{$v['disponible']}</td><td>{$v['uso']}</td></tr>\n";
	}
?>
	</table>
</div>

<h2 onclick="$('#activzona').toggle('slow')"><?php echo count($activzona); ?> objetos no fungibles asignados a zona y actividad simultáneamente (+)</h2>
<div id="activzona">
	<table>
		<tr><th>Objeto</th><th>Zonas</th><th>Actividades</th></tr>
<?php
	foreach ($activzona as $k => $v) {
		echo "\t\t<tr><td>".$this->Html->link($v['descripcion'], array($k, 'action' => 'view', 'controller' => 'Objetos'))."</td>\n<td><ul>";
		foreach ($v['zonas'] as $k2 => $v2) {
			echo '<li>'.$this->Html->link($v2, array($k2, 'action' => 'view', 'controller' => 'Zonas')).'</li>';
		}
		echo "</ul></td>\n<td>";
		foreach ($v['actividades'] as $k2 => $v2) {
			echo '<li>'.$this->Html->link($v2, array($k2, 'action' => 'view', 'controller' => 'Actividades')).'</li>';
		}
		echo "</ul></td></tr>\n";
	}
?>
	</table>
</div>

<h2 onclick="$('#solapados').toggle('slow')"><?php echo count($activzona); ?> objetos no fungibles con solape en actividades (+)</h2>
<div id="solapados">
	<table>
		<tr><th>Objeto</th><th>Actividad</th><th>Inicio</th><th>Fin</th></tr>
<?php
	foreach ($solapados as $k => $v) {
		$numhorarios = count($v['horarios']);
		$primero = array_pop($v['horarios']);
		echo "\t\t<tr><td rowspan=\"$numhorarios\">".$this->Html->link($v['descobjeto'], array($k, 'action' => 'view', 'controller' => 'Objetos'))."</td>\n";
		echo "\t\t\t<td>".$this->Html->link($primero['nomactividad'], array($primero['idactividad'], 'action' => 'view', 'controller' => 'Actividades'))."</td>\n";
		echo "\t\t\t<td>{$primero['inicio']}</td>\n";
		echo "\t\t\t<td>{$primero['fin']}</td>\n";
		echo "\t\t</tr>\n";
		foreach ($v['horarios'] as $v2) {
			echo "\t\t\t<tr>\n";
			echo "\t\t\t<td>".$this->Html->link($v2['nomactividad'], array($v2['idactividad'], 'action' => 'view', 'controller' => 'Actividades'))."</td>\n";
			echo "\t\t\t<td>{$v2['inicio']}</td>\n";
			echo "\t\t\t<td>{$v2['fin']}</td></tr>\n";
		}
	}
?>
	</table>
</div>
<?php
	echo "<p>".$this->Html->link('Volver al inicio', '/')."</p>";

	echo $this->Html->scriptBlock('
		$(\'#nosatzona\').hide();
		$(\'#nosatactividad\').hide();
		$(\'#nosatdesc\').hide();
		$(\'#infraobjeto\').hide();
		$(\'#multiobjeto\').hide();
		$(\'#sobreasignacion\').hide();
		$(\'#activzona\').hide();
		$(\'#solapados\').hide();
	');
?>

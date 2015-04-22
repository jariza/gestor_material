<h1 style="display: inline-block; width: 80%">Agenda de la zona &laquo;<?php echo htmlspecialchars($zona['Zona']['nombre']); ?>&raquo;</h1>
<p style="display: inline-block; width: 18%; text-align: right"><?php echo $this->Html->link('[Versión para imprimir]', array($zona['Zona']['id'], '?' => 'imprimir=1'), array('id' => 'avisoimprimir', 'target' => '_blank')); ?></p>
<p><?php echo $zona['Zona']['desctecnica']; ?></p>
<h2>Infraestructura necesaria para la zona</h2>
<table>
	<tr><th>Necesidad</th><th>Cantidad</th></tr>
<?php
	foreach ($necesidadzona as $v) {
		if ($v['Necesidadzona']['infraestructura']) {
			$txterror = '';
			$txtclass = '';
			if (!is_null($v['Necesidadzona']['objeto_id'])) {
				$txterror = 'OjO: infraestructura con objeto asignado. ';
				$txtclass = ' class="erroruso"';
			}
			echo "<tr$txtclass><td>$txterror".htmlspecialchars($v['Necesidadzona']['descripcion'])."</td><td>{$v['Necesidadzona']['cantidad']}</td></tr>\n";
		}
	}
?>
</table>
<h2>Material necesario en zona</h2>
<table>
	<tr><th>Objeto</th><th>Cantidad</th><th>Necesidad cubierta</th><th>Comentarios del objeto</th></tr>
<?php	
	foreach ($necesidadzona as $v) {
		if (!$v['Necesidadzona']['infraestructura']) {
			$txterror = '';
			$txtclass = '';
			if ((!$v['Objeto']['fungible']) && ($v['Necesidadzona']['cantidad'] > 1)) {
				$txterror = 'OjO: objeto no fungible con cantidad mayor que uno. ';
				$txtclass = ' class="erroruso"';
			}
			if (is_null($v['Necesidadzona']['objeto_id'])) {
				$txtobjeto = 'Sin asignar';
				$txtcomentarios = '';
			}
			else {
				$txtobjeto = htmlspecialchars($v['Objeto']['descripcion']);
				$txtcomentarios = htmlspecialchars($v['Objeto']['comentarios']);
			}
			echo "<tr$txtclass><td>$txterror$txtobjeto</td><td>{$v['Necesidadzona']['cantidad']}</td><td>".htmlspecialchars($v['Necesidadzona']['descripcion'])."</td><td>$txtcomentarios</td></tr>\n";
		}
	}
?>
</table>

<h2>Actividades</h2>
<table>
	<tr><th>Horario</th><th>Actividad</th><th>Desripción</th><th>Necesidades</th></tr>
<?php
	foreach ($horario as $v) {
		$txtnecesidades = '';
		$error = false;
		//Infraestructuras
		foreach ($v['necesidades'] as $v2) {
			if ($v2['infraestructura']) {
				if ($v2['cantidad'] > 1) {
					$txtcantidad = $v2['cantidad'].'x ';
				}
				else {
					$txtcantidad = '';
				}
				if (!is_null($v2['objeto_id'])) {
					$txterror = '¡Infraestructura con objeto asignado! ';
					$error = true;
				}
				else {
					$txterror = '';
				}
				$txtnecesidades .= "<li>{$txterror}Infraestructura: $txtcantidad".htmlspecialchars($v2['descripcion'])." </li>\n";
			}
		}
		//Material
		foreach ($v['necesidades'] as $v2) {
			if (!$v2['infraestructura']) {
				$txterror = '';
				if ($v2['cantidad'] > 1) {
					$txtcantidad = $v2['cantidad'].'x ';
					if ((!is_null($v2['objeto_id'])) && (!$objetos[$v2['objeto_id']]['fungible'])){
						$txterror = '¡Objeto no fungible con cantidad superior a uno! ';
						$error = true;
					}
				}
				else {
					$txtcantidad = '';
				}
				if (is_null($v2['objeto_id'])) {
					$txtobjeto = "Necesidad no satisfecha: $txtcantidad".htmlspecialchars($v2['descripcion']);
				}
				else {
					if ($objetos[$v2['objeto_id']]['comentarios'] != '') {
						$txtcomentario = '. '.htmlspecialchars($objetos[$v2['objeto_id']]['comentarios']);
					}
					else {
						$txtcomentario = '';
					}
					$txtobjeto = $txtcantidad.htmlspecialchars($objetos[$v2['objeto_id']]['descripcion']).' usado para '.htmlspecialchars($v2['descripcion']).$txtcomentario;
				}
				$txtnecesidades .= "<li>{$txterror}$txtobjeto</li>\n";
			}
		}
		//Monto la línea
		if ($txtnecesidades != '') {$txtnecesidades = "<ul>\n$txtnecesidades\n</ul>\n";}
		if ($error) {
			$txtclass = ' class="erroruso"';
		}
		else {
			$txtclass = '';
		}
		echo "<tr$txtclass><td>{$v['inicio']}<br />a<br />{$v['fin']}</td><td>".htmlspecialchars($v['nombreactividad'])."</td><td>".htmlspecialchars($v['descactividad'])."</td><td>$txtnecesidades</td></tr>\n";
	}
?>
</table>

<?php
	if (!$imprimir) {
		echo "<p>".$this->Html->link('Volver al listado de zonas', array('action' => 'index'))."</p>";
	}
?>

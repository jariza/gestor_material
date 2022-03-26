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
	echo "<pre>".htmlspecialchars($zona['Zona']['desctecnica'])."</pre>\n";
	echo "\t<h2>Necesidades de la zona</h2>\n\t<table>";
	echo "\t<tr><th>Descripción</th><th>Cantidad</th><th>Infraestructura</th><th>Recurso asignado</th></tr>\n";
	foreach ($zona['Necesidadzona'] as $v) {
	    if ($v['infraestructura']) {
			$txtinfraestructura = 'Sí';
			$txtdescripcion = $v['proveedor_infra'];
	    }
	    else {
			$txtinfraestructura = 'No';
			if (is_null($v['objeto_id'])) {
				$txtdescripcion = '';
			}
			else {
				if (array_key_exists('Objeto', $v) && array_key_exists('Ubicacion', $v['Objeto'])) {
					$ubicacion = array();
					// Gnapa
					if (count($v['Objeto']['Ubicacion']) == 0) {
						$ubicacion[] = 'Pendiente de entrega';
					}
					else {
						foreach($v['Objeto']['Ubicacion'] as $u) {
							$ubicacion[] = $u['nombre'];
						}
					}
					$ubicacion = '<br />Ubicación en almacén: '.implode($ubicacion, ', ');
				}
				else {
					$ubicacion = '';
				}
				$txtdescripcion = '<a href="/Objeto/view/"'.$v['Objeto']['id'].'">'.htmlspecialchars($v['Objeto']['descripcion'])."</a>$ubicacion";
			}
		}
		echo "\t\t<tr><td>".htmlspecialchars($v['descripcion'])."</td><td>{$v['cantidad']}</td><td>$txtinfraestructura</td><td>$txtdescripcion</td></tr>\n";
	}
	echo "\t</table>\n";
	echo "<p>".$this->Html->link('Volver al listado de zonas', array('action' => 'index'))." - ".$this->Html->link('Editar zona', array('action' => 'edit', $zona['Zona']['id']), array('title' => 'Editar'))."</p>";
?>

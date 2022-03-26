<h1>Detalle de la actividad</h1>

<?php
	$actividad['Actividad'] = array_map('htmlspecialchars', $actividad['Actividad']);
	echo "\t<ul>\n";
	echo "\t\t<li>Id: {$actividad['Actividad']['id']}</li>\n";
	echo "\t\t<li>Nombre: {$actividad['Actividad']['nombre']}</li>\n";
	echo "\t\t<li>Zona: {$actividad['Zona']['nombre']}</li>\n";
	echo "\t\t<li>Enlace web: ";
	$enlaceweb = $actividad['Actividad']['enlaceweb'];
	if ($enlaceweb== '') {
		echo 'No indicado';
	}
	else {
		echo "<a href=\"$enlaceweb\" target=\"_blank\">$enlaceweb</a>";
	}
	echo "</li>\n";
	echo "\t\t<li>Creado: {$actividad['Actividad']['created']}</li>\n";
	echo "\t\t<li>Modificado: {$actividad['Actividad']['modified']}</li>\n";
	echo "\t</ul>\n</p>\n";
	echo "<p>Descripción técnica:";
	echo "<pre>".htmlspecialchars($actividad['Actividad']['desctecnica'])."</pre>\n";
	echo "\t<h2>Horario</h2>\n";
	if ($actividad['Zona']['calendarioext'] != '0') {
		if ($actividad['Zona']['sync_calext'] == '0000-00-00 00:00:00') {
			echo "\t<p style=\"font-weight: bold\">Pendiente de sincronización con calendario externo.</p>\n";
		}
		else {
			echo "\t<p>Última sincronización con calendario externo: {$actividad['Zona']['sync_calext']}</p>\n";
		}
	}
	echo "\t<table>\n\t<tr><th>Sesión</th><th>Inicio</th><th>Fin</th></tr>\n";
	foreach ($actividad['Horario'] as $v) {
		echo "\t\t<tr><td>{$v['sesion']}</td><td>";
		echo date('D, j/M/Y G:i:s', strtotime($v['inicio']));
		echo "</td><td>";
		echo date('D, j/M/Y G:i:s', strtotime($v['fin']));
		echo "</td></tr>\n";
	}
	echo "\t</table>\n";
	echo "\t<h2>Recursos de la zona</h2>\n";
	if (count($actividad['Zona']['Necesidadzona']) == 0) {
		echo "<p id=\"recursoszona\">Sin recursos.</p>\n";
	}
	else {
		echo "<ul id=\"recursoszona\">\n";
		foreach($actividad['Zona']['Necesidadzona'] as $v){
			$txtcantidad = '';
			$txtinfraestructura = '';
			$txtgarantizado = '';
			if ($v['cantidad'] > 1) {
				$txtcantidad = $v['cantidad'].'x ';
			}
			if ($v['infraestructura']) {
				$txtinfraestructura = 'Infraestructura: ';
			}
			elseif (is_null($v['objeto_id'])) {
				$txtgarantizado = ' (recurso NO garantizado)';
			}
			
			echo "<li>$txtinfraestructura$txtcantidad{$v['descripcion']}$txtgarantizado</li>\n";
		}
		echo "</ul>\n";
	}
	echo "\t<h2>Necesidades de la actividad</h2>\n\t<table>";
	echo "\t<tr><th>Id</th><th>Descripción</th><th>Cantidad</th><th>Infraestructura</th><th>Sesión</th><th>Recurso asignado</th></tr>\n";
	foreach ($actividad['Necesidadactividad'] as $v) {
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
					//Gnapa
					if (count($v['Objeto']['Ubicacion']) == 0) {
						$ubicacion[] = "Pendiente de entrega";
					}
					else {
						foreach ($v['Objeto']['Ubicacion'] as $u) {	
							$ubicacion[] = $u['nombre'];
						}
					}
					$ubicacion = '<br />Ubicación en almacén: '.implode(',', $ubicacion);
				}
				else {
					$ubicacion = '';
				}	
				$txtdescripcion = '<a href="/Objetos/view/'.$v['Objeto']['id'].'"/>'.htmlspecialchars($v['Objeto']['descripcion'])."</a>$ubicacion";
			}
		}
		echo "\t\t<tr><td>{$v['id']}</td><td>".htmlspecialchars($v['descripcion'])."</td><td>{$v['cantidad']}</td><td>$txtinfraestructura</td><td>{$v['sesion']}</td><td>$txtdescripcion</td></tr>\n";
	}
	echo "\t</table>\n";
	echo "<p>".$this->Html->link('Volver al listado de actividades', array('action' => 'index'))." - ".$this->Html->link('Editar actividad', array('action' => 'edit', $actividad['Actividad']['id']), array('title' => 'Editar'))."</p>";
?>

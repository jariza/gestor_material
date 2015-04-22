<?php
echo "<h1>Gestión de material</h1>\n";
if (strcmp(AuthComponent::user('rol'), 'admin') == 0) {
	if (!version_compare(PHP_VERSION, '5.2.8', '>=')) {
		echo '<p class="notice">La versión de PHP es demasiado baja: '.phpversion().". Se necesita 5.2.8 o superior.</p>\n";
	}
	if (!is_writable(TMP)) {
		echo "<p class=\"notice\">El directorio TMP no es escribible.</p>\n";
	}
	$settings = Cache::settings();
	if (empty($settings)) {
		echo "<p class=\"notice\">La caché no está funcionando.</p>\n";
	}
}
?>

<ul id="menuprincipal">
<?php
$rol = AuthComponent::user('rol');
if (strcmp($rol, 'admin') == 0) {
	echo "\t<ul>\n";
	echo "\t<h2>Administración</h2>\n";
	echo "\t\t<li>".$this->Html->link('Logins fallidos', array('controller' => 'LoginFallidos'))."</li>\n";
	echo "\t\t<li>".$this->Html->link('Gestión de usuarios', array('controller' => 'Usuarios'))."</li>\n";
	echo "\t</ul>\n";
}
if (in_array($rol, array('admin', 'produccion'))) {
	echo "\t<ul>\n";
	echo "\t\t<h2>Inventario</h2>\n";
	echo "\t\t<li>".$this->Html->link('Gestión de inventario', array('controller' => 'Objetos'))."</li>\n";
	echo "\t\t<li>".$this->Html->link('Gestión de ubicaciones', array('controller' => 'Ubicaciones'))."</li>\n";
	echo "\t\t<li>".$this->Html->link('Agenda de recepción', array('controller' => 'Objetos', 'action' => 'agendarecepcion'))."</li>\n";
	echo "\t\t<li>".$this->Html->link('Agenda de devolución', array('controller' => 'Objetos', 'action' => 'agendadevolucion'))."</li>\n";
	echo "\t\t<li>".$this->Html->link('Agenda de préstamos', array('controller' => 'Objetos', 'action' => 'agendaprestamo'))."</li>\n";
	echo "\t</ul>\n";
	echo "\t<ul>\n";
	echo "\t\t<h2>Actividades</h2>\n";
	echo "\t\t<li>".$this->Html->link('Gestión de actividades', array('controller' => 'Actividades'))."</li>\n";
	echo "\t\t<li>".$this->Html->link('Gestión de zonas', array('controller' => 'Zonas'))."</li>\n";
	echo "\t</ul>\n";
	echo "\t<ul>\n";
	echo "\t\t<h2>Globales</h2>\n";
	echo "\t\t<li>".$this->Html->link('Infraestructura necesaria', array('controller' => 'Generales', 'action' => 'listainfraestructura'))."</li>\n";
	echo "\t\t<li>".$this->Html->link('Verificar estado', array('controller' => 'Generales', 'action' => 'estado'))."</li>\n";
	echo "\t</ul>\n";
}
?>
</ul>


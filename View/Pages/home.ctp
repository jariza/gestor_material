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

<ul>
<?php
$rol = AuthComponent::user('rol');
if (strcmp($rol, 'admin') == 0) {
	echo "\t<li>".$this->Html->link('Logins fallidos', array('controller' => 'LoginFallidos'))."</li>\n";
	echo "\t<li>".$this->Html->link('Gestión de usuarios', array('controller' => 'Usuarios'))."</li>\n";
}
if (in_array($rol, array('admin', 'produccion'))) {
	echo "\t<li>".$this->Html->link('Gestión de ubicaciones', array('controller' => 'Ubicaciones'))."</li>\n";
	echo "\t<li>".$this->Html->link('Gestión de objetos', array('controller' => 'Objetos'))."</li>\n";
	echo "\t<li>".$this->Html->link('Gestión de zonas', array('controller' => 'Zonas'))."</li>\n";
}
?>
</ul>

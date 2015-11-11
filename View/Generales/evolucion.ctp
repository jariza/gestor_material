<?php
echo $this->Html->script('jquery');
?>

<h1>Evolución del inventario</h1>

<h2 onclick="$('#gastados').toggle('slow')"><?php echo count($gastados); ?> Objetos gastados por completo (+)</h2>
<div id="gastados">
	<table>
		<th>Objeto</th><th>Cantidad anterior</th><th>Cantidad actual</th><th>Diferencia</th>
<?php
foreach ($gastados as $v) {
	echo "\t<tr><td>";
	echo $this->Html->link(htmlspecialchars($v['Objeto']['descripcion']), array($v['Objeto']['id'], 'action' => 'view', 'controller' => 'Objetos'));
	echo "</td><td>{$v['Objeto']['cantidad']}</td><td>{$v['Objeto']['cantidad_postevento']}</td><td>{$v['Objeto']['uso']}</td></tr>\n";
}
?>
	</table>
</div>

<h2 onclick="$('#nousados').toggle('slow')"><?php echo count($nousados); ?> Objetos no usados (+)</h2>
<div id="nousados">
	<table>
		<th>Objeto</th><th>Cantidad anterior</th><th>Cantidad actual</th><th>Diferencia</th>
<?php
foreach ($nousados as $v) {
	echo "\t<tr><td>";
	echo $this->Html->link(htmlspecialchars($v['Objeto']['descripcion']), array($v['Objeto']['id'], 'action' => 'view', 'controller' => 'Objetos'));
	echo "</td><td>{$v['Objeto']['cantidad']}</td><td>{$v['Objeto']['cantidad_postevento']}</td><td>{$v['Objeto']['uso']}</td></tr>\n";
}
?>
	</table>
</div>

<h2 onclick="$('#nuevos').toggle('slow')"><?php echo count($nuevos); ?> Objetos nuevos (+)</h2>
<div id="nuevos">
	<table>
		<th>Objeto</th><th>Cantidad anterior</th><th>Cantidad actual</th><th>Diferencia</th>
<?php
foreach ($nuevos as $v) {
	echo "\t<tr><td>";
	echo $this->Html->link(htmlspecialchars($v['Objeto']['descripcion']), array($v['Objeto']['id'], 'action' => 'view', 'controller' => 'Objetos'));
	echo "</td><td>{$v['Objeto']['cantidad']}</td><td>{$v['Objeto']['cantidad_postevento']}</td><td>{$v['Objeto']['uso']}</td></tr>\n";
}
?>
	</table>
</div>

<h2 onclick="$('#resto').toggle('slow')"><?php echo count($resto); ?> Resto de objetos (+)</h2>
<div id="resto">
	<table>
		<th>Objeto</th><th>Cantidad anterior</th><th>Cantidad actual</th><th>Diferencia</th>
<?php
foreach ($resto as $v) {
	echo "\t<tr><td>";
	echo $this->Html->link(htmlspecialchars($v['Objeto']['descripcion']), array($v['Objeto']['id'], 'action' => 'view', 'controller' => 'Objetos'));
	echo "</td><td>{$v['Objeto']['cantidad']}</td><td>{$v['Objeto']['cantidad_postevento']}</td><td>{$v['Objeto']['uso']}</td></tr>\n";
}
?>
	</table>
</div>

<?php
	echo "<p>".$this->Html->link('Volver al inicio', '/')."</p>";

	echo $this->Html->scriptBlock('
		$(\'#gastados\').hide();
		$(\'#nousados\').hide();
		$(\'#nuevos\').hide();
		$(\'#resto\').hide();
	');
?>

<?php
	echo "<h1 style=\"display: inline-block; width: 80%\">Gestión de zonas</h1>\n";
	echo "<p style=\"display: inline-block; width: 18%; text-align: right\">".$this->Html->image('ayuda.png', array('alt' => 'Ayuda', 'url' => array('action' => 'ayuda')))."</p>\n";
	echo '<p>'.$this->Html->link("Añadir nueva", array('action' => 'nueva'))."</p>\n";
?>

<table>
	<tr>
		<th><?php echo $this->Paginator->sort('id', 'Id'); ?></th>
		<th><?php echo $this->Paginator->sort('nombre', 'Nombre'); ?></th>
	</tr>
<?php
	foreach ($zonas as $v) {
		$v['Zona'] = array_map('htmlspecialchars', $v['Zona']);
		echo '<tr><td>'.$this->Html->link($v['Zona']['id'], array('action' => 'view', $v['Zona']['id']));
		echo " (".$this->Html->link('E', array('action' => 'edit', $v['Zona']['id']), array('title' => 'Editar'));
		echo "/".$this->Form->postLink('X', array('action' => 'delete', $v['Zona']['id']), array('confirm' => "¿Seguro que deseas eliminar la zona {$v['Zona']['nombre']}?")).")</td>";		
		echo "<td>{$v['Zona']['nombre']}</td></tr>\n";
	}
?>
</table>
<p><?php echo $this->Paginator->numbers(); ?></p>


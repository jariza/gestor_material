<?php
	echo "<h1 style=\"display: inline-block; width: 80%\">Gestión de ubicaciones</h1>\n";
	echo "<p style=\"display: inline-block; width: 18%; text-align: right\">".$this->Html->image('ayuda.png', array('alt' => 'Ayuda', 'url' => array('action' => 'ayuda')))."</p>\n";
	echo '<p>'.$this->Html->link("Añadir nueva", array('action' => 'nueva'))."</p>\n";
?>

<table>
	<tr>
		<th>Opciones</th>
		<th><?php echo $this->Paginator->sort('nombre', 'Nombre'); ?></th>
	</tr>
<?php
	foreach ($ubicaciones as $v) {
		$v['Ubicacion'] = array_map('htmlspecialchars', $v['Ubicacion']);
		if ($v['Ubicacion']['id'] != -1) { //-1 es la ubicación ficticia "Pendiente de entrega"
			echo "<tr><td>".$this->Html->link("Detalles", array('action' => 'view', $v['Ubicacion']['id']), array('title' => 'Listado de objetos en la ubicación'));
			echo " (".$this->Html->link('E', array('action' => 'edit', $v['Ubicacion']['id']), array('title' => 'Editar'));
			echo "/".$this->Form->postLink('X', array('action' => 'delete', $v['Ubicacion']['id']), array('title' => 'Borrar', 'confirm' => "¿Seguro que deseas eliminar la ubicación {$v['Ubicacion']['nombre']}?")).")</td>";
			echo "<td>{$v['Ubicacion']['nombre']}</td></tr>\n";
		}
	}
?>
</table>
<p>
<?php
echo $this->Paginator->counter('Página {:page} de {:pages}').'<br />';
echo $this->Paginator->first('<<Primera', array('after' => ' ... '));
echo $this->Paginator->numbers();
echo $this->Paginator->last('Última>>', array('before' => ' ... '));
?>
</p>

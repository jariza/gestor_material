<?php
	echo "<h1 style=\"display: inline-block; width: 80%\">Gestión de inventario</h1>\n";
	echo "<p style=\"display: inline-block; width: 18%; text-align: right\">".$this->Html->image('ayuda.png', array('alt' => 'Ayuda', 'url' => array('action' => 'ayuda')))."</p>\n";
	echo '<p style="display: inline-block; width: 18%">'.$this->Html->link("Añadir nuevo", array('action' => 'nuevo'))."</p>\n";

    echo $this->Form->create('Objeto', array('class' => 'buscar'));
    echo $this->Form->input('q', array('label' => false, 'div' => false));
    echo $this->Form->end(array('label' => 'Filtrar por descripción', 'div' => false));
?> 
<table>
	<tr>
		<th><?php echo $this->Paginator->sort('id', 'Id'); ?></th>
		<th><?php echo $this->Paginator->sort('descripcion', 'Descripción'); ?></th>
		<th><?php echo $this->Paginator->sort('fungible', 'Fungible'); ?></th>
		<th><?php echo $this->Paginator->sort('cantidad', 'Cantidad'); ?></th>
		<th><?php echo $this->Paginator->sort('fechaentrega', 'Fecha de entrega'); ?></th>
	</tr>
<?php
	foreach ($objetos as $v) {
		$v['Objeto'] = array_map('htmlspecialchars', $v['Objeto']);
		echo '<tr><td>'.$this->Html->link($v['Objeto']['id'], array('action' => 'view', $v['Objeto']['id']));
		echo " (".$this->Html->link('A', array('action' => 'agenda', $v['Objeto']['id']), array('title' => 'Agenda'));
		echo "/".$this->Html->link('E', array('action' => 'edit', $v['Objeto']['id']), array('title' => 'Editar'));
		echo "/".$this->Form->postLink('X', array('action' => 'delete', $v['Objeto']['id']), array('confirm' => "¿Seguro que deseas eliminar el objeto {$v['Objeto']['descripcion']}?")).")</td>";		
		$txtfungible = $v['Objeto']['fungible'] ? 'Si' : 'No';
		if ($v['Objeto']['fechaentrega'] == '0000-00-00 00:00:00') {
			$txtentrega = 'En stock';
		}
		else {
			$txtentrega = $v['Objeto']['fechaentrega'];
		}
		if ($v['Objeto']['fechadevolucion'] == '9999-12-31 23:59:59') {
			$txtprestamo = '';
		}
		else {
			$txtprestamo = '¡Préstamo! ';
		}
		echo "<td>$txtprestamo{$v['Objeto']['descripcion']}</td><td>$txtfungible</td><td>{$v['Objeto']['cantidad']}</td><td>$txtentrega</td></tr>\n";
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


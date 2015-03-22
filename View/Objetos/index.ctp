<?php
	echo "<h1 style=\"display: inline-block; width: 80%\">Gestión de objetos</h1>\n";
	echo "<p style=\"display: inline-block; width: 18%; text-align: right\">".$this->Html->image('ayuda.png', array('alt' => 'Ayuda', 'url' => array('action' => 'ayuda')))."</p>\n";
	echo '<p style="display: inline-block; width: 18%">'.$this->Html->link("Añadir nuevo", array('action' => 'nuevo'))."</p>\n";
?>
<?php 
    echo $this->Form->create('Objeto', array('class' => 'buscar'));
    echo $this->Form->input('q', array('label' => false, 'div' => false));
    echo $this->Form->end(array('label' => 'Filtrar por descripción', 'div' => false));
?> 
<table>
	<tr>
		<th><?php echo $this->Paginator->sort('id', 'Id'); ?></th>
		<th><?php echo $this->Paginator->sort('descripcion', 'Descripción'); ?></th>
		<th><?php echo $this->Paginator->sort('ubicacion', 'Ubicación'); ?></th>
		<th><?php echo $this->Paginator->sort('tipoobjeto', 'Tipo de objeto'); ?></th>
		<th>Comentarios</th>
	</tr>
<?php
	$tiposobjeto = Configure::read('tiposobjeto');
	foreach ($objetos as $v) {
		echo "<tr><td>{$v['Objeto']['id']}";
		echo " (".$this->Html->link('E', array('action' => 'edit', $v['Objeto']['id']), array('title' => 'Editar'));
		echo "/".$this->Form->postLink('X', array('action' => 'delete', $v['Objeto']['id']), array('confirm' => "¿Seguro que deseas eliminar el objeto {$v['Objeto']['descripcion']}?")).")</td>";		
		echo "<td>{$v['Objeto']['descripcion']}</td><td>{$v['Ubicacion']['nombre']}</td><td>{$tiposobjeto[$v['Objeto']['tipoobjeto_id']]}</td><td>{$v['Objeto']['comentarios']}</td></tr>\n";
	}
?>
</table>
<p><?php echo $this->Paginator->numbers(); ?></p>


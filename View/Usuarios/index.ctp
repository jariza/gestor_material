<?php
	echo "<h1 style=\"display: inline-block; width: 80%\">Opciones de gestión de usuarios</h1>\n";
	echo "<p style=\"display: inline-block; width: 18%; text-align: right\">".$this->Html->image('ayuda.png', array('alt' => 'Ayuda', 'url' => array('action' => 'ayuda')))."</p>\n";
	echo "<p>".$this->Html->link('Añadir usuario', array('action' => 'add'))."</p>\n";
?>
<table>
	<tr><th><?php echo $this->Paginator->sort('id', 'Id'); ?></th><th><?php echo $this->Paginator->sort('name', 'Name'); ?></th><th><?php echo $this->Paginator->sort('username', 'Username'); ?></th><th><?php echo $this->Paginator->sort('email', 'Email'); ?></th><th><?php echo $this->Paginator->sort('rol', 'Rol'); ?></th><th>Zonas</th><th><?php echo $this->Paginator->sort('created', 'Creado'); ?></th><th><?php echo $this->Paginator->sort('modified', 'Modificado'); ?></th></tr>
<?php
	foreach ($usuarios as $v) {
		echo "<tr><td>{$v['Usuario']['id']} (".$this->Html->link('E', array('action' => 'edit', $v['Usuario']['id']), array('title' => 'Editar'));
		echo '/'.$this->Form->postLink('R', array('action' => 'resetpass', $v['Usuario']['id']), array('confirm' => "¿Seguro que deseas resetear la contraseña del usuario {$v['Usuario']['username']}?"));
		if (strcmp($v['Usuario']['username'], 'admin') != 0) {echo "/".$this->Form->postLink('X', array('action' => 'delete', $v['Usuario']['id']), array('confirm' => "¿Seguro que deseas eliminar el usuario {$v['Usuario']['username']}?")).")</td>";}
		else {echo ")</td>";}
		if ($v['Usuario']['rol'] == 'managerzona') {
			if (count($v['Usuario']['zonas']) == 0) {
				$txtzonas = 'Ninguna';
			}
			else {
				$txtzonas = array();
				foreach ($v['Usuario']['zonas'] as $v2) {$txtzonas[] = $zonas[$v2];}
				$txtzonas = htmlentities(implode(', ', $txtzonas));
			}
		}
		else {
			$txtzonas = 'Todas';
		}
		echo "<td>{$v['Usuario']['name']}</td><td>{$v['Usuario']['username']}</td><td>{$v['Usuario']['email']}</td><td>{$v['Usuario']['rol']}</td><td>$txtzonas</td><td>{$v['Usuario']['created']}</td><td>{$v['Usuario']['modified']}</td></tr>\n";
	}
?>
</table>
<p><?php echo $this->Paginator->numbers(); ?></p>

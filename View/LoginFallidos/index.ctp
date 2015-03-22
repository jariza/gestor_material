<?php
echo "<h1 style=\"display: inline-block; width: 80%\">Logins fallidos</h1>\n";
echo "<p style=\"display: inline-block; width: 18%; text-align: right\">".$this->Html->image('ayuda.png', array('alt' => 'Ayuda', 'url' => array('action' => 'ayuda')))."</p>\n";
?>
<table>
	<tr>
		<th><?php echo $this->Paginator->sort('id', 'Id'); ?></th>
		<th><?php echo $this->Paginator->sort('created', 'Fecha'); ?></th>
		<th><?php echo $this->Paginator->sort('IP', 'IP'); ?></th>
		<th><?php echo $this->Paginator->sort('username', 'Username'); ?></th>
	</tr>
<?php
	$listamodulos = Configure::read('loginFallidos');
	foreach ($loginFallidos as $v) {
		echo "<tr><td>{$v['LoginFallido']['id']} (".$this->Form->postLink('X', array('action' => 'delete', $v['LoginFallido']['id']), array('confirm' => "¿Seguro que deseas eliminar el registro {$v['LoginFallido']['id']}?")).")</td>";
		echo "<td>{$v['LoginFallido']['created']}</td><td>{$v['LoginFallido']['IP']}</td><td>{$v['LoginFallido']['username']}</td></tr>\n";
	}
?>
</table>
<p><?php echo $this->Paginator->numbers(); ?></p>

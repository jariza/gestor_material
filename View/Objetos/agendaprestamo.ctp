<h1 style="display: inline-block; width: 80%">Agenda de objetos en préstamo</h1>
<p style="display: inline-block; width: 18%; text-align: right"><?php echo $this->Html->link('[Versión para imprimir]', array('?' => 'imprimir=1'), array('id' => 'avisoimprimir', 'target' => '_blank')); ?></p>
<table>
	<tr>
		<th><?php echo $this->Paginator->sort('descripcion', 'Descripción'); ?></th>
		<th><?php echo $this->Paginator->sort('cantidad', 'Cantidad'); ?></th>
		<th><?php echo $this->Paginator->sort('fechaentrega', 'Fecha de entrega'); ?></th>
		<th><?php echo $this->Paginator->sort('fechadevolucion', 'Fecha de devolución'); ?></th>
		<th>Comentarios de entrega</th>
		<th>Comentarios de devolución</th>
	</tr>
<?php
	foreach ($objetos as $v) {
		$v['Objeto'] = array_map('htmlspecialchars', $v['Objeto']);
		echo "<tr><td>{$v['Objeto']['descripcion']}</td><td>{$v['Objeto']['cantidad']}</td><td>{$v['Objeto']['fechaentrega']}</td><td>{$v['Objeto']['fechadevolucion']}</td><td>{$v['Objeto']['comentariosentrega']}</td><td>{$v['Objeto']['comentariosdevolucion']}</td></tr>\n";
	}
?>
</table>
<p>
<?php
if (!$imprimir) {echo $this->Paginator->counter('Página {:page} de {:pages}').'<br />';}
echo $this->Paginator->first('<<Primera', array('after' => ' ... '));
echo $this->Paginator->numbers();
echo $this->Paginator->last('Última>>', array('before' => ' ... '));
?>
</p>

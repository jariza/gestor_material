<?php
	echo "<h1 style=\"display: inline-block; width: 80%\">Gestión de zonas</h1>\n";
	echo "<p style=\"display: inline-block; width: 18%; text-align: right\">".$this->Html->image('ayuda.png', array('alt' => 'Ayuda', 'url' => array('action' => 'ayuda')))."</p>\n";
	echo '<p style="display: inline-block; text-align: left">'.$this->Html->link("Añadir nueva", array('action' => 'nueva'))." | </p>\n";
	echo $this->Form->postLink('Sincronizar todas las zonas con calendario externo', array('action' => 'synctodocalendario'), array('confirm' => "La sincronización de calendario puede tardar un tiempo, por favor, espera 5 minutos o a que salga un mensaje."))."\n";
?>

<table>
	<tr>
		<th><?php echo $this->Paginator->sort('id', 'Id'); ?></th>
		<th><?php echo $this->Paginator->sort('nombre', 'Nombre'); ?></th>
	</tr>
<?php
	foreach ($zonas as $v) {
		$v['Zona'] = array_map('htmlspecialchars', $v['Zona']);
		echo '<tr><td>'.$this->Html->link($v['Zona']['id'], array('action' => 'view', $v['Zona']['id']))." (";
		if ($v['Zona']['calendarioext'] != '0') {
			echo $this->Form->postLink('S', array('action' => 'synccalendario', $v['Zona']['id']), array('confirm' => "La sincronización de calendario puede tardar un tiempo, por favor, espera 5 minutos o a que salga un mensaje."))."/";
		}
		echo $this->Html->link('E', array('action' => 'edit', $v['Zona']['id']), array('title' => 'Editar'));
		echo "/".$this->Form->postLink('X', array('action' => 'delete', $v['Zona']['id']), array('confirm' => "¿Seguro que deseas eliminar la zona {$v['Zona']['nombre']}?")).")</td>";		
		echo "<td>{$v['Zona']['nombre']}</td></tr>\n";
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

<?php
	echo "<h1 style=\"display: inline-block; width: 80%\">Gestión de actividades</h1>\n";
	echo "<p style=\"display: inline-block; width: 18%; text-align: right\">".$this->Html->image('ayuda.png', array('alt' => 'Ayuda', 'url' => array('action' => 'ayuda')))."</p>\n";
	echo '<p>'.$this->Html->link("Añadir nueva", array('action' => 'nueva'))."</p>\n";
?>

<table>
	<tr>
		<th><?php echo $this->Paginator->sort('id', 'Id'); ?></th>
		<th><?php echo $this->Paginator->sort('nombre', 'Nombre'); ?></th>
		<th><?php echo $this->Paginator->sort('zona', 'Zona'); ?></th>
		<th><?php echo $this->Paginator->sort('horario', 'Horario'); ?></th>
	</tr>
<?php
	foreach ($actividades as $v) {
		$v['Actividad'] = array_map('htmlspecialchars', $v['Actividad']);
		echo '<tr><td>'.$this->Html->link($v['Actividad']['id'], array('action' => 'view', $v['Actividad']['id']));
		echo " (".$this->Html->link('E', array('action' => 'edit', $v['Actividad']['id']), array('title' => 'Editar'));
		echo "/".$this->Form->postLink('X', array('action' => 'delete', $v['Actividad']['id']), array('confirm' => "¿Seguro que deseas eliminar la actividad {$v['Actividad']['nombre']}?")).")</td>";
		if ($v['Actividad']['enlaceweb'] != '') {
			$txtenlaceweb = " [<a href=\"{$v['Actividad']['enlaceweb']}\" target=\"_blank\">Web</a>]";
		}
		else {
			$txtenlaceweb = '';
		}
		$tini = strtotime($v['Actividad']['inicio']);
		$tfin = strtotime($v['Actividad']['fin']);
		if (date('Y-m-d', $tini) == date('Y-m-d', $tfin)) { //Están en el mismo día
			$txthorario = date('D, j/M/Y, \d\e G:i:s \a ', $tini).date('G:i:s', $tfin);
		}
		else {
			$txthorario = date('\D\e\l D j/M/Y \a \l\a\s  G:i:s \a\l ', $tini).date('D j/M/Y \a \l\a\s  G:i:s', $tfin);
		}
		echo "<td>{$v['Actividad']['nombre']}$txtenlaceweb</td><td>{$v['Zona']['nombre']}</td><td>$txthorario</td></tr>\n";
	}
?>
</table>
<p><?php echo $this->Paginator->numbers(); ?></p>


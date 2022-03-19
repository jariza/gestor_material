<?php
	echo "<h1 style=\"display: inline-block; width: 80%\">Gestión de actividades</h1>\n";
	echo "<p style=\"display: inline-block; width: 18%; text-align: right\">".$this->Html->image('ayuda.png', array('alt' => 'Ayuda', 'url' => array('action' => 'ayuda')))."</p>\n";
	echo '<p style="display: inline-block; width: 18%">'.$this->Html->link("Añadir nueva", array('action' => 'nueva'))."</p>\n";

    echo $this->Form->create('Actividad', array('class' => 'buscar'));
    echo $this->Form->input('q', array('label' => false, 'div' => false));
    echo $this->Form->end(array('label' => 'Filtrar por nombre', 'div' => false));
?>

<table>
	<tr>
		<th>Opciones</th>
		<th><?php echo $this->Paginator->sort('nombre', 'Nombre'); ?></th>
		<th><?php echo $this->Paginator->sort('zona', 'Zona'); ?></th>
		<th><?php echo $this->Paginator->sort('horario', 'Horario'); ?></th>
	</tr>
<?php
	foreach ($actividades as $v) {
		$v['Actividad'] = array_map('htmlspecialchars', $v['Actividad']);
		echo '<tr><td>'.$this->Html->link("Detalles", array('action' => 'view', $v['Actividad']['id']), array('title' => 'Detalle de la actividad'));
		echo " (".$this->Html->link('E', array('action' => 'edit', $v['Actividad']['id']), array('title' => 'Editar'));
		echo "/".$this->Form->postLink('X', array('action' => 'delete', $v['Actividad']['id']), array('title' => 'Borrar', 'confirm' => "¿Seguro que deseas eliminar la actividad {$v['Actividad']['nombre']}?")).")</td>";
		if ($v['Actividad']['enlaceweb'] != '') {
			$txtenlaceweb = " [<a href=\"{$v['Actividad']['enlaceweb']}\" target=\"_blank\">Web</a>]";
		}
		else {
			$txtenlaceweb = '';
		}
		if (count($v['Horario']) == 0) {
			$txthorario = 'No definido';
		}
		elseif (count($v['Horario']) == 1) {
			$tini = strtotime($v['Horario'][0]['inicio']);
			$tfin = strtotime($v['Horario'][0]['fin']);
			if (date('Y-m-d', $tini) == date('Y-m-d', $tfin)) { //Están en el mismo día
				$txthorario = date('D, j/M/Y, \d\e G:i:s \a ', $tini).date('G:i:s', $tfin);
			}
			else {
				$txthorario = date('\D\e\l D j/M/Y \a \l\a\s  G:i:s \a\l ', $tini).date('D j/M/Y \a \l\a\s  G:i:s', $tfin);
			}
		}
		else {
			$txthorario = 'Múltiples';
		}
		echo "<td>{$v['Actividad']['nombre']}$txtenlaceweb</td><td>".htmlspecialchars($v['Zona']['nombre'])."</td><td>$txthorario</td></tr>\n";
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

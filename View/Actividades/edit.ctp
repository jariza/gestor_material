<?php
echo "<h1>Editar actividad</h1>\n";
$lngnec = count($this->request['data']['Necesidadactividad']);
if (array_key_exists('Horario', $this->request['data'])) {
	$lnghorarios = count($this->request['data']['Horario']);
}
else {
	$lnghorarios = 0;
}

echo $this->Form->create('Actividad', array('onsubmit' => 'numSesion()'));
echo $this->Form->input('nombre');
echo $this->Form->input('zona_id', array('onchange' => 'getRecursosZona(this.value)'));
echo $this->Form->input('enlaceweb', array('label' => 'Enlace a web de '.Configure::read('datosevento.nombre')));
echo $this->Form->input('desctecnica', array('label' => 'Descripción técnica'));
?>
<h2 id="cabecerahorario">Horario</h2>
<table id="tablahorarios">
<?php
	if ($this->request['data']['Zona']['calendarioext'] == '0') {
		echo "\t<caption>No usa calendario externo.</caption>\n";
	}
	else {
		if ($this->request['data']['Zona']['sync_calext'] == '0000-00-00 00:00:00') {
			echo "\t<caption>Pendiente de sincronización con calendario externo.</caption>\n";
		}
		else {
			echo "\t<caption>Última sincronización con calendario externo: ".date('D, j/M/Y G:i:s', strtotime($this->request['data']['Zona']['sync_calext']))."</caption>\n";
		}
	}
?>
<tr><th></th><th>Sesión</th><th>Inicio</th><th>Fin</th></tr>
<?php
	if ($this->request['data']['Zona']['calendarioext'] == '0') {
		if ($lnghorarios == 0) {
			echo "<tr id=\"horario0\">\n";
			echo "\t<td>".$this->Form->button('&nbsp;-&nbsp;',array('type'=>'button','title'=>'Eliminar el horario', 'onclick' => 'removeHorario(0)'))."</td>\n";
			echo "\t<td>".$this->Form->input('Horario.0.sesion', array('type' => 'text', 'size' => 3, 'div' => false, 'label' => '', 'readonly'=>'readonly', 'class' => 'faketext'))."</td>\n";
			echo "\t<td>".$this->Form->input('Horario.0.inicio', array('div' => false, 'label' => false, 'dateFormat' => 'DMY', 'timeFormat' => 24, 'empty' => '-'))."</td>\n";
			echo "\t<td>".$this->Form->input('Horario.0.fin', array('div' => false, 'label' => false, 'dateFormat' => 'DMY', 'timeFormat' => 24, 'empty' => '-'))."</td>\n</tr>\n";
		}
		else {
			foreach ($this->request['data']['Horario'] as $k => $v) {
				echo "<tr id=\"horario$k\">\n";
				if (array_key_exists('id', $v)) {
					echo '<td>'.$this->Html->Link('[X]', array('controller' => 'horarios', 'action' => 'delete', $v['id']), array('confirm' => "¿Seguro que deseas eliminar esta horario?\n¡LAS MODIFICACIONES NO GUARDADAS SE PERDERÁN!"))."</td>\n";
				}
				else { //Por si hubo un fallo antes de guardar el horario
					echo '<td>'.$this->Form->button('&nbsp;-&nbsp;',array('type'=>'button','title'=>'Eliminar el horario', 'onclick' => "removeHorario($k)"))."</td>\n";
				}
				echo "\t<td>".$this->Form->input("Horario.$k.sesion", array('type' => 'text', 'size' => 3, 'div' => false, 'label' => '', 'readonly'=>'readonly', 'class' => 'faketext'))."</td>\n";
				echo "\t<td>".$this->Form->input("Horario.$k.inicio", array('div' => false, 'label' => false, 'dateFormat' => 'DMY', 'timeFormat' => 24))."</td>\n";
				echo "\t<td>".$this->Form->input("Horario.$k.fin", array('div' => false, 'label' => false, 'dateFormat' => 'DMY', 'timeFormat' => 24)).$this->Form->input("Horario.$k.id", array('label' => false, 'type' => 'hidden'))."</td>\n";
				echo "</tr>\n";
			}
		}
		?>
		<tr id="trAdd">
			<td><?php echo $this->Form->button('+',array('type'=>'button','title'=>'Añadir un ítem','onclick'=>'addHorario()')); ?></td>
			<td></td>
			<td><?php echo $this->Form->button('Asignar nº sesión',array('type'=>'button','title'=>'Asignar nº sesión','onclick'=>'numSesion()')); ?></td>
			<td></td>
		</tr>
<?php
	}
	elseif (array_key_exists('Horario', $this->request['data'])) {
		foreach ($this->request['data']['Horario'] as $k => $v) {
			echo "\t\t<tr id=\"horario$k\"><td></td><td>{$v['sesion']}</td><td>";
			echo date('D, j/M/Y G:i:s', strtotime($v['inicio']));
			echo "</td><td>";
			echo date('D, j/M/Y G:i:s', strtotime($v['fin']));
			echo "</td></tr>\n";
		}
	}
?>
</table>

<h2>Recursos de la zona</h2>
<div id="recursoszona"></div>

<h2>Necesidades</h2>
<table id="tablanecesidades">
<tr><th></th><th>Descripción</th><th>Cantidad</th><th>Infraestructura</th></th><th>Sesión</th><th>Objeto asignado</th></tr>
<?php
if ($lngnec == 0) {
	echo "<tr id=\"necesidad0\">\n";
		echo '<td>'.$this->Form->button('&nbsp;-&nbsp;',array('type'=>'button','title'=>'Eliminar la necesidad', 'onclick' => 'removeNecesidadactividad(0)'))."</td>\n";
		echo '<td>'.$this->Form->input("Necesidadactividad.0.descripcion",array('label'=> false,'type'=>'text', 'div' => false))."</td>\n";
		echo '<td>'.$this->Form->input("Necesidadactividad.0.cantidad",array('label'=> false,'type'=>'text', 'div' => false))."</td>\n";
		echo '<td>'.$this->Form->input("Necesidadactividad.0.infraestructura",array('label'=> false, 'div' => false))."</td>\n";
		echo '<td>'.$this->Form->input("Necesidadactividad.0.sesion",array('label'=> false, 'type'=>'text', 'div' => false))."</td>\n";
		echo '<td class="objetoasignado">'.$this->Form->input("Necesidadactividad.0.objeto_nombre",array('label'=> false,'type'=>'text', 'div' => false)).$this->Form->input("Necesidadactividad.0.objeto_id",array('label'=> false,'type'=>'text', 'div' => false, 'size' => 4, 'readonly'=>'readonly'))."</td>\n";
	echo "</tr>\n";
}
else {
	foreach ($this->request['data']['Necesidadactividad'] as $k => $v) {
		echo "<tr id=\"necesidad$k\">\n";
		echo '<td>'.$this->Html->Link('[X]', array('controller' => 'necesidadactividades', 'action' => 'delete', $v['id']), array('confirm' => "¿Seguro que deseas eliminar esta necesidad?\n¡LAS MODIFICACIONES NO GUARDADAS SE PERDERÁN!"))."</td>\n";
		echo '<td>'.$this->Form->input("Necesidadactividad.$k.descripcion",array('label'=> false, 'type'=>'text', 'div' => false))."</td>\n";
		echo '<td>'.$this->Form->input("Necesidadactividad.$k.cantidad",array('label'=> false, 'type'=>'text', 'div' => false))."</td>\n";
		echo '<td>'.$this->Form->input("Necesidadactividad.$k.infraestructura",array('label'=> false, 'div' => false))."</td>\n";
		echo '<td>'.$this->Form->input("Necesidadactividad.$k.sesion",array('label'=> false, 'type'=>'text', 'div' => false))."</td>\n";
		if (is_null($v['objeto_id'])) {
			$txtobjeto = '';
		}
		else {
			$txtobjeto = $v['Objeto']['descripcion'];
		}
		echo '<td class="objetoasignado">'.$this->Form->input("Necesidadactividad.$k.id", array('label' => false, 'type' => 'hidden'));
		echo $this->Form->input("Necesidadactividad.$k.objeto_nombre",array('label'=> $txtobjeto, 'type'=>'text', 'div' => false));
		echo $this->Form->input("Necesidadactividad.$k.objeto_id",array('label'=> false,'type'=>'text', 'div' => false, 'size' => 4, 'class' => 'objetoa', 'readonly'=>'readonly'))."</td>\n";
		echo "</tr>\n";
	}
}
?>
<tr id="trAdd">
	<td><?php echo $this->Form->button('+',array('type'=>'button','title'=>'Añadir necesidad','onclick'=>'addNecesidadactividad()')); ?></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
</tr>
</table>
<?php
echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->submit('Guardar actividad', array('after' => $this->Html->link('Cancelar', array('action' => 'index'), array('class' => 'btncancelar'))));
echo $this->Form->end();

echo $this->Html->script(array('actividades'));
echo $this->Html->script(array('jquery'));
echo $this->Html->script(array('jquery-ui-autocomplete/jquery-ui'));
?>

<script type='text/javascript'>
	var lastNecesidad=<?php if ($lngnec == 0) {echo 0;} else {echo $lngnec-1;} ?>;
	var lastHorario=<?php if ($lnghorarios == 0) {echo 0;} else {echo $lnghorarios-1;} ?>;

	function addNecesidadactividad() {
		lastNecesidad++;
		$("#tablanecesidades tr#necesidad0").clone().attr('id','necesidad'+lastNecesidad).removeAttr('style').insertBefore("#tablanecesidades tr#trAdd");
		$("#necesidad"+lastNecesidad+" td:first").empty().append('<?php echo $this->Form->button('&nbsp;-&nbsp;',array('type'=>'button','title'=>'Eliminar la necesidad', 'onclick' => 'removeNecesidadactividad(\'+lastNecesidad+\')')); ?>');
		$("#necesidad"+lastNecesidad+" input:first").attr('name','data[Necesidadactividad]['+lastNecesidad+'][descripcion]').attr('id','Necesidadactividad'+lastNecesidad+'Descripcion').val('');
		$("#necesidad"+lastNecesidad+" input:eq(1)").attr('name','data[Necesidadactividad]['+lastNecesidad+'][cantidad]').attr('id','Necesidadactividad'+lastNecesidad+'Cantidad').val('');
		$("#necesidad"+lastNecesidad+" input:eq(2)").attr('name','data[Necesidadactividad]['+lastNecesidad+'][infraestructura]').attr('id','Necesidadactividad'+lastNecesidad+'Infraestructura_').val('0');
		$("#necesidad"+lastNecesidad+" input:eq(3)").attr('name','data[Necesidadactividad]['+lastNecesidad+'][infraestructura]').attr('id','Necesidadactividad'+lastNecesidad+'Infraestructura').prop('checked', false);
		$("#necesidad"+lastNecesidad+" input:eq(4)").attr('name','data[Necesidadactividad]['+lastNecesidad+'][sesion]').attr('id','Necesidadactividad'+lastNecesidad+'Sesion').val('');
		$("#necesidad"+lastNecesidad+" input:eq(5)").attr('name','data[Necesidadactividad]['+lastNecesidad+'][id]').attr('id','Necesidadactividad'+lastNecesidad+'Id').val('');
		$("#necesidad"+lastNecesidad+" input:eq(6)").attr('name','data[Necesidadactividad]['+lastNecesidad+'][objeto_nombre]').attr('id','Necesidadactividad'+lastNecesidad+'ObjetoNombre').val('');
		$("#necesidad"+lastNecesidad+" label:first").attr('for','Necesidadactividad'+lastNecesidad+'ObjetoNombre').text("");
		$("#necesidad"+lastNecesidad+" input:eq(7)").attr('name','data[Necesidadactividad]['+lastNecesidad+'][objeto_id]').attr('id','Necesidadactividad'+lastNecesidad+'ObjetoId').val('');
		$('#Necesidadactividad'+lastNecesidad+'Descripcion').autocomplete({
			source:"<?php echo Router::url('/', true); ?>necesidadactividades/findnecesidades",
			open: function() {$('.ui-menu').width('30em')}
		});
		$('#Necesidadactividad'+lastNecesidad+'ObjetoNombre').autocomplete({
			source:"<?php echo Router::url('/', true); ?>objetos/findobjeto?i="+horarioInicioSesion(lastNecesidad)+'&f='+horarioFinSesion(lastNecesidad),
			open: function() {$('.ui-menu').width('30em')},
			select: function(event, ui) {$('#'+event.target.id.replace('Nombre', 'Id')).val(ui.item.id);}
		});
	}
	function removeNecesidadactividad(x) {
		$("#necesidad"+x).remove();
	}

	function addHorario() {
		lastHorario++;
		$("#tablahorarios tr#horario0").clone().attr('id','horario'+lastHorario).removeAttr('style').insertBefore("#tablahorarios tr#trAdd");
		$("#horario"+lastHorario+" td:first").empty().append('<?php echo $this->Form->button('&nbsp;-&nbsp;',array('type'=>'button','title'=>'Eliminar el horario', 'onclick' => 'removeHorario(\'+lastHorario+\')')); ?>');
		$("#horario"+lastHorario+" input:first").attr('name','data[Horario]['+lastHorario+'][sesion]').attr('id','Horario'+lastHorario+'Sesion');
		$("#horario"+lastHorario+" select:first").attr('name','data[Horario]['+lastHorario+'][inicio][day]').attr('id','Horario'+lastHorario+'InicioDay');
		$("#horario"+lastHorario+" select:eq(1)").attr('name','data[Horario]['+lastHorario+'][inicio][month]').attr('id','Horario'+lastHorario+'InicioMonth');
		$("#horario"+lastHorario+" select:eq(2)").attr('name','data[Horario]['+lastHorario+'][inicio][year]').attr('id','Horario'+lastHorario+'InicioYear');
		$("#horario"+lastHorario+" select:eq(3)").attr('name','data[Horario]['+lastHorario+'][inicio][hour]').attr('id','Horario'+lastHorario+'InicioHour');
		$("#horario"+lastHorario+" select:eq(4)").attr('name','data[Horario]['+lastHorario+'][inicio][min]').attr('id','Horario'+lastHorario+'InicioMin');
		$("#horario"+lastHorario+" select:eq(5)").attr('name','data[Horario]['+lastHorario+'][fin][day]').attr('id','Horario'+lastHorario+'FinDay');
		$("#horario"+lastHorario+" select:eq(6)").attr('name','data[Horario]['+lastHorario+'][fin][month]').attr('id','Horario'+lastHorario+'FinMonth');
		$("#horario"+lastHorario+" select:eq(7)").attr('name','data[Horario]['+lastHorario+'][fin][year]').attr('id','Horario'+lastHorario+'FinYear');
		$("#horario"+lastHorario+" select:eq(8)").attr('name','data[Horario]['+lastHorario+'][fin][hour]').attr('id','Horario'+lastHorario+'FinHour');
		$("#horario"+lastHorario+" select:eq(9)").attr('name','data[Horario]['+lastHorario+'][fin][min]').attr('id','Horario'+lastHorario+'FinMin');
	}
	function removeHorario(x) {
		$("#horario"+x).remove();
	}

<?php
if ($lngnec == 0) {$lngnec = 1;} //Fuerza insertar al menos una cuando no hay necesidades
for ($i = 0; $i < $lngnec; $i++) {
?>
	$('#Necesidadactividad<?php echo $i; ?>Descripcion').autocomplete({
		source:"<?php echo Router::url('/', true); ?>necesidadactividades/findnecesidades",
			open: function() {$('.ui-menu').width('30em')}
		});
	$('#Necesidadactividad<?php echo $i; ?>ObjetoNombre').autocomplete({
		source:"<?php echo Router::url('/', true); ?>objetos/findobjeto?i="+horarioInicioSesion($('#Necesidadactividad<?php echo $i; ?>Sesion').val())+'&f='+horarioFinSesion($('#Necesidadactividad<?php echo $i; ?>Sesion').val()),
		open: function() {$('.ui-menu').width('30em')},
		select: function(event, ui) {$('#'+event.target.id.replace('Nombre', 'Id')).val(ui.item.id);}
	});
<?php
}
?>

	$('#ActividadZonaId').change(function() {
		var conhorario = [<?php echo '"'.implode('", "', $horariozonas).'"'; ?>];
		if ($.inArray($('#ActividadZonaId').val(), conhorario) == -1) {
			$('#tablahorarios').show();
			$('#cabecerahorario').show();
			$('input[id^=Horario0]').prop('disabled', false);
			$('select[id^=Horario0]').prop('disabled', false);
		}
		else {
			$('#tablahorarios').hide();
			$('#cabecerahorario').hide();
			$('input[id^=Horario0]').prop('disabled', true);
			$('select[id^=Horario0]').prop('disabled', true);
		}
	});
	$('#ActividadZonaId').change();
	
	function getRecursosZona(id) {
		$.ajax({
			type: "GET",
			url: '<?php echo Router::url('/', true); ?>Necesidadzonas/necesidadeszona/'+id,
			success: function(data) {
				$('#recursoszona').html(data);
			}
		});
	}

</script>

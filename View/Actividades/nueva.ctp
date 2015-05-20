<script type="text/javascript">
	function a1() {
		console.log("HOLAKEASE");
	}
</script>

<?php
echo "<h1>Nueva actividad</h1>\n";

echo $this->Form->create('Actividad', array('onsubmit' => 'numSesion(); a1()'));
echo $this->Form->input('nombre');
echo $this->Form->input('zona_id', array('onchange' => 'getRecursosZona(this.value)'));
echo $this->Form->input('enlaceweb', array('label' => 'Enlace a web de '.Configure::read('datosevento.nombre')));
echo $this->Form->input('desctecnica', array('label' => 'Descripción técnica'));
?>
<h2 id="cabecerahorario">Horario</h2>
<table id="tablahorarios">
<tr><th></th><th>Sesión</th><th>Inicio</th><th>Fin</th></tr>
<?php
echo "<tr id=\"horario0\">\n";
echo "\t<td>".$this->Form->button('&nbsp;-&nbsp;',array('type'=>'button','title'=>'Eliminar el horario', 'onclick' => 'removeHorario(0)'))."</td>\n";
echo "\t<td>".$this->Form->input('Horario.0.sesion', array('type' => 'text', 'size' => 3, 'div' => false, 'label' => '', 'readonly'=>'readonly', 'class' => 'faketext'))."</td>\n";
echo "\t<td>".$this->Form->input('Horario.0.inicio', array('div' => false, 'label' => false, 'dateFormat' => 'DMY', 'timeFormat' => 24, 'empty' => '-'))."</td>\n";
echo "\t<td>".$this->Form->input('Horario.0.fin', array('div' => false, 'label' => false, 'dateFormat' => 'DMY', 'timeFormat' => 24, 'empty' => '-'))."</td>\n</tr>\n";
?>
<tr id="trAdd">
	<td><?php echo $this->Form->button('+',array('type'=>'button','title'=>'Añadir un ítem','onclick'=>'addHorario()')); ?></td>
	<td></td>
	<td><?php echo $this->Form->button('Asignar nº sesión',array('type'=>'button','title'=>'Asignar nº sesión','onclick'=>'numSesion()')); ?></td>
	<td></td>
</tr>
</table>

<h2>Recursos de la zona</h2>
<div id="recursoszona"></div>

<h2>Necesidades</h2>
<table id="tablanecesidades">
<tr><th></th><th>Descripción</th><th>Cantidad</th><th>Infraestructura</th><th>Sesión</th><th>Objeto asignado</th></tr>
<?php
echo "<tr id=\"necesidad0\">\n";
	echo '<td>'.$this->Form->button('&nbsp;-&nbsp;',array('type'=>'button','title'=>'Eliminar la necesidad', 'onclick' => 'removeNecesidadactividad(0)'))."</td>\n";
	echo '<td>'.$this->Form->input("Necesidadactividad.0.descripcion",array('label'=> false,'type'=>'text', 'div' => false))."</td>\n";
	echo '<td>'.$this->Form->input("Necesidadactividad.0.cantidad",array('label'=> false,'type'=>'text', 'div' => false))."</td>\n";
	echo '<td>'.$this->Form->input("Necesidadactividad.0.infraestructura",array('label'=> false, 'div' => false))."</td>\n";
	echo '<td>'.$this->Form->input("Necesidadactividad.0.sesion",array('label'=> false,'type'=>'text', 'div' => false))."</td>\n";
	echo '<td class="objetoasignado">'.$this->Form->input("Necesidadactividad.0.objeto_nombre",array('label'=> false,'type'=>'text', 'div' => false)).$this->Form->input("Necesidadactividad.0.objeto_id",array('label'=> false,'type'=>'text', 'div' => false, 'size' => 4, 'readonly'=>'readonly'))."</td>\n";
echo "</tr>\n";
?>
<tr id="trAdd">
	<td><?php echo $this->Form->button('+',array('type'=>'button','title'=>'Añadir un ítem','onclick'=>'addNecesidadactividad()')); ?></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
</tr>
</table>
<?php
echo $this->Form->submit('Guardar actividad', array('after' => $this->Html->link('Cancelar', array('action' => 'index'), array('class' => 'btncancelar'))));
echo $this->Form->end();
	
echo $this->Html->script(array('actividades'));
echo $this->Html->script(array('jquery'));
echo $this->Html->script(array('jquery-ui-autocomplete/jquery-ui'));

?>

<script type='text/javascript'>
	var lastNecesidad=0;
	var lastHorario=0;
	
	function addNecesidadactividad() {
		lastNecesidad++;
		$("#tablanecesidades tr#necesidad0").clone().attr('id','necesidad'+lastNecesidad).removeAttr('style').insertBefore("#tablanecesidades tr#trAdd");
		$("#necesidad"+lastNecesidad+" button").removeAttr('onclick').attr('onclick','removeNecesidadactividad('+lastNecesidad+')');
		$("#necesidad"+lastNecesidad+" input:first").attr('name','data[Necesidadactividad]['+lastNecesidad+'][descripcion]').attr('id','Necesidadactividad'+lastNecesidad+'Descripcion').val('');
		$("#necesidad"+lastNecesidad+" input:eq(1)").attr('name','data[Necesidadactividad]['+lastNecesidad+'][cantidad]').attr('id','Necesidadactividad'+lastNecesidad+'Cantidad').val('');
		$("#necesidad"+lastNecesidad+" input:eq(2)").attr('name','data[Necesidadactividad]['+lastNecesidad+'][infraestructura]').attr('id','Necesidadactividad'+lastNecesidad+'Infraestructura_').val('0');
		$("#necesidad"+lastNecesidad+" input:eq(3)").attr('name','data[Necesidadactividad]['+lastNecesidad+'][infraestructura]').attr('id','Necesidadactividad'+lastNecesidad+'Infraestructura').prop('checked', false);
		$("#necesidad"+lastNecesidad+" input:eq(4)").attr('name','data[Necesidadactividad]['+lastNecesidad+'][sesion]').attr('id','Necesidadactividad'+lastNecesidad+'Sesion').val('');
		$("#necesidad"+lastNecesidad+" input:eq(5)").attr('name','data[Necesidadactividad]['+lastNecesidad+'][objeto_id]').attr('id','Necesidadactividad'+lastNecesidad+'ObjetoId').val('');
		$("#necesidad"+lastNecesidad+" label:first").attr('for','Necesidadactividad'+lastNecesidad+'ObjetoNombre').text("");
		$("#necesidad"+lastNecesidad+" input:eq(6)").attr('name','data[Necesidadactividad]['+lastNecesidad+'][objeto_nombre]').attr('id','Necesidadactividad'+lastNecesidad+'ObjetoNombre').val('');
		$('#Necesidadactividad'+lastNecesidad+'Descripcion').autocomplete({
			source:"<?php echo Router::url('/', true); ?>necesidadactividades/findnecesidades",
			open: function() {$('.ui-menu').width('30em')}
		});
		$('#Necesidadactividad'+lastNecesidad+'ObjetoNombre').autocomplete({
			source:"<?php echo Router::url('/', true); ?>objetos/findobjeto?i="+horarioInicioSesion(lastNecesidad)+'&f='+horarioFinSesion(lastNecesidad),
			open: function() {$('.ui-menu').width('30em')},
			select: function(event, ui) {$('#'+event.target.id.replace('Nombre', 'Id')).val(ui.item.id); console.log(event.target.id);}
		});
	}
	function removeNecesidadactividad(x) {
		$("#necesidad"+x).remove();
	}
	
	function addHorario() {
		lastHorario++;
		$("#tablahorarios tr#horario0").clone().attr('id','horario'+lastHorario).removeAttr('style').insertBefore("#tablahorarios tr#trAdd");
		$("#horario"+lastHorario+" button").removeAttr('onclick').attr('onclick','removeHorario('+lastHorario+')');
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

	$('#Necesidadactividad0Descripcion').autocomplete({
		source:"<?php echo Router::url('/', true); ?>necesidadactividades/findnecesidades",
		open: function() {$('.ui-menu').width('30em')}
	});
	$('#Necesidadactividad0ObjetoNombre').autocomplete({
		source:"<?php echo Router::url('/', true); ?>objetos/findobjeto?i="+horarioInicioSesion(0)+'&f='+horarioFinSesion(0),
		open: function() {$('.ui-menu').width('30em')},
		select: function(event, ui) {$('#'+event.target.id.replace('Nombre', 'Id')).val(ui.item.id); console.log(event.target.id);}
	});
	
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

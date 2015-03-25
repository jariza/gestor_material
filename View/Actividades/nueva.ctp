<?php
echo "<h1>Nueva actividad</h1>\n";

echo $this->Form->create('Actividad');
echo $this->Form->input('nombre');
echo $this->Form->input('zona_id');
echo $this->Form->input('inicio', array('dateFormat' => 'DMY', 'timeFormat' => 24));
echo $this->Form->input('fin', array('dateFormat' => 'DMY', 'timeFormat' => 24));
echo $this->Form->input('enlaceweb', array('label' => 'Enlace a web de '.Configure::read('datosevento.nombre')));
echo $this->Form->input('desctecnica', array('label' => 'Descripción técnica'));

?>
<h2>Necesidades</h2>
<table id="tablanecesidades">
<tr><th></th><th>Descripción</th><th>Cantidad</th><th>Objeto asignado</th></tr>
<?php
echo "<tr id=\"necesidad0\">\n";
	echo '<td>'.$this->Form->button('&nbsp;-&nbsp;',array('type'=>'button','title'=>'Eliminar la necesidad', 'onclick' => 'removeNecesidadactividad(0)'))."</td>\n";
	echo '<td>'.$this->Form->input("Necesidadactividad.0.descripcion",array('label'=>'','type'=>'text'))."</td>\n";
	echo '<td>'.$this->Form->input("Necesidadactividad.0.cantidad",array('label'=>'','type'=>'text'))."</td>\n";
	echo '<td>'.$this->Form->input("Necesidadactividad.0.objeto_id",array('label'=>'','type'=>'text', 'readonly'=>'readonly')).$this->Form->input("Necesidadactividad.0.objeto_nombre",array('label'=>'','type'=>'text'))."</td>\n";
echo "</tr>\n";
?>
<tr id="trAdd">
	<td><?php echo $this->Form->button('+',array('type'=>'button','title'=>'Añadir un ítem','onclick'=>'addNecesidadactividad()')); ?></td>
	<td></td>
	<td></td>
	<td></td>
</tr>
</table>
<?php
echo $this->Form->submit('Guardar actividad', array('after' => $this->Html->link('Cancelar', array('action' => 'index'), array('class' => 'btncancelar'))));
echo $this->Form->end();
	
echo $this->Html->script(array('jquery'));
echo $this->Html->script(array('jquery-ui-autocomplete/jquery-ui'));
?>

<script type='text/javascript'>
	var lastRow=0;
	
	function addNecesidadactividad() {
		lastRow++;
		$("#tablanecesidades tr#necesidad0").clone().attr('id','necesidad'+lastRow).removeAttr('style').insertBefore("#tablanecesidades tr#trAdd");
		$("#necesidad"+lastRow+" button").removeAttr('onclick').attr('onclick','removeNecesidadactividad('+lastRow+')');
		$("#necesidad"+lastRow+" input:first").attr('name','data[Necesidadactividad]['+lastRow+'][descripcion]').attr('id','Necesidadactividad'+lastRow+'Descripcion').val('');
		$("#necesidad"+lastRow+" input:eq(1)").attr('name','data[Necesidadactividad]['+lastRow+'][cantidad]').attr('id','Necesidadactividad'+lastRow+'Cantidad').val('');
		$("#necesidad"+lastRow+" input:eq(2)").attr('name','data[Necesidadactividad]['+lastRow+'][objeto_id]').attr('id','Necesidadactividad'+lastRow+'Objeto_id').val('');
		$("#necesidad"+lastRow+" input:eq(3)").attr('name','data[Necesidadactividad]['+lastRow+'][objeto_nombre]').attr('id','Necesidadactividad'+lastRow+'Objeto_nombre').val('');
		$('#Necesidadactividad'+lastRow+'Descripcion').autocomplete({
			source:"<?php echo Router::url('/', true); ?>necesidadactividad/findnecesidades",
			open: function() {$('.ui-menu').width('30em')}
		});
	}
	function removeNecesidadactividad(x) {
		$("#necesidad"+x).remove();
	}

	$('#Necesidadactividad0Descripcion').autocomplete({
		source:"<?php echo Router::url('/', true); ?>necesidadactividades/findnecesidades",
		open: function() {$('.ui-menu').width('30em')}
	});
</script>

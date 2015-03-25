<?php
echo "<h1>Editar actividad</h1>\n";

$lng = count($this->request['data']['Necesidadactividad']);

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
if ($lng == 0) {
	echo "<tr id=\"necesidad0\">\n";
		echo '<td>'.$this->Form->button('&nbsp;-&nbsp;',array('type'=>'button','title'=>'Eliminar la necesidad', 'onclick' => 'removeNecesidadactividad(0)'))."</td>\n";
		echo '<td>'.$this->Form->input("Necesidadactividad.0.descripcion",array('label'=>'','type'=>'text'))."</td>\n";
		echo '<td>'.$this->Form->input("Necesidadactividad.0.cantidad",array('label'=>'','type'=>'text'))."</td>\n";
		echo '<td>'.$this->Form->input("Necesidadactividad.0.objeto_id",array('label'=>'','type'=>'text', 'readonly'=>'readonly')).$this->Form->input("Necesidadactividad.0.objeto_nombre",array('label'=>'','type'=>'text'))."</td>\n";
	echo "</tr>\n";
}
else {
	foreach ($this->request['data']['Necesidadactividad'] as $k => $v) {
		echo "<tr id=\"necesidad$k\">\n";
		echo '<td>'.$this->Html->Link('[X]', array('controller' => 'necesidadactividades', 'action' => 'delete', $v['id']), array('confirm' => "¿Seguro que deseas eliminar esta necesidad?\n¡LAS MODIFICACIONES NO GUARDADAS SE PERDERÁN!"))."</td>\n";
		echo '<td>'.$this->Form->input("Necesidadactividad.$k.descripcion",array('label'=> false, 'type'=>'text', 'div' => false))."</td>\n";
		echo '<td>'.$this->Form->input("Necesidadactividad.$k.cantidad",array('label'=> '', 'type'=>'text', 'div' => false))."</td>\n";
		echo '<td>'.$this->Form->input("Necesidadactividad.$k.objeto_id",array('label'=>'','type'=>'text', 'readonly'=>'readonly'));
		echo $this->Form->input("Necesidadactividad.$k.id", array('type' => 'text'));
		if (is_null($v['objeto_id'])) {
			$txtobjeto = '';
		}
		else {
			$txtobjeto = $v['Objeto']['descripcion'];
		}
		echo $this->Form->input("Necesidadactividad.$k.objeto_nombre",array('label'=> $txtobjeto, 'type'=>'text', 'div' => false))."</td>\n";
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
</tr>
</table>
<?php
echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->submit('Guardar actividad', array('after' => $this->Html->link('Cancelar', array('action' => 'index'), array('class' => 'btncancelar'))));
echo $this->Form->end();

echo $this->Html->script(array('jquery'));
echo $this->Html->script(array('jquery-ui-autocomplete/jquery-ui'));
?>

<script type='text/javascript'>
	var lastRow=<?php echo $lng-1; ?>;
	
	function addNecesidadactividad() {
		lastRow++;
		$("#tablanecesidades tr#necesidad0").clone().attr('id','necesidad'+lastRow).removeAttr('style').insertBefore("#tablanecesidades tr#trAdd");
		$("#necesidad"+lastRow+" td:first").empty().append('<?php echo $this->Form->button('&nbsp;-&nbsp;',array('type'=>'button','title'=>'Eliminar la necesidad', 'onclick' => 'removeNecesidadactividad(\'+lastRow+\')')); ?>');
		$("#necesidad"+lastRow+" input:first").attr('name','data[Necesidadactividad]['+lastRow+'][descripcion]').attr('id','Necesidadactividad'+lastRow+'Descripcion').val('');
		$("#necesidad"+lastRow+" input:eq(1)").attr('name','data[Necesidadactividad]['+lastRow+'][cantidad]').attr('id','Necesidadactividad'+lastRow+'Cantidad').val('');
		$("#necesidad"+lastRow+" input:eq(2)").attr('name','data[Necesidadactividad]['+lastRow+'][objeto_id]').attr('id','Necesidadactividad'+lastRow+'Objeto_id').val('');
		$("#necesidad"+lastRow+" input:eq(3)").attr('name','data[Necesidadactividad]['+lastRow+'][id]').attr('id','Necesidadactividad'+lastRow+'Id').val('');
		$("#necesidad"+lastRow+" input:eq(4)").attr('name','data[Necesidadactividad]['+lastRow+'][objeto_nombre]').attr('id','Necesidadactividad'+lastRow+'Objeto_nombre').val('');
		$('#Necesidadactividad'+lastRow+'Descripcion').autocomplete({
			source:"<?php echo Router::url('/', true); ?>necesidadactividades/findnecesidades",
			open: function() {$('.ui-menu').width('30em')}
		});
	}
	function removeNecesidadactividad(x) {
		$("#necesidad"+x).remove();
	}

<?php
if ($lng == 0) {$lng = 1;} //Fuerza insertar al menos una cuando no hay necesidades
for ($i = 0; $i < $lng; $i++) {
	echo "\$('#Necesidadactividad{$i}Descripcion').autocomplete({\n";
	echo "\tsource:\"".Router::url('/', true)."necesidadactividades/findnecesidades\",\n";
	echo "\topen: function() {\$('.ui-menu').width('30em')}\n";
	echo "});\n";
}
?>
</script>

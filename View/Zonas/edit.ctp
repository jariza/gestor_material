<?php
echo "<h1>Editar zona</h1>\n";

$lng = count($this->request['data']['Necesidadzona']);

echo $this->Form->create('Zona');
echo $this->Form->input('nombre');
echo $this->Form->input('desctecnica', array('label' => 'Descripción técnica'));
?>
<h2>Necesidades</h2>
<table id="tablanecesidades">
<tr><th></th><th>Descripción</th><th>Cantidad</th><th>Objeto asignado</th></tr>
<?php
if ($lng == 0) {
	echo "<tr id=\"necesidad0\">\n";
		echo '<td>'.$this->Form->button('&nbsp;-&nbsp;',array('type'=>'button','title'=>'Eliminar la necesidad', 'onclick' => 'removeNecesidadzona(0)'))."</td>\n";
		echo '<td>'.$this->Form->input("Necesidadzona.0.descripcion",array('label'=>'','type'=>'text'))."</td>\n";
		echo '<td>'.$this->Form->input("Necesidadzona.0.cantidad",array('label'=>'','type'=>'text'))."</td>\n";
		echo '<td>'.$this->Form->input("Necesidadzona.0.objeto_id",array('label'=>'','type'=>'text', 'readonly'=>'readonly')).$this->Form->input("Necesidadzona.0.objeto_nombre",array('label'=>'','type'=>'text'))."</td>\n";
	echo "</tr>\n";
}
else {
	foreach ($this->request['data']['Necesidadzona'] as $k => $v) {
		echo "<tr id=\"necesidad$k\">\n";
		echo '<td>'.$this->Html->Link('[X]', array('controller' => 'necesidadzonas', 'action' => 'delete', $v['id']), array('confirm' => "¿Seguro que deseas eliminar esta necesidad?\n¡LAS MODIFICACIONES NO GUARDADAS SE PERDERÁN!"))."</td>\n";
		echo '<td>'.$this->Form->input("Necesidadzona.$k.descripcion",array('label'=> false, 'type'=>'text', 'div' => false))."</td>\n";
		echo '<td>'.$this->Form->input("Necesidadzona.$k.cantidad",array('label'=> '', 'type'=>'text', 'div' => false))."</td>\n";
		echo '<td>'.$this->Form->input("Necesidadzona.$k.objeto_id",array('label'=>'','type'=>'text', 'readonly'=>'readonly'));
		echo $this->Form->input("Necesidadzona.$k.id", array('type' => 'text'));
		if (is_null($v['objeto_id'])) {
			$txtobjeto = '';
		}
		else {
			$txtobjeto = $v['Objeto']['descripcion'];
		}
		echo $this->Form->input("Necesidadzona.$k.objeto_nombre",array('label'=> $txtobjeto, 'type'=>'text', 'div' => false))."</td>\n";
		echo "</tr>\n";
	}
}
?>
<tr id="trAdd">
	<td><?php echo $this->Form->button('+',array('type'=>'button','title'=>'Añadir necesidad','onclick'=>'addNecesidadzona()')); ?></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
</tr>
</table>
<?php
echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->submit('Guardar zona', array('after' => $this->Html->link('Cancelar', array('action' => 'index'), array('class' => 'btncancelar'))));
echo $this->Form->end();
?>

<?php echo $this->Html->script(array('jquery'));?>
<?php echo $this->Html->script(array('jquery-ui-autocomplete/jquery-ui'));?>

<script type='text/javascript'>
	var lastRow=<?php echo $lng-1; ?>;
	
	function addNecesidadzona() {
		lastRow++;
		$("#tablanecesidades tr#necesidad0").clone().attr('id','necesidad'+lastRow).removeAttr('style').insertBefore("#tablanecesidades tr#trAdd");
		$("#necesidad"+lastRow+" td:first").empty().append('<?php echo $this->Form->button('&nbsp;-&nbsp;',array('type'=>'button','title'=>'Eliminar la necesidad', 'onclick' => 'removeNecesidadzona(\'+lastRow+\')')); ?>');
		$("#necesidad"+lastRow+" input:first").attr('name','data[Necesidadzona]['+lastRow+'][descripcion]').attr('id','Necesidadzona'+lastRow+'Descripcion').val('');
		$("#necesidad"+lastRow+" input:eq(1)").attr('name','data[Necesidadzona]['+lastRow+'][cantidad]').attr('id','Necesidadzona'+lastRow+'Cantidad').val('');
		$("#necesidad"+lastRow+" input:eq(2)").attr('name','data[Necesidadzona]['+lastRow+'][objeto_id]').attr('id','Necesidadzona'+lastRow+'Objeto_id').val('');
		$("#necesidad"+lastRow+" input:eq(3)").attr('name','data[Necesidadzona]['+lastRow+'][id]').attr('id','Necesidadzona'+lastRow+'Id').val('');
		$("#necesidad"+lastRow+" input:eq(4)").attr('name','data[Necesidadzona]['+lastRow+'][objeto_nombre]').attr('id','Necesidadzona'+lastRow+'Objeto_nombre').val('');
		$('#Necesidadzona'+lastRow+'Descripcion').autocomplete({
			source:"<?php echo Router::url('/', true); ?>necesidadzona/findnecesidades",
			open: function() {$('.ui-menu').width('30em')}
		});
	}
	function removeNecesidadzona(x) {
		$("#necesidad"+x).remove();
	}

<?php
if ($lng == 0) {$lng = 1;} //Fuerza insertar al menos una cuando no hay necesidades
for ($i = 0; $i < $lng; $i++) {
	echo "\$('#Necesidadzona{$i}Descripcion').autocomplete({\n";
	echo "\tsource:\"".Router::url('/', true)."necesidadzona/findnecesidades\",\n";
	echo "\topen: function() {\$('.ui-menu').width('30em')}\n";
	echo "});\n";
}
?>
</script>


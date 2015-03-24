<?php
echo "<h1>Nueva zona</h1>\n";

echo $this->Form->create('Zona');
echo $this->Form->input('nombre');
echo $this->Form->input('desctecnica', array('label' => 'Descripción técnica'));

?>
<h2>Necesidades</h2>
<table id="tablanecesidades">
<tr><th></th><th>Descripción</th><th>Cantidad</th><th>Objeto asignado</th></tr>
<?php
echo "<tr id=\"necesidad0\">\n";
	echo '<td>'.$this->Form->button('&nbsp;-&nbsp;',array('type'=>'button','title'=>'Eliminar la necesidad'))."</td>\n";
	echo '<td>'.$this->Form->input("Necesidadzona.0.descripcion",array('label'=>'','type'=>'text'))."</td>\n";
	echo '<td>'.$this->Form->input("Necesidadzona.0.cantidad",array('label'=>'','type'=>'text'))."</td>\n";
	echo '<td>'.$this->Form->input("Necesidadzona.0.objeto_id",array('label'=>'','type'=>'hidden', 'readonly'=>'readonly')).$this->Form->input("Necesidadzona.0.objeto_nombre",array('label'=>'','type'=>'text'))."</td>\n";
echo "</tr>\n";
?>
<tr id="trAdd">
	<td><?php echo $this->Form->button('+',array('type'=>'button','title'=>'Añadir un ítem','onclick'=>'addNecesidadzona()')); ?></td>
	<td></td>
	<td></td>
	<td></td>
</tr>
</table>
<?php
echo $this->Form->submit('Guardar zona', array('after' => $this->Html->link('Cancelar', array('action' => 'index'), array('class' => 'btncancelar'))));
echo $this->Form->end();
	
?>

<?php echo $this->Html->script(array('jquery'));?>
<?php echo $this->Html->script(array('jquery-ui-autocomplete/jquery-ui'));?>

<script type='text/javascript'>
	var lastRow=0;
	
	function addNecesidadzona() {
		lastRow++;
		$("#tablanecesidades tr#necesidad0").clone().attr('id','Necesidadzona'+lastRow).removeAttr('style').insertBefore("#tablanecesidades tr#trAdd");
		$("#Necesidadzona"+lastRow+" button").attr('onclick','removeNecesidadzona('+lastRow+')');
		$("#Necesidadzona"+lastRow+" input:first").attr('name','data[Necesidadzona]['+lastRow+'][descripcion]').attr('id','Necesidadzona'+lastRow+'Descripcion').val('');
		$("#Necesidadzona"+lastRow+" input:eq(1)").attr('name','data[Necesidadzona]['+lastRow+'][cantidad]').attr('id','Necesidadzona'+lastRow+'Cantidad').val('');
		$("#Necesidadzona"+lastRow+" input:eq(2)").attr('name','data[Necesidadzona]['+lastRow+'][objeto_id]').attr('id','Necesidadzona'+lastRow+'Objeto_id').val('');
		$("#Necesidadzona"+lastRow+" input:eq(3)").attr('name','data[Necesidadzona]['+lastRow+'][objeto_nombre]').attr('id','Necesidadzona'+lastRow+'Objeto_nombre').val('');
	}
	function removeNecesidadzona(x) {
		$("#item"+x).remove();
	}
</script>

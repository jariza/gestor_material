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
	echo '<td>'.$this->Form->button('&nbsp;-&nbsp;',array('type'=>'button','title'=>'Eliminar la necesidad', 'onclick' => 'removeNecesidadzona(0)'))."</td>\n";
	echo '<td>'.$this->Form->input("Necesidadzona.0.descripcion",array('label'=>'','type'=>'text'))."</td>\n";
	echo '<td>'.$this->Form->input("Necesidadzona.0.cantidad",array('label'=>'','type'=>'text'))."</td>\n";
	echo '<td>'.$this->Form->input("Necesidadzona.0.objeto_id",array('label'=>'','type'=>'text', 'readonly'=>'readonly')).$this->Form->input("Necesidadzona.0.objeto_nombre",array('label'=>'','type'=>'text'))."</td>\n";
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
	
echo $this->Html->script(array('jquery'));
echo $this->Html->script(array('jquery-ui-autocomplete/jquery-ui'));
?>

<script type='text/javascript'>
	var lastRow=0;
	
	function addNecesidadzona() {
		lastRow++;
		$("#tablanecesidades tr#necesidad0").clone().attr('id','necesidad'+lastRow).removeAttr('style').insertBefore("#tablanecesidades tr#trAdd");
		$("#necesidad"+lastRow+" button").removeAttr('onclick').attr('onclick','removeNecesidadzona('+lastRow+')');
		$("#necesidad"+lastRow+" input:first").attr('name','data[Necesidadzona]['+lastRow+'][descripcion]').attr('id','Necesidadzona'+lastRow+'Descripcion').val('');
		$("#necesidad"+lastRow+" label:first").attr('for','Necesidadzona'+lastRow+'Descripcion');
		$("#necesidad"+lastRow+" input:eq(1)").attr('name','data[Necesidadzona]['+lastRow+'][cantidad]').attr('id','Necesidadzona'+lastRow+'Cantidad').val('');
		$("#necesidad"+lastRow+" label:eq(1)").attr('for','Necesidadzona'+lastRow+'Cantidad');
		$("#necesidad"+lastRow+" input:eq(2)").attr('name','data[Necesidadzona]['+lastRow+'][objeto_id]').attr('id','Necesidadzona'+lastRow+'ObjetoId').val('');
		$("#necesidad"+lastRow+" label:eq(2)").attr('for','Necesidadzona'+lastRow+'ObjetoId');
		$("#necesidad"+lastRow+" input:eq(3)").attr('name','data[Necesidadzona]['+lastRow+'][objeto_nombre]').attr('id','Necesidadzona'+lastRow+'ObjetoNombre').val('');
		$("#necesidad"+lastRow+" label:eq(3)").attr('for','Necesidadzona'+lastRow+'ObjetoNombre');
		$('#Necesidadzona'+lastRow+'Descripcion').autocomplete({
			source:"<?php echo Router::url('/', true); ?>necesidadzonas/findnecesidades",
			open: function() {$('.ui-menu').width('30em')}
		});
		$('#Necesidadzona'+lastRow+'ObjetoNombre').autocomplete({
			source:"<?php echo Router::url('/', true); ?>objetos/findobjeto",
			open: function() {$('.ui-menu').width('30em')},
			select: function(event, ui) {$('#'+event.target.id.replace('Nombre', 'Id')).val(ui.item.id); console.log(event.target.id);}
		});
	}
	function removeNecesidadzona(x) {
		$("#necesidad"+x).remove();
	}

	$('#Necesidadzona0Descripcion').autocomplete({
		source:"<?php echo Router::url('/', true); ?>necesidadzonas/findnecesidades",
		open: function() {$('.ui-menu').width('30em')}
	});
	$('#Necesidadzona0ObjetoNombre').autocomplete({
		source:"<?php echo Router::url('/', true); ?>objetos/findobjeto",
		open: function() {$('.ui-menu').width('30em')},
		select: function(event, ui) {$('#'+event.target.id.replace('Nombre', 'Id')).val(ui.item.id); console.log(event.target.id);}
	});
</script>

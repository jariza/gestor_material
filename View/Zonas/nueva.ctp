<?php
$horarioevento = Configure::read('datosevento.horario');
ksort($horarioevento);
reset($horarioevento);
$eleminicio = each($horarioevento); //value es la hora y key la fecha
$inicioevento = strtotime("{$eleminicio['key']} {$eleminicio['value']['inicio']}");
end($horarioevento);
$elemfin = each($horarioevento); //value es la hora y key la fecha
$finevento = strtotime("{$elemfin['key']} {$elemfin['value']['fin']}");

echo "<h1>Nueva zona</h1>\n";

echo $this->Form->create('Zona');
echo $this->Form->input('nombre');
if (count($calendarios) == 0) {
	echo $this->Form->input('calendarioext', array('type' => 'hidden', 'value' => '0'));
}
else {
	echo $this->Form->input('calendarioext', array('label' => 'Calendario externo con el que sincronizar', 'options' => $calendarios));
}
echo $this->Form->input('desctecnica', array('label' => 'Descripción técnica'));

?>
<h2>Necesidades</h2>
<table id="tablanecesidades">
<tr><th></th><th>Descripción</th><th>Cantidad</th><th>Infraestructura</th><th>Objeto asignado</th></tr>
<?php
echo "<tr id=\"necesidad0\">\n";
	echo '<td>'.$this->Form->button('&nbsp;-&nbsp;',array('type'=>'button','title'=>'Eliminar la necesidad', 'onclick' => 'removeNecesidadzona(0)'))."</td>\n";
	echo '<td>'.$this->Form->input("Necesidadzona.0.descripcion",array('label'=>false,'type'=>'text', 'div' => false))."</td>\n";
	echo '<td>'.$this->Form->input("Necesidadzona.0.cantidad",array('label'=>false,'type'=>'text', 'div' => false))."</td>\n";
	echo '<td>'.$this->Form->input("Necesidadzona.0.infraestructura",array('label'=> false, 'div' => false))."</td>\n";
	echo '<td class="objetoasignado">'.$this->Form->input("Necesidadzona.0.objeto_nombre",array('label'=>false,'type'=>'text', 'div' => false)).$this->Form->input("Necesidadzona.0.objeto_id",array('label'=>false,'type'=>'text', 'size' => 4, 'readonly'=>'readonly', 'div' => false))."</td>\n";
echo "</tr>\n";
?>
<tr id="trAdd">
	<td><?php echo $this->Form->button('+',array('type'=>'button','title'=>'Añadir un ítem','onclick'=>'addNecesidadzona()')); ?></td>
	<td></td>
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
		$("#necesidad"+lastRow+" input:eq(1)").attr('name','data[Necesidadzona]['+lastRow+'][cantidad]').attr('id','Necesidadzona'+lastRow+'Cantidad').val('');
		$("#necesidad"+lastRow+" input:eq(2)").attr('name','data[Necesidadzona]['+lastRow+'][infraestructura]').attr('id','Necesidadzona'+lastRow+'Infraestructura_').val('0');
		$("#necesidad"+lastRow+" input:eq(3)").attr('name','data[Necesidadzona]['+lastRow+'][infraestructura]').attr('id','Necesidadzona'+lastRow+'Infraestructura').prop('checked', false);
		$("#necesidad"+lastRow+" input:eq(4)").attr('name','data[Necesidadzona]['+lastRow+'][objeto_nombre]').attr('id','Necesidadzona'+lastRow+'ObjetoNombre').val('');
		$("#necesidad"+lastRow+" input:eq(5)").attr('name','data[Necesidadzona]['+lastRow+'][objeto_id]').attr('id','Necesidadzona'+lastRow+'ObjetoId').val('');
		$('#Necesidadzona'+lastRow+'Descripcion').autocomplete({
			source:"<?php echo Router::url('/', true); ?>necesidadzonas/findnecesidades",
			open: function() {$('.ui-menu').width('30em')}
		});
		$('#Necesidadzona'+lastRow+'ObjetoNombre').autocomplete({
			source:"<?php echo Router::url('/', true); ?>objetos/findobjeto?i=<?php echo $inicioevento; ?>&f=<?php echo $finevento; ?>",
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
		source:"<?php echo Router::url('/', true); ?>objetos/findobjeto?i=<?php echo $inicioevento; ?>&f=<?php echo $finevento; ?>",
		open: function() {$('.ui-menu').width('30em')},
		select: function(event, ui) {$('#'+event.target.id.replace('Nombre', 'Id')).val(ui.item.id); console.log(event.target.id);}
	});
</script>

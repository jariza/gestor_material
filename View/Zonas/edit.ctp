<?php
$horarioevento = Configure::read('datosevento.horario');
ksort($horarioevento);
reset($horarioevento);
$eleminicio = each($horarioevento); //value es la hora y key la fecha
$inicioevento = strtotime("{$eleminicio['key']} {$eleminicio['value']['inicio']}");
end($horarioevento);
$elemfin = each($horarioevento); //value es la hora y key la fecha
$finevento = strtotime("{$elemfin['key']} {$elemfin['value']['fin']}");

echo "<h1>Editar zona</h1>\n";

$lng = count($this->request['data']['Necesidadzona']);

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
if ($lng == 0) {
	echo "<tr id=\"necesidad0\">\n";
		echo '<td>'.$this->Form->button('&nbsp;-&nbsp;',array('type'=>'button','title'=>'Eliminar la necesidad', 'onclick' => 'removeNecesidadzona(0)'))."</td>\n";
		echo '<td>'.$this->Form->input("Necesidadzona.0.descripcion",array('label'=>false,'type'=>'text', 'div' => false))."</td>\n";
		echo '<td>'.$this->Form->input("Necesidadzona.0.cantidad",array('label'=>false,'type'=>'text', 'div' => false))."</td>\n";
		echo '<td>'.$this->Form->input("Necesidadzona.0.infraestructura",array('label'=>false, 'div' => false))."</td>\n";
		echo '<td>'.$this->Form->input("Necesidadzona.0.objeto_id",array('label'=>false,'type'=>'text', 'readonly'=>'readonly', 'div' => false)).$this->Form->input("Necesidadzona.0.objeto_nombre",array('label'=>false,'type'=>'text', 'div' => false))."</td>\n";
	echo "</tr>\n";
}
else {
	foreach ($this->request['data']['Necesidadzona'] as $k => $v) {
		echo "<tr id=\"necesidad$k\">\n";
		echo '<td>'.$this->Html->Link('[X]', array('controller' => 'necesidadzonas', 'action' => 'delete', $v['id']), array('confirm' => "¿Seguro que deseas eliminar esta necesidad?\n¡LAS MODIFICACIONES NO GUARDADAS SE PERDERÁN!"))."</td>\n";
		echo '<td>'.$this->Form->input("Necesidadzona.$k.descripcion",array('label'=>false, 'type'=>'text', 'div' => false))."</td>\n";
		echo '<td>'.$this->Form->input("Necesidadzona.$k.cantidad",array('label'=>false, 'type'=>'text', 'div' => false))."</td>\n";
		echo '<td>'.$this->Form->input("Necesidadzona.$k.infraestructura",array('label'=>false, 'div' => false))."</td>\n";
		echo '<td>'.$this->Form->input("Necesidadzona.$k.objeto_id",array('label'=>false,'type'=>'text', 'readonly'=>'readonly', 'div' => false	));
		echo $this->Form->input("Necesidadzona.$k.id", array('label' => false, 'type' => 'hidden'));
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

echo $this->Html->script(array('jquery'));
echo $this->Html->script(array('jquery-ui-autocomplete/jquery-ui'));
?>

<script type='text/javascript'>
	var lastRow=<?php echo $lng-1; ?>;
	
	function addNecesidadzona() {
		lastRow++;
		$("#tablanecesidades tr#necesidad0").clone().attr('id','necesidad'+lastRow).removeAttr('style').insertBefore("#tablanecesidades tr#trAdd");
		$("#necesidad"+lastRow+" td:first").empty().append('<?php echo $this->Form->button('&nbsp;-&nbsp;',array('type'=>'button','title'=>'Eliminar la necesidad', 'onclick' => 'removeNecesidadzona(\'+lastRow+\')')); ?>');
		$("#necesidad"+lastRow+" input:first").attr('name','data[Necesidadzona]['+lastRow+'][descripcion]').attr('id','Necesidadzona'+lastRow+'Descripcion').val('');
		$("#necesidad"+lastRow+" input:eq(1)").attr('name','data[Necesidadzona]['+lastRow+'][cantidad]').attr('id','Necesidadzona'+lastRow+'Cantidad').val('');
		$("#necesidad"+lastRow+" input:eq(2)").attr('name','data[Necesidadzona]['+lastRow+'][infraestructura]').attr('id','Necesidadzona'+lastRow+'Infraestructura_').val('0');
		$("#necesidad"+lastRow+" input:eq(3)").attr('name','data[Necesidadzona]['+lastRow+'][infraestructura]').attr('id','Necesidadzona'+lastRow+'Infraestructura').prop('checked', false);
		$("#necesidad"+lastRow+" input:eq(4)").attr('name','data[Necesidadzona]['+lastRow+'][objeto_id]').attr('id','Necesidadzona'+lastRow+'ObjetoId').val('');
		$("#necesidad"+lastRow+" input:eq(5)").attr('name','data[Necesidadzona]['+lastRow+'][id]').attr('id','Necesidadzona'+lastRow+'Id').val('');
		$("#necesidad"+lastRow+" label:first").attr('for','Necesidadzona'+lastRow+'ObjetoNombre');
		$("#necesidad"+lastRow+" input:eq(6)").attr('name','data[Necesidadzona]['+lastRow+'][objeto_nombre]').attr('id','Necesidadzona'+lastRow+'ObjetoNombre').val('');
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

<?php
if ($lng == 0) {$lng = 1;} //Fuerza insertar al menos una cuando no hay necesidades
for ($i = 0; $i < $lng; $i++) {
	echo "\$('#Necesidadzona{$i}Descripcion').autocomplete({\n";
	echo "\tsource:\"".Router::url('/', true)."necesidadzona/sfindnecesidades\",\n";
	echo "\topen: function() {\$('.ui-menu').width('30em')}\n";
	echo "});\n";
	echo "\$('#Necesidadzona{$i}ObjetoNombre').autocomplete({\n";
	echo "\tsource:\"".Router::url('/', true)."objetos/findobjeto?i=$inicioevento&f=$finevento\",\n";
	echo "\topen: function() {\$('.ui-menu').width('30em')},\n";
	echo "\tselect: function(event, ui) {\$('#'+event.target.id.replace('Nombre', 'Id')).val(ui.item.id); console.log(event.target.id);}\n";
	echo "});\n";
}
?>
</script>


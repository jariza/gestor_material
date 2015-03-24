<?php
echo "<h1>Editar zona</h1>\n"; ?>

<?php
echo $this->Form->create('Zona');
echo $this->Form->input('nombre');
echo $this->Form->input('desctecnica', array('label' => 'Descripción técnica'));
?>
<h2>Necesidades</h2>
<table id="tablanecesidads">
<tr><th></th><th>Descripción</th><th>Cantidad</th><th>Objeto asignado</th></tr>
<?php
foreach ($this->request['data']['Necesidadzona'] as $k => $v) {
	echo "<tr id=\"necesidad$k\">\n";
	echo '<td>'.$this->Html->Link('[X]', array('controller' => 'necesidadzonas', 'action' => 'delete', $v['id']), array('confirm' => "¿Seguro que deseas eliminar esta necesidad?\n¡LAS MODIFICACIONES NO GUARDADAS SE PERDERÁN!"))."</td>\n";
	echo '<td>'.$this->Form->input("Necesidadzona.$k.descripcion",array('label'=> false, 'type'=>'text', 'div' => false))."</td>\n";
	echo '<td>'.$this->Form->input("Necesidadzona.$k.cantidad",array('label'=> '', 'type'=>'text', 'div' => false))."</td>\n";
	echo '<td>'.$this->Form->input("Necesidadzona.$k.objeto_id",array('label'=>'','type'=>'hidden', 'readonly'=>'readonly'));
	echo $this->Form->input("Necesidadzona.$k.id", array('type' => 'hidden'));
	if (is_null($v['objeto_id'])) {
		$txtobjeto = '';
	}
	else {
		$txtobjeto = $v['Objeto']['descripcion'];
	}
	echo $this->Form->input("Necesidadzona.$k.objeto_nombre",array('label'=> $txtobjeto, 'type'=>'text', 'div' => false))."</td>\n";
	echo "</tr>\n";
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

//		$("#Necesidadzona"+lastRow+" input:eq(4)").remove();
//		$("#Necesidadzona"+lastRow+" label:first").remove();

?>

<?php echo $this->Html->script(array('jquery'));?>
<?php echo $this->Html->script(array('jquery-ui-autocomplete/jquery-ui'));?>

<script type='text/javascript'>
	var lastRow=<?php echo count($this->request['data']['Necesidadzona'])-1; ?>;
	
	function addNecesidadzona() {
		lastRow++;
		$("#tablanecesidads tr#necesidad0").clone().attr('id','Necesidadzona'+lastRow).removeAttr('style').insertBefore("#tablanecesidads tr#trAdd");
		$("#Necesidadzona"+lastRow+" button").attr('onclick','removeNecesidadzona('+lastRow+')');
		$("#Necesidadzona"+lastRow+" input:first").attr('name','data[Necesidadzona]['+lastRow+'][descripcion]').attr('id','Necesidadzona'+lastRow+'Descripcion').val('');
		$("#Necesidadzona"+lastRow+" input:eq(1)").attr('name','data[Necesidadzona]['+lastRow+'][cantidad]').attr('id','Necesidadzona'+lastRow+'Cantidad').val('');
		$("#Necesidadzona"+lastRow+" input:eq(2)").attr('name','data[Necesidadzona]['+lastRow+'][objeto_id]').attr('id','Necesidadzona'+lastRow+'Objeto_id').val('');
		$("#Necesidadzona"+lastRow+" input:eq(3)").attr('name','data[Necesidadzona]['+lastRow+'][objeto_nombre]').attr('id','Necesidadzona'+lastRow+'Objeto_nombre').val('');
	}
	function removeNecesidadzona(x) {
		$("#necesidad"+x).remove();
	}
</script>


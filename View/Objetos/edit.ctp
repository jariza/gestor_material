<?php
echo "<h1>Editar objeto</h1>\n"; ?>

<?php
echo $this->Form->create('Objeto');
echo $this->Form->input('descripcion');
echo $this->Form->input('ubicacion_id');
echo $this->Form->input('fungible');
echo $this->Form->input('cantidad', array('default' => 1));
echo $this->Form->input('fechaentrega', array('div' => array('id' => 'fechaentrega'), 'label' => 'Fecha de entrega', 'dateFormat' => 'DMY', 'timeFormat' => 24));
echo $this->Form->input('comentariosentrega', array('div' => array('id' => 'comentariosentrega'), 'label' => 'Comentarios sobre la entrega'));
echo $this->Form->input('comentarios');
echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->submit('Guardar objeto', array('after' => $this->Html->link('Cancelar', array('action' => 'index'), array('class' => 'btncancelar'))));
echo $this->Form->end();

echo $this->Html->script('jquery');
echo $this->Html->scriptBlock('
	$("#ObjetoUbicacionId").change(function() {
		if ($("#ObjetoUbicacionId").val() == -1) {
			$("#fechaentrega").show();
			$("#comentariosentrega").show();
		}
		else {
			$("#fechaentrega").hide();
			$("#comentariosentrega").hide();
		}
	});
	$("#ObjetoUbicacionId").trigger(\'change\');
');

?>

<?php
echo "<h1>Editar objeto</h1>\n"; ?>

<?php
echo $this->Form->create('Objeto');
echo $this->Form->input('descripcion');
echo $this->Form->input('ubicacion_id');
echo $this->Form->input('tipoobjeto_id', array('label' => 'Tipo de objeto', 'options' => Configure::read('tiposobjeto')));
echo $this->Form->input('comentarios');
echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->submit('Guardar objeto', array('after' => $this->Html->link('Cancelar', array('action' => 'index'), array('class' => 'btncancelar'))));
echo $this->Form->end();

?>

<?php
echo "<h1>Editar ubicación</h1>\n"; ?>

<?php
echo $this->Form->create('Ubicacion');
echo $this->Form->input('nombre');
echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->submit('Guardar ubicación', array('after' => $this->Html->link('Cancelar', array('action' => 'index'), array('class' => 'btncancelar'))));
echo $this->Form->end();

?>

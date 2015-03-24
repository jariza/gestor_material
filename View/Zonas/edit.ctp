<?php
echo "<h1>Editar zona</h1>\n"; ?>

<?php
echo $this->Form->create('Zona');
echo $this->Form->input('nombre');
echo $this->Form->input('desctecnica');
echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->submit('Guardar zona', array('after' => $this->Html->link('Cancelar', array('action' => 'index'), array('class' => 'btncancelar'))));
echo $this->Form->end();

?>

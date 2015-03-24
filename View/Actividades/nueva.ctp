<?php
echo "<h1>Nueva actividad</h1>\n";

echo $this->Form->create('Actividad');
echo $this->Form->input('nombre');
echo $this->Form->input('zona_id');
echo $this->Form->input('inicio', array('dateFormat' => 'DMY', 'timeFormat' => 24));
echo $this->Form->input('fin', array('dateFormat' => 'DMY', 'timeFormat' => 24));
echo $this->Form->input('enlaceweb', array('label' => 'Enlace a web de '.Configure::read('datosevento.nombre')));
echo $this->Form->input('desctecnica');
echo $this->Form->submit('Guardar actividad', array('after' => $this->Html->link('Cancelar', array('action' => 'index'), array('class' => 'btncancelar'))));
echo $this->Form->end();
	
?>

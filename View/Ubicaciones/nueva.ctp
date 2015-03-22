<?php
echo "<h1>Nueva ubicación</h1>\n";

echo $this->Form->create('Ubicacion');
echo $this->Form->input('nombre');
echo $this->Form->submit('Guardar ubicación', array('after' => $this->Html->link('Cancelar', array('action' => 'index'), array('class' => 'btncancelar'))));
echo $this->Form->end();
	
?>

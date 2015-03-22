<?php
echo "<h1>Nueva zona</h1>\n";

echo $this->Form->create('Zona');
echo $this->Form->input('nombre');
echo $this->Form->submit('Guardar zona', array('after' => $this->Html->link('Cancelar', array('action' => 'index'), array('class' => 'btncancelar'))));
echo $this->Form->end();
	
?>

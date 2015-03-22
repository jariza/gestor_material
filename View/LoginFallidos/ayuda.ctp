<h1>Ayuda sobre los logins fallidos</h1>
<p>Hay un registro de las IPs que fallaron al hacer login. Si se superan los <?php echo Configure::read('maxfallos'); ?> intentos en el mismo día se bloquea por IP. No se resetea al conseguir entrar.</p>
<p>Para borrar a un login fallido se debe pulsar sobre la X.</p>

<?php
	echo "<p>".$this->Html->link('Volver al listado de logins fallidos', array('action' => 'index'))."</p>";
?>

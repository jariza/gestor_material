<h1>Ayuda sobre la gestión de usuarios</h1>
<p style="margin-bottom: 0px">Elementos del índice:</p>
<ul style="margin-bottom: 1em">
	<li>E, enlace para edición.</li>
	<li>X, enlace para borrado.</li>
</ul>
<p>Los usuarios con rol "Admin" podrán administrar usuarios.<br />
Los usuarios con rol "Producción" puede acceder a todas las opciones salvo administración de usuarios y login fallidos.<br />
Los usuarios con rol "Manager de zona" sólo puede ver la programación de las zonas que tenga autorizadas.</p>
<p>El usuadio admin no puede ser eliminado.</p>

<?php
	echo "<p>".$this->Html->link('Volver al listado de usuarios', array('action' => 'index'))."</p>";
?>

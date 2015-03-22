<?php
//PARTE DE NO TOCAR
Configure::write('roles', array('admin' => 'Administrador', 'produccion' => 'Producción', 'managerzona' => 'Manager de zona'));
//FIN DE PARTE DE NO TOCAR

//Número máximo de fallos de login antes de bloquear
Configure::write('maxfallos', 3);

//Datos del evento
Configure::write('datosevento', array(
	'nombre' => 'Animacomic 2015', //Nombre del evento
	'imagencabecera' => 'http://www.animacomic.es/wp-content/uploads/2015/01/cabecera_general.jpg', //Imagen de la cabecera
	//'imagenpie' => '', //Imagen del pie
	'customcss' => '', //CSS propios
));

//Tipos de objeto
Configure::write('tiposobjeto', array(0 => 'Fungible', 1 => 'Impresión', 2 => 'Equpamiento', 3 => 'Material', 4 => 'Herramientas'));

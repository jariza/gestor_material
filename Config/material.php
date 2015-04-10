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
	'horario' => array(
		'2015-07-04' => array('inicio' => '10:00', 'fin' => '21:00'),
		'2015-07-05' => array('inicio' => '10:00', 'fin' => '20:00')
	),
));

//Calendario externo, Google Calendar
Configure::write('GC_email', '202257522507-2mtj9199hf166gti7fan30qmqaee600j@developer.gserviceaccount.com');
Configure::write('GC_keyfile', 'Config/63df53c241f9.p12'); //Relativo al directorio app

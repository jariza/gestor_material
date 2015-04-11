<?php
class Necesidadactividad extends AppModel {
	public $belongsTo = array('Objeto', 'Actividad');
	
    public $validate = array(
        'descripcion' => array(
            'rule' => 'notEmpty',
            'message' => 'Falta la descripción'
        ),
        'cantidad' => array(
			'rule' => 'naturalNumber',
			'message' => 'Debe ser un número mayor que cero'
		)
    );
}

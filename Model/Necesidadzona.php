<?php
class Necesidadzona extends AppModel {
	public $belongsTo = array('Objeto', 'Zona');
	
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

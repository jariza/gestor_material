<?php
class Objeto extends AppModel {
	public $belongsTo = 'Ubicacion';
	
    public $validate = array(
       'descripcion' => array(
            'rule' => 'notEmpty',
            'message' => 'No se indicó el nombre.'
        ),
        'ubicacion_id' => array(
			'rule' => 'notEmpty',
		)
	);
}

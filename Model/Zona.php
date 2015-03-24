<?php
class Zona extends AppModel {
	public $hasMany = array('Necesidadzona' => array('dependent' => true));
	public $displayField = 'nombre';

    public $validate = array(
       'nombre' => array(
            'rule' => 'notEmpty',
            'message' => 'No se indicó el nombre.'
        )
	);
}

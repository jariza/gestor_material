<?php
class Ubicacion extends AppModel {
	public $hasMany = 'Objeto';
	public $displayField = 'nombre';
	
    public $validate = array(
       'nombre' => array(
            'rule' => 'notEmpty',
            'message' => 'No se indicó el nombre.'
        )
	);
}

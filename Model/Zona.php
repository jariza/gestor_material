<?php
class Zona extends AppModel {
	public $displayField = 'nombre';

    public $validate = array(
       'nombre' => array(
            'rule' => 'notEmpty',
            'message' => 'No se indicó el nombre.'
        )
	);
}

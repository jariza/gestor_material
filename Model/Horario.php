<?php
class Horario extends AppModel {
    public $validate = array(
        'inicio' => array(
			'rule' => 'datetime',
			'message' => 'Fecha de inicio incorrecta'
		),
		'fin' => array(
			'rule' => 'datetime',
			'message' => 'Fecha de finalización incorrecta'
		)
    );
}

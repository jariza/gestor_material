<?php
class Actividad extends AppModel {
	public $belongsTo = 'Zona';

    public $validate = array(
       'nombre' => array(
            'rule' => 'notEmpty',
            'message' => 'No se indicó el nombre.'
        ),
        'inicio' => array(
			'rule' => 'datetime',
			'message' => 'Fecha de inicio incorrecta'
		),
		'fin' => array(
			'rule' => 'datetime',
			'message' => 'Fecha de finalización incorrecta'
		),
		'enlaceweb' => array(
			'rule' => 'url',
			'allowEmpty' => true,
			'message' => 'Enlace incorrecto'
		)
	);
	
	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['enlaceweb'])) {
			if (strncmp('http://', $this->data[$this->alias]['enlaceweb'], 7) != 0) {
				$this->data[$this->alias]['enlaceweb'] = 'http://'.$this->data[$this->alias]['enlaceweb'];
			}
		}
		return true;
	}
}

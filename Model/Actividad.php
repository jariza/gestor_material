<?php
class Actividad extends AppModel {
	public $belongsTo = 'Zona';
	public $hasMany = array('Necesidadactividad' => array('dependent' => true), 'Horario' => array('dependent' => true));

    public $validate = array(
       'nombre' => array(
            'rule' => 'notEmpty',
            'message' => 'No se indicó el nombre.'
        ),
		'enlaceweb' => array(
			'rule' => 'url',
			'allowEmpty' => true,
			'message' => 'Enlace incorrecto'
		)
	);
	
	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['enlaceweb'])) {
			if (($this->data[$this->alias]['enlaceweb'] != '') && (strncmp('http://', $this->data[$this->alias]['enlaceweb'], 7) != 0)) {
				$this->data[$this->alias]['enlaceweb'] = 'http://'.$this->data[$this->alias]['enlaceweb'];
			}
		}
		return true;
	}
}

<?php
class Actividad extends AppModel {
	public $belongsTo = 'Zona';
	public $hasMany = array('Necesidadactividad' => array('dependent' => true), 'Horario' => array('dependent' => true, 'order' => 'inicio'));

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
		if (array_key_exists('id', $this->data[$this->alias])) {
			$zona = $this->Zona->findById($this->data[$this->alias]['zona_id'], 'Zona.calendarioext');
			$actividad = $this->findById($this->data[$this->alias]['id'], 'zona_id');
			if (($this->data[$this->alias]['zona_id'] != $actividad['Actividad']['zona_id']) && ($zona['Zona']['calendarioext'] != '0')) {
				//Si cambia la zona y se pasa a usar una con calendario externo, eliminar los horarios guardados
				$this->Horario->deleteAll(array('actividad_id' => $this->data[$this->alias]['id']));
			}
		}
		if (isset($this->data[$this->alias]['enlaceweb'])) {
			if (($this->data[$this->alias]['enlaceweb'] != '') && (strncmp('http://', $this->data[$this->alias]['enlaceweb'], 7) != 0)) {
				$this->data[$this->alias]['enlaceweb'] = 'http://'.$this->data[$this->alias]['enlaceweb'];
			}
		}
		return true;
	}
}

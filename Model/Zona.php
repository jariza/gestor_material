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
	
	public function beforeSave($options = array()) {
		//Poner a cero el intante de notificación si no hay calendario o se cambia, sólo para edit
		if(!empty($this->data[$this->alias]['id'])) {
			$oldcalendarioext = $this->findById($this->data[$this->alias]['id']);
			if (isset($this->data[$this->alias]['calendarioext']) && ($this->data[$this->alias]['calendarioext'] == '0' || $this->data[$this->alias]['calendarioext'] != $oldcalendarioext)) {
				$this->data[$this->alias]['sync_calext'] = '0000-00-00 00:00:00';
			}
		}
		return true;
	}
}

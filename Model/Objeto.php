<?php
class Objeto extends AppModel {
	public $belongsTo = array('Ubicacion' => array('conditions' => array('Ubicacion.id !=' => '-1'))); //La condición es para los pendientes
	
	//Si la fecha es todo 0 se considera que el objeto está aquí, en otro caso es que tiene que llegar
    public $validate = array(
       'descripcion' => array(
            'rule' => 'isUnique',
            'message' => 'No se indicó el nombre o este ya existe.'
        ),
        'ubicacion_id' => array(
			'rule' => 'notEmpty',
		),
		'cantidad' => array(
			'rule' => 'validarCantidad',
		),
	);
	
	public function beforeValidate($options = array()) {
		if (isset($this->data[$this->alias]['ubicacion_id']) && ($this->data[$this->alias]['ubicacion_id'] != -1)) {
			$this->data[$this->alias]['fechaentrega'] = '0000-00-00 00:00:00';
		}
		return true;
	}
	
    public function validarCantidad($check) {
		if ($check['cantidad'] < 1) {
			return '¿Menos de un objeto?';
		}
		else if (($this->data['Objeto']['fungible'] == 0) && ($check['cantidad'] > 1)) {
			return 'Un objeto no fungible no se puede inventariar en cantidad superior a uno.';
		}
		else {
			return true;
		}
    }
}

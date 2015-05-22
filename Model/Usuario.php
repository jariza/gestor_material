<?php
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class Usuario extends AppModel {
	
    public $validate = array(
        'name' => array(
			'rule' => 'notEmpty',
			'message' => 'No se indicó el usuario.'
        ),
        'username' => array(
			'rule' => 'isUnique',
			'allowEmpty' => false,
			'message' => 'No se indicó el usuario o está repetido.'
        ),
        'password' => array(
			'rule' => 'notEmpty',
			'message' => 'No se indicó la contraseña.'
        ),
        'email' => array(
			'rule' => 'email',
			'message' => 'No se indicó la contraseña.'
        ),
        'curpassword' => array(
			'rule' => 'notEmpty',
			'message' => 'No se indicó la contraseña actual.'
        ),
        'password1' => array(
			'rule' => 'notEmpty',
			'message' => 'No se indicó la nueva contraseña.'
        ),
        'password2' => array(
			'rule' => 'notEmpty',
			'message' => 'No se confirmó la nueva contraseña.'
        ),        
    );
    
	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['password'])) {
			$passwordHasher = new SimplePasswordHasher();
			$this->data[$this->alias]['password'] = $passwordHasher->hash(
				$this->data[$this->alias]['password']
			);
		}
		if ((isset($this->data[$this->alias]['zonas'])) && (strlen($this->data[$this->alias]['zonas']) > 0)) {
			$this->data[$this->alias]['zonas'] = implode(',', $this->data[$this->alias]['zonas']);
		}
		return true;
	}
	
	public function afterFind($results, $primary = false) {
		foreach($results as $k => $v) {
			if (array_key_exists('Usuario', $v) && array_key_exists('zonas', $v['Usuario'])) {
				if ($v['Usuario']['zonas'] == '') {
					$results[$k]['Usuario']['zonas'] = array();
				}
				else {
					$results[$k]['Usuario']['zonas'] = explode(',', $v['Usuario']['zonas']);
				}
			}
		}
		return $results;
	}
}

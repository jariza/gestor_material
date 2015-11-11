<?php
class Objeto extends AppModel {
	public $hasAndBelongsToMany = array('Ubicacion');

	//Si la fecha es todo 0 se considera que el objeto está aquí, en otro caso es que tiene que llegar
    public $validate = array(
       'descripcion' => array(
            'rule' => 'isUnique',
            'message' => 'No se indicó el nombre o este ya existe.'
        ),
		'cantidad' => array(
			'rule' => 'validarCantidad',
		),
	);

	public function beforeValidate($options = array()) {
		if (isset($this->data[$this->alias]['Ubicacion']) && (!in_array(-1, $this->data[$this->alias]['Ubicacion']))) {
			$this->data[$this->alias]['fechaentrega'] = '0000-00-00 00:00:00';
			$this->data[$this->alias]['comentariosentrega'] = '';
		}
		if (!isset($this->data[$this->alias]['prestamo']) || ($this->data[$this->alias]['prestamo'] != 1)) {
			$this->data[$this->alias]['fechadevolucion'] = '9999-12-31 23:59:59';
			$this->data[$this->alias]['comentariosdevolucion'] = '';
		}
		return true;
	}

    public function validarCantidad($check) {
		if ($check['cantidad'] < 0) {
			return '¿Cantidad negativa?';
		}
		else if (($this->data['Objeto']['fungible'] == 0) && ($check['cantidad'] > 1)) {
			return 'Un objeto no fungible no se puede inventariar en cantidad superior a uno.';
		}
		else {
			return true;
		}
    }

	//http://miftyisbored.com/complete-tutorial-habtm-relationships-cakephp/
	public function beforeSave($options = array()) {
		// save our HABTM relationships
		foreach (array_keys($this->hasAndBelongsToMany) as $model){
			if(isset($this->data[$this->name][$model])){
				$this->data[$model][$model] = $this->data[$this->name][$model];
				unset($this->data[$this->name][$model]);
			}
		}
	}
	
	public function afterFind($results, $primary = false) {
		if ($primary) {
			foreach ($results as $k => $v) {
				//Al comprobar la existencia de la key Ubicacion evito que se ejecute la query siempre, solo se ejecutará cuando se tenga que comprobar la ubicación
				if ((array_key_exists('Ubicacion', $v)) && (array_key_exists('Objeto', $v)) && (array_key_exists('id', $v['Objeto']))) {
					$ubicaciones = $this->ObjetosUbicacion->findAllByObjeto_id($v['Objeto']['id'], 'ubicacion_id');
					foreach ($ubicaciones as $k2 => $v2) {
						if ($v2['ObjetosUbicacion']['ubicacion_id'] == -1) {
							$results[$k]['Ubicacion'][] = array(
								'id' => -1,
								'nombre' => 'Pendiente de entrega'
							);
						}
					}
				}
			}
		}
		return $results;
	}
}

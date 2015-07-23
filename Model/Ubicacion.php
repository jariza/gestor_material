<?php
class Ubicacion extends AppModel {
	public $displayField = 'nombre';
	public $hasAndBelongsToMany = array('Objeto');
	
    public $validate = array(
       'nombre' => array(
            'rule' => 'notEmpty',
            'message' => 'No se indicó el nombre.'
        )
	);

	public function afterFind($results, $primary = false) {
		foreach ($results as $k => $v) {
			if (is_null($v['Ubicacion']['nombre'])) {
				$results[$k]['Ubicacion']['nombre'] = 'Pendiente';
			}
		}
		$results[-1] = array('Ubicacion' => array(
			'id' => -1,
			'nombre' => 'Pendiente de entrega'
		));
		return $results;
	}
}

<?php
class Necesidadactividad extends AppModel {
	public $belongsTo = array('Objeto', 'Actividad');
	
    public $validate = array(
        'descripcion' => array(
            'rule' => 'notEmpty',
            'message' => 'Falta la descripción'
        ),
        'cantidad' => array(
			'rule' => 'naturalNumber',
			'message' => 'Debe ser un número mayor que cero'
		),
		'sesion' => array(
			'rule' => 'validarSesion'
		)
    );
    
    public function validarSesion($check) {
		if (is_numeric($check['sesion']) && (intval($check['sesion']) >= 0)) {
			return true;
		}
		else {
			return "No se ha indicado una sesión válida o 0 para todas las sesiones";
		}
    }
}

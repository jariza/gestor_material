<?php
class GeneralesController extends AppController {
    public $helpers = array('Html', 'Paginator');

	/**
	 * This controller does not use a model
	 *
	 * @var array
	 */
	public $uses = array();

	private function cmphoras($a, $b) {
		return strtotime($a['inicio']) - strtotime($b['inicio']);
	}

	public function isAuthorized($usuario) {
		if (isset($usuario['rol'])) {
			if (in_array($usuario['rol'], array('admin', 'produccion'))) {
				return true;
			}
		}
		// Default deny
		return false;
	}

	public function listainfraestructura() {
		if ($this->request->query('imprimir') == 1) {
			$this->layout = 'print';
			$this->set('imprimir', true);
		}
		else {
			$this->set('imprimir', false);
		}
		
		$mnecesidadactividad = $this->loadModel('Necesidadactividad');
		$mnecesidadzona = $this->loadModel('Necesidadzona');
		$mzona = $this->loadModel('Zona');
		$neczona = $this->Necesidadzona->find('all', array('conditions' => array('infraestructura' => true), 'fields' => array('Necesidadzona.descripcion', 'Necesidadzona.cantidad', 'Zona.nombre')));
		$necactividad = $this->Necesidadactividad->find('all', array('conditions' => array('infraestructura' => true), 'fields' => array('Necesidadactividad.descripcion', 'Necesidadactividad.cantidad', 'Actividad.nombre', 'Actividad.zona_id')));
		
		$zonaid = array();
		foreach ($necactividad as $v) {
			$zonaid[] = $v['Actividad']['zona_id'];
		}
		$results = $this->Zona->findAllById($zonaid);
		$zonas = array();
		foreach ($results as $v) {
			$zonas[$v['Zona']['id']] = $v['Zona']['nombre'];
		}
		
		$this->set('neczona', $neczona);
		$this->set('necactividad', $necactividad);
		$this->set('zonas', $zonas);
	}
}

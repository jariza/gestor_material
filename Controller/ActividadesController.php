<?php
class ActividadesController extends AppController {
    public $helpers = array('Html', 'Form', 'Paginator');

	public $paginate = array(
		'fields' => array('Actividad.id', 'Actividad.nombre', 'Zona.nombre', 'Actividad.enlaceweb')
		);

	private function testNumSesion($horario) {
		$ok = true;
		$horariocheck = array();
		foreach ($horario as $v) {
			$horariocheck[$v['sesion']] = strtotime("{$v['inicio']['year']}-{$v['inicio']['month']}-{$v['inicio']['day']} {$v['inicio']['hour']}:{$v['inicio']['min']}:00");
		}
		ksort($horariocheck);
		reset($horariocheck);
		$horaanterior = current($horariocheck);
		while (($ok) && ($val = next($horariocheck))) {
			$ok = $horaanterior < $val;
			$horaanterior = $val;
		}
		
		return $ok;
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

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Security->validatePost = false;
	}

    public function index() {
        $this->set('actividades', $this->paginate());
    }
    
	public function ayuda() {
		//Nada que hacer, sólo muestra la ayuda
	}
    
    public function nueva() {
		$this->set('zonas', $this->Actividad->Zona->find('list'));
		$this->set('horariozonas', $this->Actividad->Zona->find('list', array('fields' => 'id', 'conditions' => array('calendarioext NOT' => '0'))));
		if ($this->request->is('post')) {
			$this->Actividad->create();
			if (array_key_exists('Horario', $this->request->data)) { //Se comprueba sólo si se puede
				$numsesiones = count($this->request->data['Horario']);
				$this->Actividad->Necesidadactividad->validator()->add('sesion', 'required', array(
					'rule' => array('range', -1, $numsesiones+1),
					'message' => "Debe ser un número entre 0 y $numsesiones"
				));
			}
			if (array_key_exists('Horario', $this->request->data) && (count($this->request->data['Horario']) > 0) && !$this->testNumSesion($this->request->data['Horario'])) {
				$this->Session->setFlash('Error en el orden de las sesiones, no se pudo crear la actividad.');
			}
			elseif ($this->Actividad->saveAssociated($this->request->data)) {
                $this->Session->setFlash('Actividad añadida.');
                //return $this->redirect(array('action' => 'index'));
			}
			else {
				$this->Session->setFlash('No se pudo crear la actividad, por favor, revisa el formulario.');
			}				
		}
    }

	public function view($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Actividad desconocida'));
		}

		$this->Actividad->recursive = 2; //Para mostrar el nombre del objeto
		$actividad = $this->Actividad->findById($id);
		if (!$actividad) {
			throw new NotFoundException(__('Actividad desconocida'));
		}

		$this->set('actividad', $actividad);
	}

	public function edit($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Actividad desconocida'));
		}

		$this->Actividad->recursive = 2;
		$actividad = $this->Actividad->findById($id);
		if (!$actividad) {
			throw new NotFoundException(__('Actividad desconocida'));
		}

		$this->set('zonas', $this->Actividad->Zona->find('list'));
		$this->set('horariozonas', $this->Actividad->Zona->find('list', array('fields' => 'id', 'conditions' => array('calendarioext NOT' => '0'))));
		if ($this->request->is(array('post', 'put'))) {
			$this->Actividad->id = $id;
			if (array_key_exists('Horario', $this->request->data)) { //Se comprueba sólo si se puede
				$numsesiones = count($this->request->data['Horario']);
				$this->Actividad->Necesidadactividad->validator()->add('sesion', 'required', array(
					'rule' => array('range', -1, $numsesiones+1),
					'message' => "Debe ser un número entre 0 y $numsesiones"
				));
			}
			if (array_key_exists('Horario', $this->request->data) && (count($this->request->data['Horario']) > 0) && !$this->testNumSesion($this->request->data['Horario'])) {
				$this->Session->setFlash('Error en el orden de las sesiones, no se pudo actualizar la actividad.');
			}
			elseif ($this->Actividad->saveAssociated($this->request->data)) {
				$this->Session->setFlash('Actividad actualizada correctamente.');
				//return $this->redirect(array('action' => 'index'));
			}
			else {
				$this->Session->setFlash('No se pudo actualizar la actividad.');
			}
		}

		if (!$this->request->data) {
			$this->request->data = $actividad;
		}
		
		//Completa los datos de los asociaciados en caso de edición
		if (!array_key_exists('Zona', $this->request->data)) {
			//Datos relativos a la zona (para mostrar el horario)
			$this->Actividad->Zona->recursive = 0;
			$this->request->data = array_merge($this->request->data, $this->Actividad->Zona->findById($this->request->data['Actividad']['zona_id']));
			//Inserta el horario en caso de calendario externo
			if ($this->request->data['Zona']['calendarioext'] != '0') {
				$insertarhorario = array();
				foreach ($this->Actividad->Horario->findAllByActividad_id($this->request->data['Actividad']['id']) as $vhora) {
					$insertarhorario['Horario'][] = $vhora['Horario'];
				}
				$this->request->data = array_merge($this->request->data, $insertarhorario);
			}
			//Datos relativos al nombre el objeto asignado
			$objetosid = array();
			foreach ($this->request->data['Necesidadactividad'] as $v) {
				if (!is_null($v['objeto_id'])) {
					$objetosid[] = $v['objeto_id'];
				}
			}
			$objetos = array();
			if (count($objetosid) > 0) {
				$resobjetos = $this->Actividad->Necesidadactividad->Objeto->find('list', array('conditions' => array('Objeto.id' => $objetosid), 'fields' => array('descripcion')));
			}
			foreach ($this->request->data['Necesidadactividad'] as $k => $v) {
				if ($v['objeto_id'] != '') {
					$this->request->data['Necesidadactividad'][$k]['Objeto']['descripcion'] = $resobjetos[$v['objeto_id']];
				}
				else {
					$this->request->data['Necesidadactividad'][$k]['Objeto']['descripcion'] = array();
				}
			}
		}

	}
	
	public function delete($id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}

		if ($this->Actividad->delete($id)) {
			$this->Session->setFlash(
				__('Actividad eliminada.', $id)
			);
			return $this->redirect(array('action' => 'index'));
		}
	}
}

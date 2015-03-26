<?php
class ObjetosController extends AppController {
    public $helpers = array('Html', 'Form', 'Paginator');

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Security->unlockFields = array('ObjetoFechaentregaDay', 'ObjetoFechaentregaMonth', 'ObjetoFechaentregaYear', 'ObjetoFechaentregaHour', 'ObjetoFechaentregaMin', 'ObjetoComentariosentrega'); //El componente Security no se lleva bien con los cambios dinámicos de Forms
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

	public function findobjeto() {
		$this->autoLayout = false;
		$this->autoRender = false;
		$this->Objeto->recursive = -1;
		$results = $this->Objeto->find('all', array('fields' => array('id', 'descripcion'), 'conditions' => array('descripcion LIKE ' => '%'.$this->request->query('term').'%'), 'order' => array('descripcion')));
		$response = array();
		$i = 0;
		foreach($results as $result){
			$response[$i]['value'] = $result['Objeto']['descripcion'];
			$response[$i]['id'] = $result['Objeto']['id'];
			$i++;
		}
		echo json_encode($response);
	}

    public function index() {
		$q = $this->request->data('Objeto.q');
		$conds = array();
		if (($q !== NULL) && ($q != '')) {
			$conds = array('Objeto.descripcion LIKE' => '%'.str_replace(' ', '%', $q).'%');
		}
		$this->paginate = array(
			'conditions' => $conds,
			'fields' => array('Objeto.id', 'Objeto.descripcion', 'Ubicacion.nombre', 'Objeto.fungible', 'Objeto.cantidad', 'Objeto.fechaentrega', 'Objeto.fechadevolucion'),
		);
		$this->set('objetos', $this->paginate('Objeto'));
    }

	public function ayuda() {
		//Nada que hacer, sólo muestra la ayuda
	}

    public function nuevo() {
		if ($this->request->is('post')) {
			$this->Objeto->create();
			if ($this->Objeto->save($this->request->data)) {
                $this->Session->setFlash('Objeto añadido.');
                return $this->redirect(array('action' => 'index'));
			}
			else {
				$this->Session->setFlash(__('No se pudo crear el objeto, por favor, revisa el formulario.'));
			}
		}
		else {
			$this->set('ubicaciones', $this->Objeto->Ubicacion->find('list'));
		}
    }

	public function view($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Objeto desconocido'));
		}

		$objeto = $this->Objeto->findById($id);
		if (!$objeto) {
			throw new NotFoundException(__('Objeto desconocido'));
		}

		$this->set('objeto', $objeto);
	}

	public function agendarecepcion() {
		$opc = array();
		$this->set('imprimir', false);
		if ($this->request->query('imprimir') == 1) {
			$this->layout = 'print';
			$opc = array('limit' => $this->Objeto->find('count'));
			$this->set('imprimir', true);
		}
		$this->paginate = array_merge($opc, array(
			'conditions' => array('Objeto.ubicacion_id' => -1),
			'fields' => array('Objeto.descripcion', 'Objeto.cantidad', 'Objeto.fechaentrega', 'Objeto.comentariosentrega'),
		));
		$this->set('objetos', $this->paginate('Objeto'));
	}

	public function agendadevolucion() {
		$opc = array();
		$this->set('imprimir', false);
		if ($this->request->query('imprimir') == 1) {
			$this->layout = 'print';
			$opc = array('limit' => $this->Objeto->find('count'));
			$this->set('imprimir', true);
		}
		$this->paginate = array_merge($opc, array(
			'conditions' => array('Objeto.fechadevolucion !=' => '9999-12-31 23:59:59'),
			'fields' => array('Objeto.descripcion', 'Objeto.cantidad', 'Objeto.fechadevolucion', 'Objeto.comentariosdevolucion'),
		));
		$this->set('objetos', $this->paginate('Objeto'));
	}
	
	public function agendaprestamo() {
		$opc = array();
		$this->set('imprimir', false);
		if ($this->request->query('imprimir') == 1) {
			$this->layout = 'print';
			$opc = array('limit' => $this->Objeto->find('count'));
			$this->set('imprimir', true);
		}
		$this->paginate = array_merge($opc, array(
			'conditions' => array('Objeto.ubicacion_id' => -1, 'Objeto.fechadevolucion !=' => '9999-12-31 23:59:59'),
			'fields' => array('Objeto.descripcion', 'Objeto.cantidad', 'Objeto.fechaentrega', 'Objeto.fechadevolucion', 'Objeto.comentariosentrega', 'Objeto.comentariosdevolucion'),
		));
		$this->set('objetos', $this->paginate('Objeto'));
	}

	public function edit($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Objeto desconocido'));
		}

		$objeto = $this->Objeto->findById($id);
		if (!$objeto) {
			throw new NotFoundException(__('Objeto desconocido'));
		}

		$this->set('ubicaciones', $this->Objeto->Ubicacion->find('list'));
		if ($this->request->is(array('post', 'put'))) {
			$this->Objeto->id = $id;
			if ($this->Objeto->save($this->request->data)) {
				$this->Session->setFlash(__('Objeto actualizado correctamente.'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('No se pudo actualizar el objeto.'));
		}

		if (!$this->request->data) {
			if ($objeto['Objeto']['fechaentrega'] == '0000-00-00 00:00:00') {
				$objeto['Objeto']['fechaentrega'] = date('Y-m-d H:i:s'); //El campo fecha no determina nada en la vista, ajusto para comudidad del usuario
			}
			if ($objeto['Objeto']['fechadevolucion'] == '9999-12-31 23:59:59') {
				$this->set('prestamo', false);
				$objeto['Objeto']['fechadevolucion'] = date('Y-m-d H:i:s'); //El campo fecha no determina nada en la vista, ajusto para comudidad del usuario
			}
			else {
				$this->set('prestamo', true);
			}
			$this->request->data = $objeto;
		}
	}

	public function delete($id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}

		if ($this->Objeto->delete($id)) {
			$this->Session->setFlash(
				__('Objeto eliminado.', $id)
			);
			return $this->redirect(array('action' => 'index'));
		}
	}
}

<?php
class ActividadesController extends AppController {
    public $helpers = array('Html', 'Form', 'Paginator');

	public $paginate = array(
		'fields' => array('Actividad.id', 'Actividad.nombre', 'Zona.nombre', 'Actividad.inicio', 'Actividad.fin', 'Actividad.enlaceweb')
		);

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
		if ($this->request->is('post')) {
			$this->Actividad->create();
			if ($this->Actividad->saveAssociated($this->request->data)) {
                $this->Session->setFlash('Actividad añadida.');
                return $this->redirect(array('action' => 'index'));
			}
			else {
				$this->Session->setFlash(__('No se pudo crear la actividad, por favor, revisa el formulario.'));
			}				
		}
    }

	public function view($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Actividad desconocida'));
		}

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

		$actividad = $this->Actividad->findById($id);
		if (!$actividad) {
			throw new NotFoundException(__('Actividad desconocida'));
		}

		$this->set('zonas', $this->Actividad->Zona->find('list'));
		if ($this->request->is(array('post', 'put'))) {
			$this->Actividad->id = $id;
			if ($this->Actividad->saveAssociated($this->request->data)) {
				$this->Session->setFlash(__('Actividad actualizada correctamente.'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('No se pudo actualizar la actividad.'));
		}

		if (!$this->request->data) {
			$this->request->data = $actividad;
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

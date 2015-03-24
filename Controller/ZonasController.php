<?php
class ZonasController extends AppController {
    public $helpers = array('Html', 'Form', 'Paginator');

	public $paginate = array(
		'fields' => array('Zona.id', 'Zona.nombre')
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

    public function index() {
		$this->Zona->recursive = -1;
        $this->set('zonas', $this->paginate());
    }
    
	public function ayuda() {
		//Nada que hacer, sólo muestra la ayuda
	}
    
    public function nueva() {
		if ($this->request->is('post')) {
			$this->Zona->create();
			if ($this->Zona->save($this->request->data)) {
                $this->Session->setFlash('Zona añadida.');
                return $this->redirect(array('action' => 'index'));
			}
			else {
				$this->Session->setFlash(__('No se pudo crear la zona, por favor, revisa el formulario.'));
			}				
		}
    }

	public function view($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Zona desconocida'));
		}

		$zona = $this->Zona->findById($id);
		if (!$zona) {
			throw new NotFoundException(__('Zona desconocida'));
		}

		$this->set('zona', $zona);
	}

	public function edit($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Zona desconocida'));
		}

		$zona = $this->Zona->findById($id);
		if (!$zona) {
			throw new NotFoundException(__('Zona desconocida'));
		}

		if ($this->request->is(array('post', 'put'))) {
			$this->Zona->id = $id;
			if ($this->Zona->save($this->request->data)) {
				$this->Session->setFlash(__('Zona actualizada correctamente.'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('No se pudo actualizar la zona.'));
		}

		if (!$this->request->data) {
			$this->request->data = $zona;
		}
	}
	
	public function delete($id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}

		if ($this->Zona->delete($id)) {
			$this->Session->setFlash(
				__('Zona eliminada.', $id)
			);
			return $this->redirect(array('action' => 'index'));
		}
	}
}

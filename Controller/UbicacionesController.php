<?php
class UbicacionesController extends AppController {
    public $helpers = array('Html', 'Form', 'Paginator');

	public $paginate = array(
		'fields' => array('Ubicacion.id', 'Ubicacion.nombre')
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
        $this->set('ubicaciones', $this->paginate());
    }
    
	public function ayuda() {
		//Nada que hacer, sólo muestra la ayuda
	}
    
    public function nueva() {
		if ($this->request->is('post')) {
			$this->Ubicacion->create();
			if ($this->Ubicacion->save($this->request->data)) {
                $this->Session->setFlash('Ubicación añadida.');
                return $this->redirect(array('action' => 'index'));
			}
			else {
				$this->Session->setFlash(__('No se pudo crear la ubicación, por favor, revisa el formulario.'));
			}				
		}
    }
    
	public function edit($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Ubicación desconocida'));
		}

		$ubicacion = $this->Ubicacion->findById($id);
		if (!$ubicacion) {
			throw new NotFoundException(__('Ubicación desconocida'));
		}

		if ($this->request->is(array('post', 'put'))) {
			$this->Ubicacion->id = $id;
			if ($this->Ubicacion->save($this->request->data)) {
				$this->Session->setFlash(__('Ubicación actualizada correctamente.'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('No se pudo actualizar la ubicación.'));
		}

		if (!$this->request->data) {
			$this->request->data = $ubicacion;
		}
	}
	
	public function delete($id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}

		if ($this->Ubicacion->delete($id)) {
			$this->Session->setFlash(
				__('Ubicación eliminada.', $id)
			);
			return $this->redirect(array('action' => 'index'));
		}
	}
}

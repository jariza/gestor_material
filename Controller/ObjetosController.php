<?php
class ObjetosController extends AppController {
    public $helpers = array('Html', 'Form', 'Paginator');

	public $paginate = array(
		'fields' => array('Objeto.id', 'Objeto.descripcion', 'Ubicacion.nombre', 'Objeto.tipoobjeto_id', 'Objeto.comentarios')
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
		$q = $this->request->data('Objeto.q');
		$opc = array();
		if (($q !== NULL) && ($q != '')) {
			$opc = array('Objeto.descripcion LIKE' => '%'.str_replace(' ', '%', $q).'%');
		}
        $this->set('objetos', $this->paginate('Objeto', $opc));
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

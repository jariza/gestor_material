<?php
class NecesidadzonaController extends AppController {
    public $helpers = array('Html', 'Form');

	public function delete($id) {
		if ($this->request->is('post')) {
			throw new MethodNotAllowedException();
		}

		if ($this->Necesidadzona->delete($id)) {
			$this->Session->setFlash(__('Necesidadzona %s eliminado.', $id));
			return $this->redirect(array('controller' => 'zonas', 'action' => 'index'));
		}
	}
}

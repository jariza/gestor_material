<?php
class HorariosController extends AppController {
    public $helpers = array('Html', 'Form');

	public function isAuthorized($usuario) {
		if (isset($usuario['rol'])) {
			if (in_array($usuario['rol'], array('admin', 'produccion'))) {
				return true;
			}
		}
		// Default deny
		return false;
	}

	public function delete($id) {
		if ($this->request->is('post')) {
			throw new MethodNotAllowedException();
		}

		if ($this->Horario->delete($id)) {
			$this->Session->setFlash('Horario %s eliminada.', $id);
			return $this->redirect(array('controller' => 'actividades', 'action' => 'index'));
		}
	}
}

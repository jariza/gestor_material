<?php
class HorariosController extends AppController {
    public $helpers = array('Html', 'Form');

	public function delete($id) {
		if ($this->request->is('post')) {
			throw new MethodNotAllowedException();
		}

		if ($this->Horario->delete($id)) {
			$this->Session->setFlash(__('Horario %s eliminada.', $id));
			return $this->redirect(array('controller' => 'actividades', 'action' => 'index'));
		}
	}
}

<?php
class NecesidadzonasController extends AppController {
    public $helpers = array('Html', 'Form');

	public function findnecesidades() {
		$this->autoLayout = false;
		$this->autoRender = false;
		$this->Necesidadzona->recursive = -1;
		$results = $this->Necesidadzona->find('all', array('fields' => array('DISTINCT descripcion'), 'conditions' => array('descripcion LIKE ' => '%'.str_replace(' ', '%', $this->request->query('term')).'%'), 'order' => array('descripcion')));
		$response = array();
		$i = 0;
		foreach($results as $result){
			$response[$i]['value'] = $result['Necesidadzona']['descripcion'];
			$response[$i]['id'] = $i;
			$i++;
		}
		echo json_encode($response);
	}

	public function delete($id) {
		if ($this->request->is('post')) {
			throw new MethodNotAllowedException();
		}

		if ($this->Necesidadzona->delete($id)) {
			$this->Session->setFlash(__('Necesidadzona %s eliminada.', $id));
			return $this->redirect(array('controller' => 'zonas', 'action' => 'index'));
		}
	}
}

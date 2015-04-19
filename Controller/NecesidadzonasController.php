<?php
class NecesidadzonasController extends AppController {
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

	public function necesidadeszona($zona_id = null) {
		$this->autoLayout = false;
		$this->autoRender = false;
		
		$response = array();
		if (($zona_id) && (is_numeric($zona_id))) {
			$this->Necesidadzona->recursive = -1;
			$results = $this->Necesidadzona->findAllByZona_id($zona_id, array('descripcion', 'cantidad', 'infraestructura', 'objeto_id'));
			foreach($results as $result){
				$txtcantidad = '';
				$txtinfraestructura = '';
				$txtgarantizado = '';
				if ($result['Necesidadzona']['cantidad'] > 1) {
					$txtcantidad = $result['Necesidadzona']['cantidad'].'x ';
				}
				if ($result['Necesidadzona']['infraestructura']) {
					$txtinfraestructura = 'Infraestructura: ';
				}
				elseif (is_null($result['Necesidadzona']['objeto_id'])) {
					$txtgarantizado = ' (recurso NO garantizado)';
				}
				
				$response[] = $txtinfraestructura.$txtcantidad.$result['Necesidadzona']['descripcion'].$txtgarantizado;
			}			
		}
		
		if (count($response) > 0) {
			echo "<ul>\n";
			foreach ($response as $v) {
				echo "<li>$v</li>\n";
			}
			echo "</ul>\n";
		}
		else {
			echo "<p>Sin recursos.</p>\n";
		}
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

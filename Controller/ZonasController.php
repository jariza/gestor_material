<?php
class ZonasController extends AppController {
    public $helpers = array('Html', 'Form', 'Paginator');

	public $paginate = array(
		'fields' => array('Zona.id', 'Zona.nombre', 'Zona.calendarioext')
		);

	private function cmphoras($a, $b) {
		return strtotime($a['inicio']) - strtotime($b['inicio']);
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

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Security->validatePost = false;
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
			if ($this->Zona->saveAssociated($this->request->data)) {
                $this->Session->setFlash('Zona añadida.');
                return $this->redirect(array('action' => 'index'));
			}
			else {
				$this->Session->setFlash(__('No se pudo crear la zona, por favor, revisa el formulario.'));
			}
		}
		else {
			$mcalendario = $this->loadModel('Calendarioexterno');
			$this->set('calendarios', $this->Calendarioexterno->listacalendarios());
		}
    }

	public function view($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Zona desconocida'));
		}

		$this->Zona->recursive = 2;
		$zona = $this->Zona->findById($id);
		if (!$zona) {
			throw new NotFoundException(__('Zona desconocida'));
		}

		$this->set('zona', $zona);
	}

	public function agenda($id = null) {
		if (!$id) {
			throw new NotFoundException('Zona desconocida');
		}
		
		$this->Zona->recursive = 0;
		$zona = $this->Zona->findById($id, array('Zona.id', 'Zona.nombre', 'Zona.desctecnica'));
		if (!$zona) {
			throw new NotFoundException('Zona desconocida');
		}

		if ($this->request->query('imprimir') == 1) {
			$this->layout = 'print';
			$this->set('imprimir', true);
		}
		else {
			$this->set('imprimir', false);
		}
		
		$necesidadzona = $this->Zona->Necesidadzona->findAllByZona_id($id, array('Necesidadzona.descripcion', 'Necesidadzona.infraestructura', 'Necesidadzona.cantidad', 'Necesidadzona.objeto_id', 'Objeto.descripcion', 'Objeto.fungible', 'Objeto.comentarios'));
		$actividad = $this->Zona->Actividad->findAllByZona_id($id);

		$horario = array();
		$objetosid = array();
		foreach ($actividad as $v) {
			foreach ($v['Necesidadactividad'] as $v2) {
				if (!is_null($v2['objeto_id'])) {
					$objetosid[] = $v2['objeto_id'];
				}
			}
			foreach ($v['Horario'] as $v2) {
				$necesidades = array();
				foreach ($v['Necesidadactividad'] as $necs) {
					if (($necs['sesion'] == 0) || ($necs['sesion'] == $v2['sesion'])) {
						$necesidades[] = $necs;
					}
				}
				$horario[] = array(
					'inicio' => $v2['inicio'],
					'fin' => $v2['fin'],
					'nombreactividad' => $v['Actividad']['nombre'],
					'descactividad' => $v['Actividad']['desctecnica'],
					'necesidades' => $necesidades
				);
			}
		}
		usort($horario, array("ZonasController", "cmphoras"));
		
		$mobjeto = $this->loadModel('Objeto');
		$results = $this->Objeto->findAllById($objetosid, array('Objeto.id', 'Objeto.descripcion', 'Objeto.fungible', 'Objeto.comentarios'), array(), 0, 0, -1);
		$objetos = array();
		foreach ($results as $v) {
			$objetos[$v['Objeto']['id']] = array(
				'descripcion' => $v['Objeto']['descripcion'],
				'fungible' => $v['Objeto']['fungible'],
				'comentarios' => $v['Objeto']['comentarios']
			);
		}

		$this->set('zona', $zona);
		$this->set('necesidadzona', $necesidadzona);
		$this->set('horario', $horario);
		$this->set('objetos', $objetos);
	}

	public function listainfraestructura() {
		if ($this->request->query('imprimir') == 1) {
			$this->layout = 'print';
			$this->set('imprimir', true);
		}
		else {
			$this->set('imprimir', false);
		}
		
		$mnecesidadactividad = $this->loadModel('Necesidadactividad');
		$mnecesidadzona = $this->loadModel('Necesidadzona');
		$neczona = $this->Necesidadzona->find('all', array('conditions' => array('infraestructura' => true), 'fields' => array('Necesidadzona.descripcion', 'Necesidadzona.cantidad', 'Zona.nombre')));
		$necactividad = $this->Necesidadactividad->find('all', array('conditions' => array('infraestructura' => true), 'fields' => array('Necesidadactividad.descripcion', 'Necesidadactividad.cantidad', 'Actividad.nombre', 'Actividad.zona_id')));
		
		$zonaid = array();
		foreach ($necactividad as $v) {
			$zonaid[] = $v['Actividad']['zona_id'];
		}
		$results = $this->Zona->findAllById($zonaid);
		$zonas = array();
		foreach ($results as $v) {
			$zonas[$v['Zona']['id']] = $v['Zona']['nombre'];
		}
		
		$this->set('neczona', $neczona);
		$this->set('necactividad', $necactividad);
		$this->set('zonas', $zonas);
	}

	public function edit($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Zona desconocida'));
		}

		$this->Zona->recursive = 2;
		$zona = $this->Zona->findById($id);
		if (!$zona) {
			throw new NotFoundException(__('Zona desconocida'));
		}

		if ($this->request->is(array('post', 'put'))) {
			$this->Zona->id = $id;
			if ($this->Zona->saveAssociated($this->request->data)) {
				$this->Session->setFlash(__('Zona actualizada correctamente.'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash('No se pudo actualizar la zona.');
		}
		else {
			$mcalendario = $this->loadModel('Calendarioexterno');
			$this->set('calendarios', $this->Calendarioexterno->listacalendarios());
		}

		if (!$this->request->data) {
			$this->request->data = $zona;
		}
	}

	public function synccalendario($id = null) {
		if (!$id) {
			throw new NotFoundException('Zona desconocida');
		}

		$zona = $this->Zona->findById($id);
		if (!$zona) {
			throw new NotFoundException('Zona desconocida');
		}

		if (count($zona['Actividad']) == 0) {
			$this->Session->setFlash('La zona no tiene actividades.');
			return $this->redirect(array('action' => 'index'));
		}
		elseif ($zona['Zona']['calendarioext'] == '0') {
			$this->Session->setFlash('La zona no tiene calendario externo.');
			return $this->redirect(array('action' => 'index'));
		}
		else {
			$mcalendarioext = $this->loadModel('Calendarioexterno');
			$evcalext = $this->Calendarioexterno->listaeventos($zona['Zona']['calendarioext']);
			//Agrupo por nombre de actividad
			$eventosext = array();
			foreach ($evcalext as $v) {
				$eventosext[$v['nombre']][] = array(
					'inicio' => $v['inicio'],
					'fin' => $v['fin']
				);
			}
			$mhorario = $this->loadModel('Horario');
			//Limpiar
			$borrar = array();
			foreach ($zona['Actividad'] as $k => $v) {$borrar[] = $v['id'];}
			$this->Horario->deleteAll(array('actividad_id' => $borrar));
			//Guardar
			foreach ($zona['Actividad'] as $k => $v) {
				if (array_key_exists($v['nombre'], $eventosext)) {
					//Insertar el horario
					uasort($eventosext[$v['nombre']], array("ZonasController", "cmphoras"));
					$bloquehorarios = array();
					foreach ($eventosext[$v['nombre']] as $k2 => $v2) {
						$bloquehorarios[]['Horario'] = array(
							'actividad_id' => $v['id'],
							'sesion' => $k2+1,
							'inicio' => $v2['inicio'],
							'fin' => $v2['fin']
						);
					}
					$this->Horario->saveMany($bloquehorarios);
					unset($eventosext[$v['nombre']]);
					unset($zona['Actividad'][$k]);
				}
			}
			$this->Zona->save(array(
				'id' => $zona['Zona']['id'],
				'sync_calext' => ConnectionManager::getDataSource('default')->expression('NOW()')
			));
			$this->set('faltanext', $zona['Actividad']); //Actividades que no están en el calendario externo
			$this->set('faltanlocal', $eventosext); //Actividades que están en el calendario externo pero no en local
			$this->set('zona', $zona);
		}
	}

	public function synctodocalendario() {
		$zonas = $this->Zona->find('all', array('conditions' => array('calendarioext !=' => '0')));
		$mcalendarioext = $this->loadModel('Calendarioexterno');
		$mhorario = $this->loadModel('Horario');

		//Backup de tabla de horario
		$tablabu = 'horario_'.time();
		$this->Zona->query("CREATE TABLE $tablabu LIKE horarios");
		$this->Zona->query("INSERT $tablabu SELECT * FROM horarios");
		
		$idactividades = array();
		foreach ($zonas as $v) {
			foreach ($v['Actividad'] as $v2) {
				$idactividades[] = $v2['id'];
			}
		}
		$horarioslocales = $this->Horario->find('all', array('conditions' => array('NOT' => array('actividad_id' => $idactividades))));
		foreach ($horarioslocales as $k => $v) {unset($horarioslocales[$k]['Horario']['id']);} //Para poder reconstruir la tabla sin índices duplicados

		$this->Horario->query("TRUNCATE TABLE horarios");

		$errores = array(); //Los índices son los id de zona, los valores, string con mensajes de error
		$faltanext = array(); //Los índices son los id de zona, los valores, arrays con las actividades que no están en el calendario externo
		$faltanlocal = array(); //Los índices son los id de zona, los valores, arrays con las actividades que están en el calendario externo pero no en local
		$datoszonas = array(); //El índice es son los id de zona, los valores, arrays con el nombre y la fecha de última sincronización
		foreach ($zonas as $zona) {
			//Inizialización
			$errores[$zona['Zona']['id']] = '';
			$datoszonas[$zona['Zona']['id']] = array('nombre' => $zona['Zona']['nombre'], 'ultimasync' => $zona['Zona']['sync_calext']);

			if (count($zona['Actividad']) == 0) {
				$errores[$zona['Zona']['id']] = 'La zona no tiene actividades.';
			}			
			elseif (($zona['Zona']['calendarioext'] == '0') || ($zona['Zona']['calendarioext'] == '')) {
				$errores[$zona['Zona']['id']] = 'La zona no tiene calendario externo.';
			}
			else {
				$evcalext = $this->Calendarioexterno->listaeventos($zona['Zona']['calendarioext']);
				//Agrupo por nombre de actividad
				$eventosext = array();
				foreach ($evcalext as $v) {
					$eventosext[$v['nombre']][] = array(
						'inicio' => $v['inicio'],
						'fin' => $v['fin']
					);
				}
				//Guardar
				foreach ($zona['Actividad'] as $k => $v) {
					if (array_key_exists($v['nombre'], $eventosext)) {
						//Insertar el horario
						uasort($eventosext[$v['nombre']], array("ZonasController", "cmphoras"));
						$bloquehorarios = array();
						foreach ($eventosext[$v['nombre']] as $k2 => $v2) {
							$bloquehorarios[]['Horario'] = array(
								'actividad_id' => $v['id'],
								'sesion' => $k2+1,
								'inicio' => $v2['inicio'],
								'fin' => $v2['fin']
							);
						}
						$this->Horario->saveMany($bloquehorarios);
						unset($eventosext[$v['nombre']]);
						unset($zona['Actividad'][$k]);
					}
				}
				$faltanext[$zona['Zona']['id']] = $zona['Actividad'];
				$faltanlocal[$zona['Zona']['id']] = $eventosext;
				$this->Zona->id = $zona['Zona']['id'];
				$this->Zona->saveField('sync_calext', ConnectionManager::getDataSource('default')->expression('NOW()'));
			}
		}
		
		$this->Horario->saveMany($horarioslocales);
		
		$this->Zona->query("DROP TABLE $tablabu");
		
		$this->set('errores', $errores);
		$this->set('faltanext', $faltanext);
		$this->set('faltanlocal', $faltanlocal);
		$this->set('datoszonas', $datoszonas);
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

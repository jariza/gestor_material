<?php
class ObjetosController extends AppController {
    public $helpers = array('Html', 'Form', 'Paginator');

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Security->unlockFields = array('ObjetoFechaentregaDay', 'ObjetoFechaentregaMonth', 'ObjetoFechaentregaYear', 'ObjetoFechaentregaHour', 'ObjetoFechaentregaMin', 'ObjetoComentariosentrega'); //El componente Security no se lleva bien con los cambios dinámicos de Forms
	}

	private function cmphoras($a, $b) {
		return strtotime($b['inicio']) - strtotime($a['inicio']);
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

	public function findobjeto() {
		$this->autoLayout = false;
		$this->autoRender = false;
		$this->loadModel('Necesidadzona');
		$this->loadModel('Necesidadactividad');
		//Obtener objetos
		$results = $this->Objeto->find('all', array('fields' => array('id', 'descripcion', 'fungible', 'cantidad'), 'conditions' => array('descripcion LIKE ' => '%'.$this->request->query('term').'%'), 'order' => array('descripcion')));
		$fungibles = array();
		$inventariables = array();
		foreach ($results as $v) {
			if ($v['Objeto']['fungible']) {
				$fungibles[$v['Objeto']['id']] = array (
					'descripcion' => $v['Objeto']['descripcion'],
					'cantidad' => $v['Objeto']['cantidad']
				);
			}
			else {
				$inventariables[$v['Objeto']['id']] = $v['Objeto']['descripcion'];
			}
		}
		//Consultas para comprobar el uso
		if (count($inventariables) > 0) {
			$res = $this->Necesidadactividad->query("SELECT necesidadactividades.objeto_id, UNIX_TIMESTAMP(horarios.inicio) AS inicio, UNIX_TIMESTAMP(horarios.fin) AS fin FROM necesidadactividades, horarios WHERE necesidadactividades.actividad_id = horarios.actividad_id AND necesidadactividades.objeto_id IN (".implode(',', array_keys($inventariables)).')');
			$inventariablesactividades = array();
			foreach ($res as $v) {
				$inventariablesactividades[$v['necesidadactividades']['objeto_id']][] = array(
					'inicio' => $v[0]['inicio'],
					'fin' => $v[0]['fin'],
				);
			}
			$inventariableszonas = $this->Necesidadzona->find('list', array('fields' => array('objeto_id', 'id'), 'conditions' => array('objeto_id' => array_keys($inventariables))));
		}
		else {
			$inventariablesactividades = array();
			$inventariableszonas = array();
		}
		if (count($fungibles) > 0) {
			$this->Necesidadzona->virtualFields['uso'] = 'SUM(Necesidadzona.cantidad)';
			$fungibleszonas = $this->Necesidadzona->find('list', array('fields' => array('objeto_id', 'uso'), 'conditions' => array('objeto_id' => array_keys($fungibles)), 'group' => array('objeto_id'), 'recursive' => -1));
			$this->Necesidadactividad->virtualFields['uso'] = 'SUM(Necesidadactividad.cantidad)';
			$fungiblesactividades = $this->Necesidadactividad->find('list', array('fields' => array('objeto_id', 'uso'), 'conditions' => array('objeto_id' => array_keys($fungibles)), 'group' => array('objeto_id'), 'recursive' => -1));
			$sumfungibles = array();
			//Sumar los fungibles
			foreach (array_keys($fungibleszonas + $fungiblesactividades) as $key) {
				$sumfungibles[$key] = (isset($fungibleszonas[$key]) ? $fungibleszonas[$key] : 0) + (isset($fungiblesactividades[$key]) ? $fungiblesactividades[$key] : 0);
			}
		}
		else {
			$sumfungibles = array();
		}
		//Montar la respuesta
		$response = array();
		$i = 0;
		$limiteinicio = explode(',', $this->request->query('i'));
		$limitefin = explode(',', $this->request->query('f'));
		foreach($results as $v){
			if (array_key_exists($v['Objeto']['id'], $inventariableszonas)) {
				$comentario = ' (ocupado en zona)';
			}
			elseif (array_key_exists($v['Objeto']['id'], $sumfungibles)) {
				$disponible = $v['Objeto']['cantidad'] - $sumfungibles[$v['Objeto']['id']];
				if ($disponible > 0) {$comentario = " (quedan $disponible)";}
				elseif ($disponible == 0) {$comentario = " (todos usados)";}
				else {$comentario = ' (faltan '.abs($disponible).')';}
			}
			elseif ((count($limiteinicio) > 0) && (count($limitefin) > 0) && (array_key_exists($v['Objeto']['id'], $inventariablesactividades))) {
				foreach ($limiteinicio as $k2 => $v2) {
					foreach ($inventariablesactividades[$v['Objeto']['id']] as $v3) {
						if (($v2 < $v3['fin']) || ($limitefin[$k2] > $v3['inicio'])) {
							$comentario = ' (ocupado en actividad)';
							break 2;
						}
					}
				}
			}
			else {
				$comentario = '';
			}
			$response[$i]['value'] = $v['Objeto']['descripcion'].$comentario;
			$response[$i]['id'] = $v['Objeto']['id'];
			$i++;
		}
		echo json_encode($response);
	}

    public function index() {
		$q = $this->request->data('Objeto.q');
		$conds = array();
		if (($q !== NULL) && ($q != '')) {
			$conds = array('Objeto.descripcion LIKE' => '%'.str_replace(' ', '%', $q).'%');
		}
		$this->paginate = array(
			'conditions' => $conds,
			'fields' => array('Objeto.id', 'Objeto.descripcion', 'Objeto.fungible', 'Objeto.cantidad', 'Objeto.fechaentrega', 'Objeto.fechadevolucion'),
		);
		$this->set('objetos', $this->paginate('Objeto'));
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

		$this->set('ubicaciones', $this->Objeto->Ubicacion->find('list'));
    }

	public function view($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Objeto desconocido'));
		}

		$objeto = $this->Objeto->findById($id);
		if (!$objeto) {
			throw new NotFoundException(__('Objeto desconocido'));
		}

		$mnecesidadactividad = $this->loadModel('Necesidadactividad');
		$mnecesidadzona = $this->loadModel('Necesidadzona');
		
		$usoactividades = $this->Necesidadactividad->findAllByObjeto_id($id, array('Actividad.id', 'Actividad.nombre', 'Necesidadactividad.cantidad'));
		$usozonas = $this->Necesidadzona->findAllByObjeto_id($id, array('Zona.id', 'Zona.nombre', 'Necesidadzona.cantidad'));

		$this->set('objeto', $objeto);
		$this->set('usoactividades', $usoactividades);
		$this->set('usozonas', $usozonas);
	}

	public function agendarecepcion() {
		$opc = array();
		$this->set('imprimir', false);
		if ($this->request->query('imprimir') == 1) {
			$this->layout = 'print';
			$opc = array('limit' => $this->Objeto->find('count'));
			$this->set('imprimir', true);
		}

		$this->paginate = array_merge($opc, array(
			'joins' => array(
				array(
					'table' => 'objetos_ubicaciones',
					'type' => 'INNER',
					'conditions' => array('objetos_ubicaciones.objeto_id = Objeto.id')
				)
			),
			'conditions' => array('objetos_ubicaciones.ubicacion_id' => -1),
			'fields' => array('Objeto.descripcion', 'Objeto.cantidad', 'Objeto.fechaentrega', 'Objeto.comentariosentrega'),
		));
		$this->set('objetos', $this->paginate('Objeto'));
	}

	public function agendadevolucion() {
		$opc = array();
		$this->set('imprimir', false);
		if ($this->request->query('imprimir') == 1) {
			$this->layout = 'print';
			$opc = array('limit' => $this->Objeto->find('count'));
			$this->set('imprimir', true);
		}
		$this->paginate = array_merge($opc, array(
			'conditions' => array('Objeto.fechadevolucion !=' => '9999-12-31 23:59:59'),
			'fields' => array('Objeto.descripcion', 'Objeto.cantidad', 'Objeto.fechadevolucion', 'Objeto.comentariosdevolucion'),
		));
		$this->set('objetos', $this->paginate('Objeto'));
	}
	
	public function agendaprestamo() {
		$opc = array();
		$this->set('imprimir', false);
		if ($this->request->query('imprimir') == 1) {
			$this->layout = 'print';
			$opc = array('limit' => $this->Objeto->find('count'));
			$this->set('imprimir', true);
		}
		$this->paginate = array_merge($opc, array(
			'joins' => array(
				array(
					'table' => 'objetos_ubicaciones',
					'type' => 'INNER',
					'conditions' => array('objetos_ubicaciones.objeto_id = Objeto.id')
				)
			),
			'conditions' => array('objetos_ubicaciones.ubicacion_id' => -1, 'Objeto.fechadevolucion !=' => '9999-12-31 23:59:59'),
			'fields' => array('Objeto.descripcion', 'Objeto.cantidad', 'Objeto.fechaentrega', 'Objeto.fechadevolucion', 'Objeto.comentariosentrega', 'Objeto.comentariosdevolucion'),
		));
		$this->set('objetos', $this->paginate('Objeto'));
	}
	
	public function agenda($id = null) {
		if (!$id) {
			throw new NotFoundException('Objeto desconocido');
		}

		$objeto = $this->Objeto->findById($id);
		if (!$objeto) {
			throw new NotFoundException('Objeto desconocido');
		}

		if ($this->request->query('imprimir') == 1) {
			$this->layout = 'print';
			$this->set('imprimir', true);
		}
		else {
			$this->set('imprimir', false);
		}

		$mnzona = $this->loadModel('Necesidadzona');
		$mnactividad = $this->loadModel('Necesidadactividad');
		$usozona = $this->Necesidadzona->findAllByObjeto_id($id, array('Necesidadzona.descripcion', 'Necesidadzona.cantidad', 'Necesidadzona.infraestructura', 'Zona.id', 'Zona.nombre'));
		$usoactividades = $this->Necesidadactividad->findAllByObjeto_id($id, array('Necesidadactividad.id', 'Necesidadactividad.descripcion', 'Necesidadactividad.infraestructura', 'Necesidadactividad.cantidad', 'Necesidadactividad.actividad_id', 'Necesidadactividad.sesion'), array(), 0, 0, -1);
		
		$horarios = array();
		foreach ($usoactividades as $v) {
			$horarios[$v['Necesidadactividad']['id']] = array('actividad_id' => $v['Necesidadactividad']['actividad_id'], 'sesion' => $v['Necesidadactividad']['sesion']);
		}
		
		//Obtener necesidades y sus horas
		//Los que son de alguna sesión
		$this->Necesidadactividad->bindModel(
			array('hasOne' => array(
				'Horario' => array('foreignKey' => false, 'type' => 'INNER', 'conditions' => array('Horario.actividad_id = Necesidadactividad.actividad_id', 'Horario.sesion = Necesidadactividad.sesion', 'Necesidadactividad.sesion != ' => 0, 'Necesidadactividad.objeto_id !=' => null))
				)
			)
		);
		$results1 = $this->Necesidadactividad->findAllByObjeto_id($id, array('Necesidadactividad.descripcion', 'Necesidadactividad.cantidad', 'Necesidadactividad.infraestructura', 'Actividad.nombre', 'Horario.inicio', 'Horario.fin'));
		//Los que son de todas las sesiones
		$this->Necesidadactividad->unbindModel(array('hasOne' => array('Horario')));
		$this->Necesidadactividad->bindModel(
			array('hasOne' => array(
				'Horario' => array('foreignKey' => false, 'type' => 'INNER', 'conditions' => array('Horario.actividad_id = Necesidadactividad.actividad_id', 'Necesidadactividad.sesion' => 0, 'Necesidadactividad.objeto_id !=' => null))
				)
			)
		);
		$results2 = $this->Necesidadactividad->findAllByObjeto_id($id, array('Necesidadactividad.descripcion', 'Necesidadactividad.cantidad', 'Necesidadactividad.infraestructura', 'Actividad.nombre', 'Horario.inicio', 'Horario.fin'));
		//Montar el horario
		$results = array_merge($results1, $results2);
		$horario = array();
		foreach ($results as $v) {
			$horario[] = array(
				'necesidad' => $v['Necesidadactividad']['descripcion'],
				'actividad' => $v['Actividad']['nombre'],
				'inicio' => $v['Horario']['inicio'],
				'fin' => $v['Horario']['fin'],
				'cantidad' => $v['Necesidadactividad']['cantidad'],
				'infraestructura' => $v['Necesidadactividad']['infraestructura'],
				'solapado' => false
			);
		}
		if (!$objeto['Objeto']['fungible']) {
			//Comprobar solapes
			for ($i = 0; $i < count($horario); $i++) {
				for ($j = $i+1; $j < count($horario); $j++) {
					if (($horario[$i]['fin'] > $horario[$j]['inicio']) || ($horario[$j]['fin'] > $horario[$i]['inicio'])) {
						$horario[$i]['solapado'] = true;
						$horario[$j]['solapado'] = true;
					}
				}
			}
		}

		usort($horario, array("ObjetosController", "cmphoras"));
		$this->set('horario', $horario);
		$this->set('objeto', $objeto);
		$this->set('usozona', $usozona);
		$this->set('usoactividades', $usoactividades);
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
			if ($objeto['Objeto']['fechaentrega'] == '0000-00-00 00:00:00') {
				$objeto['Objeto']['fechaentrega'] = date('Y-m-d H:i:s'); //El campo fecha no determina nada en la vista, ajusto para comodidad del usuario
			}
			$this->request->data = $objeto;
		}
		if ($objeto['Objeto']['fechadevolucion'] == '9999-12-31 23:59:59') {
			$this->set('prestamo', false);
			$objeto['Objeto']['fechadevolucion'] = date('Y-m-d H:i:s'); //El campo fecha no determina nada en la vista, ajusto para comodidad del usuario
		}
		else {
			$this->set('prestamo', true);
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

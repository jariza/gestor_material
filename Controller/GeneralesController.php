<?php
class GeneralesController extends AppController {
    public $helpers = array('Html', 'Paginator');

	/**
	 * This controller does not use a model
	 *
	 * @var array
	 */
	public $uses = array();

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
		$mzona = $this->loadModel('Zona');
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

	public function estado() {
		$mnecesidadzona = $this->loadModel('Necesidadzona');
		$mnecesidadactividad = $this->loadModel('Necesidadactividad');

		//No satisfechas
		$this->Necesidadactividad->bindModel(array(
			'hasOne' => array('Zona' => array('foreignKey' => false, 'conditions' => 'Actividad.zona_id = Zona.id'))
		));
		$nosatzona = $this->Necesidadzona->find('all', array('conditions' => array('infraestructura' => 0, 'objeto_id' => null), 'fields' => array('Necesidadzona.cantidad', 'Necesidadzona.descripcion', 'Zona.nombre', 'Zona.id'), 'order' => 'Zona.nombre'));
		$nosatactividad = $this->Necesidadactividad->find('all', array('conditions' => array('infraestructura' => 0, 'objeto_id' => null), 'fields' => array('Necesidadactividad.cantidad', 'Necesidadactividad.cantidad', 'Necesidadactividad.descripcion', 'Zona.nombre', 'Actividad.nombre', 'Zona.id', 'Actividad.id'), 'order' => array('Zona.nombre', 'Actividad.nombre')));
		
		//No satisfechas por descripción
		$this->Necesidadactividad->virtualFields['acumulado'] = 'SUM(Necesidadactividad.cantidad)';
		$this->Necesidadzona->virtualFields['acumulado'] = 'SUM(Necesidadzona.cantidad)';
		$czona = $this->Necesidadzona->find('list', array('fields' => array('descripcion', 'acumulado'), 'group' => 'Necesidadzona.descripcion'));
		$cactividad = $this->Necesidadactividad->find('list', array('fields' => array('descripcion', 'acumulado'), 'group' => 'Necesidadactividad.descripcion'));
		foreach($czona as $k => $v) {
			if (array_key_exists($k, $cactividad)) {
				$cactividad[$k] += $v;
			}
			else {
				
				$cactividad[$k] = $v;
			}
		}
		ksort($cactividad);
		$nosatdesc = $cactividad;

		//Objetos asignados a zonas
		$this->Necesidadactividad->bindModel(array(
			'hasOne' => array('Zona' => array('foreignKey' => false, 'conditions' => 'Actividad.zona_id = Zona.id'))
		));
		$results1 = $this->Necesidadzona->find('all', array('conditions' => array('infraestructura' => 1, 'objeto_id !=' => null), 'fields' => array('Necesidadzona.cantidad', 'Necesidadzona.descripcion', 'Zona.nombre', 'Zona.id', 'Objeto.descripcion', 'Objeto.id'), 'order' => 'Zona.nombre'));
		$results2 = $this->Necesidadactividad->find('all', array('conditions' => array('infraestructura' => 1, 'objeto_id !=' => null), 'fields' => array('Necesidadactividad.cantidad', 'Necesidadactividad.cantidad', 'Necesidadactividad.descripcion', 'Zona.nombre', 'Zona.id', 'Actividad.nombre', 'Actividad.id', 'Objeto.descripcion', 'Objeto.id'), 'order' => array('Zona.nombre', 'Actividad.nombre')));
		$infraobjeto = array();
		foreach ($results1 as $v) {
			$infraobjeto[] = array(
				'nomzona' => $v['Zona']['nombre'],
				'idzona' => $v['Zona']['id'],
				'nomactividad' => '',
				'idactividad' => -1,
				'descobjeto' => $v['Objeto']['descripcion'],
				'idobjeto' => $v['Objeto']['id'],
				'necesidad' => $v['Necesidadzona']['descripcion'],
				'cantidad' => $v['Necesidadzona']['cantidad']
			);
		}
		foreach ($results2 as $v) {
			$infraobjeto[] = array(
				'nomzona' => $v['Zona']['nombre'],
				'idzona' => $v['Zona']['id'],
				'nomactividad' => $v['Actividad']['nombre'],
				'idactividad' => $v['Actividad']['id'],
				'descobjeto' => $v['Objeto']['descripcion'],
				'idobjeto' => $v['Objeto']['id'],
				'necesidad' => $v['Necesidadactividad']['descripcion'],
				'cantidad' => $v['Necesidadactividad']['cantidad']
			);
		}

		//No fungible con cantidad superior a uno
		$this->Necesidadactividad->bindModel(array(
			'hasOne' => array('Zona' => array('foreignKey' => false, 'conditions' => 'Actividad.zona_id = Zona.id'))
		));
		$results1 = $this->Necesidadzona->find('all', array('conditions' => array('Objeto.fungible' => 0, 'Necesidadzona.cantidad >' => 1), 'fields' => array('Necesidadzona.cantidad', 'Necesidadzona.descripcion', 'Zona.nombre', 'Zona.id', 'Objeto.descripcion', 'Objeto.id'), 'order' => 'Zona.nombre'));
		$results2 = $this->Necesidadactividad->find('all', array('conditions' => array('Objeto.fungible' => 0, 'Necesidadactividad.cantidad >' => 1), 'fields' => array('Necesidadactividad.cantidad', 'Necesidadactividad.cantidad', 'Necesidadactividad.descripcion', 'Zona.nombre', 'Zona.id', 'Actividad.nombre', 'Actividad.id', 'Objeto.descripcion', 'Objeto.id'), 'order' => array('Zona.nombre', 'Actividad.nombre')));
		$multiobjeto = array();
		foreach ($results1 as $v) {
			$multiobjeto[] = array(
				'nomzona' => $v['Zona']['nombre'],
				'idzona' => $v['Zona']['id'],
				'nomactividad' => '',
				'idactividad' => -1,
				'descobjeto' => $v['Objeto']['descripcion'],
				'idobjeto' => $v['Objeto']['id'],
				'necesidad' => $v['Necesidadzona']['descripcion'],
				'cantidad' => $v['Necesidadzona']['cantidad']
			);
		}
		foreach ($results2 as $v) {
			$multiobjeto[] = array(
				'nomzona' => $v['Zona']['nombre'],
				'idzona' => $v['Zona']['id'],
				'nomactividad' => $v['Actividad']['nombre'],
				'idactividad' => $v['Actividad']['id'],
				'descobjeto' => $v['Objeto']['descripcion'],
				'idobjeto' => $v['Objeto']['id'],
				'necesidad' => $v['Necesidadactividad']['descripcion'],
				'cantidad' => $v['Necesidadactividad']['cantidad']
			);
		}

		//Sobreasignación de fungibles
		$this->Necesidadactividad->unbindModel(array('belongsTo' => 'Actividad')); //Ahorro SQL
		$this->Necesidadzona->virtualFields['uso'] = 'SUM(Necesidadzona.cantidad)';
		$results1 = $this->Necesidadzona->find('all', array('fields' => array('Necesidadzona.objeto_id', 'uso', 'Objeto.descripcion', 'Objeto.id', 'Objeto.cantidad'), 'conditions' => array('Objeto.fungible' => 1), 'group' => array('objeto_id')));
		$this->Necesidadactividad->virtualFields['uso'] = 'SUM(Necesidadactividad.cantidad)';
		$results2 = $this->Necesidadactividad->find('all', array('fields' => array('Necesidadactividad.objeto_id', 'uso', 'Objeto.descripcion', 'Objeto.id', 'Objeto.cantidad'), 'conditions' => array('Objeto.fungible' => 1), 'group' => array('objeto_id')));
		$sobreasignacion = array();
		foreach ($results1 as $v) {
			$sobreasignacion[$v['Necesidadzona']['objeto_id']] = array(
				'uso' => $v['Necesidadzona']['uso'],
				'descobjeto' => $v['Objeto']['descripcion'],
				'idobjeto' => $v['Objeto']['id'],
				'disponible' => $v['Objeto']['cantidad']
			);
		}
		foreach ($results2 as $v) {
			if (array_key_exists($v['Necesidadactividad']['objeto_id'], $sobreasignacion)) {
				$sobreasignacion[$v['Necesidadactividad']['objeto_id']]['uso'] += $v['Necesidadactividad']['uso'];
			}
			else {
				$sobreasignacion[$v['Necesidadactividad']['objeto_id']] = array(
					'uso' => $v['Necesidadactividad']['uso'],
					'descobjeto' => $v['Objeto']['descripcion'],
					'idobjeto' => $v['Objeto']['id'],
					'disponible' => $v['Objeto']['cantidad']
				);
			}
		}
		//Elimino los no sobreasignados
		foreach ($sobreasignacion as $k => $v) {
			if ($v['uso'] <= $v['disponible']) {
				unset($sobreasignacion[$k]);
			}
		}

		//Objetos usados en zonas y actividades
		$this->Necesidadactividad->bindModel(array(
			'hasOne' => array(
				'Necesidadzona' => array('foreignKey' => false, 'type' => 'INNER', 'conditions' => array('Necesidadzona.objeto_id = Necesidadactividad.objeto_id', 'Objeto.fungible' => 0)),
				'Zona' => array('foreignKey' => false, 'conditions' => 'Necesidadzona.zona_id = Zona.id')
			)
		));
		$results = $this->Necesidadactividad->find('all', array('fields' => array('Objeto.descripcion', 'Objeto.id', 'Actividad.nombre', 'Actividad.id', 'Zona.nombre', 'Zona.id')));
		$activzona = array();
		foreach ($results as $v) {
			$activzona[$v['Objeto']['id']]['descripcion'] = $v['Objeto']['descripcion'];
			$activzona[$v['Objeto']['id']]['zonas'][$v['Zona']['id']] = $v['Zona']['nombre'];
			$activzona[$v['Objeto']['id']]['actividades'][$v['Actividad']['id']] = $v['Actividad']['nombre'];
		}

		//Obtener necesidades y sus horas
		//Los que son de alguna sesión
		$this->Necesidadactividad->unbindModel(array('hasOne' => array('Necesidadzona', 'Zona')));
		$this->Necesidadactividad->bindModel(
			array('hasOne' => array(
				'Horario' => array('foreignKey' => false, 'type' => 'INNER', 'conditions' => array('Horario.actividad_id = Necesidadactividad.actividad_id', 'Horario.sesion = Necesidadactividad.sesion', 'Necesidadactividad.sesion != ' => 0, 'Necesidadactividad.objeto_id !=' => null))
				)
			)
		);
		$results1 = $this->Necesidadactividad->find('all', array('conditions' => array('Necesidadactividad.infraestructura' => 0, 'Objeto.fungible' => 0), 'fields' => array('Actividad.id', 'Actividad.nombre', 'Objeto.id', 'Objeto.descripcion', 'Horario.inicio', 'Horario.fin')));
		//Los que son de todas las sesiones
		$this->Necesidadactividad->unbindModel(array('hasOne' => array('Horario')));
		$this->Necesidadactividad->bindModel(
			array('hasOne' => array(
				'Horario' => array('foreignKey' => false, 'type' => 'INNER', 'conditions' => array('Horario.actividad_id = Necesidadactividad.actividad_id', 'Necesidadactividad.sesion' => 0, 'Necesidadactividad.objeto_id !=' => null))
				)
			)
		);
		$results2 = $this->Necesidadactividad->find('all', array('conditions' => array('Necesidadactividad.infraestructura' => 0, 'Objeto.fungible' => 0), 'fields' => array('Actividad.id', 'Actividad.nombre', 'Objeto.id', 'Objeto.descripcion', 'Horario.inicio', 'Horario.fin')));
		//Montar el horario
		$results = array_merge($results1, $results2);
		$horarioobjetos = array(); //El key es el id de objeto
		foreach ($results as $v) {
			$horarioobjetos[$v['Objeto']['id']]['descobjeto'] = $v['Objeto']['descripcion'];
			$horarioobjetos[$v['Objeto']['id']]['horarios'][] = array(
				'nomactividad' => $v['Actividad']['nombre'],
				'idactividad' => $v['Actividad']['id'],
				'inicio' => $v['Horario']['inicio'],
				'fin' => $v['Horario']['fin'],
				'solapado' => false
			);
		}
		//Comprobar solapes
		foreach (array_keys($horarioobjetos) as $k) {
			for ($i = 0; $i < count($horarioobjetos[$k]['horarios']); $i++) {
				for ($j = $i+1; $j < count($horarioobjetos[$k]['horarios']); $j++) {
					if (($horarioobjetos[$k]['horarios'][$i]['fin'] > $horarioobjetos[$k]['horarios'][$j]['inicio']) || ($horarioobjetos[$k]['horarios'][$j]['fin'] > $horarioobjetos[$k]['horarios'][$i]['inicio'])) {
						$horarioobjetos[$k]['horarios'][$i]['solapado'] = true;
						$horarioobjetos[$k]['horarios'][$j]['solapado'] = true;
					}
				}
			}
		}
		//Eliminar horarios sin solape
		foreach ($horarioobjetos as $k => $v) {
			foreach ($v['horarios'] as $k2 => $v2) {
				if (!$v2['solapado']) {
					unset($horarioobjetos[$k]['horarios'][$k2]);
				}
			}
		}
		//Copiar sólo los que aún tengan algo en el horario
		$solapados = array();
		foreach ($horarioobjetos as $k => $v) {
			if (count($v['horarios']) > 0) {
				$solapados[$k] = $v;
			}
		}

		$this->set('nosatzona', $nosatzona);
		$this->set('nosatactividad', $nosatactividad);
		$this->set('nosatdesc', $nosatdesc);
		$this->set('infraobjeto', $infraobjeto);
		$this->set('multiobjeto', $multiobjeto);
		$this->set('sobreasignacion', $sobreasignacion);
		$this->set('activzona', $activzona);
		$this->set('solapados', $solapados);
	}
	
	function evolucion() {
		$mobjeto = $this->loadModel('Objeto');

		$this->Objeto->virtualFields['uso'] = 'Objeto.cantidad - Objeto.cantidad_postevento';
		$uso = $this->Objeto->find('all', array('fields' => array('id', 'descripcion', 'cantidad', 'cantidad_postevento', 'uso'), 'recursive' => -1));
		
		$gastados = array();
		$nousados = array();
		$nuevos = array();
		$resto = array();

		foreach ($uso as $v) {
			if ($v['Objeto']['cantidad_postevento'] == 0) {
				$gastados[] = $v;
			}
			elseif ($v['Objeto']['uso'] == 0) {
				$nousados[] = $v;
			}
			elseif ($v['Objeto']['uso'] < 0) {
				$nuevos[] = $v;
			}
			else {
				$resto[] = $v;
			}
		}
		
		$this->set('gastados', $gastados);
		$this->set('nousados', $nousados);
		$this->set('nuevos', $nuevos);
		$this->set('resto', $resto);
	}

	function rellenar() {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}

		$mobjeto = $this->loadModel('Objeto');
		$this->Objeto->updateAll(array('Objeto.cantidad_postevento' => 'Objeto.cantidad'));
	
		$this->Session->setFlash('Cantidades post-evento actualizadas');
		return $this->redirect('/');
	}

	function reiniciar_evento() {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}

		$mobjeto = $this->loadModel('Objeto');
		$this->Objeto->updateAll(array('Objeto.cantidad' => 'Objeto.cantidad_postevento'));
		$this->Objeto->updateAll(array('Objeto.cantidad_postevento' => 0));
		$this->Objeto->deleteAll(array('Objeto.cantidad' => 0));
		$this->Objeto->query('TRUNCATE TABLE actividades');
		$this->Objeto->query('TRUNCATE TABLE horarios');
		$this->Objeto->query('TRUNCATE TABLE necesidadactividades');
		$this->Objeto->query('TRUNCATE TABLE necesidadzonas');
		$this->Objeto->query('TRUNCATE TABLE zonas');
		
		$this->Session->setFlash('Evento reiniciado, ¡recuerda descativar el modo post-evento!');
		return $this->redirect('/');
	}
}

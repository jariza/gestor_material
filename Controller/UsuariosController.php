<?php
class UsuariosController extends AppController {
	public $helpers = array('Html', 'Form', 'Js', 'Paginator');

	public $paginate = array(
		'fields' => array('Usuario.id', 'Usuario.name', 'Usuario.username', 'Usuario.rol', 'Usuario.zonas', 'Usuario.email', 'Usuario.created', 'Usuario.modified')
		);

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('login');
	}

	public function isAuthorized($usuario) {

		if ($this->request->params['action'] === 'logout') {
			return true;
		}
		elseif (isset($usuario['rol'])) {
			if ($usuario['rol'] === 'admin') {
				return true;
			}
			elseif (in_array($usuario['rol'], array('produccion', 'managerzona'))) {
				if ($this->request->params['action'] === 'chpass') {
					return true;
				}
			}
		}
		// Default deny
		return false;
	}

	public function login() {
		$this->set('bloqueado', false);
		if ($this->request->is('post')) {
			$mlf = $this->loadModel('LoginFallido');
			//Comprobar el bloqueo por IP
			$fallos = $this->LoginFallido->find('count', array('conditions' => array('IP' => $this->request->clientIp(), 'Created >' => date('Y-m-d', strtotime("-1 day")))));
			if ($fallos < Configure::read('maxfallos')) {
				if ($this->Auth->login()) {
					return $this->redirect($this->Auth->redirect());
				}
				$this->Session->setFlash(__('Nombre de usuario o contraseña incorrectos.'));
				//Anoto el fallo
				$this->LoginFallido->create();
				$this->LoginFallido->save(array('IP' => $this->request->clientIp(), 'username' => $this->request->data['Usuario']['username']));
			}
			else {
				$this->set('bloqueado', true);
			}
		}
	}

	public function logout() {
		return $this->redirect($this->Auth->logout());
	}

    public function index() {
		$mzona = $this->loadModel('Zona');
		$this->set('zonas', $this->Zona->find('list'));
        $this->set('usuarios', $this->paginate());
    }

	public function ayuda() {
		//Nada que hacer, sólo muestra la ayuda
	}

    public function add() {
        if ($this->request->is('post')) {
            $this->Usuario->create();
            if ($this->Usuario->save($this->request->data)) {
                $this->Session->setFlash(__('Usuario añadido.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(
                __('Error al añadir el usuario.')
            );
        }
        else {
			$mzona = $this->loadModel('Zona');
			$this->set('zonas', $this->Zona->find('list'));
		}
    }

	public function chpass() {
		if ($this->request->is('post')) {
			if (strcmp($this->request->data['Usuario']['password1'], $this->request->data['Usuario']['password2']) == 0) {
				$res = $this->Usuario->findById($this->Auth->User('id'), array('password'));
				$passwordHasher = new SimplePasswordHasher();
				if (strcmp($passwordHasher->hash($this->request->data['Usuario']['curpassword']), $res['Usuario']['password']) == 0) {
					$this->Usuario->id = $this->Auth->User('id');
					$this->Usuario->name = $this->Auth->User('name');
					$this->Usuario->password = $this->request->data['Usuario']['password1'];
					if ($this->Usuario->save($this->Usuario)) {
						$this->Session->setFlash(__('Contraseña cambiada.'));
						return $this->redirect(array('controller' => 'pages', 'action' => 'home'));
					}
					$this->Session->setFlash(__('No se pudo actualizar la contraseña.'));
				}
				else {
					$this->Session->setFlash(__('La contraseña actual no es correcta.'));
				}
			}
			else {
				$this->Session->setFlash(__('La nueva contraseña y su confirmación no coinciden.'));
			}
		}
	}

    public function edit($id = null) {
        $this->Usuario->id = $id;
        if (!$this->Usuario->exists()) {
            throw new NotFoundException(__('Usuario no válido.'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Usuario->save($this->request->data)) {
                $this->Session->setFlash(__('Cambios guardados.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(
                __('No se pudieron guardar los cambios.')
            );
        } else {
			$mzona = $this->loadModel('Zona');
			$this->set('zonas', $this->Zona->find('list'));
            $this->request->data = $this->Usuario->read(null, $id);
            unset($this->request->data['Usuario']['password']);
        }
    }

    public function resetpass($id = null) {
        $this->request->onlyAllow('post');

        $this->Usuario->id = $id;
        if (!$this->Usuario->exists()) {
            throw new NotFoundException(__('Usuario no válido.'));
        }
        $nuevopass = $this->generateRandomString();
		$this->Usuario->password = $nuevopass;
		if ($this->Usuario->save($this->Usuario)) {
			$this->Session->setFlash("Contraseña cambiada a $nuevopass");
		}
		else {
			$this->Session->setFlash(__('No se pudo resetear la contraseña.'));	
		}
		return $this->redirect(array('action' => 'index'));
    }

    public function delete($id = null) {
        $this->request->onlyAllow('post');

        $this->Usuario->id = $id;
        if (!$this->Usuario->exists()) {
            throw new NotFoundException(__('Usuario no válido.'));
        }
        $res = $this->Usuario->findById($id, array('username'));
        if (strcmp($res['Usuario']['username'], 'admin') == 0) {
			$this->Session->setFlash(__('No se puede eliminar el usuario admin'));
		}
		else {
			if ($this->Usuario->delete()) {
				$this->Session->setFlash(__('Usuario eliminado'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('No se pudo eliminar el usuario.'));
		}
		return $this->redirect(array('action' => 'index'));
    }

	private function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, strlen($characters) - 1)];
		}
		return $randomString;
	}

}

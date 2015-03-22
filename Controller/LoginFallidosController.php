<?php
class LoginFallidosController extends AppController {
	public $helpers = array('Html', 'Form', 'Js', 'Paginator');

	public $paginate = array(
		'fields' => array('LoginFallido.id', 'LoginFallido.created', 'LoginFallido.IP', 'LoginFallido.username')
		);

	public function isAuthorized($usuario) {
		if (isset($usuario['rol'])) {
			if ($usuario['rol'] == 'admin') {
				return true;
			}
		}
		// Default deny
		return false;
	}

    public function index() {
        $this->set('loginFallidos', $this->paginate());
    }

	public function ayuda() {
		//Nada que hacer, sólo muestra la ayuda
	}

	public function delete($id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}

		if ($this->LoginFallido->delete($id)) {
			$this->Session->setFlash(
				__('Login fallido eliminado.', h($id))
			);
			return $this->redirect(array('action' => 'index'));
		}
	}

}

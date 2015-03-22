<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    public $components = array(
        //'Security',
        'Session',
        'Auth' => array(
            'Form' => array(
                'passwordHasher' => array(
                    'className' => 'Simple',
                    'hashType' => 'sha256'
                )
            ),
			'loginAction' => array(
				'controller' => 'usuarios',
				'action' => 'login'
			),
            'loginRedirect' => array(
                'controller' => 'pages',
                'action' => 'home'
            ),
            'logoutRedirect' => array(
                'controller' => 'pages',
                'action' => 'home'
            ),
            'authorize' => array('Controller'),
            'authError' => 'Acceso no autorizado.'
        )
    );

    public function beforeFilter() {
		//$this->Security->blackHoleCallback = 'blackhole';
		$this->Auth->authenticate = array(
			'Form' => array(
				'userModel' => 'Usuario'
			)
		);
		if ($this->Auth->loggedIn()) {
			$this->set('logueado', true);
			$this->set('facadeuname', $this->Auth->user('username'));
		}
		else {
			$this->set('logueado', false);
		}
		$this->disableCache();
    }

	public function blackhole($type) {
		CakeLog::write('error', $type.': '.$this->request->clientIp()."\n".print_r($this->request, TRUE));
		throw new BadRequestException('Fire in the hole!');
	}

	public function isAuthorized($usuario) {
		// Admin can access every action
		if (isset($usuario['rol']) && $usuario['rol'] === 'admin') {
			return true;
		}

		// Default deny
		return false;
	}
}

<?php
class UsersController extends AppController {
	public $components = array('Session');

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('add', 'login');
	}

	public function login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				if ($this->Auth->user('is_admin') == 1) {
					$this->redirect($this->Auth->redirect());
				} else {
					$this->redirect(array(
						'controller' => 'homes',
						'action' => 'index',
						'admin' => false
					));
				}
			} else {
				$this->Session->setFlash(__('invalid username or password! try again'));
			}
		}
	}

	public function logout() {
		$this->redirect($this->Auth->logout());
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('Registration successful'));
				$this->redirect(array('controller' => 'users', 'action' => 'login'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
				unset($this->request->data['User']['password']);
				unset($this->request->data['User']['password_confirm']);
			}
		}
	}
}

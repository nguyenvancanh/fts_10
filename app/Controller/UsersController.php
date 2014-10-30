<?php
class UsersController extends AppController {
	public $components = array('Session');
	public $helpers = array('Paginator');
	public $paginate = array(
		'limit' => 3,
		'order' => 'id desc'
	);

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('add');
	}
	public function index(){

	}
	public function login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				if ($this->Auth->user('is_admin') == 1) {
					$this->redirect(array(
						'controller'=>'users',
						'action'=>'index',
						'admin'=>true
					));
				} else {
					$this->redirect(array(
						'controller' => 'users',
						'action' => 'index'
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

	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->Auth->user('is_admin') && ($this->Auth->user('id') != $id)) {
			if ($this->User->delete()) {
				$this->Session->setFlash(__('User was deleted'));
				$this->redirect(array('controller' => 'users', 'action' => 'admin_index'));
			} else {
				$this->Session->setFlash(__('User was not deleted'));
				$this->redirect(array('controller' => 'users', 'action' => 'admin_index'));
			}
		} else {
			$this->Session->setFlash(__('Only admin can delete'));
		}
	}

	public function admin_index() {
		$users = $this->paginate('User');
		$this->set('users', $users);
	}
}

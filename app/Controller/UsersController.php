<?php
App::import('Model', 'User');

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
	public function index() {
		$userId = $this->Auth->user('id');
		$user = $this->User->findById($userId);
		$this->set('user', $user['User']);
	}
	
	public function admin_index() {
		$users = $this->paginate('User');
		$this->set('users', $users);
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
	
	public function edit() {
		$id = $this->Auth->user('id');
		$actionHeading = __("Edit profile");
		$actionSogan = __("Please input all fields");
		$this->set(compact('actionHeading', 'actionSogan'));
		if (!empty($this->data)) {
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The Profile has been saved'));
				$this->redirect(array('controller' => 'users', 'action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Profile could not saved'));
			}
		} else {
			$this->Session->setFlash(__("Invalid Edit"));
			$this->data = $this->User->read(null, $id);
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
	
	public function change_password() {
		$id = $this->Auth->user('id');
		$this->set('id', $id);
		if ($this->request->is('post')) {
			$oldPassword = $this->request->data['User']['old_password'];
			$checkOldPassword = $this->User->checkPass($id, $oldPassword);
			$this->User->set($this->request->data);
			if ($checkOldPassword) {
				if ($this->User->validates()) {
					$this->User->saveField('password', $this->request->data['User']['confirm_password']);
					if ($this->User->save($this->request->data, false)) {
						$this->Session->setFlash(__('Change password successful'));
						$this->redirect(array('controller' => 'users', 'action' => 'index'));
					}
				} else {
					$this->Session->setFlash(__('Please enter all fields'));
				}
			} else {
				$this->Session->setFlash(__(' Old password not correct'));
				$this->redirect(array('controller' => 'users', 'action' => 'change_password'));
			}
		}
	}

	public function change_avatar() {
		if ($this->request->is('post')) {
			if (isset($this->request->data) && !empty($this->request->data)) {
			$file = $this->request->data['User']['avatar'];
			$userId = $this->Auth->user('id');
			$typeImages = array('image/gif', 'image/jpeg', 'image/png');
				if (in_array($file['type'], $typeImages) && $file["size"] < User::MAX_FILE_SIZE) {
					$extensions = pathinfo($file['name'], PATHINFO_EXTENSION);
					
					$avatarPath = UPLOAD_DIR . md5($userId);
					$userAvatar = md5($userId);
					if (move_uploaded_file($file['tmp_name'], $avatarPath)) {
						$this->User->id = $userId;
						$this->User->saveField('avatar', $userAvatar);
						$this->Session->setFlash('Avatar Upload success!');
						$this->redirect(array('controller' => 'users', 'action' => 'index'));
					} else {
						$this->Session->setFlash('Avatar can not Upload');
						$this->redirect(array('controller' => 'users', 'action' => 'index'));
					}
				} else {
					$this->Session->setFlash('Please choose avatar');
					$this->redirect(array('controller' => 'users', 'action' => 'index'));
				}
			} else {
				$this->redirect('/users');
			}
		}
		
	}
}

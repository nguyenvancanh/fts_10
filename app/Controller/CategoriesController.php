<?php
class CategoriesController extends AppController {
	public $helpers = array('Paginator');
	public $paginate = array(
		'limit' => 3,
		'order' => 'id desc'
	);

	public function admin_index() {
		$categories = $this->paginate('Category');
		$this->set('categories', $categories);
	}

	public function admin_add() {
		$actionHeading = __("Add a new Category");
		$actionSlogan = __("Please fill in all fields");
		$this->set(compact('actionheading', 'actionSlogan'));
		if (!empty($this->data)) {
			$this->Category->create();
			if ($this->Category->save($this->data)) {
				$this->Session->setFlash(__('The Category has been saved', TRUE));
				$this->redirect(array('controller' => 'categories', 'action'  => 'admin_index'));
			} else {
				$this->Session->setFlash(__('The Category could not be saved. Please try again', TRUE));
			}
		}
	}
	
	public function admin_edit($id = null) {
		$actionHeading = __("Edit a Category");
		$actionSogan = __("Please input all fields");
		$this->set(compact('actionHeading', 'actionSogan'));
		if ($id && empty($this->data)) {
			$this->Session->setFlash(__("Invalid Category"));
		}
		if (!empty($this->data)) {
			if ($this->Category->save($this->data)) {
				$this->Session->setFlash(__('The Category has been saved'));
				$this->redirect(array('controller' => 'categories', 'action' => 'admin_index'));
			} else {
				$this->Session->setFlash(__('The Category could not saved'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Category->read(null, $id);
		}
	}

	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Category->id = $id;
		if (!$this->Category->exists()) {
			throw new NotFoundException(__('Invalid Category'));
		}
		if ($this->Auth->user('is_admin')) {
			if ($this->Category->delete()) {
				$this->Session->setFlash(__('Category was deleted'));
				$this->redirect(array('controller' => 'categories', 'action' => 'admin_index'));
			} else {
				$this->Session->setFlash(__('Category was not deleted'));
				$this->redirect(array('controller' => 'categories', 'action' => 'admin_index'));
			}
		} else {
			$this->Session->setFlash(__('Only admin can delete'));
		}
	}
}

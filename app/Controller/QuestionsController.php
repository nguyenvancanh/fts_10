<?php
class QuestionsController extends AppController {
	public $uses = array('Category', 'Question', 'Answer');

	public function admin_index() {
		$questions = $this->Question->find('all', array('order' => 'id desc'));
		if (isset($questions) && is_array($questions) && !empty($questions)) {
			$this->set('questions', $questions);
		}
	}

	public function admin_add() {
		$categories = $this->Category->find('list');
		$this->set('categories', $categories);
		if ($this->request->is('post')) {
			$categoryId = $this->request->data['Post']['category_id'];
			$this->Question->create();
			$answerCorrect = $this->request->data['Post']['AnswerCorrect'];
			$this->request->data['Question']['category_id'] = $categoryId;
			$this->request->data['Answer']['answer_correct'] = $answerCorrect;
			if ($this->Question->saveAll($this->request->data)) {
				$this->Session->setFlash(__('The questions has been saved'));
				$this->redirect(array('controller' => 'questions', 'action' => 'admin_index'));
			} else {
				$this->Session->setFlash(__('The questions could not be saved! Try Again!'));
			}
		} 
	}
	
	public function admin_edit($id = null ) {
		$actionHeading = __("Edit a Question");
		$actionSogan = __("Please input all fill");
		$this->set(compact('actionHeading', 'actionSogan'));
		if ($id && empty($this->data)) {
			$this->Session->setFlash(__("Invalid Edit"));
		}
		if (!empty($this->request->data)) {
			if ($this->Question->saveAll($this->request->data)) {
				$this->Session->setFlash(__('The Questions has been saved'));
				$this->redirect(array('controller' => 'questions', 'action' => 'admin_index'));
			} else {
				$this->Session->setFlash(__('The Questions could not saved'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Question->read(null, $id);
		}
	}
	
	public function admin_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Question->id = $id;
		if (!$this->Question->exists()) {
			throw new NotFoundException(__('Invalid Questions'));
		}
		if ($this->Question->delete()) {
			$this->Session->setFlash(__('Question delete'));
			$this->redirect(array('action' => 'admin_index'));
		} else {
			$this->Session->setFlash(__('Question was not delete'));
			$this->redirect(array('action' => 'admin_index'));
		}
	}
}


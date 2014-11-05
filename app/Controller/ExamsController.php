<?php

App::uses('AppController', 'Controller');
App::import('Model', array('Question', 'Exam'));

/**
 * CakePHP ExamsController
 * @author framgia
 */
class ExamsController extends AppController {

	public $paginate = array(
		'limit' => Exam::LIMIT_ROWS,
		'order' => 'id desc'
	);

	public $uses = array('Question', 'Exam', 'Category', 'Answer', 'Result');

	public function index() {
		$categories = $this->Category->find('list');
		if (isset($this->data) && !empty($this->data)) {
			$categoryId = $this->data['Exam']['category_id'];
			if ($categoryId == NULL) {
				$this->Session->setFlash("You must choose a category");
				$this->redirect(array('controller' => 'exams', 'action' => 'index'));
			}
			$name = $categories[$categoryId];
			$field['Exam'] = array(
				'name' => $name,
				'category_id' => $categoryId
			);
			$this->Exam->create();
			if ($this->Exam->save($field)) {
				$this->Question->unbindModel(array('hasOne' => array('Answer')));
				$data['Exam'] = null;
				$questions['Question'] = $this->Question->find('list', array(
					'conditions' => array('category_id' => $categoryId),
					'limit' => Question::MAX_NUMBER_QUESTIONS,
					'order' => 'rand()'
				));
				$data['Exam'] = array(
					'category_id' => $categoryId
				);
				$data['Exam'] += $questions;
				$this->Exam->save($data);
			}
			$this->redirect('/exams');
		}
		$exams = $this->paginate('Exam');
		$status = array(
			1 => __('Never start'),
			2 => __('Pending'),
			3 => __('Completed'),
		);
		$this->set(array(
			'categories' => $categories,
			'exams' => $exams,
			'status' => $status
		));
	}

	public function start($id) {
		$this->Exam->recursive = 2;
		$exam = $this->Exam->findById($id);
		$this->set(array(
			'exam_questions' => $exam['Question'],
			'exam' => $exam['Exam']
		));
	}

	public function check() {
		if ($this->request->is('post')) {
			$examId = $this->data['ExamInfo']['id'];
			$exams = $this->data;
			$answers = $this->Answer->find('all');
			$correctCounter = 0;
			foreach ($exams['Exam'] as $questionId => $user_answer) {
				foreach ($answers as $answer) {
					if ($answer['Answer']['question_id'] == $questionId) {
						pr($exams['Exam'][$questionId]['answer']);
						if ($answer['Answer']['answer_correct'] == $exams['Exam'][$questionId]['answer']) {
							$isCorrect = 1;
							$correctCounter++;
						} else {
							$isCorrect = 0;
						}
						$data[] = array(
							'user_id' => $this->Auth->user('id'),
							'exam_id' => $examId,
							'question_id' => $questionId,
							'user_choose' => (int) $this->data['Exam'][$questionId]['answer'],
							'is_correct' => $isCorrect
						);
					}
				}
			}
			$this->Result->create();
			if ($this->Result->saveMany($data) && $this->Exam->validates()) {
				$this->Exam->id = $examId;
				$this->Exam->save(array(
					'status' => Exam::COMPLETE,
					'correct_nums' => $correctCounter
				));
				$this->Session->setFlash('Exams Completed');
				$this->redirect(array('controller' => 'exams', 'action' => 'view', $examId));
			} else {
				$this->Session->setFlash('Exams can not Complete');
			}
		}
	}

	public function view($id) {
		$this->Exam->recursive = 2;
		$exams = $this->Exam->findById($id);
		$results = $this->Result->find('all', array(
			'conditions' => array(
				'user_id' => $this->Auth->user('id'),
				'exam_id' => $id
			)
		));
		$userAnswers = null;
		foreach ($results as $result) {
			$userAnswers[$result['Result']['question_id']] = $result['Result']['user_choose'];
		};
		$this->set(array(
			'userChoose' => $userAnswers,
			'exam_questions' => $exams['Question'],
			'exam' => $exams['Exam']
		));
	}

}

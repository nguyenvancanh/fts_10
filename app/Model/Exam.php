<?php

App::uses('AppModel', 'Model');

class Exam extends AppModel {

	const COMPLETE = 3;
	const LIMIT_ROWS = 10;

	public $validate = array(
		'answer' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Choose the answer')
		)
	);
	
	public $hasAndBelongsToMany = array(
		'Question' => array(
			'className' => 'Question',
			'joinTable' => 'questions_exams',
			'foreignKey' => 'exam_id',
			'associationForeignKey' => 'question_id',
			'unique' => 'keepExisting'
		)
	);

	public function beforeSave($options = array()) {
		foreach (array_keys($this->hasAndBelongsToMany) as $model) {
			if (isset($this->data[$this->name][$model])) {
				$this->data[$model][$model] = $this->data[$this->name][$model];
				unset($this->data[$this->name][$model]);
			}
		}
		return TRUE;
	}

}

<?php
class Question extends AppModel {
	const MAX_NUMBER_QUESTIONS = 5;
	
	public $name = 'Question';

	public $hasOne = array(
		'Answer' => array(
			'className' => 'Answer',
			'dependent' => true
		)
	);
	
	public $hasAndBelongsToMany = array(
		'Exam' => array(
			'joinTable' => 'questions_exams',
			'foreignKey' => 'question_id',
			'associationForeignKey' => 'exam_id',
			'unique' => 'keepExisting'
		)
	);
	
	public $validate = array(
		'content' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Enter question content'
			)
			
		),
		'category_id' => array(
			'rule' => 'naturalNumber'
		)
	);
}

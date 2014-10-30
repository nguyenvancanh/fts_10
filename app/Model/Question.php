<?php
class Question extends AppModel {
	public $name = 'Question';
	public $hasOne = array(
		'Answer' => array(
			'className' => 'Answer',
			'dependent' => true
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

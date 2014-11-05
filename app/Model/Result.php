<?php

class Result extends AppModel {
	
	public $name = 'Result';
	
	public $validate = array(
		'user_id' => array(
			'rule' => 'naturalNumber'
		),
		'exam_id' => array(
			'rule' => 'naturalNumber'
		),
		'question_id' => array(
			'rule' => 'naturalNumber'
		),
		'user_choose' => array(
			'rule' => 'naturalNumber'
		)
	);
}


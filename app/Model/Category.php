<?php
App::uses('AppModel', 'Model');

class Category extends AppModel {
	public $name = 'Category';

	public $validate = array(
		'name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Enter a English Word'
			)
		),
		'content' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Enter a Viet Nam word'
			)
		)
	);
}
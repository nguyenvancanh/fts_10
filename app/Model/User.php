<?php
App::uses('AppModel', 'Model');
class User extends AppModel {
	/**
	 * Validation rules
	 *
	 * @var array
	 */
	const MAX_FILE_SIZE = 20000;
	
	public $validate = array(
		'username' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Username required'
			)
		),
		'password' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Password is required'
			),
			'must_equal_validate' => array(
				'rule' => 'passwordEqualValidation',
				'message' => 'Password must be equal to password validation'
			)
		),
		'password_confirm' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Password is required'
			)
		),
		'new_password' => array(
			'rule' => 'notEmpty',
			'message' => 'Please enter new password!'
		),
		'confirm_password' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Please confirm new password!'
			),
			'isvalid' => array(
				'rule' => 'passwordMatch',
				'message' => 'Password confirm not match!'
			)
		),
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				'message' => 'Must be valid email'
			)
		),
		'fullname' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'fullename required'
			)
		)
	);

	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['password'])) {
			$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
		}
		return TRUE;
	}

	public function passwordEqualValidation($check) {
		return ($check['password'] == $this->data[$this->alias]['password_confirm']);
	}
	
	public function passwordMatch() {
		if ($this->data[$this->alias]['new_password'] == $this->data[$this->alias]['confirm_password']) {
			return true;
		}
		return false;
	}
	
	public function checkPass($id, $password) {
		if (!empty($id) && !empty($password)) {
			$data = $this->findById($id);
			if ($data['User']['password'] == AuthComponent::password($password)) {
				return true;
			} else {
				return false;
			}
		}
	}
}

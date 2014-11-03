<fieldset>
	<legend><h1><?php echo __('User Edit profile'); ?></h1></legend>
	<?php
		echo $this->Form->create('Post');
		echo $this->Form->input('User.id', array('type' => 'hidden'));
		echo $this->Form->input(
			'User.fullname', array(
				'id' => 'fullname',
				'label' => 'Full name',
				'size' => '50',
				'maxlength' => '255',
				'error' => FALSE
			)
		);
		echo $this->Form->input(
			'User.email', array(
				'id' => 'email',
				'label' => 'Email',
				'size' => '50',
				'maxlength' => '255',
				'error' => FALSE
			)
		);
		echo $this->Form->end(array('label' => 'submit'));
	?>
</fieldset>
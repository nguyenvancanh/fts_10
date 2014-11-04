<div class="users form">
	<h2><?php echo __('Change your password'); ?></h2>
	<p><?php echo __('Please enter your old password because of security reasons and then your new password twice.'); ?></p>
	<?php
		echo $this->Form->create(null,
			array(
				'type' => 'post',
				'novalidate' => 'novalidate'
			)
		);
		echo $this->Form->hidden('id',array('value'=>  $id));
		echo $this->Form->input(
			'old_password', 
			array(
				'label' => __('Old Password'),
				'type' => 'password'
			)
		);
		echo $this->Form->input(
			'new_password', 
			array(
				'label' => __('New Password'),
				'type' => 'password'
			)
		);
		echo $this->Form->input(
			'confirm_password', 
			array(
				'label' => __('Confirm'),
				'type' => 'password'
			)
		);
		echo $this->Form->end(__('Submit'));
	?>
</div>
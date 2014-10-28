<div class="users form">
	<?php echo $this->Form->create('User', array('class' => 'form-horizontal')); ?>
	<fieldset>
		<legend><?php echo __('Registration'); ?></legend>
		<?php
			echo $this->Form->input('username');
		?>
		<?php
			echo $this->Form->input('password_confirm', array('type' => 'password', 'label' => 'Password'));
			echo $this->Form->input('password', array('label' => 'Confirm password'));
			echo $this->Form->input('email');
			echo $this->Form->input('fullname');
		?>
		<div class="form-actions">
			<?php echo $this->Form->submit(__('Submit'), array('class' => 'btn-primary')); ?>
		</div>
	</fieldset>
	<?php echo $this->Form->end(); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Login'), array('controller' => 'users', 'action' => 'login')); ?></li>
	</ul>
</div>
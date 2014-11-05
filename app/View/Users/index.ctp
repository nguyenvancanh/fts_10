<div class="users form">
	<?php
	echo __("<h3>Thanks for use my systems</h3>");
	echo $this->Html->link(__('Start'), array('controller' => 'exams', 'action' => 'index'));
	?>
</div>
<div class="actions">
	<?php
	echo '<h3>Welcome ' . $user['fullname'] . '</h3>';
	if (empty($user['avatar'])):
		echo $this->Html->image('/files/avatar' . DS . 'blank.jpg', array('class' => 'avatar'));
	else:
		echo $this->Html->image('/files/avatar' . DS . $user['avatar'], array('class' => 'avatar'));
	endif;
	?>
	<div class="change-avatar">
		<?php
		echo $this->Form->create(null, array(
			'action' => 'change_avatar',
			'inputDefaults' => array(
				'label' => false
			),
			'role' => 'form',
			'type' => 'file'
		));
		echo $this->Form->file('avatar', array('type' => 'file'));
		echo $this->Form->end(__('Upload'));
		?>
	</div>
	<ul>
		<li>
			<?php
			echo $this->Html->link(
					'Edit profile', array(
				'controller' => 'users',
				'action' => 'edit'
					)
			);
			?>
		</li>
		<li>
			<?php
			echo $this->Html->link(
					'Change password', array(
				'controller' => 'users',
				'action' => 'change_password'
					)
			);
			?>
		</li>
		<li>
			<?php
			echo $this->Html->link(
					'Logout', array(
				'controller' => 'users',
				'action' => 'logout'
					)
			);
			?>
		</li>
	</ul>
</div>


<div class="users form">
	<div class="content">
		<h2> <?php echo __("List User"); ?> </h2>
		<?php
			if (isset($users) && is_array($users)):
		?>
		<table class="table table-hover">
			<tr>
				<td>
					<?php echo __("ID"); ?>
				</td>
				<td>
					<?php echo __("Username"); ?>
				</td>
				<td>
					<?php echo __("Fullname"); ?>
				</td>
				<td>
					<?php echo __("Email"); ?>
				</td>
				<td>
					<?php echo __("Modified"); ?>
				</td>
				<td colspan="2">
					<?php echo __("Action"); ?>
				</td>
			</tr>
			<?php
				if (!empty($users)):
					foreach ($users as $user): 
			?>
			<tr>
				<td>
					<?php echo $user['User']['id']; ?>
				</td>
				<td>
					<?php echo $user['User']['username']; ?>
				</td>
				<td>
					<?php echo $user['User']['fullname']; ?>
				</td>
				<td>
					<?php echo $user['User']['email']; ?>
				</td>
				<td>
					<?php echo $user['User']['modified']; ?>
				</td>
				<td>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user['User']['id']), null, __('Are you sure you want to delete # %s ?', $user['User']['id'])); ?>
				</td>
			</tr>
			<?php 
					endforeach;
				else :
					echo __("User not found");
				endif;
			?>
		</table>
		<?php	
			endif;
		?>
	</div>
	<?php echo $this->Paginator->numbers(); ?>
	<?php echo $this->Paginator->prev(__('« Previous |'), null, null, array('class' => 'disabled')); ?>
	<?php echo $this->Paginator->next(__('Next »'), null, null, array('class' => 'disabled')); ?>
	<?php echo $this->Paginator->counter(); ?>
</div>
<div class="actions">
	<h3>
		<?php echo __('Action'); ?>
	</h3>
	<ul>
		<li><?php echo $this->Html->link(__('Users'), array('controller' => 'users', 'action' => 'admin_index')); ?></li>
	</ul>
	<ul>
		<li><?php echo $this->Html->link(__('Logout'), array('controller' => 'users', 'action' => 'logout', 'admin'=>false)); ?></li>
	</ul>
</div>


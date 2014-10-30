<div class="users form">
	<div class="content">
		<h2> <?php echo __("List Question"); ?> </h2>
		<?php
			if (isset($questions)):
		?>
		<table class="table table-hover">
			<tr>
				<td>
					<?php echo __("Question ID"); ?>
				</td>
				<td>
					<?php echo __("Category ID"); ?>
				</td>
				<td>
					<?php echo __("Question Content"); ?>
				</td>
				<td>
					<?php echo __("Answer A"); ?>
				</td>
				<td>
					<?php echo __("Answer B"); ?>
				</td>
				<td>
					<?php echo __("Answer C"); ?>
				</td>
				<td colspan="2">
					<?php echo __("Action"); ?>
				</td>
			</tr>
			<?php
				foreach ($questions as $question):
			?>
			<tr>
				<td>
					<?php echo $question['Question']['id']; ?>
				</td>
				<td>
					<?php echo $question['Question']['category_id']; ?>
				</td>
				<td>
					<?php echo $question['Question']['content']; ?>
				</td>
				<td>
					<?php echo $question['Answer']['answer_a']; ?>
				</td>
				<td>
					<?php echo $question['Answer']['answer_b']; ?>
				</td>
				<td>
					<?php echo $question['Answer']['answer_c']; ?>
				</td>
				<td>
					<?php 
						echo $this->Form->postLink(
							__('Edit'), 
							array(
								'controller' => 'questions',
								'action' => 'admin_edit', $question['Question']['id']
							)
						); 
					?>
				</td>
				<td>
					<?php 
						echo $this->Form->postLink(
							__('Delete'), 
							array(
								'controller' => 'questions',
								'action' => 'admin_delete', $question['Question']['id']
							), 
							NULL, 
							__('Are you sure you want to delete # %s ?', $question['Question']['id'])
						); 
					?>
				</td>
			</tr>
			<?php
				endforeach;
			else:
				echo __("Questions not found");
			endif;
			?>
		</table>
	</div>
</div>
<div class="actions">
	<h3>
		<?php echo __('Action'); ?>
	</h3>
	<ul>
		<li><?php echo $this->Html->link(__('Users'), array('controller' => 'users', 'action' => 'admin_index')); ?></li>
	</ul>
	<ul>
		<li><?php echo $this->Html->link(__('Category'), array('controller' => 'categories', 'action' => 'admin_index')); ?></li>
	</ul>
	<ul>
		<li><?php echo $this->Html->link(__('New Questions'), array('controller' => 'questions', 'action' => 'admin_add')); ?></li>
	</ul>
	<ul>
		<li><?php echo $this->Html->link(__('Logout'), array('controller' => 'users', 'action' => 'logout', 'admin' => FALSE)); ?></li>
	</ul>
</div>


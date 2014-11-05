<div class="users form">
	<?php
		echo __('<h3>Select exams</h3>');
		echo $this->Form->create('Exam');
		echo $this->Form->input('category_id', array(
			'empty' => __('Choose one'),
			'label' => FALSE
		));
		echo $this->Form->end('Create');
	?>
	<div class="exams">
		<hr/>
		<?php if (isset($exams) && !empty($exams)): ?>
			<table class="table table-hover">
				<thead>
					<tr>
						<th><?php echo __('Name'); ?></th>
						<th><?php echo __('Questions'); ?></th>
						<th><?php echo __('Score'); ?></th>
						<th><?php echo __('Status'); ?></th>
						<th><?php echo __('Time'); ?></th>
						<th><?php echo __('Action'); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($exams as $exam): ?>
						<tr>
							<td><?php echo $categories[$exam['Exam']['category_id']]; ?></td>
							<td><?php echo $exam['Exam']['question_nums']; ?></td>
							<td>
								<?php
								if ($exam['Exam']['status'] == 3):
									echo "{$exam['Exam']['correct_nums']}/" . Question::MAX_NUMBER_QUESTIONS;
								else:
									echo "undefined";
								endif;
								?>
							</td>
							<td><?php echo $status[$exam['Exam']['status']]; ?></td>
							<td><?php echo $exam['Exam']['modified']; ?></td>
							<td>
								<?php
								switch ($exam['Exam']['status']):
									case 1:
										echo $this->Html->link(__('Start'), array(
											'controller' => 'exams',
											'action' => 'start', $exam['Exam']['id']), array(
											'class' => 'btn btn-primary'
										));
										break;
									case 2:
										echo $this->Html->link(__('View'), array(
											'controller' => 'exams',
											'action' => 'view', $exam['Exam']['id']), array(
											'class' => 'btn btn-info'
										));
										break;
									default :
										echo $this->Html->link(__('Finished'), array(), array(
											'class' => 'btn btn-success',
											'disabled' => TRUE
										));

										break;
								endswitch;
								?>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			
			<?php
		else:
			echo __('Please create an exam');
		endif;
		?>
	</div>
	<?php echo $this->element('pagination'); ?>
</div>
<div class="actions">
	<?php echo __('<h3>Actions</h3>'); ?>
	<ul>
		<li>
			<?php echo $this->Html->link(__('Back'), array('controller' => 'users', 'action' => 'index')); ?>
		</li>
	</ul>
	<ul>
		<li>
			<?php echo $this->Html->link(__('Logout'), array('controller' => 'users', 'action' => 'logout')); ?>
		</li>
	</ul>
</div>

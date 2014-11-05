<div class="users form">
	<?php
	if (isset($exam_questions) && !empty($exam_questions)):
		$count = 0;
		echo $this->Form->create('Exam',array( 'role' => 'form', 'action' => 'check'));
		echo $this->Form->hidden('ExamInfo.id', array('value' => $exam['id']));
		foreach ($exam_questions as $exam_question):
			$count++;
			echo '<h4>' . $count . '.' . $exam_question['content'] . '</h4>';
			echo '<section>';
			echo $this->Form->input("{$exam_question['id']}.answer", array(
				'type' => 'radio',
				'separator' => '<br/>',
				'legend' => false,
				'div' => false,
				'options' => array(
					1 => $exam_question['Answer']['answer_a'],
					2 => $exam_question['Answer']['answer_b'],
					3 => $exam_question['Answer']['answer_c']
				),
			));
			echo '</section><hr/>';
		endforeach;
		echo $this->Form->end('Submit');
	else:
		echo __('<h2>Questions not found</h2>');
	endif;
	?>
</div>
<div class="actions">
	<h3>
		<?php echo __('Action'); ?>
	</h3>
	<ul>
		<li><?php echo $this->Html->link(__('Back'), array('controller' => 'exams', 'action' => 'index')); ?></li>
	</ul>
	<ul>
		<li><?php echo $this->Html->link(__('Logout'), array('controller' => 'users', 'action' => 'logout')); ?></li>
	</ul>
</div>
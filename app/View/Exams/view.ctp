<div class="users form">
	<?php
	if (isset($exam_questions) && !empty($exam_questions)):
		$count = 0;
		echo '<span class="text-success">' . __("Correct {$exam['correct_nums'] }/") . Question::MAX_NUMBER_QUESTIONS . '</span><br/>';
		foreach ($exam_questions as $exam_question):
			$count++;
			echo '<h4>' . $count . '.' . $exam_question['content'] . '</h4>';
			echo '<div>';
			if ($userChoose[$exam_question['id']] == $exam_question['Answer']['answer_correct']):
				echo '<span class="text-success">' . __('Answer correct') . '</span><br/>';
			else:
				echo '<span class="text-danger">' . __('Answer wrong') . '</span><br/>';
			endif;
			echo $this->Form->input("{$exam_question['id']}.answer", array(
				'type' => 'radio',
				'separator' => '<br/>',
				'legend' => false,
				'div' => false,
				'disabled' => true,
				'value' => $userChoose[$exam_question['id']],
				'options' => array(
					1 => $exam_question['Answer']['answer_a'],
					2 => $exam_question['Answer']['answer_b'],
					3 => $exam_question['Answer']['answer_c']
				),
			));
			echo '</div><hr/>';
		endforeach;
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
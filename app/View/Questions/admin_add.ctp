<div class="users form">
	<?php
	echo $this->Form->create('Post');
	echo "<h2>Choose a Category</h2>";
	echo $this->Form->input('category_id', array(
		'empty' => __('choose one'),
		'label' => FALSE
	));
	echo __("<h4>Enter question content</h4>");
	echo $this->Form->input('Question.content', array('label' => FALSE));
	echo $this->Form->input('Answer.answer_a');
	echo $this->Form->input('Answer.answer_b');
	echo $this->Form->input('Answer.answer_c');
	echo $this->Form->input('AnswerCorrect', array(
		'div' => TRUE,
		'label' => TRUE,
		'lagend' => FALSE,
		'type' => 'radio',
		'options' => array(1 => __('Answer A'), 2 => __('Answer B'), 3 => __('Answer C') )
	));
	echo $this->Form->end('Submit');
	?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Question'), array('controller' => 'questions', 'action' => 'admin_index')); ?></li>
	</ul>
</div>


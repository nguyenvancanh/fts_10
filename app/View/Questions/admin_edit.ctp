<fieldset>
	<legend><h1><?php echo __('Edit a Category'); ?></h1></legend>
	<?php
		echo $this->Form->create('Post');
		echo $this->Form->input('Question.id', array('type' => 'hidden'));
		echo $this->Form->input('Answer.id', array('type' => 'hidden'));
		echo $this->Form->input(
			'Question.category_id', array(
				'id' => 'name',
				'label' => 'Category Id',
				'type' => 'text'
			)
		);
		echo $this->Form->input(
			'Question.content', array(
				'id' => 'name',
				'label' => 'Question',
				'size' => '50',
				'maxlength' => '255',
				'error' => FALSE
			)
		);
		echo $this->Form->input(
			'Answer.answer_a', array(
				'id' => 'content',
				'label' => 'answer a',
				'size' => '20',
				'maxlength' => '55',
				'error' => FALSE
			)
		);
		echo $this->Form->input(
			'Answer.answer_b', array(
				'id' => 'content',
				'label' => 'answer b',
				'size' => '50',
				'maxlength' => '255',
				'error' => FALSE
			)
		);
		echo $this->Form->input(
			'Answer.answer_c', array(
				'id' => 'content',
				'label' => 'answer c',
				'size' => '50',
				'maxlength' => '255',
				'error' => FALSE
			)
		);
		echo $this->Form->input(
			'Answer.answer_correct', array(
				'id' => 'content',
				'label' => 'answer correct',
				'size' => '50',
				'maxlength' => '255',
				'error' => FALSE
			)
		);
		echo $this->Form->end(array('label' => 'submit'));
	?>
</fieldset>


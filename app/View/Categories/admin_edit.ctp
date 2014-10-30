<fieldset>
	<legend><h1><?php echo __('Edit a Category'); ?></h1></legend>
	<?php
		echo $this->Form->create('Post');
		echo $this->Form->input('Category.id', array('type' => 'hidden'));
		echo $this->Form->input(
			'Category.name', array(
				'id' => 'name',
				'label' => 'Category name',
				'size' => '50',
				'maxlength' => '255',
				'error' => FALSE
			)
		);
		echo $this->Form->input(
			'Category.content', array(
				'id' => 'content',
				'label' => 'Category content',
				'size' => '50',
				'maxlength' => '255',
				'error' => FALSE
			)
		);
		echo $this->Form->end(array('label' => 'submit'));
	?>
</fieldset>
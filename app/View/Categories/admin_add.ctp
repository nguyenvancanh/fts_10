<div class="users form">
	<?php echo $this->Form->create('Category', array('class' => 'form-horizontal')); ?>
	<fieldset>
		<legend><?php echo __('Add new Category'); ?></legend>
		<?php
			echo $this->Form->input('name');
			echo $this->Form->input('content');
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
		<li><?php echo $this->Html->link(__('List Category'), array('controller' => 'categories', 'action' => 'admin_index')); ?></li>
	</ul>
</div>
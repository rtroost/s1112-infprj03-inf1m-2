<?php $this->load->view('includes/header') ?>
<div id="content">
	<?php if(isset($error)) echo $error; ?>
	<?php $this -> form_validation -> set_error_delimiters('<li">', '</li>');
	echo validation_errors(' <div class="error"> ', ' </div> ');
	?>
	<?php $required = ' <span class="required">*</span>';?>
	<?php
	$attributes = array('class' => 'singleForm');
	echo form_open('', $attributes);
	echo form_hidden('redirect', $this -> input -> get('redirect'));
	?>
	<p>
		<?php echo form_label('E-mail' . $required, 'email');?>
		<?php echo form_input(array('name' => 'email', 'id' => 'email', 'placeholder' => 'username@provider.countrycode', 'maxlength' => '100', 'value' => set_value('email')));?>
	</p>
	<p>
		<?php echo form_label('Wachtwoord' . $required, 'password');?>
		<?php echo form_password(array('name' => 'password', 'id' => 'password'));?>
	</p>
	<p>
		<?php echo form_submit(array('value' => 'Aanmelden', 'class' => 'margRight'));?>
	</p>
	<?php echo form_close();?>
</div>

<?php $this->load->view('includes/footer') ?>
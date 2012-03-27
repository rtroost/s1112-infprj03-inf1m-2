<?php $this->load->view('includes/header') ?>

<style type="text/css">
	/*
	 * Form
	 */
	form.singleForm {
		font: normal 13px Arial, Helvetica, sans-serif;
		line-height: 2em;
	}
	form.singleForm p {
		padding: 5px;
	}
	form.singleForm label {
		width: 200px;
		float: left;
	}
	form.singleForm input[type="text"], form.singleForm input[type="password"] {
		font: normal 13px Arial, Helvetica, sans-serif; ;
		padding: 4px;
	}
	form.singleForm .margRight {
		margin-left: 200px;
	}
	form.singleForm input[type="submit"] {
		border: 1px solid #39adf0;
		background: #6ac7fc;
		color: white;
		font: bold 13px Arial, Helvetica, sans-serif;
		text-transform: uppercase;
		text-shadow: 1px 1px 0 #7a7a7a;
		padding: 6px;
		cursor: pointer;
		width: 145px;
	}
	form.singleForm input[type="submit"]:hover {
		background: #70d2fd;
	}
</style>
<div id="content"> 
	<?php echo 'Deze e-mail/wachtwoord combinatie is niet gevonden.'; ?>
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
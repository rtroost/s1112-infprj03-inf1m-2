<?php $this->load->view('includes/header') ?>
<div id="content">
	<?php $this -> form_validation -> set_error_delimiters('<li">', '</li>');
	echo validation_errors(' <div class="error"> ', ' </div> ');
	?>
	<?php
	$attributes = array('id' => 'login_form', 'class' => 'login_form');
	echo form_open('', $attributes);
	echo form_hidden('redirect', $this -> input -> get('redirect'));
	?>
	<p>
	<label for="username" >Email adres:</label>
	<input name="username" id="username" type="text" value="<?php echo set_value('username');?>" />
	</p>
	<p>
	<label for="password" >Wachtwoord:</label>
	<input name="password" id="password" type="password" />
	</p>
	<p>
	<?php echo form_submit(array('value' => 'Aanmelden'));?>
	</p>
	<?php echo form_close();?>
</div>

<?php $this->load->view('includes/footer') ?>

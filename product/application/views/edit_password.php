<?php $this -> load -> view('includes/header');?>
<div id="content">
	<h2>Wachtwoord wijzigen</h2><br />
	<div style="float:right;">
		<?php
		$this -> form_validation -> set_error_delimiters('<li">', '</li>');
		echo validation_errors(' <div class="error"> ', ' </div> ');
		?>
	</div>
	<?php $attributes = array('class' => 'singleForm');?>
	<?php echo form_open('', $attributes);?>
	<?php $required = ' <span class="required">*</span>';?>
	<p>
		<?php echo form_label('Huidig wachtwoord' . $required, 'wwoud');?>
		<?php echo form_input(array('name' => 'wwoud', 'id' => 'wwoud'));?>
	</p>
	<p>
		<?php echo form_label('Nieuw wachtwoord' . $required, 'wwnieuw');?>
		<?php echo form_input(array('name' => 'wwnieuw', 'id' => 'wwnieuw'));?>
	</p>
		<p>
		<?php echo form_label('Huidig wachtwoord (Herhalen)' . $required, 'wwnieuw2');?>
		<?php echo form_input(array('name' => 'wwnieuw2', 'id' => 'wwnieuw2'));?>
	</p>
	<p>
		<?php echo form_submit(array('value' => 'Opslaan', 'class' => 'margRight'));?>
	</p>
	<?php echo form_close();?>
	</div>
<?php $this -> load -> view('includes/footer');?>
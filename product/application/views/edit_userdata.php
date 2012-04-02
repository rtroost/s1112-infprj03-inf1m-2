<?php $this -> load -> view('includes/header');?>
<div id="content">
	<h2>Mijn gegevens</h2>
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
		<?php echo form_label('Voornaam' . $required, 'voornaam');?>
		<?php echo form_input(array('name' => 'voornaam', 'id' => 'voornaam', 'placeholder' => 'John', 'maxlength' => '20', 'value' => $voornaam));?>
		</p>
		<p>
		<?php echo form_label('Achternaam' . $required, 'achternaam');?>
		<?php echo form_input(array('name' => 'achternaam', 'id' => 'achternaam', 'placeholder' => 'Do', 'maxlength' => '50', 'value' => $achternaam));?>
		</p>
		<p>
		<?php echo form_label('Adresregel 1' . $required, 'adresregel_1');?>
		<?php echo form_input(array('name' => 'adresregel_1', 'id' => 'adresregel_1', 'placeholder' => 'Straatnaam 00', 'maxlength' => '50', 'value' => $adresregel_1));?>
		</p>
		<p>
		<?php echo form_label('Adresregel 2', 'adresregel_2');?>
		<?php echo form_input(array('name' => 'adresregel_2', 'id' => 'adresregel_2', 'placeholder' => 'Straatnaam 00', 'maxlength' => '50', 'value' => $adresregel_2));?>
		</p>
		<p>
		<?php echo form_label('Postcode' . $required, 'postcode');?>
		<?php echo form_input(array('name' => 'postcode', 'id' => 'postcode', 'placeholder' => '1234AB', 'maxlength' => '6', 'value' => $postcode));?>
		</p>
		<p>
		<?php echo form_label('Woonplaats' . $required, 'woonplaats');?>
		<?php echo form_input(array('name' => 'woonplaats', 'id' => 'woonplaats', 'placeholder' => 'Utrecht', 'maxlength' => '50', 'value' => $woonplaats));?>
		</p>
		<p>
		<?php echo form_label('Telefoonnummer' . $required, 'telefoonnummer');?>
		<?php echo form_input(array('name' => 'telefoonnummer', 'id' => 'telefoonnummer', 'placeholder' => '0101234567', 'maxlength' => '10', 'value' => $telefoonnummer));?>
		</p>
		<p>
		<?php echo form_label('E-mail' . $required, 'email');?>
		<?php echo form_input(array('name' => 'email', 'id' => 'email', 'placeholder' => 'username@provider.countrycode', 'maxlength' => '100', 'value' => $email));?>
		</p>
		<?php if(isset($order) && $order == TRUE) { ?>
		<p>
		<?php echo form_label('Betaalmethode' . $required, 'payment_method');?>
		<?php $payment_method_options = array('' => '-- Maak een keuze --', 'ideal' => 'iDEAL', 'contant' => 'Contant');?>
		<?php echo form_dropdown('payment-method', $payment_method_options, set_value('payment-method'));?>
		</p>
		<p>
		<?php echo form_label('Afleveren/Ophalen' . $required, 'bestelmethode');?>
		<?php $options = array('' => '-- Maak een keuze --', '1' => 'Afhalen na 30 minuten', '2' => 'Bezorging binnen 1 uur');?>
		<?php echo form_dropdown('bestelmethode', $options, set_value('bestelmethode'));?>
		</p>
		<?php }?>
		<p>
		<?php echo form_submit(array('value' => 'Verder', 'class' => 'margRight'));?>
		</p>
		<?php echo form_close();?>
		<?php if(isset($change_password) && $change_password == TRUE) { ?>
		<br />
		<h2>Wachtwoord wijzigen</h2><br />
		<div style="float:right;">
		<?php
		$this -> form_validation -> set_error_delimiters('<li">', '</li>');
		echo validation_errors(' <div class="error"> ', ' </div> ');
		?>
	</div>	
	<?php $attributes = array('class' => 'singleForm');?>
	<?php echo form_open('user/edit_password', $attributes);?>
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
	<?php }?>
</div>
	
	
<?php $this -> load -> view('includes/footer');?>
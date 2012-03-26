<?php $this -> load -> view('includes/header');?>
<style type="text/css" media="screen">
	/*
	 * Messages
	 */
	.info, .success, .warning, .error, .validation {
		font-size: 11px;
		border: 1px solid;
		margin: 10px 0px;
		padding: 5px 5px 5px 40px;
		background-size: 20px;
		background-repeat: no-repeat;
		background-position: 10px center;
		/*		display: block;*/
		width: 250px;
	}
	.info {
		color: #00529B;
		background-color: #BDE5F8;
		background-image: url('../images/icons/info.png');
	}
	.success {
		color: #4F8A10;
		background-color: #DFF2BF;
		background-image: url('../images/icons/success.png');
	}
	.warning {
		color: #9F6000;
		background-color: #FEEFB3;
		background-image: url('../images/icons/warning.png');
	}
	.error {
		color: #D8000C;
		background-color: #FFBABA;
		background-image: url('../images/icons/error.png');
	}
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
	<?php if($this -> cart -> total_items() == 0) {
	?>
	<p>
		Uw winkelwagen is leeg.
	</p>
	<?php } else {?>
	<div style="float:right;">
		<?php
		$this -> form_validation -> set_error_delimiters('<li">', '</li>');
		echo validation_errors(' <div class="error"> ', ' </div> ');
		?>
		</div>
		<?php
		$attributes = array('class' => 'singleForm');
		echo form_open('', $attributes);
		?>
		<?php $required = ' <span class="required">*</span>';?>
			<?php echo form_open('', array('class' => 'registreerform'));?>
	<p>
		<?php echo form_label('Voorletters' . $required, 'voorletters');?>
		<?php echo form_input(array('name' => 'voorletters', 'id' => 'voorletters', 'placeholder' => 'A.B.F.', 'maxlength' => '20', 'value' => $voornaam));?>
	</p>
	<p>
		<?php echo form_label('Achternaam' . $required, 'achternaam');?>
		<?php echo form_input(array('name' => 'achternaam', 'id' => 'achternaam', 'placeholder' => '', 'maxlength' => '50', 'value' => $achternaam));?>
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
	<p>
		<?php echo form_label('Betaalmethode' . $required, 'payment_method');?>
		<?php $options = array('' => '-- Maak een keuze --', 'paypal' => 'Paypal', 'ideal' => 'iDEAL', 'gwallet' => 'Google Wallet', 'creditcard' => 'Creditcard', 'contant' => 'Contant');?>
		<?php echo form_dropdown('payment-method', $options, set_value('payment-method'));?>
	</p>
	<p>
		<?php echo form_label('Afleveren/Ophalen' . $required, 'bestelmethode');?>
		<?php $options = array('' => '-- Maak een keuze --', '1' => 'Afhalen na 30 minuten', '2' => 'Bezorging binnen 1 uur');?>
		<?php echo form_dropdown('bestelmethode', $options, set_value('bestelmethode'));?>
	</p>
	<p>
		<?php echo form_submit(array('value' => 'Verder', 'class' => 'margRight'));?>
	</p>
	<?php echo form_close();?>

	<?php }?>
	</div>
<?php $this -> load -> view('includes/footer');?>
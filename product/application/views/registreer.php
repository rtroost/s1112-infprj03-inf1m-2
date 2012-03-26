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
	 * Order-form.php
	 */
	form.registreerform {
		font: normal 13px Arial, Helvetica, sans-serif;
		line-height: 2em;
	}
	form.registreerform p {
		padding: 5px;
	}
	form.registreerform label {
		width: 200px;
		float: left;
	}
	form.registreerform input[type="text"], select {
		font: normal 13px Arial, Helvetica, sans-serif; ;
		padding: 4px;
	}
	form.registreerform input[type="password"], select {
		font: normal 13px Arial, Helvetica, sans-serif; ;
		padding: 4px;
	}
	form.registreerform .margRight {
		margin-left: 200px;
	}
	form.registreerform input[type="submit"] {
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
	form.registreerform input[type="submit"]:hover {
		background: #70d2fd;
	}

</style>

<div id="content">
	<h1>Registratie</h1>
	<p>
		Vul de gegevens zo volledig mogelijk in
	</p>
	<?php echo form_open('', array('class' => 'registreerform'));?>
	<p>
		<?php echo form_label('Voornaam', 'voornaam');?>
		<?php echo form_input(array('name' => 'voornaam', 'id' => 'voornaam', 'value' => set_value('voornaam')));?>
	</p>
	<p>
		<?php echo form_label('Achternaam', 'achternaam');?>
		<?php echo form_input(array('name' => 'achternaam', 'id' => 'achternaam', 'value' => set_value('achternaam')));?>
	</p>
	<p>
		<?php echo form_label('E-mail', 'email');?>
		<?php echo form_input(array('name' => 'email', 'id' => 'email', 'value' => set_value('email')));?>
	</p>
	<p>
		<?php echo form_label('Wachtwoord', 'wachtwoord');?>
		<?php echo form_input(array('name' => 'wachtwoord', 'id' => 'wachtwoord', 'value' => ''));?>
	</p>
	<p>
		<?php echo form_label('Herhaal wachtwoord', 'wachtwoord2');?>
		<?php echo form_password(array('name' => 'wachtwoord2', 'id' => 'wachtwoord2', 'value' => ''));?>
	</p>
	<p>
		<?php echo form_label('Adresregel 1', 'adresregel_1');?>
		<?php echo form_password(array('name' => 'adresregel_1', 'id' => 'adresregel_1', 'value' => set_value('adresregel_1')));?>
	</p>
	<p>
		<?php echo form_label('Adresregel 2', 'adresregel_2');?>
		<?php echo form_input(array('name' => 'adresregel_2', 'id' => 'adresregel_2', 'value' => set_value('adresregel_2')));?>
	</p>
	<p>
		<?php echo form_label('Postcode', 'postcode');?>
		<?php echo form_input(array('name' => 'postcode', 'id' => 'postcode', 'value' => set_value('postcode')));?>
	</p>
	<p>
		<?php echo form_label('Woonplaats', 'woonplaats');?>
		<?php echo form_input(array('name' => 'woonplaats', 'id' => 'woonplaats', 'value' => set_value('woonplaats')));?>
	</p>
	<p>
		<?php echo form_label('Telefoonnummer', 'telefoonnummer');?>
		<?php echo form_input(array('name' => 'telefoonnummer', 'id' => 'telefoonnummer', 'value' => set_value('telefoonnummer')));?>
	</p>
	<p>
		<?php echo form_submit('registreer_submit', 'Registreer');?>
	</p>
	<?php echo form_close();?>
</div>
<?php $this -> load -> view('includes/footer');?>
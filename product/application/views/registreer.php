<html>
<head>
</head>
<title> Registratie Formulier </title>
<body>

<h1>Registratie</h1>

<p>Vul de gegevens zo volledig mogelijk in</p>

<?php

echo form_open($base_url . 'index.php/registreer_cont/opslaan');

	$voornaam = array(
		'name' 	=> 	'reg_voornaam',
		'id'	=>	'reg_voornaam',
		'value'	=>	set_value('reg_voornaam')
		
	);
	
	$achternaam = array(
		'name' 	=> 	'reg_achternaam',
		'id'	=>	'reg_achternaam',
		'value'	=>	set_value('reg_achternaam')
		
	);
	$email = array(
		'name' 	=> 	'reg_email',
		'id'	=>	'reg_email',
		'value'	=>	set_value('reg_email')
		
	);
	$wachtwoord1 = array(
		'name' 	=> 	'reg_wachtwoord1',
		'id'	=>	'reg_wachtwoord1',
		'value'	=>	''
		
	);
	$wachtwoord2 = array(
		'name' 	=> 	'reg_wachtwoord2',
		'id'	=>	'reg_wachtwoord2',
		'value'	=>	''
		
	);
	$adres = array(
		'name' 	=> 	'reg_adres',
		'id'	=>	'reg_adres',
		'value'	=>	set_value('reg_adres')
		
	);
	
	$postcode = array(
		'name' 	=> 	'reg_postcode',
		'id'	=>	'reg_postcode',
		'value'	=>	set_value('reg_postcode')
		
	);
	
	$woonplaats = array(
		'name' 	=> 	'reg_woonplaats',
		'id'	=>	'reg_woonplaats',
		'value'	=>	set_value('reg_woonplaats')
		
	);
	
	$telefoonnummer = array(
		'name' 	=> 	'reg_telefoonnummer',
		'id'	=>	'reg_telefoonnummer',
		'value'	=>	set_value('reg_telefoonnummer')
		
	);
	
?> 

<ul>
	
	<label>Voornaam</label>
	<div>
		<?php echo form_input($voornaam); ?>
	</div>
	

	
	<label>Achternaam</label>
	<div>
		<?php echo form_input($achternaam); ?>
	</div>
	

	
	<label>E-mail</label>
	<div>
		<?php echo form_input($email); ?>
	</div>
	
	
	
	<label>Wachtwoord</label>
	<div>
		<?php echo form_password($wachtwoord1); ?>
	</div>
	
	
	
	<label>Controle wachtwoord</label>
	<div>
		<?php echo form_password($wachtwoord2); ?>
	</div>
	
	
	
	<label>Adres + huisnummer</label>
	<div>
		<?php echo form_input($adres); ?>
	</div>
	
	<label>Postcode</label>
	<div>
		<?php echo form_input($postcode); ?>
	</div>
	
	<label>Woonplaats</label>
	<div>
		<?php echo form_input($woonplaats); ?>
	</div>
	
	
	
	<label>Telefoonnummer</label>
	<div>
		<?php echo form_input($telefoonnummer); ?>
	</div>
	
	
	
	<div>
		<?php echo form_submit (array('name' => 'register'),'Register')?>
	</div>
	
	
	
	<div>
	<?php echo validation_errors(); ?>
	</div>
	
	
</ul>
<?php echo form_close(); ?>



</body>
</html>
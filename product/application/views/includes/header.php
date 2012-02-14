<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="UTF-8" />
<title>De huisbakker, de bakker die bezorgt</title>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css" type="text/css" />
</head>

<body>
<div id="site-wrapper">

	<div class="container">
		<div id="boven">
			<div id="inlog">
				<div id="inlogText">Gebruikersnaam:</div>
				<input id="inlogInput" name="username" type="text">
				<div id="inlogText">Wachtwoord:</div>
				<input id="inlogInput" name="wachtwoord" type="text">
				<input id="onthouInput" name="remember" type="checkbox">
				<div id="onthouText">&nbsp;&nbsp;Onthoud mij</div>
				<div id="inlogSubmit"><input id="aanmeldInput" name="aanmeldenSubmit" value="Aanmelden" type="submit"></div>
			</div>
			
			<div id="menu">
				<div id="menuItem"><a href="<?php echo base_url(); ?>index.php"><img onmouseover="this.src='<?php echo base_url(); ?>images/img_button_home_over.png' " onmouseout="this.src='<?php echo base_url(); ?>images/img_button_home_over.png'" src="<?php echo base_url(); ?>images/img_button_home_over.png"></img></a></div>
				<div id="menuItem"><a href="<?php echo base_url(); ?>index.php/bestellen_cont"><img onmouseover="this.src='<?php echo base_url(); ?>images/img_button_bestellen_over.png' " onmouseout="this.src='<?php echo base_url(); ?>images/img_button_bestellen.png'" src="<?php echo base_url(); ?>images/img_button_bestellen.png"></img></a></div>
				<div id="menuItem"><a href="<?php echo base_url(); ?>index.php/overons_cont"><img onmouseover="this.src='<?php echo base_url(); ?>images/img_button_overons_over.png' " onmouseout="this.src='<?php echo base_url(); ?>images/img_button_overons.png'" src="<?php echo base_url(); ?>images/img_button_overons.png"></img></a></div>
				<div id="menuItem"><a href="<?php echo base_url(); ?>index.php/contact_cont"><img onmouseover="this.src='<?php echo base_url(); ?>images/img_button_contact_over.png' " onmouseout="this.src='<?php echo base_url(); ?>images/img_button_contact.png'" src="<?php echo base_url(); ?>images/img_button_contact.png"></img></a></div>
			</div>
			
			
		</div>
    </div>
	
	<div class="container">
		<div id="content">
			<div id="contenttext">
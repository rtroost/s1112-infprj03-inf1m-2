<!DOCTYPE html>
<html lang="nl-nl">
	<head>
		<meta charset="UTF-8" />
		<title>Pizzario</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript" charset="utf-8"></script>
		<link rel="stylesheet" href="<?php echo base_url();?>css/style.css" type="text/css" />
	</head>
	<body>
		<div id="wrapper">
			<header>
				<div id="inlog">
					<form>
						<label for="username" >Gebruikersnaam:</label>
						<input class="right_input" name="username" type="text" />
						<label for="wachtwoord" >Wachtwoord:</label>
						<input class="right_input" name="wachtwoord" type="password" />
						<input class="remember_me" name="remember" type="checkbox" />
						<label class="remember_me_text" for="remember">Onthoud mij</label>
						<input class="aanmeldInput" name="aanmeldenSubmit" value="Aanmelden" type="submit" />
					</form>
				</div>
			
				<nav>
					<ul id="header_nav">
						<li>
							<a href="<?php echo base_url();?>index.php"><img onmouseover="this.src='<?php echo base_url();?>images/img_button_home_over.png' " onmouseout="this.src='<?php echo base_url();?>images/img_button_home_over.png'" src="<?php echo base_url();?>images/img_button_home_over.png"></img></a>
						</li>
						<li>
							<a href="<?php echo base_url();?>index.php/bestellen_cont"><img onmouseover="this.src='<?php echo base_url();?>images/img_button_bestellen_over.png' " onmouseout="this.src='<?php echo base_url();?>images/img_button_bestellen.png'" src="<?php echo base_url();?>images/img_button_bestellen.png"></img></a>
						</li>
						<li>
							<a href="<?php echo base_url();?>index.php/overons_cont"><img onmouseover="this.src='<?php echo base_url();?>images/img_button_overons_over.png' " onmouseout="this.src='<?php echo base_url();?>images/img_button_overons.png'" src="<?php echo base_url();?>images/img_button_overons.png"></img></a>
						</li>
						<li>
							<a href="<?php echo base_url();?>index.php/contact_cont"><img onmouseover="this.src='<?php echo base_url();?>images/img_button_contact_over.png' " onmouseout="this.src='<?php echo base_url();?>images/img_button_contact.png'" src="<?php echo base_url();?>images/img_button_contact.png"></img></a>
						</li>
					</ul>
				</nav>
				
				<div id="search">
					<form id="searchform" action="<?php echo base_url();?>index.php/search_cont">
						<label for="search">Zoeken</label>
						<input class="zoeken" name="search" type="text" />		
						<img src="<?php echo base_url();?>images/glas.png" onclick="document.forms['searchform'].submit();" />
					</form>
				</div>
			</header>
			<section id="main_content">

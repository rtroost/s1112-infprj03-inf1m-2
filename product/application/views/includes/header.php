<?php $this->load->library('session'); ?>

<!DOCTYPE html>
<html lang="nl-nl">
	<head>
		<meta charset="UTF-8" />
		<title>Pizzario</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="<?php echo base_url();?>js/script.js" type="text/javascript" charset="utf-8"></script>
		<script src="<?php echo base_url();?>js/tooltip.js" type="text/javascript" charset="utf-8"></script>
		<link rel="stylesheet" href="<?php echo base_url();?>css/style.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo base_url();?>css/tooltip.css" type="text/css" />
	</head>
	<body>
		<div id="wrapper">
			<header>
				
					<div id="inlog_false" class="inlog" style="<?php if($this->session->userdata('logged_in') == 1){ echo "display:none;"; } ?>" >
						<form action="<?php echo base_url();?>index.php/login" method="post">
							<label for="username" >Email adres:</label>
							<input class="right_input" name="username" id="username" type="text" />
							<label for="password" >Wachtwoord:</label>
							<input class="right_input" name="password" id="password" type="password" />
							<input class="remember_me" name="remember" id="remember_me" type="checkbox" />
							<label class="remember_me_text" for="remember_me">Onthoud mij</label>
							<input class="aanmeldInput" name="aanmeldenSubmit" id="remember_me_text" value="Aanmelden" type="submit" />
						</form>
					</div>
					<div id="inlog_true" class="inlog" style="<?php if($this->session->userdata('logged_in') != 1){ echo "display:none;"; } ?>" >
						<form action="<?php echo base_url();?>index.php/login/logout" method="post">
							<input type="submit" id="logout" value="Logout"/>
						</form>
						<a href="<?php echo base_url();?>index.php/mijnprofiel_cont">Mijn profiel</a>
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
							<a href="<?php echo base_url();?>index.php/contact_cont"><img onmouseover="this.src='<?php echo base_url();?>images/img_button_contact_over.png' " onmouseout="this.src='<?php echo base_url();?>images/img_button_contact.png'" src="<?php echo base_url();?>images/img_button_contact.png"></img></a>
						</li>
						<li>
							<a href="<?php echo base_url();?>index.php/account_cont"><img onmouseover="this.src='<?php echo base_url();?>images/beheer_over.png' " onmouseout="this.src='<?php echo base_url();?>images/beheer.png'" src="<?php echo base_url();?>images/beheer.png"></img></a>
						</li>
						<li>
							<a href="<?php echo base_url();?>index.php/product_cont/creator">Product Creator</a>
						</li>
						<li>
							<a href="<?php echo base_url();?>index.php/cart">Winkelwagen</a>
						</li>
						<li>
							<a href="<?php echo base_url();?>index.php/beheer_gebruikers_cont">Gebruikers beheer</a>
						</li>
						<li>
							<a href="<?php echo base_url();?>index.php/registreer_cont">Registreer</a>
						</li>
					</ul>
				</nav>
				
				<div id="search" style="margin-top: -10px;">
					<form id="searchform" action="<?php echo base_url();?>index.php/search_cont">
						<label for="search">Zoeken</label>
						<input class="zoeken" name="search" type="text" />		
						<img src="<?php echo base_url();?>images/glas.png" style="cursor: pointer;" onclick="document.forms['searchform'].submit();" />
					</form>
				</div>
			</header>
			<section id="main_content">
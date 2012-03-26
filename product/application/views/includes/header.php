<?php $this->load->library('session'); ?>

<!DOCTYPE html>
<html lang="nl-nl">
<head>
	<meta charset="UTF-8" />
	<title>Pizzario</title>
	<script src="<?php echo base_url();?>js/jquery-1.7.1.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="<?php echo base_url();?>js/script.js" type="text/javascript" charset="utf-8"></script>
	<script src="<?php echo base_url();?>js/tooltip.js" type="text/javascript" charset="utf-8"></script>
	<link rel="stylesheet" href="<?php echo base_url();?>css/style.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url();?>css/tooltip.css" type="text/css" />
</head>
<body>
	<div id="wrapper">
		<header>
			<?php if($this->session->userdata('logged_in') == FALSE) { ?>
			<div id="inlog_false" class="inlog">
				<?php echo form_open('user/login'); ?>
				<label for="email" >Email adres:</label>
				<input class="right_input" name="email" id="email" type="text" />
				<label for="password" >Wachtwoord:</label>
				<input class="right_input" name="password" id="password" type="password" />
				<input class="remember_me" name="remember" id="remember_me" type="checkbox" />
				<label class="remember_me_text" for="remember_me">Onthoud mij</label>
				<input class="aanmeldInput" name="aanmeldenSubmit" id="remember_me_text" value="Aanmelden" type="submit" />
				<?php echo form_close(); ?>
			</div>
			<?php } else { ?>
			<div id="inlog_true" class="inlog">
				<?php echo anchor('user/logout', 'Logout'); ?>
			</div>
			<?php } ?>
			<nav>
				<ul id="header_nav">
					<li>
						<a href="<?php echo base_url();?>index.php"><img onmouseover="this.src='<?php echo base_url();?>images/img_button_home_over.png' " onmouseout="this.src='<?php $pos = strlen($_SERVER['REQUEST_URI']); if($pos == 19) { echo base_url()."images/img_button_home_over.png";} else{ echo base_url()."images/img_button_home.png";} ?>'" src="<?php $pos = strlen($_SERVER['REQUEST_URI']); if($pos == 19) { echo base_url()."images/img_button_home_over.png";} else{ echo base_url()."images/img_button_home.png";} ?>"></img></a>
					</li>
					<li>
						<a href="<?php echo base_url();?>index.php/bestellen_cont"><img onmouseover="this.src='<?php echo base_url();?>images/img_button_bestellen_over.png' " onmouseout="this.src='<?php $pos = strpos($_SERVER['REQUEST_URI'], "bestellen_cont"); if($pos > 0) { echo base_url()."images/img_button_bestellen_over.png";} else{ echo base_url()."images/img_button_bestellen.png";} ?>'" src="<?php $pos = strpos($_SERVER['REQUEST_URI'], "bestellen_cont"); if($pos > 0) { echo base_url()."images/img_button_bestellen_over.png";} else{ echo base_url()."images/img_button_bestellen.png";} ?>" ></img></a>
					</li>
					<li>
						<a href="<?php echo base_url();?>index.php/contact_cont"><img onmouseover="this.src='<?php echo base_url();?>images/img_button_contact_over.png' " onmouseout="this.src='<?php echo base_url();?>images/img_button_contact.png'" src="<?php echo base_url();?>images/img_button_contact.png"></img></a>
					</li>
					<li>

						<a href="<?php echo base_url();?>index.php/mijnprofiel_cont"><img onmouseover="this.src='<?php echo base_url();?>images/img_button_account_over.png' " onmouseout="this.src='<?php echo base_url();?>images/img_button_account.png'" src="<?php echo base_url();?>images/img_button_account.png"></img></a>

						<!-- 							<a href="<?php echo base_url();?>index.php/account_cont"><img onmouseover="this.src='<?php echo base_url();?>images/beheer_over.png' " onmouseout="this.src='<?php echo base_url();?>images/beheer.png'" src="<?php echo base_url();?>images/beheer.png"></img></a> -->

					</ul>
				</nav>
				<div id="search" style="margin-top: -27px;">
					<form id="searchform" action="<?php echo base_url();?>index.php/search_cont">
						<label for="search">Zoeken</label>
						<input class="zoeken" name="search" type="text" />		
						<img src="<?php echo base_url();?>images/glas.png" style="cursor: pointer;" onclick="document.forms['searchform'].submit();" />
					</form>
				</div>
			</header>
			<section id="main_content">
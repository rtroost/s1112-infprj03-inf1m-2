<?php $this->load->library('session'); ?>

<!DOCTYPE html>
<html lang="nl-nl">
<head>
	<meta charset="UTF-8" />
	<title>Pizzario</title>
	<script src="<?php echo base_url();?>js/jquery-1.7.1.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="<?php echo base_url();?>js/script.js" type="text/javascript" charset="utf-8"></script>
	<script src="<?php echo base_url();?>js/tooltip.js" type="text/javascript" charset="utf-8"></script>
	<link rel="stylesheet" href="<?php echo base_url();?>css/style.css?<?php echo filemtime('css/style.css')?>" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url();?>css/tooltip.css" type="text/css" />
</head>
<body>
	<div id="wrapper">
		<header>
			<div id="inlog_false" class="inlog"<?php if($this->session->userdata('logged_in')) echo ' style="display:none;"' ?>>
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
			<div id="inlog_true" class="inlog"<?php if(!$this->session->userdata('logged_in')) echo ' style="display:none;"' ?>>
				<?php echo anchor('user/logout', 'Logout'); ?>
			</div>
			<nav>
				<ul id="header_nav">
					<li>
						<a href="<?php echo base_url();?>index.php"><img onmouseover="this.src='<?php echo base_url();?>images/img_button_home_over.png' " onmouseout="this.src='<?php $pos = strlen($_SERVER['REQUEST_URI']); if($pos < 21 ) { echo base_url()."images/img_button_home_over.png";} else{ echo base_url()."images/img_button_home.png";} ?>'" src="<?php $pos = strlen($_SERVER['REQUEST_URI']); if($pos < 21) { echo base_url()."images/img_button_home_over.png";} else{ echo base_url()."images/img_button_home.png";} ?>" /></a>
					</li>
					<li>
						<a href="<?php echo base_url();?>index.php/bestellen_cont/standaard"><img onmouseover="this.src='<?php echo base_url();?>images/img_button_bestellen_over.png' " onmouseout="this.src='<?php $pos = strpos($_SERVER['REQUEST_URI'], "bestellen_cont"); if($pos > 0) { echo base_url()."images/img_button_bestellen_over.png";} else{ echo base_url()."images/img_button_bestellen.png";} ?>'" src="<?php $pos = strpos($_SERVER['REQUEST_URI'], "bestellen_cont"); if($pos > 0) { echo base_url()."images/img_button_bestellen_over.png";} else{ echo base_url()."images/img_button_bestellen.png";} ?>" /></a>
					</li>
					<li>
						<a href="<?php echo base_url();?>index.php/contact_cont"><img onmouseover="this.src='<?php echo base_url();?>images/img_button_contact_over.png' " onmouseout="this.src='<?php $pos = strpos($_SERVER['REQUEST_URI'], "contact_cont"); if($pos > 0) { echo base_url()."images/img_button_contact_over.png";} else{ echo base_url()."images/img_button_contact.png";} ?>'" src="<?php $pos = strpos($_SERVER['REQUEST_URI'], "contact_cont"); if($pos > 0) { echo base_url()."images/img_button_contact_over.png";} else{ echo base_url()."images/img_button_contact.png";} ?>" /></a>
					</li>
					<li>
						<?php if($this->session->userdata('logged_in') and $this->session->userdata('typeid') == 2){ ?>
						<a href="<?php echo base_url();?>index.php/beheer_gebruikers_cont"><img onmouseover="this.src='<?php echo base_url();?>images/beheer_over.png' " onmouseout="this.src='<?php $pos = strpos($_SERVER['REQUEST_URI'], "beheer"); if($pos > 0) { echo base_url()."images/beheer_over.png";} else{ echo base_url()."images/beheer.png";} ?>'" src="<?php $pos = strpos($_SERVER['REQUEST_URI'], "beheer"); if($pos > 0) { echo base_url()."images/beheer_over.png";} else{ echo base_url()."images/beheer.png";} ?>" /></a> <?php }
						else { ?>
						<a href="<?php echo base_url();?>index.php/user"><img onmouseover="this.src='<?php echo base_url();?>images/img_button_account_over.png' " onmouseout="this.src='<?php if(strpos($_SERVER['REQUEST_URI'], "user") > 0 or strpos($_SERVER['REQUEST_URI'], "product_cont") > 0 or strpos($_SERVER['REQUEST_URI'], "cart") > 0) { echo base_url()."images/img_button_account_over.png";} else{ echo base_url()."images/img_button_account.png";} ?>'" src="<?php if(strpos($_SERVER['REQUEST_URI'], "user") > 0 or strpos($_SERVER['REQUEST_URI'], "product_cont") > 0 or strpos($_SERVER['REQUEST_URI'], "cart") > 0) { echo base_url()."images/img_button_account_over.png";} else{ echo base_url()."images/img_button_account.png";} ?>" /></a> <?php } ?>
					</ul>
				</nav>
				<div id="search" style="margin-top: -27px;">
					<form id="searchform" action="<?php echo base_url();?>index.php/search_cont">
						<label for="search">Zoeken</label>
						<input class="zoeken" name="search" type="text" />		
						<img src="<?php echo base_url();?>images/glas.png" style="cursor: pointer;" onclick="document.forms['searchform'].submit();" />
					</form>
				</div>
				
				<div id="sumenu">
					<nav id="navSub">
						<?php $pos = strpos($_SERVER['REQUEST_URI'], "bestellen_cont"); if($pos > 0) { ?>
						<ul id="header_nav">
							<li>
								<a href="<?php echo base_url();?>index.php/bestellen_cont/standaard"><img src="<?php if(strpos($_SERVER['REQUEST_URI'], "standaard") > 0) { echo base_url();?>images/subMenu/bestellen/productenhethuis_over.png <?php } else { echo base_url();?>images/subMenu/bestellen/productenhethuis.png <?php } ?>" onmouseover="this.src='<?php echo base_url();?>images/subMenu/bestellen/productenHetHuis_over.png' " onmouseout="this.src='<?php if(strpos($_SERVER['REQUEST_URI'], "standaard") > 0) { echo base_url();?>images/subMenu/bestellen/productenhethuis_over.png <?php } else { echo base_url();?>images/subMenu/bestellen/productenhethuis.png <?php } ?>'"/></a>
							</li>
							<li>
								<a href="<?php echo base_url();?>index.php/bestellen_cont/selfmade"><img src="<?php if(strpos($_SERVER['REQUEST_URI'], "selfmade") > 0) { echo base_url();?>images/subMenu/bestellen/ontworpenProducten_over.png <?php } else { echo base_url();?>images/subMenu/bestellen/ontworpenProducten.png <?php } ?>" onmouseover="this.src='<?php echo base_url();?>images/subMenu/bestellen/ontworpenProducten_over.png' " onmouseout="this.src='<?php if(strpos($_SERVER['REQUEST_URI'], "selfmade") > 0) { echo base_url();?>images/subMenu/bestellen/ontworpenProducten_over.png <?php } else { echo base_url();?>images/subMenu/bestellen/ontworpenProducten.png <?php } ?>'"/></a>
							</li>
						</ul>
						<?php } 
						if(strpos($_SERVER['REQUEST_URI'], "beheer") > 0 and $this->session->userdata('typeid') == 2 or strpos($_SERVER['REQUEST_URI'], "user") > 0 and $this->session->userdata('typeid') == 2) { ?>
						<ul id="header_nav">
							<li>
								<a href="<?php echo base_url();?>index.php/beheer_gebruikers_cont"><img src="<?php if(strpos($_SERVER['REQUEST_URI'], "gebruikers_cont") > 0) { echo base_url();?>images/subMenu/beheer/accounts_over.png <?php } else { echo base_url();?>images/subMenu/beheer/accounts.png <?php } ?>" onmouseover="this.src='<?php echo base_url();?>images/subMenu/beheer/accounts_over.png' " onmouseout="this.src='<?php if(strpos($_SERVER['REQUEST_URI'], "gebruikers_cont") > 0) { echo base_url();?>images/subMenu/beheer/accounts_over.png <?php } else { echo base_url();?>images/subMenu/beheer/accounts.png <?php } ?>'"/></a>
							</li>
							<li>
								<a href="<?php echo base_url();?>index.php/beheer_aanbiedingen_cont"><img src="<?php if(strpos($_SERVER['REQUEST_URI'], "beheer_aanbiedingen_cont") > 0) { echo base_url();?>images/subMenu/beheer/aanbiedingen_over.png <?php } else { echo base_url();?>images/subMenu/beheer/aanbiedingen.png <?php } ?>" onmouseover="this.src='<?php echo base_url();?>images/subMenu/beheer/aanbiedingen_over.png' " onmouseout="this.src='<?php if(strpos($_SERVER['REQUEST_URI'], "beheer_aanbiedingen_cont") > 0) { echo base_url();?>images/subMenu/beheer/aanbiedingen_over.png <?php } else { echo base_url();?>images/subMenu/beheer/aanbiedingen.png <?php } ?>'"/></a>
							</li>
							<li>
								<a href="<?php echo base_url();?>index.php/beheer_news_cont"><img src="<?php if(strpos($_SERVER['REQUEST_URI'], "beheer_news_cont") > 0) { echo base_url();?>images/subMenu/beheer/nieuws_over.png <?php } else { echo base_url();?>images/subMenu/beheer/nieuws.png <?php } ?>" onmouseover="this.src='<?php echo base_url();?>images/subMenu/beheer/nieuws_over.png' " onmouseout="this.src='<?php if(strpos($_SERVER['REQUEST_URI'], "beheer_news_cont") > 0) { echo base_url();?>images/subMenu/beheer/nieuws_over.png <?php } else { echo base_url();?>images/subMenu/beheer/nieuws.png <?php } ?>'"/></a>
							</li>
							<li>
								<a href="<?php echo base_url();?>index.php/user/product"><img src="<?php if(strpos($_SERVER['REQUEST_URI'], "product") > 0) { echo base_url();?>images/subMenu/beheer/producten_over.png <?php } else { echo base_url();?>images/subMenu/beheer/producten.png <?php } ?>" onmouseover="this.src='<?php echo base_url();?>images/subMenu/beheer/producten_over.png' " onmouseout="<?php if(strpos($_SERVER['REQUEST_URI'], "product") > 0) { echo base_url();?>images/subMenu/beheer/producten_over.png <?php } else { echo base_url();?>images/subMenu/beheer/producten.png <?php } ?>'"/></a>
							</li>
							<li>
								<a href="<?php echo base_url();?>index.php/beheer_contact_cont"><img src="<?php if(strpos($_SERVER['REQUEST_URI'], "beheer_contact_cont") > 0) { echo base_url();?>images/subMenu/beheer/contact.png <?php } else { echo base_url();?>images/subMenu/beheer/contact.png <?php } ?>" onmouseover="this.src='<?php echo base_url();?>images/subMenu/beheer/contact_over.png' " onmouseout="this.src='<?php if(strpos($_SERVER['REQUEST_URI'], "beheer_contact_cont") > 0) { echo base_url();?>images/subMenu/beheer/contact_over.png <?php } else { echo base_url();?>images/subMenu/beheer/contact.png <?php } ?>'"/></a>
							</li>
						</ul>
						<?php }
						if(strpos($_SERVER['REQUEST_URI'], "user") > 0 and $this->session->userdata('typeid') != 2 or strpos($_SERVER['REQUEST_URI'], "product_cont") > 0 and $this->session->userdata('typeid') != 2 or strpos($_SERVER['REQUEST_URI'], "cart") > 0 and $this->session->userdata('typeid') != 2) { ?>
						<ul id="header_nav">
							<li>
								<a href="<?php echo base_url();?>index.php/cart"><img src="<?php if(strpos($_SERVER['REQUEST_URI'], "cart") > 0) { echo base_url();?>images/subMenu/mijnAccount/winkelwagen_over.png <?php } else { echo base_url();?>images/subMenu/mijnAccount/winkelwagen.png <?php } ?> " onmouseover="this.src='<?php echo base_url();?>images/subMenu/mijnAccount/winkelwagen_over.png' " onmouseout="this.src='<?php if(strpos($_SERVER['REQUEST_URI'], "cart") > 0) { echo base_url();?>images/subMenu/mijnAccount/winkelwagen_over.png <?php } else { echo base_url();?>images/subMenu/mijnAccount/winkelwagen.png <?php } ?>'"/></a>
							</li>
							<li>
								<a href="<?php echo base_url();?>index.php/user/wijziggegevens"><img src="<?php if(strpos($_SERVER['REQUEST_URI'], "wijziggegevens") > 0) { echo base_url();?>images/subMenu/mijnAccount/mijnGegevens_over.png <?php } else { echo base_url();?>images/subMenu/mijnAccount/mijnGegevens.png <?php } ?>" onmouseover="this.src='<?php echo base_url();?>images/subMenu/mijnAccount/mijnGegevens_over.png' " onmouseout="this.src='<?php if(strpos($_SERVER['REQUEST_URI'], "wijziggegevens") > 0) { echo base_url();?>images/subMenu/mijnAccount/mijnGegevens_over.png <?php } else { echo base_url();?>images/subMenu/mijnAccount/mijnGegevens.png <?php } ?>'"/></a>
							</li>
							<li>
								<a href="<?php echo base_url();?>index.php/user/favoriet"><img src="<?php if(strpos($_SERVER['REQUEST_URI'], "favoriet") > 0) { echo base_url();?>images/subMenu/mijnAccount/favorieten_over.png <?php } else { echo base_url();?>images/subMenu/mijnAccount/favorieten.png <?php } ?>" onmouseover="this.src='<?php echo base_url();?>images/subMenu/mijnAccount/favorieten_over.png' " onmouseout="this.src='<?php if(strpos($_SERVER['REQUEST_URI'], "favoriet") > 0) { echo base_url();?>images/subMenu/mijnAccount/favorieten_over.png <?php } else { echo base_url();?>images/subMenu/mijnAccount/favorieten.png <?php } ?>'"/></a>
							</li>
							<li>
								<a href="<?php echo base_url();?>index.php/user/product"><img src="<?php if(strpos($_SERVER['REQUEST_URI'], "user/product") > 0) { echo base_url();?>images/subMenu/mijnAccount/mijnProducten_over.png <?php } else { echo base_url();?>images/subMenu/mijnAccount/mijnProducten.png <?php } ?>" onmouseover="this.src='<?php echo base_url();?>images/subMenu/mijnAccount/mijnProducten_over.png' " onmouseout="this.src='<?php if(strpos($_SERVER['REQUEST_URI'], "user/product") > 0) { echo base_url();?>images/subMenu/mijnAccount/mijnProducten_over.png <?php } else { echo base_url();?>images/subMenu/mijnAccount/mijnProducten.png <?php } ?>'"/></a>
							</li>
							<li>
								<a href="<?php echo base_url();?>index.php/product_cont/creator"><img src="<?php if(strpos($_SERVER['REQUEST_URI'], "creator") > 0) { echo base_url();?>images/subMenu/mijnAccount/maakProduct_over.png <?php } else { echo base_url();?>images/subMenu/mijnAccount/maakProduct.png <?php } ?>" onmouseover="this.src='<?php echo base_url();?>images/subMenu/mijnAccount/maakProduct_over.png' " onmouseout="this.src='<?php if(strpos($_SERVER['REQUEST_URI'], "creator") > 0) { echo base_url();?>images/subMenu/mijnAccount/maakProduct_over.png <?php } else { echo base_url();?>images/subMenu/mijnAccount/maakProduct.png <?php } ?>'"/></a>
							</li>
						</ul>
						<?php } ?>
					</nav><br>
				</div>
				
			</header>
			<section id="main_content">
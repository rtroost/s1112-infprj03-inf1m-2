    </section>
	
	<?php 
		$sql = "SELECT kortingspunten FROM gebruiker WHERE gebruikerid = '".$this->session->userdata('gebruikerid')."'";
		$result = mysql_query($sql);
		if(mysql_num_rows($result) > 0) {$results = mysql_fetch_object($result); $kortingspunten = $results->kortingspunten;} else { $kortingspunten = "0"; }
		
		$totalitems = $this->cart->total_items();
	/*$this->load->model('gebruiker_product_model'); 
	$data = $this->gebruiker_product_model->getKortingspunten();*/
	?>
	
	<footer>
		<div class="footer_center">
			<ul id="footer_nav">
				<li><a href="#" ><img src="<?php echo base_url(); ?>images/sociaal/Facebook.png"></img></a></li>
				<li><a href="#" ><img src="<?php echo base_url(); ?>images/sociaal/Twitter.png"></img></a></li>
				<li><a href="#" ><img src="<?php echo base_url(); ?>images/sociaal/Skype.png"></img></a></li>
				<li><a href="#" ><img src="<?php echo base_url(); ?>images/sociaal/Email.png"></img></a></li>
			</ul>
		</div>
    </footer>
	</div>
	
	<div id="updateWinkelwagen" style="
	display:none;
	position: fixed;  
	top:0px;  
	left: 30px; 
	width: 220px; 
	height:100%;
	bottom:40px;
	z-index:51;
	vertical-align:bottom;">
	
		<div style="position: absolute; 
		bottom: 25px;
		width:270px;
		height:203px;
		left:490px;
		z-index:52;
		
		background-image: url('<?php echo base_url(); ?>images/updateWinkelwagen.png');">
		</div>
	</div>
	
	<div id="footer">
		<?php if(!$this->session->userdata('logged_in')){ ?>
			<div id="barInlog">
				<ul id="inlogul">
					<li><img src="<?php echo base_url(); ?>images/bar/tussen.png" /><a href="<?php echo base_url(); ?>index.php/user/login">Login</a><img src="<?php echo base_url(); ?>images/bar/tussen.png" /></li>
					<li><a href="<?php echo base_url(); ?>index.php/user/register">Register</a><img src="<?php echo base_url(); ?>images/bar/tussen.png" /></li>
				</ul>
			</div>
		<?php }
		else { 	?>
			<div id="barInlog">
				<ul id="inlogul">
					<li><img src="<?php echo base_url(); ?>images/bar/tussen.png" /><a href="<?php echo base_url(); ?>index.php/user/">Mijn profiel</a><img src="<?php echo base_url(); ?>images/bar/tussen.png" /></li>
					<li><a href="<?php echo base_url(); ?>index.php/user/logout">Logout</a><img src="<?php echo base_url(); ?>images/bar/tussen.png" /></li>
				</ul>
			</div>
		<?php } ?>
			<div id="barLinks">
				<ul id="linksUl">
					<li><img class="tussenLinks" src="<?php echo base_url(); ?>images/bar/tussen.png" /><a href="<?php echo base_url(); ?>index.php"><img class="imgLinks" src="<?php echo base_url(); ?>images/bar/home.png" /></a><img class="tussenLinks" src="<?php echo base_url(); ?>images/bar/tussen.png" /></li>
					<li><a href="<?php echo base_url(); ?>index.php/product_cont/creator"><img class="imgLinks" src="<?php echo base_url(); ?>images/bar/roller.png" /></a><img class="tussenLinks" src="<?php echo base_url(); ?>images/bar/tussen.png" /></li>
					<li><a href="<?php echo base_url(); ?>index.php/bestellen_cont"><img class="imgLinks" src="<?php echo base_url(); ?>images/bar/bestel.png" /></a><img class="tussenLinks" src="<?php echo base_url(); ?>images/bar/tussen.png" /></li>
					<li><a href="<?php echo base_url(); ?>index.php/contact_cont"><img class="imgLinks" src="<?php echo base_url(); ?>images/bar/contact.png" /></a><img class="tussenLinks" src="<?php echo base_url(); ?>images/bar/tussen.png" /></li>
				</ul>
			</div>
		
		<div id="barCart">
			<img class="barTussen" style="float:left;margin-left:100px;" src="<?php echo base_url(); ?>images/bar/tussen.png" />
			<table style="float:left;" id="cartTable">
				<tr>
					<td><img id="barWinkelwagen" src="<?php echo base_url(); ?>images/bar/winkelwagen.png" /></td>
					<td class="cartTd"><a id="linkWinkelwagen" href="<?php echo base_url(); ?>index.php/cart" >&nbsp;Winkelwagen(<?php echo $totalitems; ?>)</a></td>
					<td class="cartTd"><b>&nbsp;|&nbsp;</b></td>
					<td class="cartTd"><a href="<?php echo base_url(); ?>index.php/cart/checkout"><b>Checkout</b></a></td>
				</tr>
			</table>
			<img class="barTussen" src="<?php echo base_url(); ?>images/bar/tussen.png" />
		</div>
		
		<div id="barKorting">
			<img class="barTussen" style="float:left;margin-left:100px;" src="<?php echo base_url(); ?>images/bar/tussen.png" />
			<a  href="#" >
				<table style="float:left;" id="cartTable">
					<tr>
						<td><img id="barWinkelwagen" src="<?php echo base_url(); ?>images/bar/korting.png" /></td>
						<td class="cartTd"><a href="<?php echo base_url(); ?>/index.php/kortingspunten_cont" >&nbsp;Kortingspunten(<?php echo $kortingspunten ?>)</a></td>
					</tr>
				</table>
			</a>
			<img class="barTussen" src="<?php echo base_url(); ?>images/bar/tussen.png" />
		</div>
	</div>
</body>
</html>
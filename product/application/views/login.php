<?php $this->load->view('includes/header') ?>
	<div id="content">
		<?php if(isset($logged_in)){ ?>
			
			<p> U bent al ingelogged. </p>
			
		<?php } else { ?>
		<div>
			<?php if(isset($link)){ ?>
			<form action="<?php echo base_url();?>index.php/login_cont/login?link=<?php echo $link; ?>" method="post">
			<?php } else { ?>
			<form action="<?php echo base_url();?>index.php/login_cont/login" method="post">
			<?php } ?>
			
				<label for="username" >Email adres:</label>
				<input name="email" type="text" /><br />
				<label for="wachtwoord" >Wachtwoord:</label>
				<input name="password" type="password" /><br />
				<input name="aanmeldenSubmit" value="Aanmelden" type="submit" />
			</form>
		</div>
		<?php } ?>
	</div>	
<?php $this->load->view('includes/footer') ?>
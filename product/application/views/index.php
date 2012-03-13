<?php $this->load->view('includes/header') ?>
	<div id="content">
		<h1>Hoofdpagina</h1>
		<?php if(isset($naam)){  ?>
			<p style="margin-bottom: 0px;">Welkom <?php echo $naam; ?></p>	
		<?php } ?>
		<a href="<?php echo base_url(); ?>index.php/login_cont?link=index.php/product_cont/creator">Login pagina</a>
<!-- 		<a href="<?php echo base_url(); ?>index.php/login_cont">Login pagina</a> -->
	</div>	
<?php $this->load->view('includes/footer') ?>
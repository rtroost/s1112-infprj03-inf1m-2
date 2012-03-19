<?php $this->load->view('includes/header') ?>
	<div id="content">
		<h1>Mijn profiel</h1>
		<p style="margin-bottom: 0px;">Welkom <?php echo $this->session->userdata('voornaam'); ?></p>	
		<a href="<?php echo base_url(); ?>index.php/mijnprofiel_cont/product">Mijn producten</a>
		


	</div>	
<?php $this->load->view('includes/footer') ?>
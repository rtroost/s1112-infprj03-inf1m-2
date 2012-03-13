<?php $this->load->view('includes/header') ?>
	<div id="content">
		<h1>Hoofdpagina</h1>
		<?php if(isset($naam)){  ?>
			<p style="margin-bottom: 0px;">Welkom <?php echo $naam; ?></p>	
		<?php } ?>
	</div>	
<?php $this->load->view('includes/footer') ?>
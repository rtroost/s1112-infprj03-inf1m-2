<?php $this->load->view('includes/header') ?>

	<div id="content">
		
		<h2>Mijn account</h2><br>
		<p style="margin-bottom: 0px;">Welkom <?php echo $this->session->userdata('voornaam'); ?>,</p><br>	
		Via het bovenstaande menu kunt u navigeren door de website en al uw eigen gegevens aanpassen.<br><br>
		Wij wensen u veel plezier op de website van PizzaRio!<br><br>
		Groeten,<br><br>
		Het PizzaRio Team
		
	</div>	
	
<?php $this->load->view('includes/footer') ?>
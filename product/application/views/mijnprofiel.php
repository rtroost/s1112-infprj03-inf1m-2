<?php $this -> load -> view('includes/header');?>
<style type="text/css" media="screen">
	p {
		padding-bottom: 10px;
		display:block;
	}
	section {
		padding-bottom: 20px;
	}
</style>
<div id="content">
	<section>
		<h2>Mijn account</h2>
		<br>
		<p style="margin-bottom: 0px;">
			Welkom <?php echo $this -> session -> userdata('voornaam');?>,
		</p>
		<p>
			Via het bovenstaande menu kunt u navigeren door de website en al uw eigen gegevens aanpassen.
		</p>
		<p>
			Wij wensen u veel plezier op de website van PizzaRio!
		</p>
		<br />
		<p>
			Met vriendelijke groet,
			<br />
			Het PizzaRio Team
		</p>
	</section>
</div>
<?php $this -> load -> view('includes/footer');?>
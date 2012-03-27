<?php $this->load->view('includes/header');?>
<div id="content">
	<?php if($this -> cart -> total_items() == 0) {
	?>
	<p>
		Uw winkelwagen is leeg.
	</p>
	<?php } else {?>
		<?php
		// Set default timezone for DATE/TIME functions
		if (function_exists('date_default_timezone_set')) {
			date_default_timezone_set('Europe/Amsterdam');
		}

		include ('library/ideallite.cls.php');

		$oIdeal = new IdealLite();

		// Set shop details
		$oIdeal -> setUrlCancel(base_url().'index.php/cart/idealresult?status=cancel');
		$oIdeal -> setUrlError(base_url().'index.php/cart/idealresult?status=error');
		$oIdeal -> setUrlSuccess(base_url().'index.php/cart/idealresult?status=success');

		// Set order details
		$oIdeal -> setAmount($this -> cart -> total() + 1.95);
		//$oIdeal -> setOrderId($sOrderId);
		$oIdeal -> setOrderDescription('Pizzaria Pizzario - Bestelling');

		// Customize submit button
		$oIdeal -> setButton('Betalen met iDEAL');

		// Generate form
		echo '<p>Uw bestelling afrekenen!</p>' . $oIdeal -> createForm();
	}
		?>
	</div>
<?php $this->load->view('includes/footer');?>
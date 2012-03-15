<style type="text/css" media="screen">
	/*
	 * Messages
	 */
	.info, .success, .warning, .error, .validation {
		font-size: 11px;
		border: 1px solid;
		margin: 10px 0px;
		padding: 5px 5px 5px 40px;
		background-size: 20px;
		background-repeat: no-repeat;
		background-position: 10px center;
		display: block;
		width: 250px;
	}
	.info {
		color: #00529B;
		background-color: #BDE5F8;
		background-image: url('../images/icons/info.png');
	}
	.success {
		color: #4F8A10;
		background-color: #DFF2BF;
		background-image: url('../images/icons/success.png');
	}
	.warning {
		color: #9F6000;
		background-color: #FEEFB3;
		background-image: url('../images/icons/warning.png');
	}
	.error {
		color: #D8000C;
		background-color: #FFBABA;
		background-image: url('../images/icons/error.png');
	}
	/*
	 * Order-form.php
	 */
	form.order_userinfo {
		font: normal 13px Arial, Helvetica, sans-serif;
		line-height: 2em;
	}
	form.order_userinfo p {
		margin: 5px;
	}
	form.order_userinfo label {
		width: 200px;
		float: left;
	}
	form.order_userinfo input[type="text"], select {
		font: normal 13px Arial, Helvetica, sans-serif; ;
		padding: 4px;
	}
	form.order_userinfo .margRight {
		margin-left: 200px;
	}
	form.order_userinfo input[type="submit"] {
		border: 1px solid #39adf0;
		background: #6ac7fc;
		color: white;
		font: bold 13px Arial, Helvetica, sans-serif;
		text-transform: uppercase;
		text-shadow: 1px 1px 0 #7a7a7a;
		padding: 6px;
		cursor: pointer;
		width: 145px;
	}
	form.order_userinfo input[type="submit"]:hover {
		background: #70d2fd;
	}
</style>
<div id="content">
	<?php if($this -> cart -> total_items() == 0) {
	?>
	<p>
		Uw winkelwagen is leeg.
	</p>
	<?php } else {?>
	<div style="float:right;">
		<?php
		$this -> form_validation -> set_error_delimiters('<li">', '</li>');
		echo validation_errors(' <div class="error"> ', ' </div> ');
		?>
		</div>
		<?php
		$attributes = array('class' => 'order_userinfo', 'id' => 'order_userinfo');
		echo form_open('', $attributes);
		?>
		<p>
		<label for="eindbedrag">Eindbedrag</label>
		<span id="eindbedrag">€ <?php echo $this -> cart -> format_number($this -> cart -> total() + 1.95);?></span>
		</p>
		<p>
		<label for="payment-method">Betaalmethode <span class="required">*</span></label>
		<?php // Change the values in this array to populate your dropdown as required?>
		<?php $options = array('' => 'Please Select', 'paypal' => 'Paypal', 'ideal' => 'iDeal', 'gwallet' => 'Google Wallet', 'creditcard' => 'Creditcard');?>

		<?php echo form_dropdown('payment-method', $options, set_value('payment-method'))
		?>
		</p>
		<p>
		<?php echo form_submit(array('value' => 'Verder', 'class' => 'margRight'));?>
		</p>
		<?php echo form_close();?>

		<?php }?>
	</div>

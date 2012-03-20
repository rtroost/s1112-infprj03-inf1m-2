<?php $this->load->view('includes/header');?>
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
		/*		display: block;*/
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
		padding: 5px;
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
		<label for="voorletters">Voorletters <span class="required">*</span></label>
		<input id="voorletters" type="text" name="voorletters" placeholder="A.B.F." maxlength="20" value="<?php echo $voornaam; ?>"  />
		</p>
		<p>
		<label for="achternaam">Achternaam <span class="required">*</span></label>
		<input id="achternaam" type="text" name="achternaam" maxlength="50" value="<?php echo $achternaam;?>"  />
		</p>
		<p>
		<label for="adresregel_1">Adresregel 1 <span class="required">*</span></label>
		<input id="adresregel_1" type="text" name="adresregel_1" placeholder="Straatnaam 00" maxlength="50" value="<?php echo $adresregel_1?>"  />
		</p>
		<p>
		<label for="adresregel_2">Adresregel 2</label>
		<input id="adresregel_2" type="text" name="adresregel_2" maxlength="50" value="<?php echo $adresregel_2;?>"  />
		</p>
		<p>
		<label for="postcode">Postcode <span class="required">*</span></label>
		<input id="postcode" type="text" name="postcode" placeholder="1234AB" maxlength="6" value="<?php echo $postcode; ?>"  />
		</p>
		<p>
		<label for="woonplaats">Woonplaats <span class="required">*</span></label>
		<input id="woonplaats" type="text" name="woonplaats" placeholder="Utrecht" maxlength="50" value="<?php echo $woonplaats;?>"  />
		</p>
		<p>
		<label for="telefoonnummer">Telefoonnummer <span class="required">*</span></label>
		<input id="telefoonnummer" type="text" name="telefoonnummer" placeholder="0101234567" maxlength="10" value="<?php echo $telefoonnummer;?>"  />
		</p>
		<p>
		<label for="email">Email <span class="required">*</span></label>
		<input id="email" type="text" name="email" placeholder="username@provider.countrycode" maxlength="100" value="<?php echo $email;?>"  />
		</p>
		<p>
		<label for="payment-method">Betaalmethode <span class="required">*</span></label>
		<?php // Change the values in this array to populate your dropdown as required?>
		<?php $options = array('' => 'Please Select', 'paypal' => 'Paypal', 'ideal' => 'iDEAL', 'gwallet' => 'Google Wallet', 'creditcard' => 'Creditcard');?>

		<?php echo form_dropdown('payment-method', $options, set_value('payment-method'))
		?>
		</p>
		<p>
		<?php echo form_submit(array('value' => 'Verder', 'class' => 'margRight'));?>
		</p>
		<?php echo form_close();?>

		<?php }?>
	</div>
<?php $this->load->view('includes/footer');?>
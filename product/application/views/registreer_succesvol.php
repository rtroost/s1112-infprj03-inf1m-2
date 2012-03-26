<?php $this -> load -> view('includes/header');?>

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
	form.registreerform {
		font: normal 13px Arial, Helvetica, sans-serif;
		line-height: 2em;
	}
	form.registreerform p {
		padding: 5px;
	}
	form.registreerform label {
		width: 200px;
		float: left;
	}
	form.registreerform error {
		width: 200px;
		float: right;
	}
	form.registreerform input[type="text"], select {
		font: normal 13px Arial, Helvetica, sans-serif; ;
		padding: 4px;
	}
	form.registreerform input[type="password"], select {
		font: normal 13px Arial, Helvetica, sans-serif; ;
		padding: 4px;
	}
	form.registreerform .margRight {
		margin-left: 200px;
	}
	form.registreerform input[type="submit"] {
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
	form.registreerform input[type="submit"]:hover {
		background: #70d2fd;
	}

</style>

<div id="content">
<h1>Aanvraag verstuurd!</h1>
	<p>
		Uw gegevens zijn succesvol verstuurd naar onze database. Gebruik uw email adres en wachtwoord om in te loggen.
	</p>
</div>
<?php $this -> load -> view('includes/footer');?>
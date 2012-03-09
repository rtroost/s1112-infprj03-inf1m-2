<?php $this->load->view('includes/header') ?>
	<div id="content">
		<?php if(isset($_COOKIE['koekje_test'])){ ?>
			<h1>Cookie gevonden.</h1>
 			<?php echo "<pre>".$_COOKIE['koekje_test']."</pre>";
				  $arr = explode(',', $_COOKIE['koekje_test']);
				  echo "<pre>";
				  print_r($arr);
				  echo "</pre>";
			
			 ?>
		<?php } ?>
		<h1>De product pagina</h1>
		<a href="<?php echo base_url(); ?>index.php/product_cont/creator">Creëer een nieuw product</a>
	</div>	
<?php $this->load->view('includes/footer') ?>
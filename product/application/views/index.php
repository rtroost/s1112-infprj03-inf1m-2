<?php $this->load->view('includes/header') ?>
	<article>
		<h1>Hoofdpagina</h1>
		<?php foreach($records as $row){ ?>
			<p><?php echo $row->testcolumn; ?></p>
			<br />
		<?php }?>
	</article>	
<?php $this->load->view('includes/footer') ?>
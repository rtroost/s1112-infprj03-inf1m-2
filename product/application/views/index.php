<?php $this->load->view('includes/header') ?>
	<?php foreach($records as $row){ ?>
		<p><?php echo $row->testcolumn; ?></p>
		<br />
	<?php }?>
<?php $this->load->view('includes/footer') ?>
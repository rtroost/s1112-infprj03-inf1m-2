<?php $this->load->view('includes/header') ?>

<link rel="stylesheet" media="all" href="<?php echo base_url(); ?>css/i.slider.css" />
<script src="<?php echo base_url(); ?>js/islider/jquery.i.slider-1.0.min.js"></script>
<script src="<?php echo base_url(); ?>js/islider/slider.js"></script>


<div id="content">

	<div id="example">
		<?php for($i = 0; $i < count($aanbiedingen); $i++)	
			{ ?>	
				<div class="i-slider-section">
					<img src="images/producten/<?php print_r($aanbiedingen[$i]->productid)?>.jpg" />
					<div class="i-slider-captions bottom">
						<?php print_r($aanbiedingen[$i]->naam); ?>
					</div>
				</div>
		<?php } ?>
	</div>
		
	<p style="clear: both;"></p>
	
	<?php if($news == null)	{ ?>
		<div id="homeNewsTitel">
			Er is momenteel geen nieuws
		</div>
		
	<?php } else { $index = count($news)-1; ?>

		<div id="homeNewsTitel">
			<?php echo $news[$index]->titel; ?>
		</div>
		
		<div id="homeNewsInhoud">
			<?php echo $news[$index]->inhoud; ?>
		</div>
		
	<?php }  ?>	
</div>	
	
<?php $this->load->view('includes/footer') ?>
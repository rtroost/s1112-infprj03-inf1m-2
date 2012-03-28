<?php $this->load->view('includes/header') ?>

<link rel="stylesheet" media="all" href="<?php echo base_url(); ?>css/i.slider.css" />
<script src="<?php echo base_url(); ?>js/islider/jquery.i.slider-1.0.min.js"></script>
<script src="<?php echo base_url(); ?>js/islider/slider.js"></script>


<div id="content">

	<div id="example">

	
		<div class="i-slider-section">
			<img src="images/examples/adorepaper.jpg" />
		</div>
		<div class="i-slider-section">
			<img src="images/examples/bed.jpg" />
			
			<div class="i-slider-captions bottom">
			Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes.
			</div>
		</div>
		<div class="i-slider-section">

			<img src="images/examples/cactus.jpg" />
		</div>
		<div class="i-slider-section">
			<img src="images/examples/chair.jpg" />
		</div>
		<div class="i-slider-section">
			<iframe title="YouTube video player" width="800" height="267" src="http://www.youtube.com/embed/ZN5PoW7_kdA" frameborder="0" allowfullscreen></iframe>
		</div>

	
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
	

	<div id="aanbiedingen">
	
	</div>		
</div>	
	
<?php $this->load->view('includes/footer') ?>
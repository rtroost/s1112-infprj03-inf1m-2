<?php $this->load->view('includes/header') ?>

<link rel="stylesheet" media="all" href="<?php echo base_url(); ?>css/i.slider.css" />
<script src="<?php echo base_url(); ?>js/islider/jquery.i.slider-1.0.min.js"></script>
<script src="<?php echo base_url(); ?>js/islider/slider.js"></script>


<div id="content">

	<div id="example">
		<?php for($i = 0; $i < count($aanbiedingen); $i++)	
			{ ?>	
				<div class="i-slider-section">
					<a href="index.php/product_cont?productid=<?php print_r($aanbiedingen[$i]->productid)?>"><img src="images/producten/<?php print_r($aanbiedingen[$i]->productid)?>.jpg" /></a>
					<div class="i-slider-captions bottom">
						<?php print_r($aanbiedingen[$i]->naam); ?>
					</div>
				</div>
		<?php } ?>
	dfgdfgdf</div>
		
	<div id="pizzaPromotie">
		<a href="<?php echo base_url();?>index.php/product_cont/creator"> <img src="<?php echo base_url();?>images/pizzaPromotie.png" /></a>
	</div>	
	
	<div id="topProducten">
		<span style="color:#a0751a;">Top 5 best verkochte ontwerpen</span>
		<table>
		<tr><td style="width:300px;font-size:10px;">Productnaam</td><td style="text-align:right;font-size:10px;">verkocht</td></tr>
		<?php
		for($i=0; $i<=4; $i++)
			{
			echo "<tr><td><a href=\"".base_url() ."index.php/product_cont?productid=".$topProducten[$i]->productid ."\">".$topProducten[$i]->naam ."</a></td><td style=\"text-align:right;\">".$topProducten[$i]->aantal ."</td></tr>";
			}
		?>
		</table>
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
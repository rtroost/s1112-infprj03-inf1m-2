<?php $this->load->view('includes/header') ?>

<div id="content">
		
<?php
	
	if($news == null)
	{
		echo "
		<div id=\"homeNewsTitel\">
			Er is momenteel geen nieuws
		</div>
		";
	}
	
	else
	{
		echo "
		<div id=\"homeNewsTitel\">
			".$news[0]->titel."
		</div>
		
		<div id=\"homeNewsInhoud\">
			".$news[0]->inhoud."
		</div>
		";	
	}
				
?>
		
</div>	
	
<?php $this->load->view('includes/footer') ?>
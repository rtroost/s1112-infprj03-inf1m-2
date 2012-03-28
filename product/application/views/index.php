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
		$index = count($news);
		$index = $index - 1;
		
		echo "
		<div id=\"homeNewsTitel\">
			".$news[$index]->titel."
		</div>
		
		<div id=\"homeNewsInhoud\">
			".$news[$index]->inhoud."
		</div>
		";	
	}
				
?>
		
</div>	
	
<?php $this->load->view('includes/footer') ?>
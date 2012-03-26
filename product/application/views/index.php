<?php $this->load->view('includes/header') ?>

<div id="content">
		
<?php
	
	if($news == null)
	{
		echo (".<h1>Er is momenteel geen nieuws</h1>");
	}
	
	else
	{
		echo "
		<div id=\"newsTitel\">
			<h1>".$news[0]->titel."</h1>
		</div>
		";	
	}
				
?>
		
</div>	
	
<?php $this->load->view('includes/footer') ?>
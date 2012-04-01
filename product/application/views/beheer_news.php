<?php $this->load->view('includes/header') ?>

<div id="content">
	
	<div id="titelBeheerNews">
		<h2>Beheer nieuws</h2>
	</div>
	
	<div id ="updateNews">
		<table id="newsTable">
			<tr><td style="width: 100px;"><b>Titel</b></td><td><textarea id="titelInput" name="Titel" disabled>Vul hier de titel in.</textarea></td></tr>
			<tr><td style="width: 100px;"><b>Inhoud</b></td><td><textarea id="inhoudInput" name="Inhoud" disabled>Vul hier de inhoud in.</textarea></td></tr>
		</table>
		
		<div id="navigatieNews">
			<input name="activateNews" id="activateNews" onmousedown="updateNews()" type="button" value="Activeer nieuws">
			<input name="cancelNews" id="cancelNews" onmousedown="cancelNews()" type="button" disabled value="Annuleer">
			
			<div id="newsOpgeslagen"></div>
		</div>
	</div>	

</div>
	
<?php $this->load->view('includes/footer') ?>
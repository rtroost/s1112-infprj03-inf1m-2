<?php $this->load->view('includes/header') ?>

<div id="content">
	
	<div id ="updateNews">
		<table id="newsTable">
			<tr><td>Titel</td><td><input id="titelInput" name="Titel" class="newsInput" disabled value="Titel"</td></tr>
			<tr><td>Inhoud</td><td><input id="inhoudInput" name="Inhoud" class="newsInput" disabled value="Inhoud"</td></tr>
			<tr><td><input name="activateNews" id="activateNews" style="width:110px" onmousedown="updateNews()" type="button" value="Voeg nieuws toe"></td>
				<td><input name="cancelNews" id="cancelNews" style="width:110px" onmousedown="cancelNews()" type="button" disabled value="Annuleer"></td></tr> 
			<tr><td><div id="newsOpgeslagen"></div></td></tr>
		
		</table>
	</div>	

</div>
	
<?php $this->load->view('includes/footer') ?>
<?php $this->load->view('includes/header') ?>

	<div id="content">
		<table id="contactTable">
			<tr><td>Adres</td><td><?php print_r($contact[0]->adres); ?></td></tr>
			<tr><td>Postcode</td><td><?php print_r($contact[0]->postcode); ?></td></tr>
			<tr><td>Plaats</td><td><?php print_r($contact[0]->plaats); ?></td></tr>
			<tr><td>Land</td><td><?php print_r($contact[0]->land); ?></td></tr>
			<tr><td>Telefoon</td><td><?php print_r($contact[0]->telefoon); ?></td></tr>
			<tr><td>Fax</td><td><?php print_r($contact[0]->fax); ?></td></tr>
			<tr><td>Email</td><td><?php print_r($contact[0]->email); ?></td></tr>
			<tr><td>Twitter</td><td><?php print_r($contact[0]->twitter); ?></td></tr>
			<tr><td>Facebook</td><td><?php print_r($contact[0]->facebook); ?></td></tr>
		</table>
		
		<iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.nl/maps?f=q&amp;source=s_q&amp;hl=nl&amp;geocode=&amp;q=Hogeschool+Rotterdam,+G.J.+de+Jonghweg,+Deelgemeente+Centrum,+Rotterdam&amp;aq=1&amp;oq=hog&amp;sll=51.908967,4.463413&amp;sspn=0.009028,0.01472&amp;g=G.J.+de+Jonghweg,+Deelgemeente+Centrum,+Rotterdam&amp;ie=UTF8&amp;hq=Hogeschool+Rotterdam,+G.J.+de+Jonghweg,+Deelgemeente+Centrum,+Rotterdam&amp;ll=51.910069,4.462519&amp;spn=0.013767,0.032015&amp;t=m&amp;output=embed"></iframe><br /><small><a href="http://maps.google.nl/maps?f=q&amp;source=embed&amp;hl=nl&amp;geocode=&amp;q=Hogeschool+Rotterdam,+G.J.+de+Jonghweg,+Deelgemeente+Centrum,+Rotterdam&amp;aq=1&amp;oq=hog&amp;sll=51.908967,4.463413&amp;sspn=0.009028,0.01472&amp;g=G.J.+de+Jonghweg,+Deelgemeente+Centrum,+Rotterdam&amp;ie=UTF8&amp;hq=Hogeschool+Rotterdam,+G.J.+de+Jonghweg,+Deelgemeente+Centrum,+Rotterdam&amp;ll=51.910069,4.462519&amp;spn=0.013767,0.032015&amp;t=m" style="color:#0000FF;text-align:left">Grotere kaart weergeven</a></small>
	</div>	
	
<?php $this->load->view('includes/footer') ?>
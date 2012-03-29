<?php $this->load->view('includes/header') ?>

	<div id="content">
		
		<table id="contactTable">
			<h1>Contact gegevens</h1><br>
			<tr><td><b>Adres</b></td><td><a href="http://maps.google.com/maps?q=G.J.+de+Jonghweg,+Deelgemeente+Centrum,+Nederland+4+-+6&hl=nl&ll=51.910113,4.462702&spn=0.011106,0.01929&sll=51.908967,4.463413&sspn=0.011106,0.01929&hnear=G.J.+de+Jonghweg+6,+Deelgemeente+Centrum,+Rotterdam,+Zuid-Holland,+Nederland&t=m&z=16"><?php print_r($contact[0]->adres); ?></a></td></tr>
			<tr><td><b>Postcode</b></td><td><?php print_r($contact[0]->postcode); ?></td></tr>
			<tr><td><b>Plaats</b></td><td><?php print_r($contact[0]->plaats); ?></td></tr>
			<tr><td><b>Land</b></td><td><?php print_r($contact[0]->land); ?></td></tr>
			<tr><td><b>Telefoon</b></td><td><?php print_r($contact[0]->telefoon); ?></td></tr>
			<tr><td><b>Fax</b></td><td><?php print_r($contact[0]->fax); ?></td></tr>
			<tr><td><b>Email</b></td><td><a href="mailto:contact@pizzario.nl"><?php print_r($contact[0]->email); ?></a></td></tr>
			<tr><td><b>Twitter</b></td><td><a href="http://www.twitter.com/pizzario"><?php print_r($contact[0]->twitter); ?></a></td></tr>
			<tr><td><b>Facebook</b></td><td><a href="http://www.facebook.com/pizzario"><?php print_r($contact[0]->facebook); ?></a></td></tr>
		</table>

		<div id="maps">
			<h2>Hier zijn wij te vinden</h2><br>
			<iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=nl&amp;geocode=&amp;q=G.J.+de+Jonghweg,+Deelgemeente+Centrum,+Nederland+4+-+6&amp;aq=&amp;sll=51.908961,4.46341&amp;sspn=0.011106,0.01929&amp;g=G.J.+de+Jonghweg,+Deelgemeente+Centrum,+Nederland&amp;ie=UTF8&amp;hq=&amp;hnear=G.J.+de+Jonghweg+6,+Deelgemeente+Centrum,+Rotterdam,+Zuid-Holland,+Nederland&amp;t=m&amp;ll=51.910391,4.462166&amp;spn=0.009266,0.018239&amp;z=15&amp;output=embed"></iframe><br /><small><a href="http://maps.google.com/maps?f=q&amp;source=embed&amp;hl=nl&amp;geocode=&amp;q=G.J.+de+Jonghweg,+Deelgemeente+Centrum,+Nederland+4+-+6&amp;aq=&amp;sll=51.908961,4.46341&amp;sspn=0.011106,0.01929&amp;g=G.J.+de+Jonghweg,+Deelgemeente+Centrum,+Nederland&amp;ie=UTF8&amp;hq=&amp;hnear=G.J.+de+Jonghweg+6,+Deelgemeente+Centrum,+Rotterdam,+Zuid-Holland,+Nederland&amp;t=m&amp;ll=51.910391,4.462166&amp;spn=0.009266,0.018239&amp;z=15" style="color:#0000FF;text-align:left">Grotere kaart weergeven</a></small>
		</div>	
		
	</div>
		
	
<?php $this->load->view('includes/footer') ?>
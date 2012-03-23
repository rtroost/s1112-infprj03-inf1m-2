<?php $this->load->view('includes/header') ?>

<?php
if(isset ($_GET['archiveer']))
{
		if($gebruikers == null)
	{
		echo ("Er zijn geen gearchiveerde gebruikers.");
	}
	
	for($i=0; $i < count($gebruikers); $i++)
	{
		$id++;
		echo "
		<div id=\"gebruikers\">
		<table id=\"gebruikerTable\">	
			<tr><td>GebruikerID</td><td><input id=\"beheer0".$id."\" name=\"gebruikerId\" class=\"beheerInput\" disabled value=\"".$gebruikers[$i]->gebruikerid ."\"</td></tr>
			<tr><td>TypeID</td><td><input id=\"beheer1".$id."\" disabled name=\"TypeId\" class=\"beheerInput\" value=\"".$gebruikers[$i]->typeid ."\"</td></tr>
			<tr><td>Voornaam</td><td><input id=\"beheer2".$id."\" disabled name=\"voornaam\" class=\"beheerInput\" value=\"".$gebruikers[$i]->voornaam ."\"</td></tr>
			<tr><td>Achternaam</td><td><input id=\"beheer3".$id."\" disabled name=\"achternaam\" class=\"beheerInput\" value=\"".$gebruikers[$i]->achternaam ."\"</td></tr>
			<tr><td>E-mail</td><td><input id=\"beheer4".$id."\" disabled name=\"email\" class=\"beheerInput\" value=\"".$gebruikers[$i]->email ."\"</td></tr>
			<tr><td>Adres1</td><td><input id=\"beheer5".$id."\" disabled name=\"adres1\" class=\"beheerInput\" value=\"".$gebruikers[$i]->adresregel_1 ."\"</td></tr>					
			<tr><td>Adres2</td><td><input id=\"beheer6".$id."\" disabled name=\"adres2\" class=\"beheerInput\" value=\"".$gebruikers[$i]->adresregel_2 ."\"</td></tr>
			<tr><td>Postcode</td><td><input id=\"beheer7".$id."\" disabled MAXLENGTH=\"6\" name=\"postcode\" class=\"beheerInput\" value=\"".$gebruikers[$i]->postcode ."\"</td></tr>
			<tr><td>Woonplaats</td><td><input id=\"beheer8".$id."\" disabled name=\"woonplaats\" class=\"beheerInput\" value=\"".$gebruikers[$i]->woonplaats ."\"</td></tr>
			<tr><td>Telefoonnummer</td><td><input id=\"beheer9".$id."\" disabled MAXLENGTH=\"10\" name=\"telefoonnummer\" class=\"beheerInput\" value=\"".$gebruikers[$i]->telefoonnummer ."\"</td></tr>
			<tr><td>Kortingspunten</td><td><input id=\"beheer10".$id."\" onchange=\"oldValue(".$id.", ".$gebruikers[$i]->kortingspunten.")\" disabled name=\"kortingspunten\" class=\"beheerInput\" value=\"".$gebruikers[$i]->kortingspunten ."\"</td></tr>					
			<tr><td><input name=\"wijzigGebruiker\" id=\"wijzigGebruiker".$id."\" style=\"width:110px\" onmousedown=\"wijzigGebruiker(".$id.")\" type=\"button\" value=\"Wijzig\"></td></tr>
			<tr><td><input name=\"archiveerGebruiker\" id=\"archiveerGebruiker".$id."\" style=\"width:110px\" onmousedown=\"archiveerGebruiker(".$id.")\" type=\"button\" value=\"Archiveer\"></td></tr>
		</table>
		</div>
		<td><div id=\"resultaat".$id."\"></div></td>
		&nbsp
		";
	}	
}

else{
	echo "
	
<div id=\"content\"> ";

	
	
	$id = 0;
	$gearchiveerd = 0;
	
	
echo "<div id=\"navigatie\">
		Gearchiveerd: <select id=\"test\" name=\"gearchiveerd\" style=\"width:100px\" onchange=\"paginaType(this)\">
			<option value=\"0\">Nee</option>
			<option value=\"1\">Ja</option>
		</select>
</div>";
	
		
	if($gebruikers == null)
	{
		echo ("Er zijn geen actieve gebruikers.");
	}
	
	for($i=0; $i < count($gebruikers); $i++)
	{
		$id++;
		echo "
		<div id=\"gebruikers\">
		<table id=\"gebruikerTable\">	
			<tr><td>GebruikerID</td><td><input id=\"beheer0".$id."\" name=\"gebruikerId\" class=\"beheerInput\" disabled value=\"".$gebruikers[$i]->gebruikerid ."\"</td></tr>
			<tr><td>TypeID</td><td><input id=\"beheer1".$id."\" disabled name=\"TypeId\" class=\"beheerInput\" value=\"".$gebruikers[$i]->typeid ."\"</td></tr>
			<tr><td>Voornaam</td><td><input id=\"beheer2".$id."\" disabled name=\"voornaam\" class=\"beheerInput\" value=\"".$gebruikers[$i]->voornaam ."\"</td></tr>
			<tr><td>Achternaam</td><td><input id=\"beheer3".$id."\" disabled name=\"achternaam\" class=\"beheerInput\" value=\"".$gebruikers[$i]->achternaam ."\"</td></tr>
			<tr><td>E-mail</td><td><input id=\"beheer4".$id."\" disabled name=\"email\" class=\"beheerInput\" value=\"".$gebruikers[$i]->email ."\"</td></tr>
			<tr><td>Adres1</td><td><input id=\"beheer5".$id."\" disabled name=\"adres1\" class=\"beheerInput\" value=\"".$gebruikers[$i]->adresregel_1 ."\"</td></tr>					
			<tr><td>Adres2</td><td><input id=\"beheer6".$id."\" disabled name=\"adres2\" class=\"beheerInput\" value=\"".$gebruikers[$i]->adresregel_2 ."\"</td></tr>
			<tr><td>Postcode</td><td><input id=\"beheer7".$id."\" disabled MAXLENGTH=\"6\" name=\"postcode\" class=\"beheerInput\" value=\"".$gebruikers[$i]->postcode ."\"</td></tr>
			<tr><td>Woonplaats</td><td><input id=\"beheer8".$id."\" disabled name=\"woonplaats\" class=\"beheerInput\" value=\"".$gebruikers[$i]->woonplaats ."\"</td></tr>
			<tr><td>Telefoonnummer</td><td><input id=\"beheer9".$id."\" disabled MAXLENGTH=\"10\" name=\"telefoonnummer\" class=\"beheerInput\" value=\"".$gebruikers[$i]->telefoonnummer ."\"</td></tr>
			<tr><td>Kortingspunten</td><td><input id=\"beheer10".$id."\" onchange=\"oldValue(".$id.", ".$gebruikers[$i]->kortingspunten.")\" disabled name=\"kortingspunten\" class=\"beheerInput\" value=\"".$gebruikers[$i]->kortingspunten ."\"</td></tr>					
			<tr><td><input name=\"wijzigGebruiker\" id=\"wijzigGebruiker".$id."\" style=\"width:110px\" onmousedown=\"wijzigGebruiker(".$id.")\" type=\"button\" value=\"Wijzig\"></td></tr>
			<tr><td><input name=\"archiveerGebruiker\" id=\"archiveerGebruiker".$id."\" style=\"width:110px\" onmousedown=\"archiveerGebruiker(".$id.")\" type=\"button\" value=\"Archiveer\"></td></tr>
		</table>
		</div>
		<td><div id=\"resultaat".$id."\"></div></td>
		&nbsp
		";
	}
	}
	?>
</div>

<?php $this->load->view('includes/footer') ?>
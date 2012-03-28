function plusAantal(id, prijs)
{
	document.getElementById("aantal"+id).value = parseInt(document.getElementById("aantal"+id).value) + 1
	totaalprijs = document.getElementById("aantal"+id).value * prijs / 100
	document.getElementById("totaal"+id).innerHTML = "&#8364;" + totaalprijs.toFixed(2)
	
}

function minAantal(id, prijs)
{
	if(document.getElementById("aantal"+id).value > 0)
	{
		document.getElementById("aantal"+id).value = parseInt(document.getElementById("aantal"+id).value) - 1
	}
		
	totaalprijs = document.getElementById("aantal"+id).value * prijs / 100
	document.getElementById("totaal"+id).innerHTML = "&#8364;" + totaalprijs.toFixed(2)
}

function manualAantal(id, prijs)
{			
	totaalprijs = document.getElementById("aantal"+id).value * prijs / 100
	document.getElementById("totaal"+id).innerHTML = "&#8364;" + totaalprijs.toFixed(2)	
		
	if(document.getElementById("totaal"+id).innerHTML.search('NaN') == 1 || document.getElementById("aantal"+id).value < 0)
		{
			document.getElementById("aantal"+id).value =0;
			totaalprijs = document.getElementById("aantal"+id).value * prijs / 100
			document.getElementById("totaal"+id).innerHTML = "&#8364;" + totaalprijs.toFixed(2)	
		}
}

function oldValue(id, oudeWaarde)
{
	if(isNaN(document.getElementById("beheer10"+id).value) == true)
		{ 
			document.getElementById("beheer10"+id).value = oudeWaarde;
		}
}

function updateWinkelwagen(naam, id, price)
{
	aantal = document.getElementById("aantal"+id).value
	if(window.XMLHttpRequest)
	{
		xmlhttp=new XMLHttpRequest();
	}
	else 
	{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}

	xmlhttp.onreadystatechange=function()
	{
		if(xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			
		}
	}
	
	xmlhttp.open("GET","ajax_cont?updateWagen=true&naam="+naam+"&id="+id+"&aantal="+aantal+"&prijs="+price,true);
	xmlhttp.send();
}

function getSearch()
{
	var status = document.getElementById("gebruikersType").value;
	var searchText = document.getElementById("zoekBeheer").value;
	
	xmlhttp=new XMLHttpRequest();
	xmlhttp.open("GET","ajax_cont?status="+status+"&search="+searchText, true);
	xmlhttp.send();
	
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
    		document.getElementById("gebruikers").innerHTML=xmlhttp.responseText;
    	}
	}
}

function wijzigGebruiker(id)
{
	if(document.getElementById("beheer1"+id).disabled == true)
	{
		for(i=1; i<=10; i++)
		{
			document.getElementById("beheer"+i+id).disabled = false;
		}
		
		document.getElementById("wijzigGebruiker"+id).value = "Opslaan";
	}
	else
	{
		if(window.XMLHttpRequest)
		{
			xmlhttp=new XMLHttpRequest();
		}
		else
		{
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
	
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				document.getElementById("resultaat"+id).innerHTML = "De gebruiker is aangepast en opgeslagen.";
			}
		}
		
		xmlhttp.open("GET","ajax_cont?wijzigGebruiker=waar&id="+document.getElementById("beheer0"+id).value+"&voornaam="+document.getElementById("beheer2"+id).value+"&achternaam="+document.getElementById("beheer3"+id).value+"&email="+document.getElementById("beheer4"+id).value+"&adres1="+document.getElementById("beheer5"+id).value+"&adres2="+document.getElementById("beheer6"+id).value+"&postcode="+document.getElementById("beheer7"+id).value+"&woonplaats="+document.getElementById("beheer8"+id).value+"&telefoon="+document.getElementById("beheer9"+id).value+"&korting="+document.getElementById("beheer10"+id).value, true);
		xmlhttp.send();
		
		for(i=1; i<=10; i++)
		{
			document.getElementById("beheer"+i+id).disabled = true;
		}
		
		document.getElementById("wijzigGebruiker"+id).value = "Wijzig";
	}
}

function archiveerGebruiker(id)
{
	var answer = confirm("Weet u zeker dat u de gebruiker wilt archiveren?")
	var status = document.getElementById("gebruikersType").value;
		if(answer)
		{
			xmlhttp=new XMLHttpRequest();
			xmlhttp.open("GET","ajax_cont?archiveer=waar&status="+status+"&id="+document.getElementById("beheer0"+id).value,true);
			xmlhttp.send();
		}
		
		xmlhttp.onreadystatechange=function()
			{
		  	if (xmlhttp.readyState==4 && xmlhttp.status==200)
    			{
    			document.getElementById("gebruikers").innerHTML=xmlhttp.responseText;
    			}
			}
}

function activeerGebruiker(id)
{
	var answer = confirm("Weet u zeker dat u de gebruiker wilt activeren?")
	var status = document.getElementById("gebruikersType").value;
	
		if(answer)
		{
			xmlhttp=new XMLHttpRequest();
			xmlhttp.open("GET","ajax_cont?activeer=waar&status="+status+"&id="+document.getElementById("beheer0"+id).value,true);
			xmlhttp.send();
		}
		
		xmlhttp.onreadystatechange=function()
			{
		  	if (xmlhttp.readyState==4 && xmlhttp.status==200)
    			{
    			document.getElementById("gebruikers").innerHTML=xmlhttp.responseText;
    			}
			}
}

function paginaType(sel)
{
	var value = sel.options[sel.selectedIndex].value;
	
	if(value == 1)
	{
		
		xmlhttp=new XMLHttpRequest();
		xmlhttp.open("GET","ajax_cont?archief=waar&status=1",true);
		xmlhttp.send();
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
    			document.getElementById("gebruikers").innerHTML=xmlhttp.responseText;
    		}
		}
	}
	
	if(value == 0)
	{
		xmlhttp=new XMLHttpRequest();
		xmlhttp.open("GET","ajax_cont?archief=waar&status=0",true);
		xmlhttp.send();
		
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
    			document.getElementById("gebruikers").innerHTML=xmlhttp.responseText;
    		}
		}
	}
}

function updateNews()
{
	var titel = document.getElementById("titelInput").value;
	var inhoud = document.getElementById("inhoudInput").value;
	
	if(document.getElementById("titelInput").disabled == true)
	{
			document.getElementById("titelInput").disabled = false;
			document.getElementById("titelInput").value = "";
			document.getElementById("inhoudInput").disabled = false;
			document.getElementById("inhoudInput").value = "";
			document.getElementById("cancelNews").disabled = false;
			document.getElementById("activateNews").value = "Opslaan";
	}
	else
	{
		if(window.XMLHttpRequest)
		{
			xmlhttp=new XMLHttpRequest();
		}
		else
		{
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
	
		xmlhttp.open("GET","ajax_cont?updateNews=waar&titel="+titel+"&inhoud="+inhoud, true);
		xmlhttp.send();
		
		document.getElementById("activateNews").disabled = true;
		document.getElementById("activateNews").value = "Voeg nieuws toe";
		
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				document.getElementById("newsOpgeslagen").innerHTML = "Het nieuws bericht is opgeslagen en nu zichtbaar op de homepage.";
			}
		}
	}
}

function cancelNews()
{
	if(document.getElementById("titelInput").disabled == false)
	{
		document.getElementById("titelInput").disabled = true;
		document.getElementById("titelInput").value = "Vul hier de titel in.";
			
		document.getElementById("inhoudInput").disabled = true;
		document.getElementById("inhoudInput").value = "Vul hier de inhoud in.";
			
		document.getElementById("cancelNews").disabled = true;
		document.getElementById("activateNews").value = "Voeg nieuws toe";
	}
}

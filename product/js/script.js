function plusAantal(id, prijs)
{
	document.getElementById("aantal"+id).value = parseInt(document.getElementById("aantal"+id).value) + 1
	document.getElementById("totaal"+id).innerHTML = document.getElementById("aantal"+id).value * prijs
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

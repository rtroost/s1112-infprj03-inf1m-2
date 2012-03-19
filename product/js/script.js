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

function updateWinkelwagen(id, price){
	aantal = document.getElementById("aantal"+id).value
	if (window.XMLHttpRequest){xmlhttp=new XMLHttpRequest();}
	else {xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}

	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
		}
	}
	
	xmlhttp.open("GET","updatewinkelwagen_cont?id="+id+"&aantal="+aantal+"&prijs="+price,true);
	xmlhttp.send();
}
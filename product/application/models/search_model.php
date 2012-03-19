<?php

class search_model extends CI_model{
	
	function getSearchProducten(){
		$categorienQ = $this->db->query("
		SELECT categorie.categorieid, categorie.naam, categorie.ingredienten, categorie.standaardprijs, categorie.gearchiveerd, categorie.omschrijving, categorie.image_klein, categorie.image_groot
		FROM categorie
		INNER JOIN product ON (categorie.categorieid = product.categorieid)
		INNER JOIN product_ingredient ON (product.productid = product_ingredient.productid)
		INNER JOIN categorie_ingredient ON (product_ingredient.catingid = categorie_ingredient.catingid)
		INNER JOIN ingredient ON (categorie_ingredient.ingredientid = ingredient.ingredientid)
		WHERE product.naam like '%".$_GET['search']."%' AND categorie.gearchiveerd != '1' and product.gearchiveerd != '1' OR categorie.naam like '%".$_GET['search']."%' AND categorie.gearchiveerd != '1' and product.gearchiveerd != '1' OR ingredient.naam like '%".$_GET['search']."%' AND categorie.gearchiveerd != '1' and product.gearchiveerd != '1'
		GROUP BY categorie.naam");
		
	  	if($categorienQ->num_rows() > 0){
	   		foreach($categorienQ->result() as $categorie){
	    
	    $productenQ = $this->db->query("
	    SELECT product.productid, product.naam, product.standaard, product.categorieid, product.gearchiveerd, product.temp
		FROM categorie
		INNER JOIN product ON (categorie.categorieid = product.categorieid)
		INNER JOIN product_ingredient ON (product.productid = product_ingredient.productid)
		INNER JOIN categorie_ingredient ON (product_ingredient.catingid = categorie_ingredient.catingid)
		INNER JOIN ingredient ON (categorie_ingredient.ingredientid = ingredient.ingredientid)
		WHERE product.naam like '%".$_GET['search']."%' AND categorie.gearchiveerd != '1' and product.gearchiveerd != '1' and product.categorieid = '".$categorie->categorieid ."' OR categorie.naam like '%".$_GET['search']."%' AND categorie.gearchiveerd != '1' and product.gearchiveerd != '1' and product.categorieid = '".$categorie->categorieid ."' OR ingredient.naam like '%".$_GET['search']."%' AND categorie.gearchiveerd != '1' and product.gearchiveerd != '1' and product.categorieid = '".$categorie->categorieid ."'
		GROUP BY product.naam");
		
		if($productenQ->num_rows() > 0){
	    	foreach($productenQ->result() as $product){
	     
	    $ingredientenQ = $this->db->query("SELECT ingredient.naam, product_ingredient.ingredienthoeveelheid, categorie_ingredient.prijs
		FROM categorie
		INNER JOIN product ON (categorie.categorieid = product.categorieid)
		INNER JOIN product_ingredient ON (product.productid = product_ingredient.productid)
		INNER JOIN categorie_ingredient ON (product_ingredient.catingid = categorie_ingredient.catingid)
		INNER JOIN ingredient ON (categorie_ingredient.ingredientid = ingredient.ingredientid)
		WHERE product.productid = '".$product->productid ."'");
				
			if($ingredientenQ->num_rows() > 0){
			    $i=0;
			    $prijs = 0;
				    foreach($ingredientenQ->result() as $ingredient){
					    $data[$categorie->naam][$product->naam][$i] = $ingredient->naam;
					    $prijs = $prijs+(($ingredient->ingredienthoeveelheid*0.5)*$ingredient->prijs);
					    $i++;        
				    }
				    $prijs = $categorie->standaardprijs+$prijs;
				    $data[$categorie->naam][$product->naam]['prijs'] = $prijs;
		    }
    		}
		}
	   	}
	 	}
	  		else{
				$data = null;
			}		
	  return $data;
 }
}

?>
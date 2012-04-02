<?php
// Deze model zorgt voor het genereren van data voor bestellijsten
class Bestellen_model extends CI_model{
	
	// Returned een array met bestellijst van alle producten die neit gemaakt zijn door admins en niet zijn gearchiveerd.
	// Returnde array bevat alle categorieen welke vervolgens alle producten bevat welke vervolgens alle ingredienten van het product bevat, prijs en image
	function getFullProducten(){
		$categorienQ = $this->db->query('select * from categorie where gearchiveerd = 0');
		if($categorienQ->num_rows() > 0){
			foreach($categorienQ->result() as $categorie){
				
				$productenQ = $this->db->query('select * from product 
				inner join gebruiker_product on (product.productid = gebruiker_product.productid)
				inner join gebruiker on (gebruiker_product.gebruikerid = gebruiker.gebruikerid)
				where categorieid = '.$categorie->categorieid .' and product.gearchiveerd = 0 and gebruiker.typeid = 2');
				if($productenQ->num_rows() > 0){
					foreach($productenQ->result() as $product){
						
						$ingredientenQ = $this->db->query('
						select ingredient.naam, product_ingredient.ingredienthoeveelheid, categorie_ingredient.prijs from product_ingredient
						inner join categorie_ingredient on (product_ingredient.catingid = categorie_ingredient.catingid)
						inner join ingredient on (categorie_ingredient.ingredientid = ingredient.ingredientid)
						where productid = '.$product->productid .'');
						if($ingredientenQ->num_rows() > 0){
							$i=0;
							$prijs = 0;
							foreach($ingredientenQ->result() as $ingredient){
								if($ingredient->ingredienthoeveelheid == 1) {$hoeveelheid = "(w)";};
								if($ingredient->ingredienthoeveelheid == 2) {$hoeveelheid = "(n)";};
								if($ingredient->ingredienthoeveelheid == 3) {$hoeveelheid = "(v)";};
								$data[$categorie->naam][$product->naam][$i]	= $hoeveelheid.$ingredient->naam;
								$prijs = $prijs+(($ingredient->ingredienthoeveelheid*0.5)*$ingredient->prijs);
								$i++;								
							}
							if($product->aanbieding == 1)
							{
								$prijs = $categorie->standaardprijs+$prijs;
								$prijs = $prijs*0.8;
							}
							else{
								$prijs = $categorie->standaardprijs+$prijs;
							}
							$data[$categorie->naam][$product->naam]['prijs'] = $prijs;
							$data[$categorie->naam][$product->naam]['id'] = $product->productid;
							if (file_exists("images/products/".$product->productid .".png")){
								$data[$categorie->naam][$product->naam]['plaatje'] = $product->productid .".png";
							}elseif(file_exists( base_url()."images/products/".$product->productid .".jpg")){
								$data[$categorie->naam][$product->naam]['plaatje'] = $product->productid .".jpg";
							}elseif(file_exists( base_url()."images/products/".$product->productid .".gif")){
								$data[$categorie->naam][$product->naam]['plaatje'] = $product->productid .".gif";
							}else{
								$data[$categorie->naam][$product->naam]['plaatje'] = "geenAfbeelding.png";
							}
						}
					}
				}
			}
		}
		return $data;
	}

	// Returned een array met bestellijst van alle producten die neit gemaakt zijn door admins en niet zijn gearchiveerd.
	// Returnde array bevat alle categorieen welke vervolgens alle producten bevat welke vervolgens alle ingredienten van het product bevat, prijs en image
	function getFullSelfmade(){
		$categorienQ = $this->db->query('select * from categorie where gearchiveerd = 0');
		if($categorienQ->num_rows() > 0){
			foreach($categorienQ->result() as $categorie){
				
				$productenQ = $this->db->query('select * from product 
				inner join gebruiker_product on (product.productid = gebruiker_product.productid)
				inner join gebruiker on (gebruiker_product.gebruikerid = gebruiker.gebruikerid)
				where categorieid = '.$categorie->categorieid .' and product.gearchiveerd = 0 and gebruiker.typeid != 2');
				if($productenQ->num_rows() > 0){
					foreach($productenQ->result() as $product){
						
						$ingredientenQ = $this->db->query('
						select ingredient.naam, product_ingredient.ingredienthoeveelheid, categorie_ingredient.prijs from product_ingredient
						inner join categorie_ingredient on (product_ingredient.catingid = categorie_ingredient.catingid)
						inner join ingredient on (categorie_ingredient.ingredientid = ingredient.ingredientid)
						where productid = '.$product->productid .'');
						if($ingredientenQ->num_rows() > 0){
							$i=0;
							$prijs = 0;
							foreach($ingredientenQ->result() as $ingredient){
								if($ingredient->ingredienthoeveelheid == 1) {$hoeveelheid = "(w)";};
								if($ingredient->ingredienthoeveelheid == 2) {$hoeveelheid = "(n)";};
								if($ingredient->ingredienthoeveelheid == 3) {$hoeveelheid = "(v)";};
								$data[$categorie->naam][$product->naam][$i]	= $hoeveelheid.$ingredient->naam;
								$prijs = $prijs+(($ingredient->ingredienthoeveelheid*0.5)*$ingredient->prijs);
								$i++;								
							}
							$prijs = $categorie->standaardprijs+$prijs;
							$data[$categorie->naam][$product->naam]['prijs'] = $prijs;
							$data[$categorie->naam][$product->naam]['id'] = $product->productid;
							if (file_exists("images/products/".$product->productid .".png")){
								$data[$categorie->naam][$product->naam]['plaatje'] = $product->productid .".png";
							}elseif(file_exists( base_url()."images/products/".$product->productid .".jpg")){
								$data[$categorie->naam][$product->naam]['plaatje'] = $product->productid .".jpg";
							}elseif(file_exists( base_url()."images/products/".$product->productid .".gif")){
								$data[$categorie->naam][$product->naam]['plaatje'] = $product->productid .".gif";
							}else{
								$data[$categorie->naam][$product->naam]['plaatje'] = "geenAfbeelding.png";
							}
						}
					}
				}
			}
		}
		return $data;
	}
}
?>
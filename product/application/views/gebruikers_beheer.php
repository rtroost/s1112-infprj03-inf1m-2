<<<<<<< .mine
<?php $this->load->view('includes/header') ?>

<div id="content">
	<?php
		for($i=0; $i < count($gebruikers); $i++)
		{
			echo "
			<table id=\"bestellijst\">
				<tr id=\"categorieRow\">
					<td id=\"categorieColumn\">".$gebruikers[$i]->voornaam ."</td>
					<td id=\"categorieColumn\">".$gebruikers[$i]->achternaam ."</td>
				</tr>
			</table>
			";
		}
	?>
</div>

<?php $this->load->view('includes/footer') ?>=======
<?php $this->load->view('includes/header') ?>

<?php
	print_r($gebruikers);
?>

<?php $this->load->view('includes/footer') ?>>>>>>>> .r53

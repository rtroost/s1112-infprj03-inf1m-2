<?php

class Test_model extends CI_model
{
	
	function getNews()
	{
		$news = $this->db->query('
		SELECT titel, inhoud
		FROM news
		');
		
		if ($news->num_rows() > 0)
		{
			$data = $news->result();
		}
		else
		{
			$data = null;
		}
		
		return $data;
	}
}

?>
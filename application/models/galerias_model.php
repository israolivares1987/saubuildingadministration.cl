<?php
class galerias_model extends CI_Model{

	var $table = 'galeriaimagenes';
	

	
	function listaCuadrosGraduacion()
	{

	  $this->db->select("archivo,archivo_thumb, directorio"); 
      $this->db->from($this->table);	
	  $this->db->where('directorio','cuadros');
	  $this->db->order_by('id', 'desc');
	  $Archivo = $this->db->get();

	  return  $Archivo->result();
	}



}
?>
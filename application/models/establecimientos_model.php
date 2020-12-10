<?php
class establecimientos_model extends CI_Model{

	var $table = 'establecimientos';
	

	
	function obtieneDatosEstablecimiento($id_establecimiento)
	{
	  $this->db->select("*"); 
      $this->db->from($this->table);	
	  $this->db->where('id_establecimiento',$id_establecimiento);
	  $Archivo = $this->db->get();
	  return  $Archivo->result();
	}

}
?>
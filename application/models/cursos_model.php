<?php
class cursos_model extends CI_Model{

	var $table = 'cursos_establecimientos';
	

	
	function obtieneDatosCurso($token)
	{
	  $this->db->select("*"); 
      $this->db->from($this->table);	
	  $this->db->where('token_curso',$token);
	  $Archivo = $this->db->get();
	  return  $Archivo->result();
	}

}
?>
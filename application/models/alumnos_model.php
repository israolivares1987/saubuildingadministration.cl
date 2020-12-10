<?php
class alumnos_model extends CI_Model{

	var $table = 'alumnos';
	

	
	function obtieneDatosAlumnos($id_establecimiento,$id_curso)
	{
	  $this->db->select("*"); 
      $this->db->from($this->table);
	  $this->db->where('id_establecimiento',$id_establecimiento);
	  $this->db->where('id_curso',$id_curso);
	  $Archivo = $this->db->get();
	  return  $Archivo->result();
	}

	function actualizaFotografiaAlumno($data,$where)
    {
		   $this->db->update($this->table, $data, $where);
		   $this->db->affected_rows();
		   
		   if ($this->db->affected_rows() > 0 ) {
			   return true; // Or do whatever you gotta do here to raise an error
		   } else {
			   return false;
		   }
	}

	function obtieneDatoAlumno($id_alumno,$id_establecimiento,$id_curso)
	{
	  $this->db->select("*"); 
      $this->db->from($this->table);
	  $this->db->where('id_establecimiento',$id_establecimiento);
	  $this->db->where('id_curso',$id_curso);
	  $this->db->where('id_alumno',$id_alumno);
	
	  $Archivo = $this->db->get();
	  return  $Archivo->result();
	}


}
?>
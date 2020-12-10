<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    /**
     * Carga plantilla vista
     *
     * @param array $param
	 * @param array $nav
     * @return void
     */
    public function plantilla_home($view, $datos = array()){

//		$this->load->view('home/header');
    //    $this->load->view('home/navbar');
        $this->load->view($view);
        //$this->load->view('home/footer'); 
	}


	

	public function creaDirectorio($directorio)
	{
		$retorno = false;
		$carpeta = $directorio;

		if (!file_exists($carpeta)) {
			mkdir($carpeta, 0777, true);
			$retorno = true;
		}

		return $retorno;
	}

	public function uploadFile($param){

		$retorno 		= false;
		$array_upload 	= array();

		$this->creaDirectorio('pro'.$param['userFile']['id_proyecto_or']);
				
		$config['upload_path'] 		= './uploads/pro'.$param['userFile']['id_proyecto_or'];
		$config['allowed_types'] 	= 'jpg|png|jpeg|pdf|dwg';
		$config['max_size'] 		= '10000';
		$config['file_name'] 		= $param['userFile']['file_name'];
		$config['overwrite'] 		= TRUE;

		#Recepcion de parametros input FILE
		$_FILES = array();
		$_FILES['userFile']['name'] 		= $param['userFile']['name'];
		$_FILES['userFile']['type'] 		= $param['userFile']['type'];
		$_FILES['userFile']['tmp_name']		= $param['userFile']['tmp_name'];
		$_FILES['userFile']['error'] 		= $param['userFile']['error'];
		$_FILES['userFile']['size'] 		= $param['userFile']['size'];

		$this->load->library('upload',$config);
		$this->upload->initialize($config);

		if($this->upload->do_upload('userFile')){
			
			#Contiene informaciónn de archivo subido$
			$retorno  = $this->upload->data();

		}else{

			$retorno = false;

			}
		

		return $retorno;

	}


}

/* End of file MY_Controller.php */

<?php
class Home extends MY_Controller{
  
  function __construct(){
    parent::__construct(); 
  
  }

  function index(){

    $this->plantilla_home('pages/login/login');
            
  }

  



}

?>
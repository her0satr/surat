<?php

class home extends CI_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
//		$this->User_model->login_user_store_required();
		
		$this->load->view( 'home' );
    }
}
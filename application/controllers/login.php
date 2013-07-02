<?php

class login extends CI_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'login' );
    }
	
	function signout() {
		$this->User_model->delete_session();
		header("Location: ".base_url('login'));
	}
}
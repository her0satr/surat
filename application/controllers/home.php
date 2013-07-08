<?php

class home extends PANEL_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'home' );
    }
	
	function upload() {
		$this->load->view( 'common/upload_single' );
	}
}
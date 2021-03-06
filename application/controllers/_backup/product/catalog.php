<?php

class catalog extends PANEL_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'panel/product/catalog' );
    }
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		// user
		$user = $this->User_model->get_session();
		
		$result = array();
		if ($action == 'update') {
			$_POST['store_id'] = $user['store_active']['store_id'];
			$result = $this->Catalog_model->update($_POST);
		} else if ($action == 'delete') {
			$result = $this->Catalog_model->delete($_POST);
		}
		
		echo json_encode($result);
	}
	
	function grid() {
		// user
		$user = $this->User_model->get_session();
		
		$_POST['column'] = array( 'title', 'name' );
		$_POST['store_id'] = $user['store_active']['store_id'];
		$output = array(
			"sEcho" => intval($_POST['sEcho']),
			"aaData" => $this->Catalog_model->get_array($_POST),
			"iTotalDisplayRecords" => $this->Catalog_model->get_count()
		);
		echo json_encode( $output );
	}
}
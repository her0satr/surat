<?php

class letter_type extends PANEL_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'master/letter_type' );
    }
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'update') {
			$result = $this->Letter_Type_model->update($_POST);
		} else if ($action == 'delete') {
			$result = $this->Letter_Type_model->delete($_POST);
		}
		
		echo json_encode($result);
	}
	
	function grid() {
		$_POST['is_edit'] = 1;
		$_POST['column'] = array( 'name' );
		
		$output = array(
			"sEcho" => intval($_POST['sEcho']),
			"aaData" => $this->Letter_Type_model->get_array($_POST),
			"iTotalDisplayRecords" => $this->Letter_Type_model->get_count()
		);
		
		echo json_encode( $output );
	}
}
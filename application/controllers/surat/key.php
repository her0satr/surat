<?php

class key extends PANEL_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'surat/key' );
    }
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'update') {
			$result = $this->Key_model->update($_POST);
		} else if ($action == 'delete') {
			$result = $this->Key_model->delete($_POST);
		}
		
		echo json_encode($result);
	}
	
	function grid() {
		$_POST['is_edit'] = 1;
		$_POST['column'] = array( 'name', 'code' );
		
		$output = array(
			"sEcho" => intval($_POST['sEcho']),
			"aaData" => $this->Key_model->get_array($_POST),
			"iTotalDisplayRecords" => $this->Key_model->get_count()
		);
		
		echo json_encode( $output );
	}
}
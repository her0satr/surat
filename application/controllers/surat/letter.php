<?php

class letter extends PANEL_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'surat/letter' );
    }
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'update') {
			if (is_array($_POST['array_file'])) {
				$_POST['letter_file'] = json_encode($_POST['array_file']);
			}
			
			$result = $this->Letter_model->update($_POST);
		} else if ($action == 'delete') {
			$result = $this->Letter_model->delete($_POST);
		}
		
		echo json_encode($result);
	}
	
	function grid() {
		$_POST['is_edit'] = 1;
		$_POST['column'] = array( 'id', 'letter_no', 'letter_type_name', 'source' );
		
		$output = array(
			"sEcho" => intval($_POST['sEcho']),
			"aaData" => $this->Letter_model->get_array($_POST),
			"iTotalDisplayRecords" => $this->Letter_model->get_count()
		);
		
		echo json_encode( $output );
	}
}
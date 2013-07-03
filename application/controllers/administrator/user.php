<?php

class user extends PANEL_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'administrator/user' );
    }
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'update') {
			if (!empty($_POST['passwd'])) {
				$_POST['passwd'] = EncriptPassword($_POST['passwd']);
			}
			
			$result = $this->User_model->update($_POST);
		} else if ($action == 'delete') {
			$result = $this->User_model->delete($_POST);
		}
		
		echo json_encode($result);
	}
	
	function grid() {
		$_POST['is_edit'] = 1;
		$_POST['column'] = array( 'name', 'email', 'user_type_name' );
		
		$output = array(
			"sEcho" => intval($_POST['sEcho']),
			"aaData" => $this->User_model->get_array($_POST),
			"iTotalDisplayRecords" => $this->User_model->get_count()
		);
		
		echo json_encode( $output );
	}
}
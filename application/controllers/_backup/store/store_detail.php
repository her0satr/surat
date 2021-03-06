<?php

class store_detail extends PANEL_Controller {
    function __construct() {
        parent::__construct();
    }
    
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'update') {
			$result = $this->Store_Detail_model->update($_POST);
		} else if ($action == 'delete') {
			$result = $this->Store_Detail_model->delete($_POST);
		}
		
		echo json_encode($result);
	}
	
	function grid() {
		$_POST['column'] = array(  'title', 'content' );
		$output = array(
			"sEcho" => intval($_POST['sEcho']),
			"aaData" => $this->Store_Detail_model->get_array($_POST),
			"iTotalDisplayRecords" => $this->Store_Detail_model->get_count()
		);
		echo json_encode( $output );
	}
}
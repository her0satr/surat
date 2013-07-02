<?php

class blog extends PANEL_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'panel/product/blog' );
    }
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'update') {
			$result = $this->Blog_model->update($_POST);
		} else if ($action == 'delete') {
			$result = $this->Blog_model->delete($_POST);
		}
		
		echo json_encode($result);
	}
	function grid() {
		$_POST['column'] = array( 'title', 'page_view' );
		$output = array(
			"sEcho" => intval($_POST['sEcho']),
			"aaData" => $this->Blog_model->get_array($_POST),
			"iTotalDisplayRecords" => $this->Blog_model->get_count()
		);
		echo json_encode( $output );
	}
}
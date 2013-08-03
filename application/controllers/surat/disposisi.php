<?php

class disposisi extends PANEL_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'surat/disposisi' );
    }
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'update') {
			$result = $this->Disposisi_model->update($_POST);
		} else if ($action == 'delete') {
			$result = $this->Disposisi_model->delete($_POST);
		}
		
		echo json_encode($result);
	}
	
	function grid() {
		$_POST['is_edit'] = 1;
		$_POST['column'] = array( 'id', 'user_name', 'no_agenda', 'date_letter', 'date_finish' );
		
		$output = array(
			"sEcho" => intval($_POST['sEcho']),
			"aaData" => $this->Disposisi_model->get_array($_POST),
			"iTotalDisplayRecords" => $this->Disposisi_model->get_count()
		);
		
		echo json_encode( $output );
	}
}
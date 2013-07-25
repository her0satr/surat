<?php

class letter_new extends PANEL_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'surat/letter_new' );
    }
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'update') {
			$result = $this->Letter_New_model->update($_POST);
		} else if ($action == 'delete') {
			$result = $this->Letter_New_model->delete($_POST);
		}
		
		echo json_encode($result);
	}
	
	function grid() {
		$_POST['is_edit'] = 1;
		$_POST['column'] = array( 'date_surat', 'letter_type_name', 'no_surat' );
		$_POST['is_custom']  = '<img class="button-cursor print" src="'.base_url('static/img/button_print.png').'"> ';
		
		$output = array(
			"sEcho" => intval($_POST['sEcho']),
			"aaData" => $this->Letter_New_model->get_array($_POST),
			"iTotalDisplayRecords" => $this->Letter_New_model->get_count()
		);
		
		echo json_encode( $output );
	}
	
	function cetak() {
		$this->load->view( 'surat/letter_cetak' );
	}
}
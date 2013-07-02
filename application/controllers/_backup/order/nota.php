<?php

class nota extends PANEL_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'panel/order/nota' );
    }
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'update') {
			$result = $this->Nota_model->update($_POST);
		} else if ($action == 'delete') {
			$result = $this->Nota_model->delete($_POST);
		}
		
		echo json_encode($result);
	}
	function grid() {
		$_POST['column'] = array( 'id', 'nota_date', 'nota_name', 'nota_currency_total', 'status_nota_name' );
		
		$output = array(
			"sEcho" => intval($_POST['sEcho']),
			"aaData" => $this->Nota_model->get_array($_POST),
			"iTotalDisplayRecords" => $this->Nota_model->get_count()
		);
		echo json_encode( $output );
	}
	
	function view() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		if ($action == 'product_list') {
			$view = 'panel/order/nota_product_list';
		}
		
		$this->load->view( $view );
	}
}
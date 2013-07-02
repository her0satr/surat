<?php

class item extends PANEL_Controller {
	function __construct() {
		parent::__construct();
	}
	
	function index() {
		$this->load->view( 'panel/product/item');
	}
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'get_item_by_id') {
			$result = $this->Item_model->get_by_id(array('id' => $_POST['id']));
		}
		else if ($action == 'update') {
			$_POST['update_date'] = $this->config->item('current_datetime');
			$result = $this->Item_model->update($_POST);
			
			// insert catalog
			$this->Item_Catalog_model->delete(array('item_id' => $result['id']));
			if (is_array($_POST['catalog_id'])) {
				foreach($_POST['catalog_id'] as $value) {
					$this->Item_Catalog_model->update(array('item_id' => $result['id'], 'catalog_id' => $value));
				}
			}
			
			// insert category
			$this->Item_Category_model->delete(array('item_id' => $result['id']));
			if (is_array($_POST['category_id'])) {
				foreach($_POST['category_id'] as $value) {
					$this->Item_Category_model->update(array('item_id' => $result['id'], 'category_id' => $value));
				}
			}
			
			// insert price
			$this->Item_Price_model->delete(array('item_id' => $result['id']));
			$this->Item_Price_model->update(array('item_id' => $result['id'], 'currency_id' => $_POST['currency_id'], 'price' => $_POST['price']));
			
			// insert picture
			$this->Item_Picture_model->delete(array('item_id' => $result['id']));
			if (isset($_POST['item_picture']) && is_array($_POST['item_picture'])) {
				foreach($_POST['item_picture'] as $value) {
					$picture = $this->Picture_model->update(array('picture_name' => $value));
					$this->Item_Picture_model->update(array('item_id' => $result['id'], 'picture_id' => $picture['id']));
				}
				
				// update thumbnail
				$this->Item_model->update(array('id' => $result['id'], 'thumbnail' => $value));
			}
		}
		else if ($action == 'delete') {
			$result = $this->Item_model->delete($_POST);
		}
		
		echo json_encode($result);
	}
	
	function grid() {
		// user
		$user = $this->User_model->get_session();
		
		$_POST['column'] = array( 'code', 'title', 'stock', 'discount' );
		$_POST['store_id'] = $user['store_active']['store_id'];
		$output = array(
			"sEcho" => intval($_POST['sEcho']),
			"aaData" => $this->Item_model->get_array($_POST),
			"iTotalDisplayRecords" => $this->Item_model->get_count()
		);
		echo json_encode( $output );
	}
}
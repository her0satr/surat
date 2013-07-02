<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cart_model extends CI_Model {
    function __construct() {
        parent::__construct();
		
		/*	Cart Info */
		/*	Cart Session
			name : user_cart => array(
				array( 'store_id' => 1, 'item_id' => 1, 'quantity' => 1 ),
				array( 'store_id' => 1, 'item_id' => 1, 'quantity' => 1 )
			)
			name : user_nota => array note
		/*	*/
    }
	
	function update_cart($param) {
		if (empty($param['item_id'])) {
			return;
		}
		
		$user_cart = $this->get_array();
		
		$is_avaliable_on_cart = false;
		foreach ($user_cart as $key => $item) {
			if (empty($item['item_id'])) {
				continue;
			} else if ($item['item_id'] == $param['item_id']) {
				$is_avaliable_on_cart = true;
				$user_cart[$key]['quantity'] = $param['quantity'];
			}
		}
		
		if (! $is_avaliable_on_cart) {
			$user_cart[] = $param;
		}
		
		$_SESSION['user_cart'] = $user_cart;
	}
	
	function get_array() {
		if (! isset($_SESSION['user_cart'])) {
			$_SESSION['user_cart'] = array();
		}
		
		return $_SESSION['user_cart'];
	}
	
	function get_count() {
		$array_cart = $this->get_array();
		return count($array_cart);
	}
	
	function get_item_id() {
		$list_item_id = 0;
		$array_cart = $this->get_array();
		foreach ($array_cart as $item) {
			if (empty($item['item_id'])) {
				continue;
			}
			
			$list_item_id = (empty($list_item_id)) ? $item['item_id'] : $list_item_id.','.$item['item_id'];
		}
		
		return $list_item_id;
	}
	
	function get_total_price() {
		$user_cart = $this->get_array();
		
		$result = array('price' => 0, 'currency' => '');
		foreach ($user_cart as $item) {
			if (empty($item['item_id'])) {
				continue;
			}
			
			$result['price'] += ($item['price_final'] * $item['quantity']);
			$result['currency'] = $item['currency_name'];
		}
		$result['price_label'] = $result['currency'].' '.$result['price'];
		
		return $result;
	}
	
	function delete_cart($param) {
		if (isset($param['is_clear']) && $param['is_clear'] == 1) {
			$user_cart = array();
		} else {
			$user_cart = $this->get_array();
			foreach ($user_cart as $key => $item) {
				if ($item['item_id'] == $param['item_id']) {
					unset($user_cart[$key]);
				}
			}
		}
		
		$_SESSION['user_cart'] = $user_cart;
	}
	
	/*	Region Cart Note */
	
	function update_cart_note($param) {
		foreach ($param as $key => $value) {
			$_SESSION['user_nota'][$key] = $value;
		}
	}
	
	function get_cart_note() {
		$user_note = (isset($_SESSION['user_nota'])) ? $_SESSION['user_nota'] : array();
		return $user_note;
	}
	
	function delete_cart_note() {
		$_SESSION['user_nota'] = array();
	}
	
	/*	End Region Cart Note */
}
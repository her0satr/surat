<?php

class ajax extends CI_Controller {
    function __construct() {
        parent::__construct();
    }
    
	function user() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		
		if ($action = 'login') {
			$user = $this->User_model->get_by_id(array( 'email' => $_POST['email'] ));
			
			$result = array( 'status' => false, 'message' => '' );
			if (count($user) == 0) {
				$result['message'] = 'Email anda tidak ditemukan.';
			} else if (EncriptPassword($_POST['passwd']) == $user['passwd']) {
				$result['status'] = true;
				$this->User_model->set_session($user);
			}
		}
		
		echo json_encode($result);
	}
}
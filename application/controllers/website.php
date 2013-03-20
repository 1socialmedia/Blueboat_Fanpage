<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require('functions.php');

class Website extends CI_Controller {
		
	function index()
	{
		$data = '';
		$this->load->view('website', $data);
		
	}
	
}


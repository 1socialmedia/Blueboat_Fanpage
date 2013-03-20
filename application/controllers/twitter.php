<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require('functions.php');

class Twitter extends CI_Controller {
		
	function index()
	{
		$data = '';
		$this->load->view('twitter', $data);
		
	}
	
}


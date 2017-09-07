<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$valid = $this->form_validation;
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$valid->set_rules('username','Username','required');
		$valid->set_rules('password','Password','required');
		if ($valid->run()) {
			$this->auth_login->login($username,$password,base_url('home'),base_url('login'));
		}
		$data = array('title' => 'Halaman Login');
		$this->load->view('login', $data);
	}

	public function logout() {
		$this->auth_login->logout();
	}
}
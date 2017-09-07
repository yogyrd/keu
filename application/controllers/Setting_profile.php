<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting_profile extends MY_Base_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('M_Setting_profile','setting');
    }

    public function index() {
        $data = array( 'title' => 'Setting Profile');
        $this->load->view('setting_profile', $data);
    }

    public function changePass() {
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required|matches[password]');
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('error_message', 'Password dan Konfirmasi Password Harus Sama!');
            header('Location: ' . $this->this_controller);
        }
        else
        {
            $pass = md5($this->input->post('password'));
            $this->setting->updateUser($pass);
            $this->session->set_flashdata('message', 'Password Berhasil Diubah');
            header('Location: ' . $this->this_controller);
        }
    }

}
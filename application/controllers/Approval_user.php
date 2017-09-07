<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Approval_user extends MY_Base_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('M_Approval_user','app');
    }

    public function index() {
        $data_trans = $this->app->getListTransNonApprov();
        $pass_data_baru_ke_view = ['list_trans'=>$data_trans];
        $this->addViewData($pass_data_baru_ke_view);

        parent::index();
    }

    public function update_status() {
        $userid = $this->session->userdata('id');
        $this->app->updateStatusTrans($userid);
        header('Location: ' . $this->this_controller);
    }

//    public function filter

}
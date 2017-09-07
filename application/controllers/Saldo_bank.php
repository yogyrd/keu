<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Saldo_bank extends MY_Base_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('M_Saldo_bank','saldo');
        $this->load->model('M_Master_bank','bank');
    }

    public function index() {
        $data_bank = $this->bank->getAllBank();
        $pass_data_baru_ke_view = ['list_bank'=>$data_bank];
        $this->addViewData($pass_data_baru_ke_view);

        parent::index();
    }

    public function insert_debet() {

    }

}
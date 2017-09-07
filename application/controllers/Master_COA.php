<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_COA extends MY_Base_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('M_Master_COA','coa');
    }

    public function index() {
        $data_coa = $this->coa->getAllAccounts();
        $data_level = $this->coa->getAllLevel();
        $pass_data_baru_ke_view = [
            'list_coa'      =>  $data_coa,
            'list_level'    =>  $data_level];
        $this->addViewData($pass_data_baru_ke_view);

        parent::index();
    }

    public function getParent() {
        echo $this->coa->getNewNoAkunParent() . '.000';
    }

    public function getKategori() {
        $lvl = $this->input->post('lvl');
        echo $this->coa->getAllKategoriByLevel($lvl);
    }
}
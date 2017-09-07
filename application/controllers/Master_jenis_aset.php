<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_jenis_aset extends MY_Base_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('M_Master_jenis_aset','mjenisaset');
    }

    public function index() {
        $data_jenisaset = $this->mjenisaset->getAllJenisAset();
        $pass_data_baru_ke_view = ['list_jenis'=>$data_jenisaset];
        $this->addViewData($pass_data_baru_ke_view);

        parent::index();
    }

}
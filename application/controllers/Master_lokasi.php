<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_lokasi extends MY_Base_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('M_Master_lokasi','lokasi');
    }

    public function index() {
        $data_lokasi = $this->lokasi->getAllLokasi();
        $pass_data_baru_ke_view = ['list_lokasi'=>$data_lokasi];
        $this->addViewData($pass_data_baru_ke_view);

        parent::index();
    }

}
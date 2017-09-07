<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_aset extends MY_Base_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('M_Master_aset','aset');
        $this->load->model('M_Master_lokasi','lokasi');
    }

    public function index() {
        $list_lokasi = $this->lokasi->getAllLokasi();
        $pass_data_baru_ke_view = [ 'list_lokasi'   =>  $list_lokasi];
        $this->addViewData($pass_data_baru_ke_view);

        parent::index();
    }



}
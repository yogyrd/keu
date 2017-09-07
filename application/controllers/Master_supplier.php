<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_supplier extends MY_Base_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('M_Master_supplier','supp');
    }

    public function index() {
        $list_lokasi = $this->supp->getAllLokasi();
        $data_supplier = $this->supp->getAllSupplier();
        $pass_data_baru_ke_view = ['list_lokasi'    =>  $list_lokasi,
                                    'list_supp'     =>  $data_supplier];
        $this->addViewData($pass_data_baru_ke_view);

        parent::index();
    }



}
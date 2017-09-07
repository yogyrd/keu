<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Approval2_penerimaan extends MY_Base_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('M_Approval2_penerimaan','app');
    }

    public function index() {
        $list_lokasi = $this->app->getAllLokasi();
        $loc = $this->input->post('filter_loc');
        $data_trans = $this->app->getListTransNonApprov2($loc);
        $location_ket = $this->app->getLocation($loc);
        $pass_data_baru_ke_view = [ 'list_trans'    =>  $data_trans,
                                    'list_lokasi'   =>  $list_lokasi,
                                    'location'      =>  $location_ket];
        $this->addViewData($pass_data_baru_ke_view);

        parent::index();
    }

    public function update_status() {
        $user = $this->session->userdata('username');
        $this->app->updateStatusTrans($user);
        header('Location: ' . $this->this_controller);
    }

}
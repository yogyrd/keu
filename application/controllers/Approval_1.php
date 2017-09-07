<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Approval_1 extends MY_Base_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('M_Approval_1','app');
        $this->load->model('M_Master_lokasi','lokasi');
    }

    public function index() {
        $list_lokasi = $this->lokasi->getAllLokasi();
        $loc = $this->input->post('filter_loc');
        $data_trans = $this->app->getListTransNonApprov($loc);
        $location_ket = $this->lokasi->getLokasiById($loc);
        $pass_data_baru_ke_view = ['list_trans'=>$data_trans,
                                    'list_lokasi' => $list_lokasi,
                                    'location' =>$location_ket];
        $this->addViewData($pass_data_baru_ke_view);

        parent::index();
    }

    public function update_status() {
        $userid = $this->session->userdata('id');
        $this->app->updateStatusTrans($userid);
        header('Location: ' . $this->this_controller);
    }

    public function reject_transaksi() {
        $userid = $this->session->userdata('id');
        $this->app->rejectTransaksi($userid);
        header('Location: ' . $this->this_controller);
    }
    
    public function view_approved() {
        $locid = $this->input->get('locid');
        $tgl1 = $this->input->get('tgl1');
        $tgl2 = $this->input->get('tgl2');
        $data_trans = $this->app->getListTransApprov($locid,$tgl1,$tgl2);
        $list_trans = array(
            'app1'          => true,
            'app2'          => false,
            'app3'          => false,
            'locid'         => $locid,
            'tgl1'          => $tgl1,
            'tgl2'          => $tgl2,
            'list'          => $data_trans
        );
        $this->load->view('view_approved', $list_trans);
    }

}
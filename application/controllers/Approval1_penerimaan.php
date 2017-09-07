<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Approval1_penerimaan extends MY_Base_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('M_Approval1_penerimaan','app');
    }

    public function index() {
        $list_lokasi = $this->app->getAllLokasi();
        $locid = $this->input->post('filter_loc');
        $tgl = $this->input->post('filter_tgl');
        $data_trans = $this->app->getListTransNonApprov($locid,$tgl);
        $location_ket = $this->app->getLocation($locid);
        $jenispenerimaan = $this->app->getJenisPenerimaan();
        $jenisbayar = $this->app->getJenisPembayaran();
        $kartu = $this->app->getKartu();
        $mesin = $this->app->getMesin();
        $pass_data_baru_ke_view = [ 'list_trans'    => $data_trans,
                                    'list_lokasi'   => $list_lokasi,
                                    'location'      => $location_ket,
                                    'tgl'           => $tgl,
                                    'locid'         => $locid,
                                    'list_jenispenerimaan'    => $jenispenerimaan,
                                    'list_jenisbayar'    => $jenisbayar,
                                    'list_kartu'    => $kartu,
                                    'list_mesin'    => $mesin];
        $this->addViewData($pass_data_baru_ke_view);

        parent::index();
    }

    public function update_status() {
        $tgl = $this->input->post('tgl');
        $locid = $this->input->post('locid');
        $user = $this->session->userdata('id');
        $this->app->updateStatusTrans($user, $tgl, $locid);
        header('Location: ' . $this->this_controller);
    }

}
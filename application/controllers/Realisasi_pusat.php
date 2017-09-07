<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Realisasi_pusat extends MY_Base_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('M_Realisasi_pusat','real');
    }

    public function index() {
        $list_lokasi = $this->real->getAllLokasi();
        $loc = $this->input->post('filter_loc');
        $bank = $this->input->post('bankid');
        $list_bank = $this->real->getAllBank();
        $lokasi = $this->real->getLocationById($loc);
        $list_realisasi = $this->real->getListTransNonReal($loc);
        $namabank = $this->real->getBankById($bank);
        $pass_data_baru_ke_view = [ 'list_lokasi' => $list_lokasi,
                                    'list_bank'       => $list_bank,
                                    'location'        => $lokasi,
                                    'locid'           => $loc,
                                    'bankid'          => $bank,
                                    'bank'            => $namabank,
                                    'list_trans'      => $list_realisasi];
        $this->addViewData($pass_data_baru_ke_view);

        parent::index();
    }

    public function update_status() {
        $userid = $this->session->userdata('id');
        $this->real->updateStatusRealisasi($userid);
        header('Location: ' . $this->this_controller);
    }



}
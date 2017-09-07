<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_jurnal extends MY_Base_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('M_Master_jurnal','jurnal');
    }

    public function index() {
        $data_jenispengeluaran = $this->jurnal->getJenisPengeluaran();
        $data_jenispenerimaan = $this->jurnal->getJenisPenerimaan();
        $data_akun = $this->jurnal->getAllAkun();
        $data_jurnal = $this->jurnal->getAllDataJurnal();
        $pass_data_baru_ke_view = [ 'list_pengeluaran'  =>  $data_jenispengeluaran,
                                    'list_penerimaan'   =>  $data_jenispenerimaan,
                                    'list_akun'         =>  $data_akun,
                                    'list_jurnal'       =>  $data_jurnal];
        $this->addViewData($pass_data_baru_ke_view);

        parent::index();
    }
	
	public function simpan() {
        $userid = $this->session->userdata('id');

        if (!$jenisid) {
            $this->jurnal->simpanHeaderDetil($userid);
            header('Location: ' . $this->this_controller);
        } else {
            $this->jurnal->updateHeaderDetil($userid);
            header('Location: ' . $this->this_controller);
        }
	}

}
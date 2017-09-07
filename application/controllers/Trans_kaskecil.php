<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trans_kaskecil extends MY_Base_Controller {

	function __construct() {
		parent::__construct();
        $this->load->model('M_Trans_kas','trans_kas');
	}

	public function index() {
        $locid              = $this->session->userdata('locid');
        $list_cash          = $this->trans_kas->getPengeluaranCash($locid);
        $list_pengajuan     = $this->trans_kas->getPengeluaranPengajuan($locid);
        $data_transkaskecil = $this->trans_kas->getAllTransKaskecil($locid);
        $data_transpengajuan= $this->trans_kas->getAllTransPengajuan($locid);
        $pass_data_baru     = [
            'list_transpengajuan'   =>  $data_transpengajuan,
            'list_transkaskecil'    =>  $data_transkaskecil,
            'list_cash'             =>  $list_cash,
            'list_pengajuan'        =>  $list_pengajuan];
        $this->addViewData($pass_data_baru);
        parent::index();
	}

    public function loadTotalPengeluaran() {
        $pengajuan = $this->input->post('pengajuan');
        if($pengajuan == 0) {
            $locid = $this->input->post('locid');
            $outid = $this->input->post('outid');
            echo $this->trans_kas->getTotalPengeluaran($locid,$outid);
        }
    }

    public function getSaldo() {
        $locid = $this->input->post('locid');
        echo $this->trans_kas->getSaldo($locid);
    }

}
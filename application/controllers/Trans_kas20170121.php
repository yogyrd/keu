<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trans_kas extends MY_Base_Controller {

	function __construct() {
		parent::__construct();
        $this->load->model('M_Trans_kas','trans_kas');
	}

	public function index() {
        $list_lokasi = $this->trans_kas->getAllLokasi();

        $pass_data_baru_ke_view = [ 'lokasi'        =>  $list_lokasi];
        $this->addViewData($pass_data_baru_ke_view);

        $locid = ucfirst($this->session->userdata('locid'));
        $data_trans = $this->trans_kas->getAllTransPengeluaran($locid);
        $pass_data_baru = ['list_trans'=>$data_trans];
        $this->addViewData($pass_data_baru);
        parent::index();
	}

	public function loadJenis() {
        $modul = $this->input->post('modul');
        if ($modul=="groupjenis") {
            $id = $this->input->post('id');
            echo $this->trans_kas->getAllGroupJenisByLocId($id);
        }
        elseif ($modul=="jenis") {
            $locid = $this->input->post('locid');
            $costid = $this->input->post('costid');
            echo $this->trans_kas->getAllJenisByGroup($locid,$costid);
        }
    }

    public function loadNilaimax() {
        $nilaimax = $this->input->post('nilaimax');
        if($nilaimax == "groupjenis") {
            $locid = $this->input->post('locid');
            $costid = $this->input->post('costid');
            echo $this->trans_kas->getNilaimaxGroupJenis($locid,$costid);
        }
        elseif($nilaimax == "jenis") {
            $locid = $this->input->post('locid');
            $costid = $this->input->post('costid');
            $outid = $this->input->post('outid');
            echo $this->trans_kas->getNilaimaxJenis($locid,$costid,$outid);
        }
    }

    public function loadTotalPengeluaran() {
        $total = $this->input->post('total');
        if($total == "pengeluaran") {
            $locid = $this->input->post('locid');
            $costid = $this->input->post('costid');
            echo $this->trans_kas->getTotalPengeluaran($locid,$costid);
        }
    }


}
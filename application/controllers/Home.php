<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Base_Controller {

	function __construct() {
		parent::__construct();
        $this->load->model('M_Home','home');
        $this->load->model('M_Master_lokasi','mlokasi');
	}

	public function index() {
        $userlocid = $this->session->userdata('locid');
        $data_trans = $this->home->getAllTransByLocid($userlocid);
        $data_reject = $this->home->getAllTransRejected($userlocid);
        $data_realisasi = $this->home->getAllTransRealized($userlocid);
        $data_lokasi = $this->mlokasi->getAllLokasi();
        $pass_data_baru_ke_view = [
            'list_lokasi'   => $data_lokasi,
            'list_trans'    => $data_trans,
            'list_realisasi'=> $data_realisasi,
            'list_reject'   => $data_reject];
        $this->addViewData($pass_data_baru_ke_view);
        parent::index();
	}

}
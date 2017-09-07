<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rpt_penerimaan extends MY_Base_Controller {

	function __construct() {
            parent::__construct();
            $this->load->model('M_Rpt_penerimaan','income');
	}

	public function index() {
//        $list_lokasi = $this->income->getAllLokasi();
//        $pass_data_baru_ke_view = [
//            'list_lokasi'       => $list_lokasi];
//        $this->addViewData($pass_data_baru_ke_view);

        parent::index();
	}

    public function filter() {
//        $locid = $this->input->get('locid');
        $tgl1 = $this->input->get('tgl1');
        $tgl2 = $this->input->get('tgl2');
//        $locket = $this->income->getLocationById($locid);
        $data_lokasi = $this->income->getLokasi();
        $data_trans = array(
//            'locid'         => $locid,
//            'locationket'   => $locket,
            'list_lokasi'   => $data_lokasi,
            'tgl1'          => $tgl1,
            'tgl2'          => $tgl2,
            'title'         => ''
        );
        $this->load->view('filter_penerimaan', $data_trans);

    }


}
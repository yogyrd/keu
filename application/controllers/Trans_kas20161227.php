<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trans_kas extends MY_Base_Controller {

	function __construct() {
		parent::__construct();
        $this->load->model('M_Trans_kas','trans_kas');
	}

	public function index() {
        $list_lokasi = $this->trans_kas->getAllLokasi();
        $list_groupjenis = $this->trans_kas->getAllGroupJenisPengeluaran();
        $list_jenispengeluaran1 = $this->trans_kas->getAllJenisPengeluaranByGroup1();
        $list_jenispengeluaran2 = $this->trans_kas->getAllJenisPengeluaranByGroup2();
        $list_jenispengeluaran3 = $this->trans_kas->getAllJenisPengeluaranByGroup3();
        $list_jenispengeluaran4 = $this->trans_kas->getAllJenisPengeluaranByGroup4();
        $list_jenispengeluaran5 = $this->trans_kas->getAllJenisPengeluaranByGroup5();
        $pass_data_baru_ke_view = ['lokasi' =>  $list_lokasi,
                                    'groupjenis' => $list_groupjenis,
                                    'list_1' => $list_jenispengeluaran1,
                                    'list_2' => $list_jenispengeluaran2,
                                    'list_3' => $list_jenispengeluaran3,
                                    'list_4' => $list_jenispengeluaran4,
                                    'list_5' => $list_jenispengeluaran5,];
        $this->addViewData($pass_data_baru_ke_view);

        $locid = ucfirst($this->session->userdata('locid'));
        $data_trans = $this->trans_kas->getAllTransPengeluaran($locid);
        $pass_data_baru = ['list_trans'=>$data_trans];
        $this->addViewData($pass_data_baru);
        parent::index();
	}

}
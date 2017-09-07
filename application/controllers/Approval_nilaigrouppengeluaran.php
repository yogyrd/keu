<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Approval_nilaigrouppengeluaran extends MY_Base_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('M_Approval_nilaigrouppengeluaran','nilai');
    }

    public function index() {
        $loc = $this->input->post('filter_loc');
        $group = $this->input->post('filter_group');
        $list_lokasi = $this->nilai->getAllLokasi($loc);
        $list_groupjenis = $this->nilai->getAllGroupJenis();
        $location_ket = $this->nilai->getLocationById($loc);
        $list_nilai = $this->nilai->getAllNilaiJenisGroupPengeluaran($loc,$group);
        $pass_data_baru_ke_view = [ 'list_lokasi'       => $list_lokasi,
                                    'list_groupjenis'   => $list_groupjenis,
                                    'lokasi'            => $location_ket,
                                    'locid'         => $loc,
                                    'list_nilai'        => $list_nilai];
        $this->addViewData($pass_data_baru_ke_view);

        parent::index();
    }

    public function lock_budget() {
        $userid = $this->session->userdata('id');
        $this->nilai->lockBudget($userid);
        header('Location: ' . $this->this_controller);
    }

}
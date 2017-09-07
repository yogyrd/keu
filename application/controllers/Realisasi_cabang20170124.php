<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Realisasi_cabang extends MY_Base_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('M_Realisasi_cabang','app');
    }

    public function index() {
        $list_lokasi = $this->app->getAllLokasi();
        $locid = $this->input->post('filter_loc');
        $data = $this->app->getListTransNonReal($locid);
        $location_ket = $this->app->getLocationById($locid);
        $pass_data_baru_ke_view = [ 'list_lokasi' => $list_lokasi,
                                    'list_trans'=>$data,
                                    'locid'     => $locid,
                                    'location' => $location_ket];
        $this->addViewData($pass_data_baru_ke_view);

        parent::index();
    }
    
    public function filterByLocation() {
        $locid = $this->input->get('locid');
        $data = $this->app->getListTransNonReal($locid);
        $location_ket = $this->app->getLocationById($locid);
        log_message('error','sampek sini');
        $pass_data_baru_ke_view = ['list_trans'=>$data,
                                    'location' => $location_ket];
          log_message('error','sampek sini2');                          
        $this->addViewData($pass_data_baru_ke_view);
    }

    public function update_status() {
        $userid = $this->session->userdata('id');
        $this->app->updateStatusRealisasi($userid);
        header('Location: ' . $this->this_controller);
    }

}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Retur_pengajuan extends MY_Base_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('M_Retur_pengajuan','retur');
    }

    public function index() {
        $locid = $this->session->userdata('locid');
        $grup_user = $this->session->userdata('grp');
        $data_pengajuan = $this->retur->getDataPengajuan($locid,$grup_user);
        $data_retur     = $this->retur->getDataRetur();
        $pass_data_baru_ke_view = [
            'list_pengajuan'    =>  $data_pengajuan,
            'list_retur'        =>  $data_retur
        ];
        $this->addViewData($pass_data_baru_ke_view);

        parent::index();
    }
    
    public function save() {
        $transoutid = $this->input->post('transoutid');
        $returnilai = floatval($this->input->post('nilaiuangretur'));
        $realisasi  = floatval($this->input->post('realisasi'));
        $retur = $realisasi - $returnilai;
        $bankid = $this->input->post('bankid');
        $locid = $this->input->post('locid');
        $keterangan = $this->input->post('keterangan');
        $nofaktur = $this->input->post('nofaktur');
        $this->retur->insertRetur($transoutid, $retur, $bankid, $locid, $keterangan, $nofaktur);
        header('Location: ' . $this->this_controller);
    }
    
    public function delete() {
        $incomeid = $this->input->get('id');
        $this->retur->deleteRetur($incomeid);
        header('Location: ' . $this->this_controller);
    }
    
    public function load() {
        $incomeid = $this->input->get('id');
        $this->retur->loadRetur($incomeid);
        header('Location: ' . $this->this_controller);
    }

}
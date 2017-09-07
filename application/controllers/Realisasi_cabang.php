<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Realisasi_cabang extends MY_Base_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('M_Realisasi_cabang','real');
    }

    public function index() {
        $list_lokasi = $this->real->getAllLokasi();
        $loc = $this->input->post('filter_loc');
        $bank = $this->input->post('bankid');
        $bankidin = $this->input->post('bankidin');
        $list_bank = $this->real->getAllBank();
        $lokasi = $this->real->getLocationById($loc);
        $namabank = $this->real->getBankById($bank);
        $list_realisasi = $this->real->getListTransNonReal($loc);
        $pass_data_baru_ke_view = [ 'list_lokasi' => $list_lokasi,
                                    'list_bank'       => $list_bank,
                                    'location'        => $lokasi,
                                    'locid'           => $loc,
                                    'bank'            => $namabank,
                                    'bankin'          => $bankidin,
                                    'bankid'          => $bank,
                                    'list_trans'      => $list_realisasi];
        $this->addViewData($pass_data_baru_ke_view);

        parent::index();
    }

    public function cetakKasKecil() {
        $userid = $this->session->userdata('id');
        $transoutid = $this->input->get('id');
        $notrans = $this->real->getNoTrans($transoutid);
        $locid = $this->real->getLocid($transoutid);
        $tgltrans = $this->real->getTglTrans($transoutid);
        $tglrealisasi = $this->real->getTglRealisasi($transoutid);
        $data_trans = $this->real->getDataTrans($transoutid);
        $location_ket = $this->real->getLocationById($locid);
        $list = array(
            'list_trans'    => $data_trans,
            'locationket'   => $location_ket,
            'notrans'       => $notrans,
            'tglrealisasi'  => $tglrealisasi,
            'tgltrans'      => $tgltrans);
        $this->real->closeTransaksi($userid, $transoutid);
//        cetak bkk
//        $this->load->view('report/rpt_pdf_voucher', $list);
        $this->load->library('pdf');
        log_message('debug','JN::RPT_PDF ' . json_encode($list));
        $html = $this->load->view('report/rpt_pdf_voucher', $list, true);
        $m_pdf = new Pdf;
        $m_pdf->pdf_create_85x55($html, 'rpt_pdf_voucher_' . date('YmdHis'));
    }

    public function update_status() {
        $userid = $this->session->userdata('id');
        $this->real->updateStatusRealisasi($userid);
        header('Location: ' . $this->this_controller);
    }



}
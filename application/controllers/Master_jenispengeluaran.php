<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_jenispengeluaran extends MY_Base_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('M_Master_jenispengeluaran','jenis');
    }

    public function index() {
        $data_jenis = $this->jenis->getAllJenisPengeluaran();
        $data_group = $this->jenis->getAllGroupPengeluaran();
        $list_lokasi = $this->jenis->getAllLokasi();
        $pass_data_baru_ke_view = ['list_data'=>$data_jenis,
                                    'list_group'=>$data_group,
                                    'lokasi' => $list_lokasi];
        $this->addViewData($pass_data_baru_ke_view);
        parent::index();
    }

    public function cetak_jenispengeluaran() {
        $data_group = $this->jenis->getAllJenisSortByName();
        $list = array( 'list_data' => $data_group);
//        $this->load->view('report/rpt_pdf_jenispengeluaran', $list);
        $this->load->library('pdf');
        log_message('debug','JN::RPT_PDF ' . json_encode($list));
        $html = $this->load->view('report/rpt_pdf_jenispengeluaran', $list, true);
        $m_pdf = new Pdf;
        $m_pdf->pdf_create($html, 'rpt_pdf_jenispengeluaran' . date('YmdHis'));
    }

}
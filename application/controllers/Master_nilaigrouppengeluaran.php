<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_nilaigrouppengeluaran extends MY_Base_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('M_Master_nilaigrouppengeluaran','nilai');
    }

    public function index() {
        $loc = $this->input->post('filter_loc');
        $list_lokasi = $this->nilai->getAllLokasi($loc);
        $location_ket = $this->nilai->getLocationById($loc);
        $list_groupjenis = $this->nilai->getAllNilaiJenisGroupPengeluaran($loc);
        $pass_data_baru_ke_view = [ 'list_lokasi'       => $list_lokasi,
                                    'locid'             => $loc,
                                    'lokasi'            => $location_ket,
                                    'list_groupjenis'   => $list_groupjenis];
        $this->addViewData($pass_data_baru_ke_view);

        parent::index();
    }

    public function insert_cutoff() {
        $userid = $this->session->userdata('id');
        $this->nilai->updateMaster($userid);
        header('Location: ' . $this->this_controller);
    }

    public function cetak_nilaipengeluarangroup() {
        $locid = $this->input->get('locid');
        $list_report = $this->nilai->getDataReportNilaiGroupJenis($locid);
        $location_ket = $this->nilai->getLocationById($locid);
        $list = array( 'list_data' => $list_report,
            'locationket'   => $location_ket);
//        $this->load->view('report/rpt_pdf_nilaigrouppengeluaran', $list);
        $paper = 'F4';
        $this->load->library('pdf');
        log_message('debug','JN::RPT_PDF ' . json_encode($list));
        $html = $this->load->view('report/rpt_pdf_nilaigrouppengeluaran', $list, true, $paper);
        $m_pdf = new Pdf;
        $m_pdf->pdf_create($html, 'rpt_nilaigrouppengeluaran_' . date('YmdHis'));
    }

    public function export_to_excel() {
        $locid = $this->input->get('locid');
        $list_report = $this->nilai->getDataReportNilaiGroupJenis($locid);
        $title = 'rpt_nilaigrouppengeluaran_'. $locid . '_' . date('YmdHis');
        $list = array( 'list_data'      => $list_report,
            'title'         => $title);
        $this->load->view('report/rpt_csv_nilaigrouppengeluaran', $list);
    }

}
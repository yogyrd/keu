<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_nilaidetilpengeluaran extends MY_Base_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('M_Master_nilaidetilpengeluaran','nilai');
    }

    public function index() {
        $loc = $this->input->post('filter_loc');
        $group = $this->input->post('filter_group');
        $list_lokasi = $this->nilai->getAllLokasi($loc);
        $list_groupjenis = $this->nilai->getAllGroupJenis();
        $location_ket = $this->nilai->getLocationById($loc);
        $list_nilai = $this->nilai->getAllNilaiJenisDetilPengeluaran($loc,$group);
        $pass_data_baru_ke_view = [ 'list_lokasi'       => $list_lokasi,
                                    'list_groupjenis'   => $list_groupjenis,
                                    'lokasi'            => $location_ket,
                                    'locid'         => $loc,
                                    'list_nilai'        => $list_nilai];
        $this->addViewData($pass_data_baru_ke_view);

        parent::index();
    }

    public function insert_cutoff() {
        $userid = $this->session->userdata('id');
        $this->nilai->updateMaster($userid);
        header('Location: ' . $this->this_controller);
    }

    public function cetak_nilaijenispengeluaran() {
        $locid = $this->input->get('locid');
        $group = $this->input->get('filter_group');
        $list_report = $this->nilai->getAllNilaiJenisDetilPengeluaran($locid,$group);
        $location_ket = $this->nilai->getLocationById($locid);
        $list = array( 'list_data' => $list_report,
                        'locationket'   => $location_ket);
//        $this->load->view('report/rpt_pdf_nilaidetailpengeluaran', $list);
        $paper = 'F4';
        $this->load->library('pdf');
        log_message('debug','JN::RPT_PDF ' . json_encode($list));
        $html = $this->load->view('report/rpt_pdf_nilaidetailpengeluaran', $list, true, $paper);
        $m_pdf = new Pdf;
        $m_pdf->pdf_create($html, 'rpt_nilaidetailpengeluaran_' . date('YmdHis'));
    }

    public function export_to_excel() {
        $locid = $this->input->get('locid');
        $group = $this->input->get('filter_group');
        $list_report = $this->nilai->getDataReportNilaiJenis($locid, $group);
        $title = 'rpt_nilaidetailpengeluaran_' . date('YmdHis');
        $list = array( 'list_data'      => $list_report,
                        'title'         => $title);
        $this->load->view('report/rpt_csv_nilaidetailpengeluaran', $list);
    }

}
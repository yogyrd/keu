<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rpt_kaskecil extends MY_Base_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('M_Rpt_kaskecil','mrpt');
        $this->load->model('M_Master_lokasi','mlok');
    }

    public function index() {
        $list_lokasi = $this->mlok->getAllLokasi();
        $pass_data_baru_ke_view = ['list_lokasi'    => $list_lokasi];
        $this->addViewData($pass_data_baru_ke_view);

        parent::index();
    }

    public function filter() {
        $locid = $this->input->get('locid');
        $option = $this->input->get('option');
        $tgloption = $this->input->get('tgloption');
        $tgl1 = $this->input->get('tgl1');
        $tgl2 = $this->input->get('tgl2');
        $locket = $this->mlok->getLokasiById($locid);
        $list_trans = array(
            'locid'         => $locid,
            'locationket'   => $locket,
            'tgloption'     => $tgloption,
            'tgl1'          => $tgl1,
            'tgl2'          => $tgl2
        );
        if ($option == 1) {
            $data_trans = $this->mrpt->getDataKasKecilNoReal($locid,$tgloption,$tgl1,$tgl2);
            $list_trans = array_merge($list_trans, array('list' => $data_trans));
            $this->load->view('view_rptkaskecilnoreal', $list_trans);
        } elseif ($option ==2) {
            $data_trans = $this->mrpt->getDataKasKecilReal($locid,$tgloption,$tgl1,$tgl2);
            $list_trans = array_merge($list_trans, array('list' => $data_trans));
            $this->load->view('view_rptkaskecilreal', $list_trans);
        }

    }

    public function getStringTglOption($tgloption) {
        if ($tgloption=='createddate') {
            $tgloptionstring = "Tanggal Input";
        } elseif ($tgloption=='transtgl') {
            $tgloptionstring = "Tanggal Transaksi";
        } elseif ($tgloption=='realisasidate') {
            $tgloptionstring = "Tanggal Realisasi";
        }

        return $tgloptionstring;
    }

    public function print_kaskecil() {
        $tgl1 = $this->input->get('tgl1');
        $tgl2 = $this->input->get('tgl2');
        $locid = $this->input->get('locid');
        $locket = $this->mlok->getLokasiById($locid);
        $tgloption = $this->input->get('tgloption');
        $tgloptionstring = $this->getStringTglOption($tgloption);
        $list_trans = array(
            'locid'         => $locid,
            'locationket'   => $locket,
            'tgloption'     => $tgloptionstring,
            'tgl1'          => $tgl1,
            'tgl2'          => $tgl2
        );
        $data_trans = $this->mrpt->getDataKasKecilNoReal($locid,$tgloption,$tgl1,$tgl2);
        $list_trans = array_merge($list_trans, array('list' => $data_trans));
        $this->load->view('report/rpt_pdf_kaskecil', $list_trans);
//        $html = $this->load->view('report/rpt_pdf_kaskecil', $list_trans,TRUE);
//
//        $this->load->library('m_pdf');
//        $pdf=$this->m_pdf->load();
//        $pdf->SetFooter(''.'|{PAGENO}|'.''); //Add a footer for good measure
//        $pdf->WriteHTML($html); //write the HTML into PDF
//        $pdf->Output();
    }

    public function print_realized() {
        $tgl1 = $this->input->get('tgl1');
        $tgl2 = $this->input->get('tgl2');
        $locid = $this->input->get('locid');
        $locket = $this->rpt->getLocationById($locid);
        $tgloption = $this->input->get('tgloption');
        $tgloptionstring = $this->getStringTglOption($tgloption);
        $list_trans = array(
            'locid'         => $locid,
            'locationket'   => $locket,
            'tgloption'     => $tgloptionstring,
            'tgl1'          => $tgl1,
            'tgl2'          => $tgl2
        );
        $data_trans = $this->rpt->getAllDataKasKecilRealized($locid,$tgloption,$tgl1,$tgl2);
        $list_trans = array_merge($list_trans, array('list' => $data_trans));
        $this->load->view('report/rpt_pdf_realized', $list_trans);
    }



}
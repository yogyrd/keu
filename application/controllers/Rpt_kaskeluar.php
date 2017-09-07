<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rpt_kaskeluar extends MY_Base_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('M_Rpt_kaskeluar','rpt');
    }

    public function index() {
        $list_lokasi = $this->rpt->getAllLokasi();
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
        $locket = $this->rpt->getLocationById($locid);
        $list_trans = array(
            'locid'         => $locid,
            'locationket'   => $locket,
            'tgloption'     => $tgloption,
            'tgl1'          => $tgl1,
            'tgl2'          => $tgl2
        );
        if ($option == 1) {
            $data_trans = $this->rpt->getAllDataKasKecilNotRealized($locid,$tgloption,$tgl1,$tgl2);
            $list_trans = array_merge($list_trans, array('list' => $data_trans));
            $this->load->view('view_rptkaskecil', $list_trans);
        } elseif ($option ==2) {
            $data_trans = $this->rpt->getAllDataKasKecilRealized($locid,$tgloption,$tgl1,$tgl2);
            $list_trans = array_merge($list_trans, array('list' => $data_trans));
            $this->load->view('view_rptrealized', $list_trans);
        } elseif ($option == 3) {
            $data_trans = $this->rpt->getAllDataPengajuanNotRealized($locid,$tgloption,$tgl1,$tgl2);
            $list_trans = array_merge($list_trans, array('list' => $data_trans));
            $this->load->view('view_rpt_pengajuan', $list_trans);
        } elseif ($option == 4) {
            $data_trans = $this->rpt->getAllDataPengajuanRealized($locid,$tgloption,$tgl1,$tgl2);
            $list_trans = array_merge($list_trans, array('list' => $data_trans));
            $this->load->view('view_rpt_pengajuanrealized', $list_trans);
        } elseif ($option == 5) {
            $data_trans = $this->rpt->getAllDataRejected($locid,$tgloption,$tgl1,$tgl2);
            $list_trans = array_merge($list_trans, array('list' => $data_trans));
            $this->load->view('view_rpt_kasrejected', $list_trans);
        }

    }

    public function getStringTglOption($tgloption) {
        if ($tgloption==1) {
            $tgloptionstring = "Tanggal Input";
        } elseif ($tgloption==2) {
            $tgloptionstring = "Tanggal Transaksi";
        } elseif ($tgloption==3) {
            $tgloptionstring = "Tanggal Realisasi";
        } elseif ($tgloption==4) {
            $tgloptionstring = "Tanggal Reject";
        }

        return $tgloptionstring;
    }

    public function print_kaskeluar() {
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
        $data_trans = $this->rpt->getAllDataKasKecilNotRealized($locid,$tgloption,$tgl1,$tgl2);
        $list_trans = array_merge($list_trans, array('list' => $data_trans));
        $this->load->view('report/rpt_pdf_kaskecil', $list_trans);
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

    public function print_pengajuan() {
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
        $data_trans = $this->rpt->getAllDataPengajuanNotRealized($locid,$tgloption,$tgl1,$tgl2);
        $list_trans = array_merge($list_trans, array('list' => $data_trans));
        $this->load->view('report/rpt_pdf_pengajuan', $list_trans);
    }

    public function print_pengajuanrealized() {
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
        $data_trans = $this->rpt->getAllDataPengajuanRealized($locid,$tgloption,$tgl1,$tgl2);
        $list_trans = array_merge($list_trans, array('list' => $data_trans));
        $this->load->view('report/rpt_pdf_pengajuanrealized', $list_trans);
    }

    public function print_rejected() {
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
        $data_trans = $this->rpt->getAllDataRejected($locid,$tgloption,$tgl1,$tgl2);
        $list_trans = array_merge($list_trans, array('list' => $data_trans));
        $this->load->view('report/rpt_pdf_rejected', $list_trans);
    }

}
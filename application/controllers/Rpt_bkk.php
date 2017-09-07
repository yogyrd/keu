<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rpt_bkk extends MY_Base_Controller {

	function __construct() {
		parent::__construct();
        $this->load->model('M_Rpt_bkk','bkk');
	}

	public function index() {
	    $groupuser = $this->session->userdata('grp');
        $list_lokasi = $this->bkk->getAllLokasi();
	    if ($groupuser >= 4) {
            $locid = $this->session->userdata('locid');
        } else {
            $locid = $this->input->post('filter_loc');
        }
        $location_ket = $this->bkk->getLocation($locid);
        $list_kaskeluar = $this->bkk->getAllKasKeluar($locid);
        $pass_data_baru_ke_view = [ 'list_lokasi'       => $list_lokasi,
                                    'location'          => $location_ket,
                                    'list_kaskeluar'    => $list_kaskeluar];
        $this->addViewData($pass_data_baru_ke_view);

        parent::index();
	}

	public function show_detail() {
        $incomeid = $this->input->get('id');
//        $incomeid = $this->uri->segment(3);
//        $locid = $this->uri->segment(4);
        $locid = $this->bkk->getLocid($incomeid);
        $list_detail = $this->bkk->getAllDetailById($incomeid);
        $location_ket = $this->bkk->getLocation($locid);
        $title = 'Detail Transaksi ID ' . $incomeid;
        $list = array(  'list_detail'   => $list_detail,
                        'title'         => $title,
                        'location'   => $location_ket);
        $this->load->view('detail_kaskeluar', $list);
    }

    public function print_bkk() {
        $incomeid = $this->input->get('id');
        $locid = $this->bkk->getLocid($incomeid);
        $list_detail = $this->bkk->getAllDetailById($incomeid);
        $location_ket = $this->bkk->getLocation($locid);
        $list = array( 'list_detail' => $list_detail,
            'locationket'   => $location_ket);
        $this->bkk->closeTransaksi($incomeid);
        //cetak bkk
//        $this->load->view('report/rpt_pdf_bkk', $list);
        $this->load->library('pdf');
        log_message('debug','JN::RPT_PDF ' . json_encode($list));
        $html = $this->load->view('report/rpt_pdf_bkk', $list, true);
        $m_pdf = new Pdf;
        $m_pdf->pdf_create_85x55($html, 'rpt_pdf_bkk_'. $incomeid . '_' . date('YmdHis'));
    }

    public function print_pengajuan() {
        $this->load->model('M_Home','home');
        $transoutid = $this->input->get('id');
        $locid = $this->input->get('locid');
        $data_realisasi = $this->home->getAllTransRealized($transoutid);
        $list = array(
            'list'      => $data_realisasi
        );
        $this->load->view('report/rpt_pdf_bkk', $list);
    }
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_grouppengeluaran extends MY_Base_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('M_Master_grouppengeluaran','group');
    }

    public function index() {
        $data_group = $this->group->getAllGroupPengeluaran();
        $pass_data_baru_ke_view = ['list_group'=>$data_group];
        $this->addViewData($pass_data_baru_ke_view);

        parent::index();
    }

    public function cetak_groupjenispengeluaran() {
        $data_group = $this->group->getAllGroupSortByName();
        $list = array( 'list_data' => $data_group);
        $this->load->library('pdf');
        log_message('debug','JN::RPT_PDF ' . json_encode($list));
        $html = $this->load->view('report/rpt_pdf_grouppengeluaran', $list, true);
        $m_pdf = new Pdf;
        $m_pdf->pdf_create($html, 'rpt_pdf_groupjenis' . date('YmdHis'));
    }

}
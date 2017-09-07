<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Send_email extends MY_Base_Controller {
    //put your code here
    function __construct() {
        parent::__construct();
        $this->load->model('M_Approval_user','appuser');
        $this->load->model('M_Master_user','mstuser');
        $this->load->model('M_Master_lokasi','mlokasi');
        date_default_timezone_set('Asia/Jakarta');
    }
    
    public function index() {
//        $data_trans = $this->appuser->getListTransNonApprov($locid);
//        $list_trans = array_merge($list_trans, array('list' => $data_trans));
//        $this->load->view('view_rptkaskecil', $list_trans);
        $this->sendmail();
        parent::index();
    }
    
    public function sendmail() {
        $this->load->view('sendmail');
//        $locid = 2;
//        $locationket = $this->mlokasi->getLokasiById($locid);
//        $tgl = date('Y-m-d');
//        $data_trans = array('list' => $this->appuser->getListTransNonApprovToday($locid), 
//                            'tgl1' => $tgl, 
//                            'tgl2' => $tgl,
//                            'locationket' => $locationket);
//        $htmlContent = $this->load->view('report/rpt_mail_approveuser', $data_trans);
//    	$recipientArr = array('yogy.rd24@gmail.com', 'it@mitramedicare.com');
//        $this->email->to($recipientArr);
//        $this->email->from('mitramedicare.it@gmail.com');
//        $this->email->subject('Transaksi Kas Keluar');
//        $this->email->message($htmlContent);
//        if ($this->email->send()) {
//            echo "Mail sent";
//        } else { 
//            echo "ERROR";
//        }
    }
}

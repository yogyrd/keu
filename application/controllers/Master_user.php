<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_user extends MY_Base_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('M_Master_user','user');
        $this->load->model('M_Master_lokasi','lokasi');
    }

    public function index() {
        $data_user = $this->user->getAllUser();
        $data_group = $this->user->getAllgroupUser();
        $data_lokasi = $this->lokasi->getAllLokasi();
        $pass_data_baru_ke_view = [
            'list_user'     => $data_user,
            'list_group'    => $data_group,
            'list_lokasi'   => $data_lokasi];
        $this->addViewData($pass_data_baru_ke_view);

        parent::index();
    }

    public function save() {
        $id_user = $this->input->post('id_user');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $loc = $this->input->post('location');
        $group_user = $this->input->post('group_user');
        $nama = $this->input->post('nama');
        $data = array (
            'id_user'       => $id_user,
            'username'      => $username,
            'password'      => md5($password),
            'location'         => $loc,
            'group_user'    => $group_user,
            'nama'          => $nama
        );
        if (!$id_user) {
            $this->user->simpan($data);
        } else {
            $this->user->ubah($id_user,$password,$loc,$group_user,$nama);
        }
        header('Location: ' . $this->this_controller);
    }

    public function cekUsername() {
        $username = $this->input->post('username');
        log_message('debug',$this->user->cekUsername($username));
        echo $this->user->cekUsername($username);
    }

}
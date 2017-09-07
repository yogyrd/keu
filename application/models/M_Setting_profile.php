<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Setting_profile extends MY_Base_Model {

    function __construct() {
        parent::__construct();
    }

    public function updateUser($pass) {
        $user = $this->input->post('username');
        $sql = "update users set password='$pass' where username='$user'";
        $this->db->query($sql);

    }


}
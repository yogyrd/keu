<?php

class M_Approval2_penerimaan extends MY_Master_Model {

    function __construct() {
        parent::__construct();
        $this->table_name = 'acctranspenerimaan';
        $this->id_field = 'incomeid';
        date_default_timezone_set('Asia/Jakarta');
    }

    public function getAllLokasi() {
        $sql = "select * from masterlokasi";
        $query = $this->db->query($sql,false);
        return $query->result();
    }

    public function getListTransNonApprov2($loc) {
        $sql = "select * from acctranspenerimaan where acc1status=1 and acc2status=0 and loc like '%$loc%'";
        $query = $this->db->query($sql,false);
        return $query->result();
    }

    public function getLocation($loc) {
        $sql = "select * from masterlokasi where locid like '%$loc%'";
        $query = $this->db->query($sql,false);
        return $query->result('array')[0]['locationket'];
    }

    public function updateStatusTrans($user) {
        $update = $this->input->post('update');
        if ($update) {
            $editstatus = $this->input->post('editstatus');
            if ($editstatus > 0) {
                $status = 1;
                $tgl = date('Y-m-d H:i:s');
                foreach ($editstatus as $id) {
                    $update_data = array('acc2by' => $user, 'acc2status' => $status, 'acc2date' => $tgl);
                    $this->db->where('incomeid', $id);
                    $this->db->update('acctranspenerimaan', $update_data);
                }
            }
        }


    }

}
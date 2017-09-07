<?php

class M_Master_aset extends MY_Master_Model {

    function __construct() {
        parent::__construct();
        $this->table_name = 'accmasteraset'; // nama tabel
        $this->id_field = 'aset_id'; // nama id primary key dari tabel tsb
    }

    public function getAllBank() {
        $sql = "select a.bankid, a.locid, b.locationket, a.namabank, a.norekening, a.namarekening, a.cabangrekening
                from accmasterbank a inner join masterlokasi b on a.locid=b.locid";
        $query = $this->db->query($sql,false);
        return $query->result();
    }
    
    public function getNamaBank($bankid) {
        $sql = "select * from accmasterbank where bankid=$bankid";
        $query = $this->db->query($sql,false);
        return $query->result('array')[0]['namabank'];
    }

}
<?php

class M_Master_COA extends MY_Master_Model {

    function __construct() {
        parent::__construct();
        $this->table_name = 'accmasterakun'; // nama tabel
        $this->id_field = 'akunid'; // nama id primary key dari tabel tsb
    }

    public function getAllAccounts() {
        $sql = "select * from accmasterakun order by noakun asc";
        $query = $this->db->query($sql,false);
        return $query->result();
    }

    public function getAllLevel() {
        $sql = "select (select max(lvl) from accmasterakun)+1 as lvl union all 
                select distinct(lvl) from accmasterakun order by lvl asc";
        $query = $this->db->query($sql,false);
        return $query->result();
    }

    public function getNewNoAkunParent() {
        $sql = "select max(noakun)+1 as newnoakun from accmasterakun where lvl=1";
        $query = $this->db->query($sql,false);
        return $query->result('array')[0]['newnoakun'];
    }

    public function getAllKategoriByLevel($lvl) {
        $kategori = "<option value='0'>Pilih Kategori</pilih>";
        $sql = "select * from accmasterakun where lvl=$lvl-1";
        $query = $this->db->query($sql,false);

        foreach ($query->result_array() as $list) {
            $kategori.= "<option value='$list[akunid]'>$list[noakun] - $list[namaakun]</option>";
        }
        return $kategori;
    }

}
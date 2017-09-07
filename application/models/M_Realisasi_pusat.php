<?php

class M_Realisasi_pusat extends MY_Master_Model {

    function __construct() {
        parent::__construct();
        $this->table_name = 'acctranskas';
        $this->id_field = 'transoutid';
        date_default_timezone_set('Asia/Jakarta');
    }

    public function getAllLokasi() {
        $sql = "select * from masterlokasi";
        $query = $this->db->query($sql,false);
        return $query->result();
    }
    
    public function getLocationById($locid) {
        $sql = "select * from masterlokasi where locid ='$locid'";
        $query = $this->db->query($sql,false);
        if ($query->num_rows() > 0) {
            return $query->result('array')[0]['locationket'];
        } else {
            return '-';
        }
    }

    public function getAllBank() {
        $sql = "select * from accmasterbank";
        $query = $this->db->query($sql, false);
        return $query->result();
    }

    public function getBankById($bankid) {
        $sql = "select * from accmasterbank where bankid ='$bankid'";
        $query = $this->db->query($sql,false);
        if ($query->num_rows() > 0) {
            return $query->result('array')[0]['namabank'];
        } else {
            return '-';
        }
    }
    
    public function getListTransNonReal($loc) {
        $sql = "select a.transoutid, a.notrans, a.keterangan, c.jenis, d.costjenis, a.nilaiuang, a.realisasi, a.realisasidate, c.pengajuan
                from acctranskas a inner join accmasterpengeluarannilai b on a.nilaidetailid=b.nilaidetailid
                inner join accmasterpengeluaran c on b.outid=c.outid
                inner join accmasterpengeluarangroup d on c.costid=d.costid
                where realisasistatus=0 and c.pengajuan=1 and a.loc='$loc' and a.acc3status=1;";
        $query = $this->db->query($sql,false);
        return $query->result();
    }

    public function updateStatusRealisasi($user) {
        $update = $this->input->post('update');
        if ($update) {
            $editstatus = $this->input->post('editstatus');
            if ($editstatus > 0) {
                $status = 1;
                $tgl = date('Y-m-d H:i:s');
                foreach ($editstatus as $id) {
                    $nilairealisasi = $this->input->post('realisasi_'.$id);
                    $bankid = $this->input->post('bankid_'.$id);
                    $update_data = array(
                        'realisasiby'       => $user,
                        'realisasistatus'   => $status,
                        'realisasi'         => $nilairealisasi,
                        'realisasidate'     => $tgl,
                        'closed'            => $user,
                        'closeddate'        => $tgl,
                        'bankid'            => $bankid);
                    $this->db->where('transoutid', $id);
                    $this->db->update('acctranskas', $update_data);
                }
            }
        }
    }

}
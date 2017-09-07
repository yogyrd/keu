<?php

class M_Approval_2 extends MY_Master_Model {

    function __construct() {
        parent::__construct();
        $this->table_name = 'acctranskas';
        $this->id_field = 'transoutid';
        date_default_timezone_set('Asia/Jakarta');
    }

    public function getListTransNonApprov2($loc) {
        if ($loc == NULL) {
            $sql = "select a.transoutid, a.notrans, a.nilaidetailid, a.keterangan,a.nomorfaktur, b.outid, c.jenis, a.loc, d.locationket, a.transtgl, a.bebantgl, a.nilaiuang, b.nilaimax, a.realisasi, c.pengajuan
                from acctranskas a inner join accmasterpengeluarannilai b on a.nilaidetailid=b.nilaidetailid
                inner join accmasterpengeluaran c on b.outid=c.outid
                inner join masterlokasi d on a.loc=d.locid
                where acc1status = 1 and acc2status=0 and reject2id=0 and a.closed = 0";
        } else {
            $sql = "select a.transoutid, a.notrans, a.nilaidetailid, a.keterangan,a.nomorfaktur, b.outid, c.jenis, a.loc, d.locationket, a.transtgl, a.bebantgl, a.nilaiuang, b.nilaimax, a.realisasi, c.pengajuan
                from acctranskas a inner join accmasterpengeluarannilai b on a.nilaidetailid=b.nilaidetailid
                inner join accmasterpengeluaran c on b.outid=c.outid
                inner join masterlokasi d on a.loc=d.locid
                where acc1status=1 and acc2status=0 and reject2id=0 and a.closed=0 and loc=$loc";
        }
        $query = $this->db->query($sql,false);
        return $query->result();
    }
    
    public function getListTransApprov($loc,$tgl1,$tgl2) {
        if ($loc == NULL)  {
            $sql = "select a.*, c.jenis 
                    from acctranskas a inner join accmasterpengeluarannilai b on a.nilaidetailid=b.nilaidetailid
                    inner join accmasterpengeluaran c on b.outid=c.outid
                    where acc1status=1 and acc2status=1 and acc2date between '$tgl1' and '$tgl2 23:59:59'";
        } else {
            $sql = "select a.*, c.jenis 
                    from acctranskas a inner join accmasterpengeluarannilai b on a.nilaidetailid=b.nilaidetailid
                    inner join accmasterpengeluaran c on b.outid=c.outid
                    where acc1status=1 and acc2status=1 and acc2date between '$tgl1' and '$tgl2 23:59:59' and loc=$loc";
        }
        $query = $this->db->query($sql,false);
        return $query->result();
    }

    public function updateStatusTrans($user) {
        $update = $this->input->post('update');
        $status = 1;
        $tgl = date('Y-m-d H:i:s');
        if ($update) {
            $editstatus = $this->input->post('editstatus');
            if ($editstatus > 0) {
                foreach ($editstatus as $id) {
                    $pengajuan = $this->input->post('pengajuan'.$id);
                    $nilairealisasi = $this->getNilaiRealisasi($id);
                    $nilaiplafon = $this->getPlafonByTrans($id);

                    $this->db->trans_begin();
                    if ($pengajuan == 1 && $nilairealisasi > $nilaiplafon) {
                        $update_data = array('acc2by' => $user, 'acc2status' => $status, 'acc2date' => $tgl);
                        $this->db->where('transoutid', $id);
                        $this->db->update('acctranskas', $update_data);
                    } else {
                        $update_data = array('acc2by' => $user, 'acc2status' => $status, 'acc2date' => $tgl,'acc3by' => $user, 'acc3status' => $status, 'acc3date' => $tgl);
                        $this->db->where('transoutid', $id);
                        $this->db->update('acctranskas', $update_data);
                    }
                    if ($this->db->trans_status() === FALSE) {
                        $this->db->trans_rollback();
                    } else {
                        $this->db->trans_commit();
                    }
                }
            }
        }
    }

    public function getNilaiRealisasi($transoutid) {
        $sql = "select realisasi from acctranskas where transoutid=$transoutid";
        $query = $this->db->query($sql,false);
        return $query->result('array')[0]['realisasi'];
    }

    public function getPlafonByTrans($transoutid) {
        $sql = "select b.nilaimax from acctranskas a inner join accmasterpengeluarannilai b on a.nilaidetailid=b.nilaidetailid where a.transoutid=$transoutid";
        $query = $this->db->query($sql,false);
        return $query->result('array')[0]['nilaimax'];
    }

    public function rejectTransaksi($userid) {
        $keterangan = $this->input->post('keterangan');
        $data = array(  'keterangan'    =>  $keterangan ,
                        'rejectedby'    =>  $userid);
        $this->db->insert('accrejecttranskas', $data);
        $rejectid = $this->getLastIdReject();
        $transoutid = $this->input->post('transoutid_modal');
        $sql = "update acctranskas set reject2id='$rejectid' where transoutid='$transoutid'";
        $this->db->query($sql,false);
    }

    public function getLastIdReject() {
        $sql = "select max(rejectid) as id from accrejecttranskas";
        $query = $this->db->query($sql,false);
        return $query->result('array')[0]['id'];
    }

}
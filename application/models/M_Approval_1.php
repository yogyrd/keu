<?php

class M_Approval_1 extends MY_Master_Model {

    function __construct() {
        parent::__construct();
        $this->table_name = 'acctranskas';
        $this->id_field = 'transoutid';
        date_default_timezone_set('Asia/Jakarta');
    }

    public function getListTransNonApprov($loc) {
        if ($loc == NULL)  {
            $sql = "select a.transoutid,  a.notrans, a.nilaidetailid, a.keterangan, a.nomorfaktur, b.outid, c.jenis, a.loc, d.locationket, a.transtgl, a.bebantgl, a.nilaiuang, b.nilaimax, c.pengajuan
                from acctranskas a inner join accmasterpengeluarannilai b on a.nilaidetailid=b.nilaidetailid
                inner join accmasterpengeluaran c on b.outid=c.outid
                inner join masterlokasi d on a.loc=d.locid
                where accuserstatus = 1 and acc1status=0 and reject1id=0 and a.closed = 0";
        } else {
            $sql = "select a.transoutid,  a.notrans, a.nilaidetailid, a.keterangan, a.nomorfaktur, b.outid, c.jenis, a.loc, d.locationket, a.transtgl, a.bebantgl, a.nilaiuang, b.nilaimax, c.pengajuan
                from acctranskas a inner join accmasterpengeluarannilai b on a.nilaidetailid=b.nilaidetailid
                inner join accmasterpengeluaran c on b.outid=c.outid
                inner join masterlokasi d on a.loc=d.locid
                where accuserstatus = 1 and acc1status=0 and reject1id=0 and a.closed = 0 and a.loc=$loc";
        }
        $query = $this->db->query($sql,false);
        return $query->result();
    }
    
    public function getListTransApprov($loc,$tgl1,$tgl2) {
        if ($loc == NULL)  {
            $sql = "select a.*, c.jenis 
                    from acctranskas a inner join accmasterpengeluarannilai b on a.nilaidetailid=b.nilaidetailid
                    inner join accmasterpengeluaran c on b.outid=c.outid
                    where acc1status=1 and acc2status=0 and acc1date between '$tgl1' and '$tgl2 23:59:59'";
        } else {
            $sql = "select a.*, c.jenis 
                    from acctranskas a inner join accmasterpengeluarannilai b on a.nilaidetailid=b.nilaidetailid
                    inner join accmasterpengeluaran c on b.outid=c.outid
                    where acc1status=1 and acc2status=0 and acc1date between '$tgl1' and '$tgl2 23:59:59' and loc=$loc";
        }
        $query = $this->db->query($sql,false);
        return $query->result();
    }

    public function updateStatusTrans($user) {
        $update = $this->input->post('update');
        if ($update) {
            $editstatus = $this->input->post('editstatus');
//            if ($editstatus > 0) {
                $status = 1;
            $tgl = date('Y-m-d H:i:s');
                foreach ($editstatus as $id) {
                    $realisasi = $this->input->post('realisasi_'.$id);
                    $realisasiket = $this->input->post('realisasiket_'.$id);
                    $update_data = array('acc1by' => $user, 'acc1status' => $status, 'acc1date' => $tgl, 'realisasi' => $realisasi, 'realisasiket' => $realisasiket);
                    $this->db->where('transoutid', $id);
                    $this->db->update('acctranskas', $update_data);
                }
//            }
        }


    }

    public function rejectTransaksi($userid) {
        $keterangan = $this->input->post('keterangan');
        $data = array(  'keterangan'    =>  $keterangan ,
                        'rejectedby'    =>  $userid);
        $this->db->insert('accrejecttranskas', $data);
        $rejectid = $this->getLastIdReject();
        $transoutid = $this->input->post('transoutid_modal');
        $sql = "update acctranskas set reject1id='$rejectid' where transoutid='$transoutid'";
        $this->db->query($sql,false);
    }

    public function getLastIdReject() {
        $sql = "select max(rejectid) as id from accrejecttranskas";
        $query = $this->db->query($sql,false);
        return $query->result('array')[0]['id'];
    }

}
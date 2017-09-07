<?php

class M_Approval_user extends MY_Master_Model {

    function __construct() {
        parent::__construct();
        $this->table_name = 'acctranskas';
        $this->id_field = 'transoutid';
        date_default_timezone_set('Asia/Jakarta');
    }

    public function getListTransNonApprov() {
        $grup_user = $this->session->userdata('grp');
        $loc = $this->session->userdata('locid');
        if ($grup_user >= 4) {
            $sql = "select a.transoutid, a.notrans, a.nilaidetailid, a.keterangan, a.nomorfaktur, b.outid, c.jenis, a.loc, d.locationket, a.transtgl, a.bebantgl, a.nilaiuang, b.nilaimax, c.pengajuan
                    from acctranskas a inner join accmasterpengeluarannilai b on a.nilaidetailid=b.nilaidetailid
                    inner join accmasterpengeluaran c on b.outid=c.outid
                    inner join masterlokasi d on a.loc=d.locid
                    where accuserstatus = 0 and closed = 0  and a.loc='$loc'";
            $query = $this->db->query($sql,false);
            return $query->result();
        } else {
            $sql = "select a.transoutid, a.notrans, a.nilaidetailid, a.keterangan, a.nomorfaktur, b.outid, c.jenis, a.loc, d.locationket, a.transtgl, a.bebantgl, a.nilaiuang, b.nilaimax, c.pengajuan
                    from acctranskas a inner join accmasterpengeluarannilai b on a.nilaidetailid=b.nilaidetailid
                    inner join accmasterpengeluaran c on b.outid=c.outid
                    inner join masterlokasi d on a.loc=d.locid
                    where accuserstatus = 0 and closed = 0 ";
            $query = $this->db->query($sql,false);
            return $query->result();
        }

    }

    public function updateStatusTrans($user) {
        $update = $this->input->post('update');
        if ($update) {
            $editstatus = $this->input->post('editstatus');
            if ($editstatus > 0) {
                $status = 1;
                $tgl = date('Y-m-d H:i:s');
                foreach ($editstatus as $id) {
                    $update_data = array('accuserby' => $user, 'accuserstatus' => $status, 'accuserdate' => $tgl);
                    $this->db->where('transoutid', $id);
                    $this->db->update('acctranskas', $update_data);
                }
            }
        }


    }

}
<?php

class M_Retur_pengajuan extends MY_Master_Model {

    function __construct() {
        parent::__construct();
        $this->table_name = 'incomeid'; // nama tabel
        $this->id_field = 'acctranspenerimaan'; // nama id primary key dari tabel tsb
        date_default_timezone_set('Asia/Jakarta');
    }

    public function getDataPengajuan($locid, $group_user) {
        if ($group_user > 3) {
            $sql = "select a.*, date(a.realisasidate) realisasidate, date(a.transtgl) transtgl, c.jenis, d.*, e.locationket from acctranskas a inner join accmasterpengeluarannilai b on a.nilaidetailid=b.nilaidetailid
                    inner join accmasterpengeluaran c on b.outid=c.outid
                    inner join mastersupplier d on a.supplierid=d.supplierid
                    inner join masterlokasi e on a.loc=e.locid
                    where c.pengajuan=1 and a.realisasistatus=1 and a.loc='$locid'
                    order by transoutid desc";
        } else {
            $sql = "select a.*, date(a.realisasidate) realisasidate, date(a.transtgl) transtgl, c.jenis, d.*, e.locationket from acctranskas a inner join accmasterpengeluarannilai b on a.nilaidetailid=b.nilaidetailid
                    inner join accmasterpengeluaran c on b.outid=c.outid
                    inner join mastersupplier d on a.supplierid=d.supplierid
                    inner join masterlokasi e on a.loc=e.locid
                    where c.pengajuan=1 and a.realisasistatus=1
                    order by transoutid desc";
        }
        $query = $this->db->query($sql,false);
        return $query->result();
    }
    
    public function getDataRetur() {
        $sql = "select a.incomeid, b.transoutid, b.notrans, b.realisasidate, b.realisasi, d.jenis, b.keterangan, b.nomorfaktur, e.locationket, a.inctgl, a.incnilai, f.namabank, f.namarekening, f.norekening, a.keterangan as keteranganretur
                from acctranspenerimaan a inner join acctranskas b on a.transoutid=b.transoutid
                inner join accmasterpengeluarannilai c on b.nilaidetailid=c.nilaidetailid
                inner join accmasterpengeluaran d on c.outid=d.outid
                inner join masterlokasi e on a.loc=e.locid
                inner join accmasterbank f on a.bankid=f.bankid
                where incjenis='Retur Pengajuan' and a.realisasistatus=0";
        $query = $this->db->query($sql,false);
        return $query->result();
    }

    public function insertRetur($transoutid, $returnilai, $bankid, $locid, $keterangan, $nofaktur) {
        $this->db->trans_begin();
        $tgl = date('Y-m-d H:i:s');
        $userid = $this->session->userdata('id');
        $data = array(
            'inctgl'        => $tgl,
            'incjenis'      => 'Retur Pengajuan',
            'incnilai'      => $returnilai,
            'keterangan'    => $keterangan,
            'bankid'        => $bankid,
            'loc'           => $locid,
            'transoutid'    => $transoutid,
            'acc1status'    => 1,
            'acc1date'      => $tgl,
            'acc1by'        => $userid
        );
        $this->db->insert('acctranspenerimaan', $data);
        
        $incid = $this->getLastIncomeId();
        $data = array(
            'incomeid'      => $incid,
            'inctgl'        => $tgl,
            'loc'           => $locid,
            'incjenis'      => 'Retur Pengajuan',
            'incnilai'      => $returnilai,
        );
        $this->db->insert('acctranspenerimaandetail', $data);
        
        $update_data = array('nomorfaktur' => $nofaktur);
        $this->db->where('transoutid', $transoutid);
        $this->db->update('acctranskas', $update_data);
                        
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $this->session->set_flashdata('err_message', 'Gagal Menyimpan Data');
        } else {
            $this->db->trans_commit();
            $this->session->set_flashdata('err_message', 'Data Berhasil Disimpan!');
        }
    }
    
    public function getLastIncomeId() {
        $sql = "select max(incomeid) as id from acctranspenerimaan";
        $query = $this->db->query($sql,false);
        return $query->result('array')[0]['id'];
    }
    
    public function loadRetur($id) {
        $query = $this->db->get_where('acctranspenerimaan', array('incomeid' => $id));
        $result = $query->result();
        return $result[0];
    }
    
    public function deleteRetur($id) {
        $sql = "delete from acctranspenerimaan where incomeid=$id";
        return $this->db->query($sql);
        $sql = "delete from acctranspenerimaandetail where incomeid=$id";
        return $this->db->query($sql);
        
    }

}
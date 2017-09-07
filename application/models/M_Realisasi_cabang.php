<?php

class M_Realisasi_cabang extends MY_Master_Model {

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
        $sql = "select a.transoutid, a.notrans, a.keterangan, a.nomorfaktur, c.jenis, d.costjenis, a.nilaiuang, a.realisasi, a.realisasidate, c.pengajuan
                from acctranskas a inner join accmasterpengeluarannilai b on a.nilaidetailid=b.nilaidetailid
                inner join accmasterpengeluaran c on b.outid=c.outid
                inner join accmasterpengeluarangroup d on c.costid=d.costid
                where realisasistatus=0 and a.loc='$loc' and a.acc3status=1 and closed=0;";
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
                $locid = $this->input->post('locid');
                $bankidin = $this->input->post('bankidin');
                $lastIdPenerimaan = $this->getLastIdPenerimaan();
                $nextIdPenerimaan = $lastIdPenerimaan + 1;
                $totalrealisasi = 0;
                $this->db->trans_begin();

                foreach ($editstatus as $id) {
                    $nilairealisasi = $this->input->post('realisasi_'.$id);
                    $bankid = $this->input->post('bankid_'.$id);
                    $pengajuan = $this->input->post('pengajuan_'.$id);
                    if ($pengajuan == 0) {
                        $update_data = array(
                            'realisasiby'       => $user ,
                            'realisasistatus'   => $status,
                            'realisasi'         => $nilairealisasi,
                            'realisasidate'     => $tgl,
                            'closed'            => $user,
                            'closeddate'        => $tgl,
                            'bankid'            => $bankid,
                            'incomeid'          => $nextIdPenerimaan);
                        $totalrealisasi = $totalrealisasi + $nilairealisasi;
                    }
                    elseif ($pengajuan == 1) {
                        $update_data = array(
                            'realisasiby'       => $user ,
                            'realisasistatus'   => $status,
                            'realisasi'         => $nilairealisasi,
                            'realisasidate'     => $tgl,
                            'bankid'            => $bankid);
                    }
                    $this->db->where('transoutid', $id);
                    $this->db->update('acctranskas', $update_data);
                }

                $data = array(
                    'inctgl'        => $tgl, 
                    'incjenis'      => 'Kas Kecil', 
                    'keterangan'    => 'Pengajuan Kas Kecil', 
                    'incnilai'      => $totalrealisasi,
                    'acc1status'    => 1,
                    'acc1date'      => $tgl,
                    'acc1by'        => $user,
                    'realisasistatus'   => 1,
                    'realisasidate' => $tgl,
                    'realisasiby'   => $user,
                    'bankid'        => $bankidin,
                    'closed'        => 1,
                    'loc'           => $locid);
                $this->db->insert('acctranspenerimaan',$data);
                
                
                    $insert_data = array (
                        'incomeid'          => $nextIdPenerimaan,
                        'inctgl'            => $tgl,
                        'loc'               => $locid,
                        'incjenis'          => 'Kas Kecil',
                        'incnilai'          => $totalrealisasi
                    );
                    $this->db->insert('acctranspenerimaandetail',$insert_data);
                
                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    $this->session->set_flashdata('err_message', 'Gagal Menyimpan Data');
                } else {
                    $this->db->trans_commit();
                    $this->session->set_flashdata('err_message', 'Data Berhasil Disimpan!');
                }
            }
        }
    }

    public function getLastIdPenerimaan() {
        $sql = "select max(incomeid) as lastid from acctranspenerimaan";
        $query = $this->db->query($sql,false);
        return $query->result('array')[0]['lastid'];

    }

    public function getDataTrans($transoutid) {
        $sql = "select a.notrans, a.transoutid, f.noakun, a.keterangan, a.nomorfaktur, c.jenis, d.costjenis, a.nilaiuang, a.realisasi, a.realisasidate, c.pengajuan
                from acctranskas a inner join accmasterpengeluarannilai b on a.nilaidetailid=b.nilaidetailid
                inner join accmasterpengeluaran c on b.outid=c.outid
                inner join accmasterpengeluarangroup d on c.costid=d.costid
                left join accmasterjurnal e on c.outid=e.jenisid and e.jurnaldebet=1
                left join accmasterakun f on e.akunid=f.akunid
                where a.transoutid='$transoutid';";
        $query = $this->db->query($sql,false);
        return $query->result();
    }

    public function getLocid($transoutid) {
        $sql = "select loc from acctranskas where transoutid='$transoutid'";
        $query = $this->db->query($sql,false);
        return $query->result('array')[0]['loc'];
    }

    public function getTglRealisasi($transoutid) {
        $sql = "select realisasidate from acctranskas where transoutid='$transoutid'";
        $query = $this->db->query($sql,false);
        return $query->result('array')[0]['realisasidate'];
    }

    public function getTglTrans($transoutid) {
        $sql = "select transtgl from acctranskas where transoutid='$transoutid'";
        $query = $this->db->query($sql,false);
        return $query->result('array')[0]['transtgl'];
    }

    public function getNoTrans($transoutid) {
        $sql = "select notrans from acctranskas where transoutid='$transoutid'";
        $query = $this->db->query($sql,false);
        return $query->result('array')[0]['notrans'];
    }

    public function closeTransaksi($userid, $transoutid) {

        $sql = "select * from acctranskas where transoutid='$transoutid'";
        $query = $this->db->query($sql,false);
        $realisasi = $query->result('array')[0]['realisasi'];
        $locid =  $query->result('array')[0]['loc'];

        $tgl = date('Y-m-d H:i:s');
        $lastIdPenerimaan = $this->getLastIdPenerimaan();
        $nextIdPenerimaan = $lastIdPenerimaan + 1;
        $update_data = array(
            'closed'            => $userid,
            'closeddate'        => $tgl,
            'incomeid'          => $nextIdPenerimaan);
        $this->db->where('transoutid', $transoutid);
        $this->db->update('acctranskas', $update_data);

        $data = array('inctgl' => $tgl, 'incnilai' => $realisasi,'loc' => $locid, 'createdate' => $tgl);
        $this->db->insert('acctranspenerimaan',$data);
    }
}
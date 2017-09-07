<?php

class M_Approval1_penerimaan extends MY_Master_Model {

    function __construct() {
        parent::__construct();
        $this->table_name = 'acctranspenerimaandetail';
        $this->id_field = 'incdetailid';
        date_default_timezone_set('Asia/Jakarta');
    }

    public function getAllLokasi() {
        $sql = "select * from masterlokasi";
        $query = $this->db->query($sql,false);
        return $query->result();
    }

    public function getListTransNonApprov($locid, $tgl) {
        $sql = "select * from acctranspenerimaandetail where loc ='$locid' and inctgl ='$tgl' and incomeid=0";
        $query = $this->db->query($sql,false);
        return $query->result();
    }

    public function getLocation($locid) {
        $sql = "select * from masterlokasi where locid ='$locid'";
        $query = $this->db->query($sql,false);
        if ($query->num_rows() > 0) {
            return $query->result('array')[0]['locationket'];
        } else {
            return '-';
        }
    }
    
    public function getJenisPenerimaan() {
        $sql = "select * from config where configName='JenisPenerimaan'";
        $query = $this->db->query($sql,false);
        return $query->result();
    }

    public function getJenisPembayaran() {
        $sql = "select * from config where configName='JenisPembayaran'";
        $query = $this->db->query($sql,false);
        return $query->result();
    }

    public function getKartu() {
        $sql = "select * from config where configName='Kartu'";
        $query = $this->db->query($sql,false);
        return $query->result();
    }

    public function getMesin() {
        $sql = "select * from config where configName='Mesin'";
        $query = $this->db->query($sql,false);
        return $query->result();
    }

    public function updateStatusTrans($user, $tglfilter, $locidfilter) {
        $update = $this->input->post('update');
        if ($update) {
            $editstatus = $this->input->post('editstatus');
            if ($editstatus > 0) {
                $status = 1;
                $tgl = date('Y-m-d H:i:s');
                $locid = (float)$this->input->post('locid');
                $lastIdPenerimaan = $this->getLastIdPenerimaan();
                $nextIdPenerimaan = $lastIdPenerimaan + 1;

                $this->db->trans_start();

                foreach ($editstatus as $id) {
                    $incdetailid = $this->input->post('incdetailid_'.$id);
                    $jenispenerimaan = $this->input->post('jenispenerimaan_'.$id);
                    $jenisbayar = $this->input->post('jenisbayar_'.$id);
                    $kartu = $this->input->post('kartu_'.$id);
                    $mesin = $this->input->post('mesin_'.$id);
                    $nilai = $this->input->post('nilai_'.$id);

                    $update_data = array(
                        'incomeid'  => $nextIdPenerimaan,
                        'incjenis'  => $jenispenerimaan,
                        'jenis'     => $jenisbayar,
                        'kartu'     => $kartu,
                        'mesin'     => $mesin,
                        'incnilai'  => $nilai);
                    $this->db->where('incdetailid', $incdetailid);
                    $this->db->update('acctranspenerimaandetail', $update_data);

                }

                foreach ($this->resultIncomeJenis($tglfilter, $locidfilter) as $list_incjenis) {
                    foreach ($this->resultJenis($tglfilter, $locidfilter, $list_incjenis->incjenis) as $list_jenis) {
                        foreach ($this->resultKartu($tglfilter, $locidfilter, $list_incjenis->incjenis, $list_jenis->jenis) as $list_kartu) {
                            foreach ($this->resultMesin($tglfilter, $locidfilter, $list_incjenis->incjenis, $list_jenis->jenis, $list_kartu->kartu) as $list_mesin) {
                                $sumincnilai = (float)$this->resultSUMFilter($tglfilter, $locidfilter, $list_incjenis->incjenis, $list_jenis->jenis, $list_kartu->kartu, $list_mesin->mesin);
                                if ($sumincnilai > 0 ) {
                                    $data = array(
                                        'inctgl'        => $tgl,
                                        'incjenis'      => $list_incjenis->incjenis,
                                        'jenis'         => $list_jenis->jenis,
                                        'mesin'         => $list_mesin->mesin,
                                        'kartu'         => $list_kartu->kartu,
                                        'incnilai'      => $sumincnilai,
                                        'acc1status'    => 1,
                                        'acc1date'      => $tgl,
                                        'acc1by'        => $user,
                                        'loc'           => $locid,
                                        'createdate'    => $tgl);
                                    $this->db->insert('acctranspenerimaan',$data);
                                    $this->db->trans_complete();
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    
    public function getLastIdPenerimaan() {
        $sql = "select ifnull(max(incomeid),0) as lastid from acctranspenerimaan";
        $query = $this->db->query($sql,false);
        return $query->result('array')[0]['lastid'];
    }

    public function resultIncomeJenis($tglfilter, $locidfilter) {
        $sql = "select distinct(incjenis) from acctranspenerimaandetail where inctgl='$tglfilter' and loc='$locidfilter';";
        $query = $this->db->query($sql,false);
        return $query->result();
    }

    public function resultJenis($tglfilter, $locidfilter, $incjenis) {
        $sql = "select distinct(jenis) from acctranspenerimaandetail where inctgl='$tglfilter' and loc='$locidfilter' and incjenis='$incjenis';";
        $query = $this->db->query($sql,false);
        return $query->result();
    }

    public function resultKartu($tglfilter, $locidfilter, $incjenis, $jenis) {
        $sql = "select distinct(kartu) from acctranspenerimaandetail where inctgl='$tglfilter' and loc='$locidfilter' and incjenis='$incjenis' and jenis='$jenis';";
        $query = $this->db->query($sql,false);
        return $query->result();
    }

    public function resultMesin($tglfilter, $locidfilter, $incjenis, $jenis, $kartu) {
        $sql = "select distinct(mesin) as mesin from acctranspenerimaandetail where inctgl='$tglfilter' and loc='$locidfilter' and incjenis='$incjenis' and jenis='$jenis' and kartu='$kartu'";
        $query = $this->db->query($sql,false);
        return $query->result();
    }

    public function resultSUMFilter($tglfilter, $locidfilter, $incjenis, $jenis, $kartu, $mesin) {
        $sql = "select ifnull(sum(incnilai),0) as incnilai from acctranspenerimaandetail where inctgl='$tglfilter' and loc='$locidfilter' and incjenis='$incjenis' and jenis='$jenis' and kartu='$kartu' and mesin='$mesin'";
        $query = $this->db->query($sql,false);
        return $query->result('array')[0]['incnilai'];
    }

}
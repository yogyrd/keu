<?php

class M_Rpt_penerimaan extends MY_Base_Model {
    
    function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
    }

    public function getAllPenerimaan($locid) {
        $sql = "";
        $query = $this->db->query($sql,false);
        return $query->result();
    }

    public function getLokasi() {
        $sql = "select * from masterlokasi";
        $query = $this->db->query($sql,false);
        return $query->result();
    }

    public function getLocationById($loc) {
        $sql = "select * from masterlokasi where locid ='$loc'";
        $query = $this->db->query($sql,false);
        if ($query->num_rows() > 0) {
            return $query->result('array')[0]['locationket'];
        } else {
            return 'Semua Lokasi';
        }
    }

    public function getLocid($incomeid) {
        $sql = "select loc from acctranspenerimaan where incomeid ='$incomeid'";
        $query = $this->db->query($sql,false);
        return $query->result('array')[0]['loc'];
    }

    public function getOmzetAdminTunai($locid,$tgl1,$tgl2) {
        if ($tgl1 == $tgl2) {
            $sql = "select sum(incnilai) as jum from acctranspenerimaandetail where incjenis='Admin' and jenis<>'TAGIHAN' and inctgl='$tgl1' and loc='$locid'";
        } else {
            $sql = "select sum(incnilai) as jum from acctranspenerimaandetail where incjenis='Admin' and jenis<>'TAGIHAN' and inctgl between '$tgl1 00:00:00' and '$tgl2 23:59:59' and loc=$locid";
        }
        $query = $this->db->query($sql,false);
        if ($query->result('array')[0]['jum'] == NULL) {
            return 0;
        } else {
            return $query->result('array')[0]['jum'];
        }
    }

    public function getOmzetAdminTagihan($locid,$tgl1,$tgl2) {
        if ($tgl1 == $tgl2) {
            $sql = "select sum(incnilai) as jum from acctranspenerimaandetail where incjenis='Admin' and jenis='TAGIHAN' and inctgl='$tgl1' and loc='$locid'";
        } else {
            $sql = "select sum(incnilai) as jum from acctranspenerimaandetail where incjenis='Admin' and jenis='TAGIHAN' and inctgl between '$tgl1 00:00:00' and '$tgl2 23:59:59' and loc=$locid";
        }
        $query = $this->db->query($sql,false);
        if ($query->result('array')[0]['jum'] == NULL) {
            return 0;
        } else {
            return $query->result('array')[0]['jum'];
        }
    }

    public function getOmzetPoliAwalTunai($locid,$tgl1,$tgl2) {
        if ($tgl1 == $tgl2) {
            $sql = "select sum(incnilai) as jum from acctranspenerimaandetail where incjenis='Poli Awal' and jenis<>'TAGIHAN' and inctgl='$tgl1' and loc='$locid'";
        } else {
            $sql = "select sum(incnilai) as jum from acctranspenerimaandetail where incjenis='Poli Awal' and jenis<>'TAGIHAN' and inctgl between '$tgl1 00:00:00' and '$tgl2 23:59:59' and loc=$locid";
        }
        $query = $this->db->query($sql,false);
        if ($query->result('array')[0]['jum'] == NULL) {
            return 0;
        } else {
            return $query->result('array')[0]['jum'];
        }
    }

    public function getOmzetPoliAwalTagihan($locid,$tgl1,$tgl2) {
        if ($tgl1 == $tgl2) {
            $sql = "select sum(incnilai) as jum from acctranspenerimaandetail where incjenis='Poli Awal' and jenis='TAGIHAN' and inctgl='$tgl1' and loc='$locid'";
        } else {
            $sql = "select sum(incnilai) as jum from acctranspenerimaandetail where incjenis='Poli Awal' and jenis='TAGIHAN' and inctgl between '$tgl1 00:00:00' and '$tgl2 23:59:59' and loc=$locid";
        }
        $query = $this->db->query($sql,false);
        if ($query->result('array')[0]['jum'] == NULL) {
            return 0;
        } else {
            return $query->result('array')[0]['jum'];
        }
    }

    public function getOmzetPoliTunai($locid,$tgl1,$tgl2) {
        if ($tgl1 == $tgl2) {
            $sql = "select sum(incnilai) as jum from acctranspenerimaandetail where incjenis='Poli' and jenis<>'TAGIHAN' and inctgl='$tgl1' and loc='$locid'";
        } else {
            $sql = "select sum(incnilai) as jum from acctranspenerimaandetail where incjenis='Poli' and jenis<>'TAGIHAN' and inctgl between '$tgl1 00:00:00' and '$tgl2 23:59:59' and loc=$locid";
        }
        $query = $this->db->query($sql,false);
        if ($query->result('array')[0]['jum'] == NULL) {
            return 0;
        } else {
            return $query->result('array')[0]['jum'];
        }
    }

    public function getOmzetPoliTagihan($locid,$tgl1,$tgl2) {
        if ($tgl1 == $tgl2) {
            $sql = "select sum(incnilai) as jum from acctranspenerimaandetail where incjenis='Poli' and jenis='TAGIHAN' and inctgl='$tgl1' and loc='$locid'";
        } else {
            $sql = "select sum(incnilai) as jum from acctranspenerimaandetail where incjenis='Poli' and jenis='TAGIHAN' and inctgl between '$tgl1 00:00:00' and '$tgl2 23:59:59' and loc=$locid";
        }
        $query = $this->db->query($sql,false);
        if ($query->result('array')[0]['jum'] == NULL) {
            return 0;
        } else {
            return $query->result('array')[0]['jum'];
        }
    }

    public function getOmzetGigiTunai($locid,$tgl1,$tgl2) {
        if ($tgl1 == $tgl2) {
            $sql = "select sum(incnilai) as jum from acctranspenerimaandetail where incjenis='Gigi' and jenis<>'TAGIHAN' and inctgl='$tgl1' and loc='$locid'";
        } else {
            $sql = "select sum(incnilai) as jum from acctranspenerimaandetail where incjenis='Gigi' and jenis<>'TAGIHAN' and inctgl between '$tgl1 00:00:00' and '$tgl2 23:59:59' and loc=$locid";
        }
        $query = $this->db->query($sql,false);
        if ($query->result('array')[0]['jum'] == NULL) {
            return 0;
        } else {
            return $query->result('array')[0]['jum'];
        }
    }

    public function getOmzetGigiTagihan($locid,$tgl1,$tgl2) {
        if ($tgl1 == $tgl2) {
            $sql = "select sum(incnilai) as jum from acctranspenerimaandetail where incjenis='Gigi' and jenis='TAGIHAN' and inctgl='$tgl1' and loc='$locid'";
        } else {
            $sql = "select sum(incnilai) as jum from acctranspenerimaandetail where incjenis='Gigi' and jenis='TAGIHAN' and inctgl between '$tgl1 00:00:00' and '$tgl2 23:59:59' and loc=$locid";
        }
        $query = $this->db->query($sql,false);
        if ($query->result('array')[0]['jum'] == NULL) {
            return 0;
        } else {
            return $query->result('array')[0]['jum'];
        }
    }

    public function getOmzetLabTunai($locid,$tgl1,$tgl2) {
        if ($tgl1 == $tgl2) {
            $sql = "select sum(incnilai) as jum from acctranspenerimaandetail where incjenis='Laboratorium' and jenis<>'TAGIHAN' and inctgl='$tgl1' and loc='$locid'";
        } else {
            $sql = "select sum(incnilai) as jum from acctranspenerimaandetail where incjenis='Laboratorium' and jenis<>'TAGIHAN' and inctgl between '$tgl1 00:00:00' and '$tgl2 23:59:59' and loc=$locid";
        }
        $query = $this->db->query($sql,false);
        if ($query->result('array')[0]['jum'] == NULL) {
            return 0;
        } else {
            return $query->result('array')[0]['jum'];
        }
    }

    public function getOmzetLabTagihan($locid,$tgl1,$tgl2) {
        if ($tgl1 == $tgl2) {
            $sql = "select sum(incnilai) as jum from acctranspenerimaandetail where incjenis='Laboratorium' and jenis='TAGIHAN' and inctgl='$tgl1' and loc='$locid'";
        } else {
            $sql = "select sum(incnilai) as jum from acctranspenerimaandetail where incjenis='Laboratorium' and jenis='TAGIHAN' and inctgl between '$tgl1 00:00:00' and '$tgl2' and loc=$locid";
        }
        $query = $this->db->query($sql,false);
        if ($query->result('array')[0]['jum'] == NULL) {
            return 0;
        } else {
            return $query->result('array')[0]['jum'];
        }
    }

    public function getTotalTunai($locid,$tgl1,$tgl2) {
        if ($tgl1 == $tgl2) {
            $sql = "select sum(incnilai) as jum from acctranspenerimaandetail where loc='$locid' and jenis<>'TAGIHAN' and inctgl='$tgl1'";
        } else {
            $sql = "select sum(incnilai) as jum from acctranspenerimaandetail where loc='$locid' and jenis<>'TAGIHAN' and inctgl between '$tgl1 00:00:00' and '$tgl2 23:59:59'";
        }
        $query = $this->db->query($sql,false);
        if ($query->result('array')[0]['jum'] == NULL) {
            return 0;
        } else {
            return $query->result('array')[0]['jum'];
        }
    }

    public function getTotalTagihan($locid,$tgl1,$tgl2) {
        if ($tgl1 == $tgl2) {
            $sql = "select sum(incnilai) as jum from acctranspenerimaandetail where loc='$locid' and jenis='TAGIHAN' and inctgl='$tgl1'";
        } else {
            $sql = "select sum(incnilai) as jum from acctranspenerimaandetail where loc='$locid' and jenis='TAGIHAN' and inctgl between '$tgl1 00:00:00' and '$tgl2 23:59:59'";
        }
        $query = $this->db->query($sql,false);
        if ($query->result('array')[0]['jum'] == NULL) {
            return 0;
        } else {
            return $query->result('array')[0]['jum'];
        }
    }

    public function getTotalTunaiAllKlinik($tgl1,$tgl2) {
        if ($tgl1 == $tgl2) {
            $sql = "select sum(incnilai) as totalAll from acctranspenerimaandetail where jenis<>'TAGIHAN' and inctgl='$tgl1'";
        } else {
            $sql = "select sum(incnilai) as totalAll from acctranspenerimaandetail where jenis<>'TAGIHAN' and inctgl between '$tgl1 00:00:00' and '$tgl2 23:59:59'";
        }
        $query = $this->db->query($sql,false);
        if ($query->result('array')[0]['totalAll'] == NULL) {
            return 0;
        } else {
            return $query->result('array')[0]['totalAll'];
        }
    }

    public function getTotalTagihanAllKlinik($tgl1,$tgl2) {
        if ($tgl1 == $tgl2) {
            $sql = "select sum(incnilai) as totalAll from acctranspenerimaandetail where jenis='TAGIHAN' and inctgl='$tgl1'";
        } else {
            $sql = "select sum(incnilai) as totalAll from acctranspenerimaandetail where jenis='TAGIHAN' and inctgl between '$tgl1 00:00:00' and '$tgl2 23:59:59'";
        }
        $query = $this->db->query($sql,false);
        if ($query->result('array')[0]['totalAll'] == NULL) {
            return 0;
        } else {
            return $query->result('array')[0]['totalAll'];
        }
    }
}
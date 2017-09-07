<!-- Navigation -->
<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" style="color: #fff" href="<?= base_url() . 'home'; ?>">Mitra Medicare</a>
    </div>
    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?= ucfirst($this->session->userdata('username')); ?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li>
                    <a href="<?= base_url(). 'setting_profile?id='.ucfirst($this->session->userdata('id'));  ?>"><i class="fa fa-fw fa-gear"></i> Settings</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="<?= base_url('login/logout'); ?>"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                </li>
            </ul>
        </li>
    </ul>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li>
                <div class="user-panel">
                    <div class="pull-left image">
                        <a style="color:#fff; font-size: 16px;"> Hi, <?= ucfirst($this->session->userdata('username')); ?><br />
                            <?=  ucfirst($this->session->userdata('location'));?></a>
                    </div>
                </div>
            </li>
            <li>
                <a href="<?= base_url() . 'home'; ?>"> Home</a>
            </li>
            <?php if (ucfirst($this->session->userdata('grp')) <= 3 ) { ?>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#master"><i class="fa fa-fw fa-archive"></i> Master <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="master" class="collapse">
                    <li>
                        <a href="<?= base_url() . 'master_user'; ?>"> User</a>
                    </li>
                    <li>
                        <a href="<?= base_url() . 'master_COA'; ?>"> Akun</a>
                    </li>
                    <li>
                        <a href="<?= base_url() . 'master_supplier'; ?>"> Supplier</a>
                    </li>
                    <li>
                        <a href="<?= base_url() . 'master_bank'; ?>"> Bank</a>
                    </li>
                    <li>
                        <a href="<?= base_url() . 'master_lokasi'; ?>"> Lokasi</a>
                    </li>
                    <li>
                        <a href="<?= base_url() . 'master_grouppengeluaran'; ?>"> Group Jenis Pengeluaran</a>
                    </li>
                    <li>
                        <a href="<?= base_url() . 'master_jenispengeluaran'; ?>"> Detil Jenis Pengeluaran</a>
                    </li>
                    <li>
                        <a href="<?= base_url() . 'master_nilaigrouppengeluaran'; ?>"> Nilai Group Jenis</a>
                    </li>
                    <li>
                        <a href="<?= base_url() . 'master_nilaidetilpengeluaran'; ?>"> Nilai Detil Jenis</a>
                    </li>
                    <li>
                        <a href="<?= base_url() . 'master_jurnal'; ?>"> Jurnal</a>
                    </li>
                </ul>
            </li>
            <?php }; ?>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#transaksi"><i class="fa fa-fw fa-money"></i> Transaksi <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="transaksi" class="collapse">
                    <li>
                        <a href="<?= base_url() . 'trans_kas'; ?>"> Kas Pengeluaran</a>
                    </li>
                    <li>
                        <a href="<?= base_url() . 'retur_pengajuan'; ?>"> Retur Pengajuan</a>
                    </li>
                    <?php if (ucfirst($this->session->userdata('grp')) <= 3) { ?>
                    <li>
                        <a href="<?= base_url() . 'approval1_penerimaan'; ?>"> Penerimaan</a>
                    </li>
                    <?php }?>
                </ul>
            </li>
            <?php if (ucfirst($this->session->userdata('grp')) <= 4) { ?>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#approval"><i class="fa fa-fw fa-check-square"></i> Approval <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="approval" class="collapse">
                    <li>
                        <a href="<?= base_url() . 'approval_user'; ?>"> Kakanper</a>
                    </li>
                    <?php if (ucfirst($this->session->userdata('grp')) <= 3) { ?>
                    <li>
                        <a href="<?= base_url() . 'approval_1'; ?>"> Keuangan</a>
                    </li>
                    <?php };?>
                    <?php if (ucfirst($this->session->userdata('grp')) <= 2) { ?>
                        <li>
                            <a href="<?= base_url() . 'approval_2'; ?>"> Kadiv. Keuangan</a>
                        </li>
                    <?php };?>
                    <?php if (ucfirst($this->session->userdata('grp'))<= 1) { ?>
                        <li>
                            <a href="<?= base_url() . 'approval_3'; ?>"> Dir. Keuangan</a>
                        </li>
                        <li>
                            <a href="<?= base_url() . 'approval_nilaigrouppengeluaran'; ?>"> Group Pengeluaran</a>
                        </li>
                    <?php };?>
                </ul>
            </li>
            <?php } ?>
            <?php if (ucfirst($this->session->userdata('grp')) <= 3) { ?>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#realisasi"><i class="fa fa-fw fa-dollar"></i> Realisasi <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="realisasi" class="collapse">
                    <li>
                        <a href="<?= base_url() . 'realisasi_cabang'; ?>"> Cabang</a>
                    </li>
                    <li>
                        <a href="<?= base_url() . 'realisasi_pusat'; ?>"> Pusat</a>
                    </li>
                </ul>
            </li>
            <?php };?>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#report"><i class="fa fa-fw fa-table"></i> Laporan <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="report" class="collapse">
                    <li>
                        <a href="<?= base_url() . 'rpt_kaskeluar'; ?>">Kas Pengeluaran</a>
                    </li>
                    <?php if (ucfirst($this->session->userdata('grp')) <= 3) { ?>
                    <li>
                        <a href="<?= base_url() . 'rpt_bkk'; ?>">Bukti Kas Keluar</a>
                    </li>
                    <?php };?>
                    <?php if (ucfirst($this->session->userdata('grp')) <= 2) { ?>
                        <li>
                            <a href="<?= base_url() . 'rpt_penerimaan'; ?>">Omzet All Klinik</a>
                        </li>
                    <?php };?>
                </ul>
            </li>
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>
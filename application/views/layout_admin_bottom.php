
</div> <!-- admin-wrapper -->
<script>

    function checkAll(ele) {
        var checkboxes = document.getElementsByName('editstatus[]');
        var checkboxes2 = document.getElementsByName('unlock[]');
        if (checkboxes) {
            for(var i=0, n=checkboxes.length;i<n;i++) {
                checkboxes[i].checked = ele.checked;
            }
        }
        if (checkboxes2) {
            for(var i=0, n=checkboxes2.length;i<n;i++) {
                checkboxes2[i].checked = ele.checked;
            }
        }

    }

	$(function(){
		$('.dt_date').datetimepicker({
			format:'YYYY-MM-DD',
			ignoreReadonly:true
		});
		$('.dt_date_time').datetimepicker({
			format:'YYYY-MM-DD HH:mm',
			ignoreReadonly:true
		});
		$('.dt_time').datetimepicker({
			format:'HH:mm',
			ignoreReadonly:true
		});
		$('#tabel_userrealisasi').dataTable();
		$('#tabel_reject').dataTable();
        $('#tabel_data').dataTable();
        $('#tabel_jenispengeluaran').dataTable();
        $('#tabel_cash').dataTable();
        $('#tabel_pengajuan').dataTable();
        $('#tabel_akun').dataTable();
        $('#tabel_pengeluaran').dataTable();
        $('#tabel_penerimaan').dataTable();
        $('#tabel_kaskecil').dataTable();
        $('#tabel_trans_kas_home').dataTable();
        $('#tabel_listpengajuan').dataTable();
        $('#tabel_listkaskecil').dataTable();

	});

    function hapus_data(name, ket, del_url){
        if(confirm('Apakah anda yakin ingin menghapus transaksi id '+ name +' dengan keterangan "'+ ket +'"?')){
            window.location.href=del_url;
        }
    }
</script>
<?php include_once 'layout_bottom.php'; ?>
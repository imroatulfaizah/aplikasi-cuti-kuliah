<?php
	include("sess_check.php");
	
	// deskripsi halaman
	$pagedesc = "Data Karyawan";
	$menuparent = "master";
	include("layout_top.php");
?>
	<?php
						$url='http://localhost/pmb/webservice/list_json_mhs.php';
						$json = file_get_contents($url);
						 
						// deserialize data from JSON
						$krs = json_decode($json,true);
						 // var_dump($krs);
?>

<script type="text/javascript">
	function checkNppAvailability() {
	$("#loaderIcon").show();
	jQuery.ajax({
		url: "check_nppavailability.php",
		data:'npp='+$("#npp").val(),
		type: "POST",
		success:function(data){
			$("#user-availability-status").html(data);
			$("#loaderIcon").hide();
		},
		error:function (){}
	});
	}
</script>
<!-- top of file -->
		<!-- Page Content -->
		<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Data Akses</h1>
                    </div><!-- /.col-lg-12 -->
                </div><!-- /.row -->

				<div class="row">
					<div class="col-lg-12"><?php include("layout_alert.php"); ?></div>
				</div>
				
				<div class="row">
					<div class="col-lg-12">
						<form class="form-horizontal" action="karyawan_insert.php" method="POST" enctype="multipart/form-data">
							<div class="panel panel-default">
								<div class="panel-heading"><h3>Tambah Data</h3></div>
								<div class="panel-body">
									<div class="form-group">
										<label class="control-label col-sm-3">ID</label>
										<div class="col-sm-4">
										<select type ="text" id="npm"  onchange="cek_mahasiswa()" name = "npp" class="form-control" required>
							<?php 

						$no = 0;
						foreach ($krs['list_info'] as $kr) {
							$no++;
							foreach ($kr as $key => $value) {
								$$key=$value;
							}

							?>
						<option><?php echo $npm; } ?>
							
						</option>

						</select>
						</div>
						</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Nama</label>
										<div class="col-sm-4">
											<input type="text" name="nama" id="nama" class="form-control" placeholder="Nama" required readonly>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Jenis Kelamin</label>
										<div class="col-sm-4">
										<input type="text" name="jk" id="jenis_kelamin" class="form-control" placeholder="Jenis Kelamin" required readonly>
										</div>
									</div>
									
									<div class="form-group">
										<label class="control-label col-sm-3">Telepon</label>
										<div class="col-sm-4">
											<input type="text" name="telp" id="hp_siswa" min="0" class="form-control" placeholder="Telepon" required readonly>
										</div>
									</div>
									
									<div class="form-group">
										<label class="control-label col-sm-3">Divisi</label>
										<div class="col-sm-4">
											<input type="text" name="divisi" class="form-control" placeholder="Divisi" required>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Jabatan</label>
										<div class="col-sm-4">
											<input type="text" name="jabatan" class="form-control" placeholder="Jabatan" required>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Alamat</label>
										<div class="col-sm-4">
											<textarea name="alamat" id="alamat_siswa" class="form-control" placeholder="Alamat" rows="3" required readonly></textarea>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Jumlah Cuti</label>
										<div class="col-sm-3">
											<input type="number" name="jml" min="0" class="form-control" placeholder="Jumlah Cuti" required>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Hak Akses</label>
										<div class="col-sm-3">
											<select name="akses" id="akses" class="form-control" required>
												<option value="" selected>--- Pilih Hak Akses ---</option>
											<option value="manager">Wakil Rektor 1</option>
                                                    <option value="Supervisor">Dekan Fakultas</option>
                                                <option value="Leader">Kepala Prodi</option>
												<option value="Pegawai">Mahasiswa</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Foto</label>
										<div class="col-sm-3">
											<input type="text" name="foto" id="foto" class="form-control" placeholder="foto" required readonly>
										</div>
									</div>
								</div>
								<div class="panel-footer">
									<button type="submit" name="simpan" class="btn btn-success">Simpan</button>
								</div>
							</div><!-- /.panel -->
						</form>
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
						<script type="text/javascript">
						    function cek_mahasiswa(){
						        var npm = $("#npm").val();
						        $.ajax({
						            url: 'http://localhost/PMB/webservice/cek_mahasiswa.php',
						            data:"npm="+npm ,
						        }).success(function (data) {
						            var json = data,
						            obj =
						            JSON.parse(json);
						            $('#nama').val(obj.nama);
						            $('#jenis_kelamin').val(obj.jenis_kelamin);
						            $('#alamat_siswa').val(obj.alamat_siswa);
						            $('#hp_siswa').val(obj.hp_siswa);
						            $('#foto').val(obj.foto);		 
						        });
						    }
						</script>

					</div><!-- /.col-lg-12 -->
				</div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div><!-- /#page-wrapper -->
<!-- bottom of file -->
<?php
	include("layout_bottom.php");
?>
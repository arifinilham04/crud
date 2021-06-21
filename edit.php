<?php include('koneksi.php'); ?>


	<div class="container" style="margin-top:20px">
		<center><font size="6">Edit Data</font></center>

		<hr>

		<?php
		//jika sudah mendapatkan parameter GET id dari URL
		if(isset($_GET['NISN'])){
			//membuat variabel $id untuk menyimpan id dari GET id di URL
			$NISN = $_GET['NISN'];

			//query ke database SELECT tabel mahasiswa berdasarkan id = $id
			$select = mysqli_query($koneksi, "SELECT * FROM `tabel_siswa` WHERE NISN='$NISN'") or die(mysqli_error($koneksi));

			//jika hasil query = 0 maka muncul pesan error
			if(mysqli_num_rows($select) == 0){
				echo '<div class="alert alert-warning">ID tidak ada dalam database.</div>';
				exit();
			//jika hasil query > 0
			}else{
				//membuat variabel $data dan menyimpan data row dari query
				$data = mysqli_fetch_assoc($select);
			}
		}
		?>

		<?php
		//jika tombol simpan di tekan/klik
		if(isset($_POST['submit'])){
			$Nama		  = $_POST['Nama'];
			$Jenis_Kelamin	= $_POST['Jenis_Kelamin'];
			$Jurusan	= $_POST['Jurusan'];

			$sql = mysqli_query($koneksi, "UPDATE tabel_siswa SET Nama='$Nama', Jenis_kelamin='$Jenis_Kelamin', Jurusan='$Jurusan' WHERE NISN='$NISN'") or die(mysqli_error($koneksi));

			if($sql){
				echo '<script>alert("Berhasil menyimpan data."); document.location="index.php?page=tampil_mhs";</script>';
			}else{
				echo '<div class="alert alert-warning">Gagal melakukan proses edit data.</div>';
			}
		}
		?>

		<form action="index.php?page=edit_mhs&Nim=<?php echo $NISN; ?>" method="post">
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">NISN</label>
				<div class="col-md-6 col-sm-6">
					<input type="text" name="NISN" class="form-control" size="4" value="<?php echo $data['NISN']; ?>" readonly required>
				</div>
			</div>
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Nama</label>
				<div class="col-md-6 col-sm-6">
					<input type="text" name="Nama" class="form-control" value="<?php echo $data['Nama']; ?>" required>
				</div>
			</div>
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Jenis Kelamin</label>
				<div class="col-md-6 col-sm-6 ">c
					<div class="btn-group" data-toggle="buttons">
						<label class="btn btn-secondary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
							<input type="radio" class="join-btn" name="Jenis_kelamin" value="Laki-Laki" <?php if($data['Jenis_kelamin'] == 'Laki-Laki'){ echo 'checked'; } ?> required>Laki-Laki
						</label>
						<label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
							<input type="radio" class="join-btn" name="Jenis_kelamin" value="Perempuan" <?php if($data['Jenis_kelamin'] == 'Perempuan'){ echo 'checked'; } ?> required>Perempuan
						</label>
					</div>
				</div>
			</div>
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Jurusan</label>
				<div class="col-md-6 col-sm-6">
					<select name="Jurusan" class="form-control" required>
						<option value="">Pilih Jurusan</option>
						<option value="Rekayasa Perangkat Lunak" <?php if($data['Jurusan'] == 'Rekayasa Perangkat Lunak'){ echo 'selected'; } ?>>Rekayasa Perangkat Lunak</option>
						<option value="Multimedia" <?php if($data['Jurusan'] == 'Multimedia'){ echo 'selected'; } ?>>Multimedia</option>
						<option value="Teknik Komputer Jaringan" <?php if($data['Jurusan'] == 'Teknik Komputer Jaringan'){ echo 'selected'; } ?>>Teknik Komputer Jaringan</option>
					</select>
				</div>
			</div>
			<div class="item form-group">
				<div class="col-md-6 col-sm-6 offset-md-3">
					<input type="submit" name="submit" class="btn btn-primary" value="Simpan">
					<a href="index.php?page=tampil_mhs" class="btn btn-warning">Kembali</a>
				</div>
			</div>
		</form>
	</div>

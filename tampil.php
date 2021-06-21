<?php
//memasukkan file config.php
include('koneksi.php');
?>


	<div class="container" style="margin-top:20px">
		<center><font size="6">Data siswa</font></center>
		<hr>
		<a href="tambah.php"><button class="btn btn-dark right">Tambah Data</button></a>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
		<div class="table-responsive">
		<table class="table table-striped table-hover"
			<thead>
				<tr>
					<th>NO.</th>
					<th>NISN</th>
					<th>Nama </th>
					<th>Jenis kelamin</th>
					<th>Jurusaan</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php
				//query ke database SELECT tabel mahasiswa urut berdasarkan id yang paling besar
				$sql = mysqli_query($koneksi, "SELECT * FROM `tabel_siswa`") or die(mysqli_error($koneksi));
				//jika query diatas menghasilkan nilai > 0 maka menjalankan script di bawah if...
				if(mysqli_num_rows($sql) > 0){
					//membuat variabel $no untuk menyimpan nomor urut
					$no = 1;
					//melakukan perulangan while dengan dari dari query $sql
					while($data = mysqli_fetch_assoc($sql)){
						//menampilkan data perulangan
						echo '
						<tr>
							<td>'.$no.'</td>
							<td>'.$data['NISN'].'</td>
							<td>'.$data['Nama'].'</td>
							<td>'.$data['Jenis_kelamin'].'</td>
							<td>'.$data['Jurusan'].'</td>
							<td>
								<a href= "index.php?page=edit_mhs&Nim='.$data['NISN'].'" class="btn btn-secondary btn-sm">Edit</a>
								<a href= "delete.php?Nim='.$data['NISN'].'" class="btn btn-danger btn-sm" onclick="return confirm(\'Yakin ingin menghapus data ini?\')">Delete</a>
							</td>
						</tr>
						';
						$no++;
					}
				//jika query menghasilkan nilai 0
				}else{
					echo '
					<tr>
						<td colspan="6">Tidak ada data.</td>
					</tr>
					';
				}
				?>
			<tbody>
		</table>
	</div>
	</div>

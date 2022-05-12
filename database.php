<?php require_once("author.php"); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Daftar Pengunjung</title>
	<link rel = "stylesheet" type = "text/css" href = "databasestyle.css">
</head>
<body>

<?php

$koneksi = mysqli_connect("localhost","root","","utsip") or die(mysqli_error());

function tambah($koneksi){
	
	if (isset($_POST['btn_simpan'])){
		$id = time();
		$nama = $_POST['nama'];
		$email = $_POST['email'];
		$alamat = $_POST['alamat'];
		
		if(!empty($nama) && !empty($email) && !empty($alamat) && !empty($tgl)){
			$sql = "INSERT INTO data_user (id,nama, email, alamat, tgl) VALUES(".$id.",'".$nama."','".$email."','".$alamat."','".$tanggal."')";
			$simpan = mysqli_query($koneksi, $sql);
			if($simpan && isset($_GET['aksi'])){
				if($_GET['aksi'] == 'create'){
					header('location: database.php');
				}
			}
		} else {
			$pesan = "Tidak dapat menyimpan, data belum lengkap!";
		}
	}

	?> 
		<form action="" method="POST">
			<section class="base">
				<h2>Tambah Data</h2>
				<label>Nama  <input type="text" name="nama" /></label> <br>
				<label>Email <input type="text" name="email" /></label><br>
				<label>Alamat <input type="text" name="alamat" /></label> <br>
				<thead>
					<button type="submit" name="btn_simpan" value="Simpan">Simpan</button>
					<button type="reset" name="reset" value="reset">Reset</button>
					<a href="admin.php"> Home</a> 
				</thead>
				<p><?php echo isset($pesan) ? $pesan : "" ?></p>
			</section>
		</form>
	<?php

}

function tampil_data($koneksi){
	$sql = "SELECT * FROM data_user";
	$query = mysqli_query($koneksi, $sql);
	
	echo "<fieldset>";
	echo "<legend><h2>Data</h2></legend>";
	
	echo "<table border='1' cellpadding='10'>";
	echo "<tr>
			<th>ID</th>
			<th>Nama</th>
			<th>Email</th>
			<th>Alamat</th>
			<th>Tindakan</th>
		  </tr>";
	
	while($data = mysqli_fetch_array($query)){
		?>
			<tr>
				<td><?php echo $data['id']; ?></td>
				<td><?php echo $data['nama']; ?></td>
				<td><?php echo $data['email']; ?></td>
				<td><?php echo $data['alamat']; ?></td>
				<td>
					<a href="database.php?aksi=update&id=<?php echo $data['id']; ?>&nama=<?php echo $data['nama']; ?>&email=<?php echo $data['email']; ?>&alamat=<?php echo $data['alamat']; ?>&tanggal=<?php echo $data['tgl']; ?>">Ubah</a> |
					<a href="database.php?aksi=delete&id=<?php echo $data['id']; ?>">Hapus</a>
				</td>
			</tr>
		<?php
	}
	echo "</table>";
	echo "</fieldset>";
}

function ubah($koneksi){

	if(isset($_POST['btn_ubah'])){
		$id = $_POST['id'];
		$nama = $_POST['nama'];
		$email = $_POST['email'];
		$alamat = $_POST['alamat'];
		
		if(!empty($nama) && !empty($email) && !empty($alamat) && !empty($tgl)){
			$perubahan = "nama='".$nama."',email=".$email.",alamat=".$alamat.",tgl='".$tgl."'";
			$sql_update = "UPDATE data_user SET ".$perubahan." WHERE id=$id";
			$update = mysqli_query($koneksi, $sql_update);
			if($update && isset($_GET['aksi'])){
				if($_GET['aksi'] == 'update'){
					header('location: database.php');
				}
			}
		} else {
			$pesan = "Data tidak lengkap!";
		}
	}
	
	if(isset($_GET['id'])){
		?>
			<a href="index.php"> &laquo; Home</a> | 
			<a href="database.php"> &laquo; Kembali</a> | 
			<a href="database.php?aksi=create"> (+) Tambah Data</a>
			<hr>
			
			<form action="" method="POST">
			<section class="base">
			<table>
				<h2>Ubah data</h2>
				<input type="hidden" name="id" value="<?php echo $_GET['id'] ?>"/>
				<label>Nama <input type="text" name="nama" value="<?php echo $_GET['nama'] ?>"/></label> <br>
				<label>Email <input type="text" name="email" value="<?php echo $_GET['email'] ?>"/></label><br>
				<label>Alamat <input type="text" name="alamat" value="<?php echo $_GET['alamat'] ?>"/></label> <br>
				<br>
				<label>
					<input type="submit" name="btn_ubah" value="Simpan Perubahan"/> atau <a href="database.php?aksi=delete&id=<?php echo $_GET['id'] ?>"> (x) Hapus data ini</a>!
				</label>
				<br>
				<p><?php echo isset($pesan) ? $pesan : "" ?></p>
			</table>
			</section>
			</form>
		<?php
	}
	
}

function hapus($koneksi){

	if(isset($_GET['id']) && isset($_GET['aksi'])){
		$id = $_GET['id'];
		$sql_hapus = "DELETE FROM data_user WHERE id=" . $id;
		$hapus = mysqli_query($koneksi, $sql_hapus);
		
		if($hapus){
			if($_GET['aksi'] == 'delete'){
				header('location: database.php');
			}
		}
	}
	
}

if (isset($_GET['aksi'])){
	switch($_GET['aksi']){
		case "create":
			echo '<a href="database.php"> &laquo; Home</a>';
			tambah($koneksi);
			break;
		case "read":
			tampil_data($koneksi);
			break;
		case "update":
			ubah($koneksi);
			tampil_data($koneksi);
			break;
		case "delete":
			hapus($koneksi);
			break;
		default:
			echo "<h3>Aksi <i>".$_GET['aksi']."</i> tidaka ada!</h3>";
			tambah($koneksi);
			tampil_data($koneksi);
	}
} else {
	tambah($koneksi);
	tampil_data($koneksi);
}

?>
</body>
</html>
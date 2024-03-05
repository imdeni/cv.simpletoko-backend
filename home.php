<?php
session_start();
if (!isset($_SESSION['username'])) {
	echo '<script>
        alert("Please login first!");
        window.location.href = "../../index.php";
        </script>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>WELCOME!</title>
	<!-- Link -->
	<link rel="stylesheet" href="assets/style.css">
	<link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Judson' rel='stylesheet'>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<!-- <link rel="stylesheet" href="/resources/demos/style.css"> -->
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<body>
	<div class="container">
		<header>
			<div class="logo">
				<img src="icon/logo.png" width="100px" height="50px">
			</div>
			<nav>
				<ul>
					<li id="homeBtn" onclick="showContent('home')">Home</li>
					<div class="dropdown">
						<li><a href="#" class="dropbtn">Master Data</a></li>
						<div class="dropdown-content">
							<li id="userBtn" class="mnu" onclick="showContent('user')">Data User</li>
							<li id="supplierBtn" onclick="showContent('supplier')">Data Supplier</li>
							<li id="pelangganBtn" onclick="showContent('pelanggan')">Data Pelanggan</li>
						</div>
					</div>
					<li id="persediaanBtn" onclick="showContent('persediaan')">Persediaan</li>
					<li id="penjualanBtn" onclick="showContent('penjualan')">Penjualan</li>
					<div class="dropdown">
						<li><a href="#" class="dropbtn">Laporan</a></li>
						<div class="dropdown-content">
							<li id="laporanpersediaanBtn" onclick="showContent('laporanpersediaan')">Laporan Persediaan
							</li>
							<li id="laporanpenjualanBtn" onclick="showContent('laporanpenjualan')">Laporan Penjualan
							</li>
						</div>
					</div>
					<div class="dropdown">
						<li><a href="#" class="dropbtn">Pengaturan</a></li>
						<div class="dropdown-content">
							<li id="logBtn" onclick="showContent('log')">Log Aktivitas!</li>
							<li id="panduanBtn" onclick="showContent('panduan')">Panduan?</li>
						</div>
					</div>
					<li id="logoutButton">logout</li>
				</ul>
			</nav>
			<div class="profil">
				<li><a href="#"><img src="icon/user.png" width="35px" height="35px"></a></li>
			</div>
		</header>
	</div>

	<!-- Konten Home -->
	<div id="homeContent">
		<hr />
		<div class="row">
			<div class="column">
				<b>
					<h1>Welcome to Flortem!</h1>
				</b>
				<div class="p1">
					<h3>Great Product is built by great teams!</h3>
					<p>We help build and manage a team of world-class developers to bring your vision to life.</p>
				</div>
				<button><a href="https://wa.me/08997110638" type="button">Contact Us!</a></button>
				<footer>
					<h2><b>Flortem</b></h2>
					<p>Copyright 2023</p>
				</footer>
			</div>
			<div class="column1">
				<img src="icon/developer.png" width="600px" height="500px">
			</div>
		</div>
	</div>

	<!-- Konten USER -->
	<div id="userContent" style="display:none">
		<br>
		<h1>DATA USER</h1>
		<table>
			<thead>
				<button class="add-button">+ Tambah Data</button><br><br>
				<tr>
					<th>NO.</th>
					<th>ID BARANG</th>
					<th>NAMA BARANG</th>
					<th>QTY</th>
					<th>HARGA BARANG</th>
					<th>AKSI</th>
					<th>NAMA</th>
					<th>KETERANGAN</th>
				</tr>
			</thead>
		</table>
	</div>

	<!-- Konten SUPPLIER -->
	<div id="supplierContent" style="display:none">
		<br>
		<h1>DATA SUPPLIER</h1>
		<table>
			<thead>
				<button class="add-button">+ Tambah Data</button><br><br>
				<tr>
					<th>NO.</th>
					<th>ID SUPPLIER</th>
					<th>NAMA SUPPLIER</th>
					<th>ALAMAT SUPPLIER</th>
					<th>KATEGORI</th>
					<th>AKSI</th>
					<th>KETERANGAN</th>
				</tr>
			</thead>
		</table>
	</div>

	<!-- Konten PELANGGAN -->
	<div id="pelangganContent" style="display:none">
		<br>
		<h1>DATA PELANGGAN</h1>
		<table>
			<thead>
				<button class="add-button">+ Tambah Data</button><br><br>
				<tr>
					<th>NO.</th>
					<th>ID PELANGGAN</th>
					<th>NAMA PELANGGAN</th>
					<th>ALAMAT PELANGGAN</th>
					<th>AKSI</th>
					<th>KETERANGAN</th>
				</tr>
			</thead>
		</table>
	</div>

	<!-- Konten Persediaan -->
	<div id="persediaanContent" style="display:none">
		<br>
		<h1>DAFTAR PERSEDIAAN</h1>
		<table>
			<thead>
				<button class="add-button">+ Tambah Data</button><br><br>
				<tr>
					<th>NO.</th>
					<th>ID BARANG</th>
					<th>NAMA BARANG</th>
					<th>QTY</th>
					<th>HARGA BARANG</th>
					<th>AKSI</th>
					<th>NAMA</th>
					<th>KETERANGAN</th>
				</tr>
			</thead>
		</table>
	</div>

	<!-- Konten Penjualan -->
	<div id="penjualanContent" style="display: none;">
		<br>
		<h1>DAFTAR PENJUALAN</h1>
		<table>
			<thead>
				<tr>
					<th>NO.</th>
					<th>ID PENJUALAN</th>
					<th>ID BARANG</th>
					<th>ID PELANGGAN</th>
					<th>TOTAL HARGA</th>
					<th>ID USER</th>
					<th>AKSI</th>
					<th>NAMA</th>
					<th>KETERANGAN</th>
				</tr>
			</thead>
		</table>
	</div>
	</div>

	<!-- Konten laporan -->
	<div id="laporanpersediaanContent" style="display: none;">
		<br>
		<h1>LAPORAN PERSEDIAAN</h1>
		<form id="orderForm">
			<label for="startDate">Start Date:</label>
			<input type="text" id="startDate" name="startDate" placeholder="mm/dd/yyyy" required>
			<label for="endDate">End Date:</label>
			<input type="text" id="endDate" name="endDate" placeholder="mm/dd/yyyy" required>
			<button type="submit">Tampilkan</button>
		</form>
		<div id="searchContainer">
			<label for="search">Search:</label>
			<input type="text" id="search" name="search" placeholder="cari...">
		</div>
		<table id="orderTable">
			<thead>
				<tr>
					<th>NO.</th>
					<th>ID BARANG</th>
					<th>NAMA BARANG</th>
					<th>QTY</th>
					<th>KATEGORI</th>
					<th>JUMLAH BARANG</th>
				</tr>
			</thead>
			<tbody id="orderList">
				<!-- Order entries will be inserted here by your script -->
			</tbody>
		</table>
		<div id="pagination">
			<button id="prev">Previous</button>
			<span id="currentPage">1</span>
			<button id="next">Next</button>
		</div>
	</div>

	<div id="laporanpenjualanContent" style="display: none;">
		<br>
		<h1>LAPORAN PENJUALAN</h1>
		<form id="orderForm">
			<label for="startDate">Start Date:</label>
			<input type="text" id="startDate" name="startDate" placeholder="mm/dd/yyyy" required>
			<label for="endDate">End Date:</label>
			<input type="text" id="endDate" name="endDate" placeholder="mm/dd/yyyy" required>
			<button type="submit">Tampilkan</button>
		</form>
		<div id="searchContainer">
			<label for="search">Search:</label>
			<input type="text" id="search" name="search" placeholder="cari...">
		</div>
		<table id="orderTable">
			<thead>
				<tr>
					<th>NO.</th>
					<th>TANGGAL PESANAN</th>
					<th>ID PENJUALAN</th>
					<th>ID PELANGGAN</th>
					<th>NAMA BARANG</th>
					<th>HARGA</th>
					<th>TOTAL</th>
					<th>METODE PEMBAYARAN</th>
					<th>STATUS PEMBAYARAN</th>
				</tr>
			</thead>
			<tbody id="orderList">
				<!-- Order entries will be inserted here by your script -->
			</tbody>
		</table>
		<div id="pagination">
			<button id="prev">Previous</button>
			<span id="currentPage">1</span>
			<button id="next">Next</button>
		</div>
	</div>

	<!-- Konten Pengaturan -->
	<div id="logContent" style="display: none;">
		<br>
		<h1>Log Aktivitas</h1>
	</div>

	<div id="panduanContent" style="display: none;">
		<br>
		<h1>Panduan?</h1>
	</div>

	<script src="assets/script.js"></script>
	<!-- <script src="date.js"></script> -->
	<script>
		document.getElementById("logoutButton").addEventListener("click", function () {
			if (confirm("Are you sure you want to logout?")) {
				// Send AJAX request to logout.php
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function () {
					if (this.readyState == 4 && this.status == 200) {
						// Redirect to login page after logout
						window.location.href = "Setting/logoutSet.php";
					}
				};
				xhttp.open("GET", "Setting/logoutSet.php", true);
				xhttp.send();
			}
		});
	</script>
</body>

</html>
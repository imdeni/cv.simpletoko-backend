<?php include("../../Setting/dbSet.php");
session_start();
if (!isset($_SESSION['username'])) {
	echo '<script>
        alert("Please login first!");
        window.location.href = "../../index.php";
        </script>';
}
$sql = "SELECT * FROM persediaan";
$stmt = $conn->prepare($sql);
if (!$stmt) {
	die("sql error" . $sql);
}
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Form persediaan</title>
	<!-- Link -->
	<link rel="stylesheet" href="../../assets/mystyle.css">
	<link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
</head>
<style>
	.overlay {
		display: none;
		position: fixed;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		background-color: rgba(0, 0, 0, 0.5);
		/* Semi-transparent background */
		z-index: 1000;
	}

	.popup {
		display: none;
		position: fixed;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
		background-color: white;
		padding: 20px;
		border: 1px solid #ccc;
		box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
		z-index: 1000;
	}
</style>

<body>

	<?php include 'component/nav.php'; ?>


	<!-- Konten Persediaan -->
	<div id="persediaanContent">
		<br>
		<h1>DAFTAR PERSEDIAAN</h1>
		<table>
			<thead>
				<button onclick="openForm()" class="add-button">+ Tambah Data</button><br><br>
				<tr>
					<th>NO.</th>
					<th>NAMA BARANG</th>
					<th>QTY</th>
					<th>HARGA BARANG</th>
                    <th>KATEGORI</th>
					<th>AKSI</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$counter = 1;
				while ($row = $result->fetch_assoc()) {
					echo "<tr>";
					echo "<td>" . $counter++ . "</td>";
					echo "<td>" . $row['nama_barang'] . "</td>";
					echo "<td>" . $row['qty'] . "</td>";
					echo "<td>" . $row['harga_barang'] . "</td>";
					echo "<td>" . $row['kategori'] . "</td>";
					?>
					<td>
						<a onclick="openFormEdit(<?php echo $row['id_barang']; ?>)"><button>Edit</button></a>
						<a href="../../Setting/persediaandeleteSet.php?id=<?php echo $row['id_barang']; ?>"><button>Delete</button></a>
					</td>
					</tr>
					<?php
				}
				?>
			</tbody>
		</table>
	</div>

	<!-- Tambah persediaan -->
	<div class="overlay" id="overlay"></div>
	<div class="popup" id="myForm">
		<form action="../../Setting/datapersediaanSet.php" method="post">
			<h2>Tambah persediaan</h2>
			<label for="nama">Nama barang :</label>
			<input type="text" id="nama" name="nama"><br>
			<label for="qty">Quantity :</label>
			<input type="number" id="qty" name="qty"><br>
            <label for="harga">Harga :</label>
			<input type="number" id="harga" name="harga"><br>
            <label for="kategori">Kategori :</label>
			<input type="text" id="kategori" name="kategori">
			<br><br>
			<button type="submit">Submit</button>
			<button type="button" onclick="closeForm()">Close</button>
		</form>
	</div>

	<!-- Edit user -->
	<div class="popup" id="editForm" style="display: none;">
		<form id="editpersediaanForm" method="post">
		<h2>Edit persediaan</h2>
		<label for="nama">Nama barang :</label>
			<input type="text" id="namaEdit" name="nama"><br>
			<label for="qty">Quantity :</label>
			<input type="number" id="qtyEdit" name="qty"><br>
            <label for="harga">Harga :</label>
			<input type="number" id="hargaEdit" name="harga"><br>
            <label for="kategori">Kategori :</label>
			<input type="text" id="kategoriEdit" name="kategori">
			<br><br>
			<button type="submit">Submit</button>
			<button type="button" onclick="closeFormEdit()">Close</button>
		</form>
	</div>


	<script>
		function openForm() {
			document.getElementById("overlay").style.display = "block";
			document.getElementById("myForm").style.display = "block";
		}
		function closeForm() {
			document.getElementById("overlay").style.display = "none";
			document.getElementById("myForm").style.display = "none";
		}
		function openFormEdit(id) {
			document.getElementById("overlay").style.display = "block";
			document.getElementById("editForm").style.display = "block";
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function () {
				if (this.readyState == 4 && this.status == 200) {
					console.log(this.responseText);
					var data = JSON.parse(this.responseText);

					document.getElementById("namaEdit").value = data.nama_barang;
					document.getElementById("qtyEdit").value = data.qty;
					document.getElementById("hargaEdit").value = data.harga_barang;
					document.getElementById("kategoriEdit").value = data.kategori;
					document.getElementById("editpersediaanForm").action = "../../Setting/persediaanupdateSet.php?id=" + id;

				}
			};
			xhttp.open("GET", "../../Setting/persediaaneditSet.php?id=" + id, true);
			xhttp.send();
		}
		function closeFormEdit() {
			document.getElementById("overlay").style.display = "none";
			document.getElementById("editForm").style.display = "none";
		}
	</script>
</body>

</html>
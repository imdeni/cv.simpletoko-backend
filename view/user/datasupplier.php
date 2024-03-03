<?php include("../../Setting/dbSet.php");
session_start();
if (!isset($_SESSION['username'])) {
	echo '<script>
        alert("Please login first!");
        window.location.href = "index.php";
        </script>';
}
$sql = "SELECT * FROM supplier";
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
	<title>WELCOME!</title>
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


	<!-- Konten USER -->
	<div id="userContent">
		<br>
		<h1>DATA SUPPLIER</h1>
		<table>
			<thead>
				<button onclick="openForm()" class="add-button">+ Tambah Supplier</button><br><br>
				<tr>
					<th>NO.</th>
					<th>Nama Supplier</th>
					<th>Alamat Supplier</th>
					<th>AKSI</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$counter = 1;
				while ($row = $result->fetch_assoc()) {
					echo "<tr>";
					echo "<td>" . $counter++ . "</td>";
					echo "<td>" . $row['nama_supplier'] . "</td>";
					echo "<td>" . $row['alamat_supplier'] . "</td>";
					?>
					<td>
						<a onclick="openFormEdit(<?php echo $row['id_supplier']; ?>)"><button>Edit</button></a>
						<a href="../../Setting/supplierdeleteSet.php?id=<?php echo $row['id_supplier']; ?>"><button>Delete</button></a>
					</td>
					</tr>
					<?php
				}
				?>
			</tbody>
		</table>
	</div>

	<!-- Tambah Supplier -->
	<div class="overlay" id="overlay"></div>
	<div class="popup" id="myForm">
		<form action="../../Setting/datasupplierSet.php" method="post">
			<h2>Tambah Supplier</h2>
			<label for="nama">Nama Supplier :</label>
			<input type="text" id="nama" name="nama"><br>
			<label for="alamat">Alamat Supplier :</label>
			<input type="text" id="alamat" name="alamat">
			<br><br>
			<button type="submit">Submit</button>
			<button type="button" onclick="closeForm()">Close</button>
		</form>
	</div>

	<!-- Edit user -->
	<div class="popup" id="editForm" style="display: none;">
		<form id="editSupplierForm" method="post">
		<h2>Edit Supplier</h2>
			<label for="nama">Nama Supplier :</label>
			<input type="text" id="namaEdit" name="nama"><br>
			<label for="alamat">Alamat Supplier :</label>
			<input type="text" id="alamatEdit" name="alamat">
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

					document.getElementById("namaEdit").value = data.nama_supplier;
					document.getElementById("alamatEdit").value = data.alamat_supplier;
					document.getElementById("editSupplierForm").action = "../../Setting/supplierupdateSet.php?id=" + id;

				}
			};
			xhttp.open("GET", "../../Setting/suppliereditSet.php?id=" + id, true);
			xhttp.send();
		}
		function closeFormEdit() {
			document.getElementById("overlay").style.display = "none";
			document.getElementById("editForm").style.display = "none";
		}
	</script>
</body>

</html>
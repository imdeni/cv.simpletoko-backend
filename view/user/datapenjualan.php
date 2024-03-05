<?php include("../../Setting/dbSet.php");
session_start();
if (!isset($_SESSION['username'])) {
    echo '<script>
        alert("Please login first!");
        window.location.href = "../../index.php";
        </script>';
}
$sql = "SELECT * FROM supplier";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("sql error" . $sql);
}
$stmt->execute();
$result = $stmt->get_result();

$sqlpersediaan = "SELECT * FROM persediaan";
$stmtpersediaan = $conn->prepare($sqlpersediaan);
if (!$stmtpersediaan) {
    die("sql error" . $sqlpersediaan);
}
$stmtpersediaan->execute();
$resultpersediaan = $stmtpersediaan->get_result();

$sqlpelanggan = "SELECT * FROM pelanggan";
$stmtpelanggan = $conn->prepare($sqlpelanggan);
if (!$stmtpelanggan) {
    die("sql error" . $sqlpelanggan);
}
$stmtpelanggan->execute();
$resultpelanggan = $stmtpelanggan->get_result();

$sqlpenjualan = "SELECT * FROM penjualan";
$stmtpenjualan = $conn->prepare($sqlpenjualan);
if (!$stmtpenjualan) {
    die("sql error" . $sqlpenjualan);
}
$stmtpenjualan->execute();
$resultpenjualan = $stmtpenjualan->get_result();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Penjualan</title>
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Include Select2 CSS and JS files -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <!-- Link -->
    <!-- Include Select2 CSS -->
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

    <!-- Konten Penjualan -->
    <div>
        <br>
        <h1>Penjualan</h1>
        <table>
            <thead>
                <label for=""
                    style="padding: 0 5px;background-color:white;font-weight:bold;white;margin-left:10px;margin-top:-12px;position:absolute;">Tambah
                    penjualan</label>
                <div class="border">
                    <form action="../../Setting/datapenjualanSet.php" method="post">
                        <div class="column-container">
                            <label for="">Nama barang : </label>
                            <select name="nama" id="select2" style="min-width: 200px;">
                                <option>Silahkan pilih barang</option>
                                <?php
                                while ($row = $resultpersediaan->fetch_assoc()) {
                                    echo '<option value="' . $row['nama_barang'] . '">' . $row['nama_barang'] . '</option>';
                                }
                                ?>
                            </select><br>
                        </div>
                        <div class="column-container">
                            <label for="">Quantity : </label>
                            <input type="int" name="qty" value="" id="qty">
                        </div><br>
                        <div class="column-container">
                            <label for="">Stok : </label>
                            <input type="int" name="stok" readonly id="fillqty">
                        </div><br>
                        <div class="column-container">
                            <label for="">Harga : </label>
                            <input type="int" name="harga" readonly id="fillharga">
                        </div><br>
                        <div class="column-container">
                            <label for="">Kategori : </label>
                            <input type="text" name="kategori" readonly id="fillkategori">
                        </div>
                        <div class="column-container">
                            <label for="">Nama pelanggan : </label>
                            <select name="nama_pelanggan" id="" style="min-width: 200px;">
                                <option>Pilih pelanggan</option>
                                <?php
                                while ($rowpelanggan = $resultpelanggan->fetch_assoc()) {
                                    echo '<option value="' . $rowpelanggan['nama_pelanggan'] . '">' . $rowpelanggan['nama_pelanggan'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="column-container">
                            <label for="">Nama user : </label>
                            <input type="text" name="nama_user" value="<?php echo $_SESSION['username'] ?>" readonly>
                        </div>
                        <button type="submit">Submit</button>
                    </form>
                </div>
                <br>
                <tr>
                    <th>NO.</th>
                    <th>NAMA BARANG</th>
                    <th>JUMLAH</th>
                    <th>HARGA BARANG</th>
                    <th>TOTAL HARGA</th>
                    <th>NAMA USER</th>
                    <th>NAMA PELANGGAN</th>
                    <th>AKSI</th>
                </tr>
            </thead>
            <tbody>
				<?php
				$counter = 1;
				while ($row = $resultpenjualan->fetch_assoc()) {
					echo "<tr>";
					echo "<td>" . $counter++ . "</td>";
					echo "<td>" . $row['nama_barang'] . "</td>";
					echo "<td>" . $row['jumlah'] . "</td>";
					echo "<td>" . $row['harga'] . "</td>";
					echo "<td>" . $row['total_harga'] . "</td>";
					echo "<td>" . $row['nama_user'] . "</td>";
                    echo "<td>" . $row['nama_pelanggan'] . "</td>";
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
    <script>
        $(document).ready(function () {
            // Initialize Select2
            $('#select2').select2();
            $('#select2').on('change', function () {

                // Make an AJAX request to fetch data based on the selected value
                $.ajax({
                    url: '../../Setting/penjualanfillSet.php',  // Replace with your server-side script
                    method: 'POST',  // Adjust the HTTP method if needed
                    data: { selectedValue: $('#select2').val() },
                    success: function (responseString) {
                        // Parse the JSON string into a JavaScript object
                        var response = JSON.parse(responseString);

                        // Update your UI or auto-fill the input field
                        $('#fillqty').val(response.qty);
                        $('#fillharga').val(response.harga_barang);
                        $('#fillkategori').val(response.kategori)
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
</body>

</html>
<?php include("dbSet.php");

$nama = $_POST['nama'];
$qty = $_POST['qty'];
$stok = $_POST['stok'];
$harga = $_POST['harga'];
$kategori = $_POST['kategori'];
$nama_pelanggan = $_POST['nama_pelanggan'];
$nama_user = $_POST['nama_user'];
$totalharga = $qty * $harga;
$stokterakhir = $stok - $qty;

if ($nama == "") {
    echo '<script>
            alert("nama barang tidak boleh kosong!");
            window.location.href = "../view/user/datapenjualan.php";
            </script>';
} elseif ($qty == "") {
    echo '<script>
            alert("qty tidak boleh kosong!");
            window.location.href = "../view/user/datapenjualan.php";
            </script>';
} elseif ($stok == "") {
    echo '<script>
            alert("stok tidak boleh kosong!");
            window.location.href = "../view/user/datapenjualan.php";
            </script>';
} elseif ($harga == "") {
    echo '<script>
            alert("harga tidak boleh kosong!");
            window.location.href = "../view/user/datapenjualan.php";
            </script>';
} elseif ($stok == "") {
    echo '<script>
            alert("stok tidak boleh kosong!");
            window.location.href = "../view/user/datapenjualan.php";
            </script>';
} elseif ($nama_pelanggan == "") {
    echo '<script>
            alert("nama pelanggan tidak boleh kosong!");
            window.location.href = "../view/user/datapenjualan.php";
            </script>';
} elseif ($nama_user == "") {
    echo '<script>
            alert("nama user tidak boleh kosong!");
            window.location.href = "../view/user/datapenjualan.php";
            </script>';
} else {

    if ($stok - $qty <= -1) {
        echo '<script>
            alert("Stok barang kurang dari 0, tidak dapat melakukan penjualan!");
            window.location.href = "../view/user/datapenjualan.php";
            </script>';
    } else {
        // insert data penjualan on db
        $sql = "INSERT INTO penjualan (nama_barang,nama_pelanggan,harga,total_harga,nama_user,jumlah) VALUES (?, ?,?, ?,?,?)";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            die("sql error" . $sql);
        }
        $stmt->bind_param("ssiis", $nama, $nama_pelanggan, $harga, $totalharga, $nama_user,$qty);

        if ($stmt->execute()) {
            $sqlupdate = "UPDATE persediaan SET qty=? WHERE nama_barang=?";
            $stmtupdate = $conn->prepare($sqlupdate);
            if (!$stmtupdate) {
                die("sql error" . $sqlupdate);
            }
            $stmtupdate->bind_param("is", $stokterakhir, $nama);
            if ($stmtupdate->execute()) {
                echo '<script>
            alert("Data penjualan berhasil di tambahkan!");
            window.location.href = "../view/user/datapenjualan.php";
            </script>';
            } else {
                echo '<script>
                alert("Data stok persediaan gagal di update!");
                window.location.href = "../view/user/datapenjualan.php";
                </script>';
            }
            $stmt->close();
            $stmtupdate->close();
            $conn->close();

        } else {
            echo '<script>
            alert("Data penjualan gagal di tambahkan!");
            window.location.href = "../view/user/datapenjualan.php";
            </script>';
        }
    }
}


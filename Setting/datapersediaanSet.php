<?php include("dbSet.php");

// Get data input on insert data persediaan
$nama = $_POST['nama'];
$qty = $_POST['qty'];
$harga = $_POST['harga'];
$kategori = $_POST['kategori'];

if ($nama == "") {
    echo '<script>
            alert("Nama persediaan tidak boleh kosong!");
            window.location.href = "../view/user/datapersediaan.php";
            </script>';
} elseif ($qty == "") {
    echo '<script>
            alert("Quantity tidak boleh kosong!");
            window.location.href = "../view/user/datapersediaan.php";
            </script>';
} elseif ($harga == "") {
    echo '<script>
            alert("Harga tidak boleh kosong!");
            window.location.href = "../view/user/datapersediaan.php";
            </script>';
} elseif ($kategori == "") {
    echo '<script>
            alert("Kategori tidak boleh kosong!");
            window.location.href = "../view/user/datapersediaan.php";
            </script>';
} else {
    // Check if the persediaan exists in the database
    $sqlcheck = "SELECT * FROM persediaan WHERE nama_barang = ?";
    $checkdata = $conn->prepare($sqlcheck);
    if (!$checkdata) {
        die("sql error" . $sqlcheck);
    }
    $checkdata->bind_param("s", $nama);
    $checkdata->execute();
    $result = $checkdata->get_result();
    if ($result->num_rows > 0) {
        echo '<script>
            alert("persediaan sudah ada!");
            window.location.href = "../view/user/datapersediaan.php";
            </script>';
    } else {
        //insert data persediaan on db
        $sql = "INSERT INTO persediaan (nama_barang,qty,harga_barang,kategori) VALUES (?, ?,?,?)";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            die("sql error" . $sql);
        }
        $stmt->bind_param("siis", $nama, $qty, $harga, $kategori);
        if ($stmt->execute()) {
            echo '<script>
            alert("Data persediaan berhasil di tambahkan!");
            window.location.href = "../view/user/datapersediaan.php";
            </script>';
        } else {
            echo '<script>
            alert("Data persediaan gagal di tambahkan!");
            window.location.href = "../view/user/datapersediaan.php";
            </script>';
        }
        $stmt->close();
        $conn->close();
    }
}


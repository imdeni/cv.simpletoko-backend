<?php include("dbSet.php");

// Get data input on insert data pelanggan
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];

if ($nama == "") {
    echo '<script>
            alert("Nama pelanggan tidak boleh kosong!");
            window.location.href = "../view/user/datapelanggan.php";
            </script>';
} elseif ($alamat == "") {
    echo '<script>
            alert("Alamat tidak boleh kosong!");
            window.location.href = "../view/user/datapelanggan.php";
            </script>';
} else {
    // Check if the pelanggan exists in the database
    $sqlcheck = "SELECT * FROM pelanggan WHERE nama_pelanggan = ?";
    $checkdata = $conn->prepare($sqlcheck);
    if (!$checkdata) {
        die("sql error" . $sqlcheck);
    }
    $checkdata->bind_param("s", $username);
    $checkdata->execute();
    $result = $checkdata->get_result();
    if ($result->num_rows > 0) {
        echo '<script>
            alert("pelanggan sudah ada!");
            window.location.href = "../view/user/datapelanggan.php";
            </script>';
    } else {
        //insert data pelanggan on db
        $sql = "INSERT INTO pelanggan (nama_pelanggan,alamat_pelanggan) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            die("sql error" . $sql);
        }
        $stmt->bind_param("ss", $nama, $alamat);
        if ($stmt->execute()) {
            echo '<script>
            alert("Data pelanggan berhasil di tambahkan!");
            window.location.href = "../view/user/datapelanggan.php";
            </script>';
        } else {
            echo '<script>
            alert("Data pelanggan gagal di tambahkan!");
            window.location.href = "../view/user/datapelanggan.php";
            </script>';
        }
        $stmt->close();
        $conn->close();
    }
}


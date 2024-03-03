<?php include("dbSet.php");

// Get data input on insert data supplier
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];

if ($nama == "") {
    echo '<script>
            alert("Nama supplier tidak boleh kosong!");
            window.location.href = "../view/user/datasupplier.php";
            </script>';
} elseif ($alamat == "") {
    echo '<script>
            alert("Alamat tidak boleh kosong!");
            window.location.href = "../view/user/datasupplier.php";
            </script>';
} else {
    // Check if the supplier exists in the database
    $sqlcheck = "SELECT * FROM supplier WHERE nama_supplier = ?";
    $checkdata = $conn->prepare($sqlcheck);
    if (!$checkdata) {
        die("sql error" . $sqlcheck);
    }
    $checkdata->bind_param("s", $username);
    $checkdata->execute();
    $result = $checkdata->get_result();
    if ($result->num_rows > 0) {
        echo '<script>
            alert("Supplier sudah ada!");
            window.location.href = "../view/user/datasupplier.php";
            </script>';
    } else {
        //insert data supplier on db
        $sql = "INSERT INTO supplier (nama_supplier,alamat_supplier) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            die("sql error" . $sql);
        }
        $stmt->bind_param("ss", $nama, $alamat);
        if ($stmt->execute()) {
            echo '<script>
            alert("Data supplier berhasil di tambahkan!");
            window.location.href = "../view/user/datasupplier.php";
            </script>';
        } else {
            echo '<script>
            alert("Data supplier gagal di tambahkan!");
            window.location.href = "../view/user/datasupplier.php";
            </script>';
        }
        $stmt->close();
        $conn->close();
    }
}


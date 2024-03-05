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

    $sqlcheck2 = "SELECT * FROM persediaan WHERE nama_barang = ? and harga_barang = ?";
    $checkdata2 = $conn->prepare($sqlcheck2);

    if (!$checkdata) {
        die("sql error" . $sqlcheck);
    }
    if (!$checkdata2) {
        die("sql error" . $sqlcheck2);
    }

    $checkdata->bind_param("s", $nama);
    $checkdata->execute();
    $result = $checkdata->get_result();

    $checkdata2->bind_param("si", $nama, $harga);
    $checkdata2->execute();
    $result2 = $checkdata2->get_result();


    if ($result2->num_rows > 0) {
        $row = $result2->fetch_assoc();
        $sql = "UPDATE persediaan SET qty=? WHERE nama_barang=?";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            die("sql error" . $sql);
        }
        $final_qty = $row['harga_barang'] + $qty;
        $stmt->bind_param("is", $final_qty, $nama);
        if ($stmt->execute()) {
            echo '<script>
                alert("Berhasil menambahkan persediaan!");
                window.location.href = "../view/user/datapersediaan.php";
                </script>';
        } else {
            echo '<script>
                alert("Error!' . $stmt->error . '");
                window.location.href = "../view/user/datapersediaan.php";
                </script>';
        }
        $stmt->close();
        $conn->close();
    } else if ($result->num_rows > 0) {
        echo '<script>
            alert("persediaan sudah ada!");
            window.location.href = "../view/user/datapersediaan.php";
            </script>'; 
    } else {
        //insert data persediaan on db
        $sql2 = "INSERT INTO persediaan (nama_barang,qty,harga_barang,kategori) VALUES (?, ?,?,?)";
        $stmt2 = $conn->prepare($sql2);
        if (!$stmt2) {
            die("sql error" . $sql2);
        }
        $stmt2->bind_param("siis", $nama, $qty, $harga, $kategori);
        if ($stmt2->execute()) {
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
        $stmt2->close();
        $conn->close();

    }
}


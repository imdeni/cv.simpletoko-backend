<?php
include 'dbSet.php';

if (isset($_GET['id'])) {
    $id = $conn->real_escape_string($_GET['id']);

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
            alert("persediaan sudah ada, gagal edit!");
            window.location.href = "../view/user/datapersediaan.php";
            </script>';
        } else {
            // Prepare and execute SQL UPDATE statement
            $sql = "UPDATE persediaan SET nama_barang=?, qty=?,harga_barang=?,kategori=? WHERE id_barang=?";
            $stmt = $conn->prepare($sql);
            if (!$stmt) {
                die("sql error" . $sql);
            }

            $stmt->bind_param("siisi", $nama, $qty, $harga, $kategori, $id);
            if ($stmt->execute()) {
                echo '<script>
                    alert("persediaan berhasil di edit!");
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
        }
    }
}
?>
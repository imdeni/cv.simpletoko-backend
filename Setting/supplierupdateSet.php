<?php
include 'dbSet.php';

if (isset($_GET['id'])) {
    $id = $conn->real_escape_string($_GET['id']);

    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];

    if (strpos($nama, ' ') !== false || $nama == "") {
        echo '<script>
                alert("Nama supplier tidak boleh kosong atau menggunakan spasi!");
                window.location.href = "../view/user/datasupplier.php";
                </script>';
    } elseif ($alamat == "") {
        echo '<script>
                alert("Alamat tidak boleh kosong!");
                window.location.href = "../view/user/datasupplier.php";
                </script>';
    } else {
        $sqlcheck = "SELECT * FROM supplier WHERE nama_supplier = ?";
        $checkdata = $conn->prepare($sqlcheck);
        if (!$checkdata) {
            die("sql error" . $sqlcheck);
        }
        $checkdata->bind_param("s", $nama);
        $checkdata->execute();
        $result = $checkdata->get_result();
        if ($result->num_rows > 0) {
            echo '<script>
            alert("Supplier sudah ada, gagal edit!");
            window.location.href = "../view/user/datasupplier.php";
            </script>';
        } else {
            // Prepare and execute SQL UPDATE statement
            $sql = "UPDATE supplier SET nama_supplier=?, alamat_supplier=? WHERE id_supplier=?";
            $stmt = $conn->prepare($sql);
            if (!$stmt) {
                die("sql error" . $sql);
            }

            $stmt->bind_param("ssi", $nama, $alamat,$id);
            if ($stmt->execute()) {
                echo '<script>
                    alert("supplier berhasil di edit!");
                    window.location.href = "../view/user/datasupplier.php";
                    </script>';
            } else {
                echo '<script>
                    alert("Error!' . $stmt->error . '");
                    window.location.href = "../view/user/datauser.php";
                    </script>';
            }
            $stmt->close();
            $conn->close();
        }
    }
}
?>
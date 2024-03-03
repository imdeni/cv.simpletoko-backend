<?php
include 'dbSet.php';

if (isset($_GET['id'])) {
    $id = $conn->real_escape_string($_GET['id']);

    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];

    if (strpos($nama, ' ') !== false || $nama == "") {
        echo '<script>
                alert("Nama pelanggan tidak boleh kosong atau menggunakan spasi!");
                window.location.href = "../view/user/datapelanggan.php";
                </script>';
    } elseif ($alamat == "") {
        echo '<script>
                alert("Alamat tidak boleh kosong!");
                window.location.href = "../view/user/datapelanggan.php";
                </script>';
    } else {
        $sqlcheck = "SELECT * FROM pelanggan WHERE nama_pelanggan = ?";
        $checkdata = $conn->prepare($sqlcheck);
        if (!$checkdata) {
            die("sql error" . $sqlcheck);
        }
        $checkdata->bind_param("s", $nama);
        $checkdata->execute();
        $result = $checkdata->get_result();
        if ($result->num_rows > 0) {
            echo '<script>
            alert("pelanggan sudah ada, gagal edit!");
            window.location.href = "../view/user/datapelanggan.php";
            </script>';
        } else {
            // Prepare and execute SQL UPDATE statement
            $sql = "UPDATE pelanggan SET nama_pelanggan=?, alamat_pelanggan=? WHERE id_pelanggan=?";
            $stmt = $conn->prepare($sql);
            if (!$stmt) {
                die("sql error" . $sql);
            }

            $stmt->bind_param("ssi", $nama, $alamat,$id);
            if ($stmt->execute()) {
                echo '<script>
                    alert("pelanggan berhasil di edit!");
                    window.location.href = "../view/user/datapelanggan.php";
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
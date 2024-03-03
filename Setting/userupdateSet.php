<?php
include 'dbSet.php';

if (isset($_GET['id'])) {
    $id = $conn->real_escape_string($_GET['id']);

    $username = $_POST['username'];
    $password = $_POST['password'];
    $alamat = $_POST['alamat'];
    $jabatan = $_POST['jabatan'];

    if (strpos($username, ' ') !== false || strpos($password, ' ') !== false || $username == "" || $password = "") {
        echo '<script>
                alert("Username atau password tidak boleh kosong atau menggunakan spasi!");
                window.location.href = "../view/user/datauser.php";
                </script>';
    } elseif ($alamat == "") {
        echo '<script>
                alert("Alamat tidak boleh kosong!");
                window.location.href = "../view/user/datauser.php";
                </script>';
    } else {
        $sqlcheck = "SELECT * FROM users WHERE username_user = ?";
        $checkdata = $conn->prepare($sqlcheck);
        if (!$checkdata) {
            die("sql error" . $sqlcheck);
        }
        $checkdata->bind_param("s", $username);
        $checkdata->execute();
        $result = $checkdata->get_result();
        if ($result->num_rows > 0) {
            echo '<script>
            alert("User sudah ada, gagal edit!");
            window.location.href = "../view/user/datauser.php";
            </script>';
        } else {
            // Prepare and execute SQL UPDATE statement
            $sql = "UPDATE users SET username_user=?, password=?,alamat_user=?,jabatan_user=? WHERE id_user=?";
            $stmt = $conn->prepare($sql);
            if (!$stmt) {
                die("sql error" . $sql);
            }

            $stmt->bind_param("ssssi", $username, $password, $alamat, $jabatan, $id);
            if ($stmt->execute()) {
                echo '<script>
                    alert("User berhasil di edit edit!");
                    window.location.href = "../view/user/datauser.php";
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
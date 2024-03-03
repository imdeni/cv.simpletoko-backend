<?php include("dbSet.php");

// Get data input on insert data user
$username = $_POST['username'];
$password = $_POST['password'];
$alamat = $_POST['alamat'];
$jabatan = $_POST['jabatan'];

if (strpos($username, ' ') !== false || strpos($password, ' ') !== false) {
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
    // Check if the user exists in the database
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
            alert("User sudah ada!");
            window.location.href = "../view/user/datauser.php";
            </script>';
    } else {
        //insert data users on db
        $sql = "INSERT INTO users (username_user, password,alamat_user,jabatan_user) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            die("sql error" . $sql);
        }
        $stmt->bind_param("ssss", $username, $password, $alamat, $jabatan);
        if ($stmt->execute()) {
            echo '<script>
            alert("Data user berhasil di tambahkan!");
            window.location.href = "../view/user/datauser.php";
            </script>';
        } else {
            echo '<script>
            alert("Data user gagal di tambahkan!");
            window.location.href = "../view/user/datauser.php";
            </script>';
        }
        $stmt->close();
        $conn->close();
    }
}


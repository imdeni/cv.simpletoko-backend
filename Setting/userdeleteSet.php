<?php 
include 'dbSet.php';
if (isset($_GET['id'])) {
    $id = $conn->real_escape_string($_GET['id']);

    $sql = "DELETE FROM users WHERE id_user = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id);

    if ($stmt->execute()) {
        echo '<script>
            alert("Data user berhasil di hapus!");
            window.location.href = "../view/user/datauser.php";
            </script>';
    } else {
        echo '<script>
            alert("Data user gagal di hapus!"'. $conn->error.');
            window.location.href = "../view/user/datauser.php";
            </script>';
    }
    $stmt->close();
    $conn->close();
} else {
    echo '<script>
            alert("Id tidak di temukan!");
            window.location.href = "../view/user/datauser.php";
            </script>';
}
?>
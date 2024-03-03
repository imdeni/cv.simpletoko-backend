<?php 
include 'dbSet.php';
if (isset($_GET['id'])) {
    $id = $conn->real_escape_string($_GET['id']);

    $sql = "DELETE FROM pelanggan WHERE id_pelanggan = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id);

    if ($stmt->execute()) {
        echo '<script>
            alert("Data pelanggan berhasil di hapus!");
            window.location.href = "../view/user/datapelanggan.php";
            </script>';
    } else {
        echo '<script>
            alert("Data pelanggan gagal di hapus!"'. $conn->error.');
            window.location.href = "../view/user/datapelanggan.php";
            </script>';
    }
    $stmt->close();
    $conn->close();
} else {
    echo '<script>
            alert("Id tidak di temukan!");
            window.location.href = "../view/user/datapelanggan.php";
            </script>';
}
?>
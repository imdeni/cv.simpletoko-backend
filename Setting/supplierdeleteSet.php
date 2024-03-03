<?php 
include 'dbSet.php';
if (isset($_GET['id'])) {
    $id = $conn->real_escape_string($_GET['id']);

    $sql = "DELETE FROM supplier WHERE id_supplier = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id);

    if ($stmt->execute()) {
        echo '<script>
            alert("Data supplier berhasil di hapus!");
            window.location.href = "../view/user/datasupplier.php";
            </script>';
    } else {
        echo '<script>
            alert("Data supplier gagal di hapus!"'. $conn->error.');
            window.location.href = "../view/user/datasupplier.php";
            </script>';
    }
    $stmt->close();
    $conn->close();
} else {
    echo '<script>
            alert("Id tidak di temukan!");
            window.location.href = "../view/user/datasupplier.php";
            </script>';
}
?>
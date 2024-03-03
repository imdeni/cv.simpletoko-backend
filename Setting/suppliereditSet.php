<?php
include 'dbSet.php';
if (isset($_GET['id'])) {
    $id = $conn->real_escape_string($_GET['id']);

    $sql = "SELECT * FROM supplier WHERE id_supplier = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("sql error" . $sql);
    }

    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        header('Content-Type: application/json');
        echo json_encode($row);
    } else {
        echo json_encode(array('error' => 'Data tidak di temukan'));
    }

} else {
    echo '<script>
            alert("Id tidak di temukan!");
            window.location.href = "../view/user/datasupplier.php";
            </script>';
}
?>
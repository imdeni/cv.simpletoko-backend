<?php include('dbSet.php');
$selectedValue = $_POST['selectedValue'];

// Fetch data based on the selected value
$query = "SELECT * FROM persediaan WHERE nama_barang = '$selectedValue'";
$result = $conn->query($query);

if ($result) {
    // Fetch a single value (assuming you want to fill an input field)
    $data = $result->fetch_assoc();

    // Close the result set
    $result->close();

    // Return the data as JSON
    echo json_encode($data);
} else {
    // If the query fails, return an error message
    echo json_encode(['error' => 'Query failed']);
}

// Close the database connection
$conn->close();
?>
<?php include("dbSet.php");

// Get data input on click login
$username = $_POST['username'];
$password = $_POST['password'];

// Check if the user exists in the database
$sql = "SELECT * FROM users WHERE username_user = ?";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("sql error" . $sql);
}

$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Verify the password
    if ($password == $row['password']) {

        session_start();
        $_SESSION['username'] = $row['username_user'];
        $_SESSION['role'] = $row['jabatan_user'];

        if ($row['jabatan_user'] == 'user') {
            // Redirect to user homepage
            echo '<script>
                alert("Login Success!. Hi user '.$username.'");
                window.location.href = "../view/user/home.php";
                </script>';
        } elseif ($row['jabatan_user'] == 'admin') {
            // Redirect to admin homepage
            echo '<script>
                alert("Login Success!. Hi admin '.$username.'");
                window.location.href = "../home_admin.php";
                </script>';
        }

    } else {
        // Password is incorrect
        echo '<script>
            alert("Incorrect password!");
            window.location.href = "../index.php";
            </script>';
    }
} else {
    // User does not exist
    echo '<script>
        alert("User not found!");
        window.location.href = "../index.php";
        </script>';
}

$stmt->close();
$conn->close();


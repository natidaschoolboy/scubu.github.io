<?php
$Fname = $_POST["Fname"];
$Lname = $_POST["Lname"];
$email = $_POST["email"];
$Pssword = $_POST["password"];
$cPassword = $_POST["confirm-password"];

$host = "localhost:3307";
$dbname = "dbscubu";
$username = "root";
$db_password = ""; // Changed variable name to avoid conflict with $password variable

$conn = mysqli_connect($host, $username, $db_password, $dbname);

if (mysqli_connect_errno()) {
    die("Connection error: " . mysqli_connect_error());
}

$sql = "INSERT INTO tblAccounts (FirstName, LastName, Email, Pssword) VALUES (?, ?, ?, ?)";

$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
    die(mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "ssss", $Fname, $Lname, $email, $Pssword); // Changed "ssii" to "ssss" for string parameters

if (mysqli_stmt_execute($stmt)) {
    echo "Record Saved";
    $redirect_url = "Sign.html";
header("Location: $redirect_url");
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
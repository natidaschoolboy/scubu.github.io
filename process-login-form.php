<?php
$host = "localhost:3307"; // MySQL server hostname
$username = "root"; // MySQL username
$password = ""; // MySQL password
$database = "dbscubu"; // MySQL database name

// Create a MySQLi database connection
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user input from the form
$email = $_POST["email"];
$Pssword = $_POST["password"];

// SQL query to check if the user exists in the database (replace 'users' with your actual table name)
$sql = "SELECT * FROM tblAccounts WHERE Email = ? AND Pssword = ?";

// Prepare the SQL statement
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Error in preparing statement: " . $conn->error);
}

// Bind the input values to the query placeholders
$stmt->bind_param("ss", $email, $Pssword);

// Execute the query
$stmt->execute();

// Get the result
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    // User exists, login successful
    echo "Login successful!";
     echo '<link rel="stylesheet" href="style.css" type="text/css">
     <div class="products">
            <center>
                <h3>Footwear Example</h3>
            </center>
            
                <center>
                    <img class="product-img" src="footwear.jfif" alt="">
                </center>
                <h4 style="padding-left: 15px;">Price: R1000<br></br>Description:</h4>

           <center>
            <div class="product-content">
                
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quas hic sit ut quam sed eveniet aperiam cupiditate minus dolorem mollitia dolorum architecto eaque illo nam accusantium placeat excepturi, alias modi.</p>
            </div>
           </center>
           <div class="checkout">
            <a href="#" class="btn">Add To Cart</a>
            <a href="Cart.html" class="btn">See Cart</a>
           </div>
        </div>';
} else {
    // User does not exist or incorrect credentials
    echo "Login failed. Please check your username and password.";
}

// Close the statement and database connection
$stmt->close();
$conn->close();
?>

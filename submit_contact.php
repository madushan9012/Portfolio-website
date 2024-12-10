<?php
// Database connection details
$host = "sql102.infinityfree.com";      // e.g., sql123.epizy.com
$dbname = "if0_37541735_contact_form";  // e.g., epiz_12345678_contact_form
$username = "if0_37541735";
$password = "GzB48rXSmAv0R";

try {
    // Create a new PDO instance to connect to the database
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // SQL query to create the contacts table if it doesn't exist
    $query = "CREATE TABLE IF NOT EXISTS contacts (
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        name TEXT NOT NULL,
        email TEXT NOT NULL,
        contact_number TEXT NOT NULL,
        message TEXT NOT NULL
    )";
    
    // Execute the query to create the table
    $conn->exec($query);

    // Prepare SQL query to insert form data into the contacts table
    $stmt = $conn->prepare("INSERT INTO contacts (name, email, contact_number, message) 
                            VALUES (:name, :email, :contact_number, :message)");

    // Bind form values to the query parameters
    $stmt->bindParam(':name', $_POST['name']);
    $stmt->bindParam(':email', $_POST['email']);
    $stmt->bindParam(':contact_number', $_POST['contact_number']);
    $stmt->bindParam(':message', $_POST['message']);

    // Execute the query to insert data
    $stmt->execute();

    // Success message
    echo "Thank you for getting in touch! We will respond shortly.";

} catch (PDOException $e) {
    // Error message
    echo "Error: " . $e->getMessage();
}

// Close the connection
$conn = null;
?>

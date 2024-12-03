<?php
// Database connection settings
$servername = "localhost"; // Typically 'localhost' for local development
$username = "root";        // Your MySQL username
$password = "";            // Your MySQL password (leave empty if using default XAMPP settings)
$dbname = "contact_form;";  // The name of your database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];

    // Simple form validation (you can extend this as needed)
    if (!empty($name) && !empty($email)) {
        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO contacts (name, email) VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $email);

        // Execute the query
        if ($stmt->execute()) {
            echo "<h1>Thank You!</h1>";
            echo "<p>Your information has been saved successfully.</p>";
        } else {
            echo "<h1>Error!</h1>";
            echo "<p>There was an issue saving your data. Please try again later.</p>";
        }

        // Close statement
        $stmt->close();
    } else {
        echo "<h1>Error!</h1>";
        echo "<p>Please fill out both fields.</p>";
    }
}

// Close connection
$conn->close();
?>
<?php
// Database connection settings
$servername = "localhost"; // Your database server
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "your_database_name"; // Your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Check if fields are not empty
    if (!empty($name) && !empty($email) && !empty($phone) && !empty($message)) {
        // Simple email validation
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Simple phone number validation
            if (preg_match("/^[0-9]{10,15}$/", $phone)) {
                // Prepare SQL statement
                $stmt = $conn->prepare("INSERT INTO contact_form (name, email, phone, message) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $name, $email, $phone, $message);

                // Execute statement
                if ($stmt->execute()) {
                    echo "<h1>Thank You!</h1>";
                    echo "<p>Your message has been received. We will get back to you shortly.</p>";
                } else {
                    echo "<p>Sorry, there was an error saving your message. Please try again later.</p>";
                }

                // Close statement
                $stmt->close();
            } else {
                echo "<p>Invalid phone number. Please enter a valid phone number with 10 to 15 digits.</p>";
            }
        } else {
            echo "<p>Invalid email address. Please enter a valid email address.</p>";
        }
    } else {
        echo "<p>All fields are required.</p>";
    }
} else {
    echo "<p>Invalid request method.</p>";
}

// Close connection
$conn->close();
?>
<?php
// Database configuration
$host = "localhost";
$dbname = "contact_db";
$username = "root";
$password = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $website = $_POST['website'];
    $message = $_POST['message'];

    try {
        // Connect to the database
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Insert the form data into the database
        $stmt = $conn->prepare("INSERT INTO messages (name, email, website, message) VALUES (:name, :email, :website, :message)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':website', $website);
        $stmt->bindParam(':message', $message);
        $stmt->execute();

        echo "<script>alert('Message sent successfully!'); window.location.href='contact.html';</script>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Close the database connection
    $conn = null;
}
?>

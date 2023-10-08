<?php
// Database connection details
$host = "localhost";
$username = "root";
$password = "";
$database = "oop";

// Create a connection to the database
$conn = new mysqli($host, $username, $password, $database);

// SQL query to retrieve data
$sql = "SELECT * FROM users";

// Execute the query and fetch data
$result = mysqli_query($conn, $sql);

if (mysqli_fetch_array($result) > 0) {
    $data = array();

    while ($row = mysqli_fetch_array($result)) {
        // Add each row as an associative array to the data array
        $data[] = $row;
    }

    // Convert data to JSON format
    $json_data = json_encode($data, JSON_PRETTY_PRINT);

    // Write JSON data to a file
    file_put_contents('data.json', $json_data);

    echo "Data successfully exported to data.json";
} else {
    echo "No data found in the database.";
}

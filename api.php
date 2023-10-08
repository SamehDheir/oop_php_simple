
<?php


// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$database = "oop";

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);


// SQL query to retrieve data (replace with your own query)
$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);


// Fetch column names and store them in an array
$columns = array();
while ($fieldinfo = mysqli_fetch_field($result)) {
    $columns[] = $fieldinfo->name;
}

// Fetch data and store it in an associative array
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $rowData = array();
    foreach ($columns as $column) {
        $rowData[$column] = $row[$column];
    }
    $data = $rowData;
}

// Close the database connection
mysqli_close($conn);

// Create an associative array with column names and data
$exportData = array(
    "columns" => $columns,
    "data" => $data
);

// Convert the data to JSON format
$jsonData = json_encode($exportData, JSON_PRETTY_PRINT);

// Write JSON data to a file
$file = 'data.json';
file_put_contents($file, $jsonData);

echo "Data has been exported to $file";
?>

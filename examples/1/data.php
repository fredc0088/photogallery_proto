<?php

/* NOTE: These examples are not built with portability in mind! */

// THIS IS THE `SERVER' SCRIPT

// We can use the config values defined in config.php as arguments¬
$link = mysqli_connect(
    'localhost',
    'dbuser',
    'dbuser',
    'bookshop');
// If the connection fails, we "exit" which stops all further processing by PHP¬
if (mysqli_connect_errno()) {
    exit("Error connecting to database.");
}

// Send appropriate header
header('Content-type: application/json');

// Generate sql based on query string params
if ($_GET['type'] == 'author') {
    // Construct the query
    $sql = "SELECT firstname,lastname FROM author";
} elseif ($_GET['type'] == 'book') {
    $sql = "SELECT title FROM book";
} else {
    echo "Invalid parameter.";
}

if (isset($sql)) {
    // Execute the query, assigning the result to $result
    $result = mysqli_query($link,$sql);
    // If the query failed, $result will be "false", so we test for this, and exit if it is
    if ($result === false) {
        exit("Error retrieving records from database.");
    }
    // Check if the query returned anything
    if (mysqli_num_rows($result) == 0) {
        exit("No results to display.");
    } else {
        // Make result into array of JSON objects
        $structure = array();
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($structure, json_encode($row));
        }
        // Check for errors
        if(json_last_error() == JSON_ERROR_NONE){
            // No errors occurred, so echo json objects
            foreach ($structure as $json) {
                echo $json;
            }
        } else{
            // Errors encountered
            echo 'Something is wrong with JSON...';
            echo 'CODE: ' . json_last_error();
        }
    }
}


?>


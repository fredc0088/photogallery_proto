<?php
$fruit = array(
'a' => 'apple',
'b' => 'banana',
'c' => 'cherry'
);

$vegetables = array(
'a' => 'artichoke',
'b' => 'brussel sprouts',
'c' => 'cabbage'
);

// Convert array to JSON object
//$json = json_encode($fruit);
//echo $json;

// Send appropriate header
header('Content-type: application/json');

// Generate output based on query string params
if ($_GET['type'] == 'fruit') {
    $json = json_encode($fruit);
} elseif ($_GET['type'] == 'vegetables') {
    $json = json_encode($vegetables);
} else {
    $json = "Invalid parameter.";
}

// Check for errors
if(json_last_error() == JSON_ERROR_NONE){
    // No errors occurred
    echo $json;
} else{
    // Errors encountered
    echo 'Something is wrong with JSON...';
    echo 'CODE: ' . json_last_error();
}

?>


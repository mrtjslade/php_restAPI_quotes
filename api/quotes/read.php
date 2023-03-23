<?php
// Call the read() function to retrieve all quotes
$quotes_data = $quote->read();

// Check if any quotes were returned
if ($quotes_data) {
    // Encode the quotes data as JSON and return it
    //http_response_code(200);
    $json_options = JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE;
    echo json_encode($quotes_data, $json_options);
} else {
    // Return an error message if no quotes were found
    //http_response_code(404);
    echo json_encode(array('message' => 'No quotes found.'));
}
?>
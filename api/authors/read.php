<?php
// Call the read() function to retrieve all authors
$authors_data = $author->read();

// Check if any authors were returned
if ($authors_data) {
    // Encode the authors data as JSON and return it
    //http_response_code(200);
    $json_options = JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE;
    echo json_encode($authors_data, $json_options);
} else {
    // Return an error message if no authors were found
    //http_response_code(404);
    echo json_encode(array('message' => 'No authors found.'));
}
?>

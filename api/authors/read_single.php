<?php
// Parse the query string to get the id parameter
parse_str($_SERVER['QUERY_STRING'], $query_params);
$id = isset($query_params['id']) ? $query_params['id'] : null;

// Call the read_single() function to retrieve the author with the specified ID
$author_data = $author->read_single($id);

// Check if an author was returned
if ($author_data) {
    // Encode the author data as JSON and return it
    //http_response_code(200);
    $json_options = JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE;
    echo json_encode($author_data, $json_options);
} else {
    // Return an error message if no author was found
    //http_response_code(404);
    echo json_encode(array('message' => 'author_id Not Found'));
}
?>


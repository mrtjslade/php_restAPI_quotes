<?php
// Parse the query string to get the id parameter
parse_str($_SERVER['QUERY_STRING'], $query_params);
$id = isset($query_params['id']) ? $query_params['id'] : null;

// Call the read_single() function to retrieve the category with the specified ID
$category_data = $category->read_single($id);

// Check if a category was returned
if ($category_data) {
    // Encode the category data as JSON and return it
    //http_response_code(200);
    $json_options = JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE;
    echo json_encode($category_data, $json_options);
} else {
    // Return an error message if no category was found
    //http_response_code(404);
    echo json_encode(array('message' => 'category_id Not Found'));
}
?>

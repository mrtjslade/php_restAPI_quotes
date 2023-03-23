<?php
// Call the read() function to retrieve all categories
$categories_data = $category->read();

// Check if any categories were returned
if ($categories_data) {
    // Encode the categories data as JSON and return it
    //http_response_code(200);
    $json_options = JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE;
    echo json_encode($categories_data, $json_options);
} else {
    // Return an error message if no categories were found
    //http_response_code(404);
    echo json_encode(array('message' => 'No categories found.'));
}
?>

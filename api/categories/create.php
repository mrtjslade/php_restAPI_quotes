<?php
// Get the posted data
$data = json_decode(file_get_contents("php://input"), true);

// Check if category parameter is provided
if (!isset($data['category'])) {
    //http_response_code(400);
    echo json_encode(array('message' => 'Missing Required Parameters'));
    exit;
}

// Create a new Category object
$category = new Category();

// Call the create() function to create a new category with the specified name
$created_category = $category->create(array('category' => $data['category']));

if ($created_category) {
    //http_response_code(201);
    echo json_encode($created_category);
} else {
    //http_response_code(500);
    echo json_encode(array('message' => 'Unable to create category.'));
}

?>

<?php
// Get the posted data
$data = json_decode(file_get_contents("php://input"), true);

// Check if author parameter is provided
if (!isset($data['author'])) {
    //http_response_code(400);
    echo json_encode(array('message' => 'Missing Required Parameters'));
    exit;
}

// Create a new Author object
$author = new Author();

// Call the create() function to create a new author with the specified name
$created_author = $author->create(array('author' => $data['author']));

if ($created_author) {
    //http_response_code(201);
    echo json_encode($created_author);
} else {
    //http_response_code(500);
    echo json_encode(array('message' => 'Unable to create author.'));
}

?>
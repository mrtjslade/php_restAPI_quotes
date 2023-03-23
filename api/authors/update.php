<?php
// Parse PUT data
$data = json_decode(file_get_contents('php://input'), true);

// Check if ID and author parameters are provided
if (!isset($data['id'], $data['author'])) {
    //http_response_code(400);
    echo json_encode(array('message' => 'Missing Required Parameters'));
    exit;
}

// Call the update() function to update the author with the specified ID
if ($author->update($data['id'], $data)) {
    //http_response_code(200);
    echo json_encode(array('id' => $data['id'], 'author' => $data['author']));
} else {
    //http_response_code(500);
    echo json_encode(array('message' => 'Error updating author.'));
}


?>
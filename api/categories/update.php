<?php
// Parse PUT data
$data = json_decode(file_get_contents('php://input'), true);

// Check if category parameter is provided
if (!isset($data['category'])) {
    //http_response_code(400);
    echo json_encode(array('message' => 'Missing Required Parameters'));
    exit;
}

// Call the update() function to update the category with the specified ID
if ($category->update($data['id'], $data)) {
    //http_response_code(200);
    echo json_encode(array('id' => $data['id'], 'category' => $data['category']));
} else {
    //http_response_code(500);
    echo json_encode(array('message' => 'Error updating category.'));
}

?>

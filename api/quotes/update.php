<?php
// Parse PUT data
$data = json_decode(file_get_contents('php://input'), true);

// Check if quote, author_id and category_id parameters are provided
if (!isset($data['quote']) || !isset($data['author_id']) || !isset($data['category_id'])) {
    //http_response_code(400);
    echo json_encode(array('message' => 'Missing Required Parameters'));
    exit;
}

// Call the update() function to update the quote with the specified ID
if ($quote->update($data['id'], $data)) {
    //http_response_code(200);
    echo json_encode(array('id' => $data['id'], 'quote' => $data['quote'], 'author_id' => $data['author_id'], 'category_id' => $data['category_id']));
} else {
    //http_response_code(500);
    echo json_encode(array('message' => 'Error updating quote.'));
}

?>

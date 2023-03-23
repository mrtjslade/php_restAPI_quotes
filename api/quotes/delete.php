<?php
require_once('../../config/Database.php');
require_once('../../models/Quote.php');

// Instantiate new Quote object
$quote = new Quote();

// Read request body
$data = json_decode(file_get_contents('php://input'), true);

// Get id from request body
$id = isset($data['id']) ? $data['id'] : null;

// Check if an ID was provided in the request
if ($id) {
    if ($method === 'DELETE') {
        // Call the delete() function to delete the quote with the specified ID
        $deleted_quote_id = $quote->delete($id);
        if ($deleted_quote_id) {
            //http_response_code(200);
            $deleted_quote = array('id' => $deleted_quote_id);
            echo json_encode($deleted_quote);
        } else {
            //http_response_code(404);
            echo json_encode(array('message' => 'No Quotes Found'));
        }
    }
} else {
    //http_response_code(400);
    echo json_encode(array('message' => 'Missing required parameter: id'));
}

?>

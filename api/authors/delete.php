<?php
require_once('../../config/Database.php');
require_once('../../models/Author.php');

// Instantiate new Author object
$author = new Author();

// Read request body
$data = json_decode(file_get_contents('php://input'), true);

// Get id from request body
$id = isset($data['id']) ? $data['id'] : null;

// Check if an ID was provided in the request
if ($id) {
    if ($method === 'DELETE') {
        // Call the delete() function to delete the author with the specified ID
        $deleted_author_id = $author->delete($id);
        if ($deleted_author_id) {
            //http_response_code(200);
            $deleted_author = array('id' => $deleted_author_id);
            echo json_encode($deleted_author);
        } else {
            //http_response_code(404);
            echo json_encode(array('message' => 'Author not found.'));
        }
    }
} else {
    //http_response_code(400);
    echo json_encode(array('message' => 'Missing required parameter: id'));
}
?>
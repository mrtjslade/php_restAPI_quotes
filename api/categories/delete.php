<?php
require_once('../../config/Database.php');
require_once('../../models/Category.php');

// Instantiate new Category object
$category = new Category();

// Read request body
$data = json_decode(file_get_contents('php://input'), true);

// Get id from request body
$id = isset($data['id']) ? $data['id'] : null;

// Check if an ID was provided in the request
if ($id) {
    if ($method === 'DELETE') {
        // Call the delete() function to delete the category with the specified ID
        $deleted_category_id = $category->delete($id);
        if ($deleted_category_id) {
            //http_response_code(200);
            $deleted_category = array('id' => $deleted_category_id);
            echo json_encode($deleted_category);
        } else {
            //http_response_code(404);
            echo json_encode(array('message' => 'Category not found.'));
        }
    }
} else {
    //http_response_code(400);
    echo json_encode(array('message' => 'Missing required parameter: id'));
}
?>

<?php
// Get the posted data
$data = json_decode(file_get_contents("php://input"), true);

// Check if all parameters are provided
if (!isset($data['quote']) || !isset($data['author_id']) || !isset($data['category_id'])) {
    //http_response_code(400);
    echo json_encode(array('message' => 'Missing Required Parameters'));
    exit;
}

// Create a new Quote object
$quote = new Quote();

// Call the create() function to create a new quote with the specified data
$created_quote = $quote->create(array(
    'quote' => $data['quote'],
    'author_id' => $data['author_id'],
    'category_id' => $data['category_id']
));

if ($created_quote) {
    //http_response_code(201);
    echo json_encode($created_quote);
} else {
    //http_response_code(500);
    echo json_encode(array('message' => 'Unable to create quote.'));
}

?>

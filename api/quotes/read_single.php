<?php
require_once('../../config/Database.php');
require_once('../../models/Quote.php');

// Instantiate a new Quote object
$quote = new Quote();

// Parse the query string to get the id parameter
parse_str($_SERVER['QUERY_STRING'], $query_params);
$id = isset($query_params['id']) ? $query_params['id'] : null;

// Call the read_single() function to retrieve the quote with the specified ID
$quote_data = $quote->read_single($id);

// Check if a quote was returned
if ($quote_data) {
    // Encode the quote data as JSON and return it
    $json_options = JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE;
    $quote_json = array(
        'id' => $quote_data['id'],
        'quote' => $quote_data['quote'],
        'author' => $quote_data['author'],
        'category' => $quote_data['category']
    );
    echo json_encode($quote_json, $json_options);
} else {
    // Return an error message if no quote was found
    echo json_encode(array('message' => 'No Quotes Found'));
}
?>

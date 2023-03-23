<?php
class Quote {
    // Properties
    private $conn;
    private $table = 'quotes';

    public $id;
    public $quote;
    public $author_id;
    public $category_id;

    // Constructor with DB
    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }


// Read all quotes
public function read() {
    // Create query
    $query = 'SELECT q.id, q.quote, a.author AS author, c.category AS category FROM ' . $this->table . ' q ';
    $query .= 'LEFT JOIN authors a ON q.author_id = a.id ';
    $query .= 'LEFT JOIN categories c ON q.category_id = c.id ';
    $query .= 'ORDER BY id ASC';

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Execute query
    $stmt->execute();

    // Fetch all rows and return data as an array of associative arrays
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function read_single($id) {
    // Create query
    $query = 'SELECT q.id, q.quote, a.author AS author, c.category AS category FROM ' . $this->table . ' q JOIN authors a ON q.author_id = a.id JOIN categories c ON q.category_id = c.id WHERE q.id = :id LIMIT 1';

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Bind parameter
    $stmt->bindParam(':id', $id);

    // Execute query
    $stmt->execute();

    // Check if a row was returned
    if ($stmt->rowCount() > 0) {
        // Fetch row data as an associative array
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set properties
        $this->id = $row['id'];
        $this->quote = $row['quote'];
        $this->author = $row['author'];
        $this->category = $row['category'];

        return $row;
    } else {
        return null;
    }
}

    // Create quote
    public function create($data) {
    // Create query
    $query = 'INSERT INTO ' . $this->table . ' (quote, author_id, category_id) VALUES (:quote, :author_id, :category_id)';

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Bind parameters
    $stmt->bindParam(':quote', $data['quote']);
    $stmt->bindParam(':author_id', $data['author_id']);
    $stmt->bindParam(':category_id', $data['category_id']);

    // Execute query
    if ($stmt->execute()) {
        // Get ID of new quote
        $this->id = $this->conn->lastInsertId();
        $this->quote = $data['quote'];
        $this->author_id = $data['author_id'];
        $this->category_id = $data['category_id'];
        return array(
            'id' => $this->id,
            'quote' => $this->quote,
            'author_id' => $this->author_id,
            'category_id' => $this->category_id
        );
    } else {
        return null;
    }
}

// Update quote
public function update($id, $data) {
    // Create query
    $query = 'UPDATE ' . $this->table . ' SET quote = :quote, author_id = :author_id, category_id = :category_id WHERE id = :id';

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Bind parameters
    $quote = $data['quote'];
    $author_id = $data['author_id'];
    $category_id = $data['category_id'];
    $stmt->bindParam(':quote', $quote);
    $stmt->bindParam(':author_id', $author_id);
    $stmt->bindParam(':category_id', $category_id);
    $stmt->bindParam(':id', $id);

    // Execute query
    return $stmt->execute();
}

// Delete quote
public function delete($id) {
    // Create query
    $query = 'DELETE FROM ' . $this->table . ' WHERE id = ?';

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Bind ID parameter
    $stmt->bindParam(1, $id);

    // Execute query
    if ($stmt->execute()) {
        return $id;
    } else {
        return null;
    }
}
}
?>
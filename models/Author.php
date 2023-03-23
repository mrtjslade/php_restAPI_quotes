<?php
class Author {
    // Properties
    private $conn;
    private $table = 'authors';

    public $id;
    public $author;

    // Constructor with DB
    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

// Read all authors
public function read() {
    // Create query
    $query = 'SELECT * FROM ' . $this->table . ' ORDER BY id ASC';

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Execute query
    $stmt->execute();

    // Fetch all rows and return data as an array of associative arrays
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    public function read_single($id) {
        // Create query
        $query = 'SELECT * FROM ' . $this->table . ' WHERE id = ? LIMIT 1';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind parameter
        $stmt->bindParam(1, $id);

        // Execute query
        $stmt->execute();

        // Check if a row was returned
        if ($stmt->rowCount() > 0) {
            // Fetch row data as an associative array
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Set properties
            $this->id = $row['id'];
            $this->author = $row['author'];

            return $row;
        } else {
            return null;
        }
    }

public function create($data) {
    // Create query
    $query = 'INSERT INTO ' . $this->table . ' (author) VALUES (:author)';

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Bind parameter
    $stmt->bindParam(':author', $data['author']);

    // Execute query
    if ($stmt->execute()) {
        // Get ID of new author
        $this->id = $this->conn->lastInsertId();
        $this->author = $data['author'];
        return array(
            'id' => $this->id,
            'author' => $this->author
        );
    } else {
        return null;
    }
}

    // Update author
    public function update($id, $data) {
        // Create query
        $query = 'UPDATE ' . $this->table . ' SET author = :author WHERE id = :id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':author', $data['author']);
        $stmt->bindParam(':id', $id);

        // Execute query
        return $stmt->execute();
    }

    // Delete author
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
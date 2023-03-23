<?php
class Category {
    // Properties
    private $conn;
    private $table = 'categories';

    public $id;
    public $category;

    // Constructor with DB
    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    // Read all categories
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

    // Read single category
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
            $this->category = $row['category'];

            return $row;
        } else {
            return null;
        }
    }

    // Create category
    public function create($data) {
        // Create query
        $query = 'INSERT INTO ' . $this->table . ' (category) VALUES (:category)';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind parameter
        $stmt->bindParam(':category', $data['category']);

        // Execute query
        if ($stmt->execute()) {
            // Get ID of new category
            $this->id = $this->conn->lastInsertId();
            $this->category = $data['category'];
            return array(
                'id' => $this->id,
                'category' => $this->category
            );
        } else {
            return null;
        }
    }

    // Update category
    public function update($id, $data) {
        // Create query
        $query = 'UPDATE ' . $this->table . ' SET category = :category WHERE id = :id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':category', $data['category']);
        $stmt->bindParam(':id', $id);

        // Execute query
        return $stmt->execute();
    }

    // Delete category
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

<?php
class Movie {
    private $conn;
    private $table_name = "movies";

    public $id;
    public $title;
    public $description;
    public $poster_url;
    public $rating;
    public $year;
    public $category;
    public $duration;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function search($keywords) {
        $query = "SELECT * FROM " . $this->table_name . " \
                 WHERE title LIKE ? OR description LIKE ? OR category LIKE ?\
                 ORDER BY created_at DESC";
        
        $stmt = $this->conn->prepare($query);
        $keywords = "%{
        $keywords}%";
        $stmt->bindParam(1, $keywords);
        $stmt->bindParam(2, $keywords);
        $stmt->bindParam(3, $keywords);
        $stmt->execute();
        return $stmt;
    }

    public function getByCategory($category) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE category = ? ORDER BY rating DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $category);
        $stmt->execute();
        return $stmt;
    }

    public function getTrending() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY rating DESC LIMIT 6";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
?>
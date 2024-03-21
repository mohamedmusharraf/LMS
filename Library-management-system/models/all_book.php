<?php

require_once 'BaseModel.php';

class All_books extends BaseModel
{
    public $bookName;
    public $availability;

    protected function getTableName()
    {
        return "add_books";
    }

    public function addNewRec()
    {
        // Implementation for adding a new record
    }

    public function updateRec()
    {
        // Implementation for updating a record
    }
    
    }
    function getById($bookId, $column = 'book_id') {
        // Prepare SQL query
        $query = "SELECT * FROM add_books WHERE book_id = :book_id";

        
        // Prepare statement
        $stmt = $this->db->prepare($query);
    
        // Bind parameters
        $stmt->bindParam(':book_id', $bookId);
    
        // Execute statement
        $stmt->execute();
    
        // Fetch book details
        $book = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Close statement
        $stmt->closeCursor();
    
        return $book;
    }

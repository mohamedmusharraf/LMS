<?php

class Add_books {
    private $connection;

    // Constructor to initialize the database connection
    public function __construct($connection) {
        $this->connection = $connection;
    }

    // Method to increase the number of copies for a book
    public function increaseNumberOfCopies($bookId) {
        // Prepare SQL statement
        $query = "UPDATE add_books SET number_of_copies = number_of_copies + 1 WHERE id = :book_id";
        $statement = $this->connection->prepare($query);
        $statement->bindValue(':book_id', $bookId, PDO::PARAM_INT);

        // Execute the statement
        return $statement->execute();
    }

    // Add other methods related to managing books in the database as needed
}

?>

<?php
require_once 'BaseModel.php';

class Book_Recommendation extends BaseModel
{
    public $bookName;
    public $description;

    protected function getTableName()
    {
        return "book_recommend";
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
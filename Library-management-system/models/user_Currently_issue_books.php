<?php

require_once 'BaseModel.php';

class User_currently_issue_books extends BaseModel
{
    public $bookName;
    public $availability;

    protected function getTableName()
    {
        return "borrowed_books";
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


<?php

require_once 'BaseModel.php';

class admin_inbox extends BaseModel
{
    public $bookName;
    public $availability;

    protected function getTableName()
    {
        return "user_message";
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
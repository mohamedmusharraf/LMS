<?php

require_once 'BaseModel.php';

class user_send_message extends BaseModel
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


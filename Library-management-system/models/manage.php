<?php

require_once 'BaseModel.php';

class Manage extends BaseModel
{
    public $bookName;
    public $availability;

    protected function getTableName()
    {
        return "user_table";
    }

    protected function addNewRec()
    {
        // Hash the password before storing it
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);

        $param = array(
            ':user_name' => $this->user_name,
            ':user_email' => $this->user_email,
            ':user_address' => $this->user_address,
            ':user_contect' => $this->user_contect,
        );

        return $this->pm->run("INSERT INTO " . $this->getTableName() . "(username, password,permission,email,is_active) values(:username, :password,:permission,:email,:is_active)", $param);
    }

    protected function updateRec()
{
    // Check if the new username or email already exists (excluding the current user's record)
    $existingUser = $this->getUserByUsernameOrEmailWithId($this->user_name, $this->user_email, $this->user_address, $this->user_contact, $this->user_id);
    if ($existingUser) {
        // Handle the error (return an appropriate message or throw an exception)
        return false; // Or throw an exception with a specific error message
    }

    // Hash the password if it is being updated
    if (!empty($this->password)) {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
    }

    $param = array(
        ':user_name' => $this->user_name,
        ':user_email' => $this->user_email,
        ':user_address' => $this->user_address,
        ':user_contact' => $this->user_contact,
        ':user_id' => $this->id
    );
    return $this->pm->run(
        "UPDATE " . $this->getTableName() . " 
        SET 
        user_name = :user_name, 
        user_email = :user_email,
        user_address = :user_address,  
        user_contact = :user_contact
        WHERE user_id = :user_id",
        $param
    );
}
}


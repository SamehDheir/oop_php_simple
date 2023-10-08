<?php
session_start();
include 'connection.php';
class DataBaseController extends Connect
{
    public $table;

    public function __construct($table)
    {
        parent::__construct();
        $this->table = $table;
    }

    public function read()
    {
        $result = mysqli_query($this->conn, "SELECT * FROM {$this->table}");
        return $result;
    }

    public function delete($id)
    {
        $result = mysqli_query($this->conn, "DELETE FROM {$this->table} WHERE id = {$id}");
        $_SESSION['delete'] = ' ✅ Delete Data Successfuly';
        return $result;
    }

    public function edit($id)
    {
        $result = mysqli_query($this->conn, "SELECT * FROM {$this->table} WHERE id = {$id}");
        return $result;
    }

    public function updatePost($id, $title, $description)
    {
        $result = mysqli_query($this->conn, "UPDATE  {$this->table} SET title = '$title' , description = '$description' WHERE id = {$id}");
        $_SESSION['update'] = '';
        return $result;
    }

    public function updateRoles($id, $roles)
    {
        $result = mysqli_query($this->conn, "UPDATE  {$this->table} SET roles = '$roles'  WHERE id = {$id}");
        return $result;
    }

    public function addPost($title, $description)
    {
        $result = mysqli_query($this->conn, "INSERT INTO {$this->table} VALUES(NULL,'$title','$description') ");
        $_SESSION['add'] = '';
        return $result;
    }
}



// class Roles extends Connect {
//     public $permissions;

//     public function __construct($permissions)
//     {
//         parent::__construct();
//         $this->permissions = $permissions;
//     }
// }
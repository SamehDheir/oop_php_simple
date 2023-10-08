<?php
class Connect
{
    public $host = 'localhost';
    public $username = 'root';
    public $password = '';
    public $db_name = 'oop';

    public $conn;

    public function __construct()
    {
        $this->conn = mysqli_connect($this->host, $this->username, $this->password, $this->db_name);
    }
}

class Registration extends Connect
{
    public function register($name, $email, $password)
    {
        mysqli_query($this->conn, "INSERT INTO users VALUES(NULL,'$name','$email','$password')");
        header('location:index.php');
    }

    public function login($email, $password, $permissions)
    {
        session_start();

        $result = mysqli_query($this->conn, "SELECT * FROM users WHERE email = '$email' AND password = '$password'");
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            $_SESSION['roles'] = $row['roles'];
            header('location:showPosts.php');
        } else {
            echo "<script>alert('Invalid Email Or Password')</script>";
        }
    }
}

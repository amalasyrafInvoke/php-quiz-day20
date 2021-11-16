<?php

class Database{

    private $username;
    private $password;
    private $host;
    private $dbname;
    private $connection;

    public function __construct($username,$password,$host ,$dbname )
    {
        $this->username = $username;
        $this->password = $password;
        $this->host = $host;
        $this->dbname = $dbname;
    }

    public function connect(){
        $this->connection = new mysqli($this->host,$$this->username,$$this->password);
        if($this->connection->connect_error){
            die('Connection Fail');
        }
    }

    public function query(){

    }

    public function __destruct()
    {
        $this->connection->close();

    }
}

$db =new Database('root','','localhost','laravel');
$db->connect();
$db->query('Select * from Stundet where student_score>=80');
?>

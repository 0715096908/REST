<?php
//Author Tony Okoth
//0715096908

//connect to the database
Class Database
{
    //set your database parameters
    private $host = 'localhost';
    private $db_name = 'rest_db';
    private $username = 'root';
    private $password = '';
    
    private $conn;

    public function connect()
    {
        $this->conn = null;

        try
        {
            $this->conn=new PDO('mysql:host='. $this->host .';dbname='. $this->db_name,$this->username,$this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(Exception $e)
        {
        echo 'Connection to database error:' .$e.getMessage();
        }

    return $this->conn;
    }
}
?>
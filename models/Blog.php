<?php
// our post model
Class Blog
{
    private $conn;
    private $table = 'blogs';

    //define the post properties
    public $id;
    public $blog_id;
    public $blog_name;
    public $blog_title;
    public $blog_body;
    public $blog_author;
    public $created_at;

    public function __construct($db)
    {
        $this->conn = $db;
    }

   public function read_blog()
    {
    $query = 'SELECT t.blog_name as blog_name,b.id, b.blog_id, b.blog_title,b.blog_body, b.blog_author, b.created_at FROM '.$this->table.' b LEFT JOIN type t ON b.blog_id = t.id ORDER BY b.created_at DESC';
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt;
    }
//lets get one post
public function read_single_blog()
{
    $query = 'SELECT t.blog_name as blog_name,b.id, b.blog_id, b.blog_title,b.blog_body, b.blog_author, b.created_at FROM '.$this->table.' b LEFT JOIN type t ON b.blog_id = t.id WHERE b.id = ? LIMIT 0,1';
    $stmt = $this->conn->prepare($query); 

    //BIND ID
    $stmt->bindParam(1,$this->id);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $this->blog_title=$row['blog_title'];
    $this->blog_body=$row['blog_body'];
    $this->blog_author=$row['blog_author'];
    $this->blog_id=$row['blog_id'];
    $this->blog_name=$row['blog_name'];


}
//create a post
public function create_blog()
{
    $query = 'INSERT INTO '.$this->table.' SET blog_title=:blog_title, blog_body=:blog_body, blog_author=:blog_author, blog_id=:blog_id';
    $stmt = $this->conn->prepare($query);

    $this->blog_title = htmlspecialchars(strip_tags($this->blog_title));
    $this->blog_body = htmlspecialchars(strip_tags($this->blog_body));
    $this->blog_author = htmlspecialchars(strip_tags($this->blog_author));
    $this->blog_id = htmlspecialchars(strip_tags($this->blog_id));

    //lets bind the data now
    $stmt ->bindParam(':blog_title', $this->blog_title);
    $stmt ->bindParam(':blog_body', $this->blog_body);
    $stmt ->bindParam(':blog_author', $this->blog_author);
    $stmt ->bindParam(':blog_id', $this->blog_id);

    if($stmt->execute())
    {
        return true;
    }
    //we print an error 
    printf("Error: %s.\n",$stmt->error);
    return false;
}
public function update_blog()
{
    $query = 'UPDATE '.$this->table.' SET blog_title=:blog_title, blog_body=:blog_body, blog_author=:blog_author, blog_id=:blog_id WHERE id = :id';
    $stmt = $this->conn->prepare($query);

    $this->blog_title = htmlspecialchars(strip_tags($this->blog_title));
    $this->blog_body = htmlspecialchars(strip_tags($this->blog_body));
    $this->blog_author = htmlspecialchars(strip_tags($this->blog_author));
    $this->blog_id = htmlspecialchars(strip_tags($this->blog_id));
    $this->id = htmlspecialchars(strip_tags($this->id));

    //lets bind the data now
    $stmt ->bindParam(':blog_title', $this->blog_title);
    $stmt ->bindParam(':blog_body', $this->blog_body);
    $stmt ->bindParam(':blog_author', $this->blog_author);
    $stmt ->bindParam(':blog_id', $this->blog_id);
    $stmt ->bindParam(':id', $this->id);

    if($stmt->execute())
    {
        return true;
    }
    //we print an error 
    printf("Error: %s.\n",$stmt->error);
    return false;
}
//lets delete post
public function delete_blog()
{
    //it only takes the id as the parameter
    $query = 'DELETE FROM '.$this->table.' WHERE id = :id';

    $stmt = $this->conn->prepare($query);

    $this->id = htmlspecialchars(strip_tags($this->id));

    $stmt->bindParam('id',$this->id);

    if($stmt->execute())
    {
        return true;
    }
    else
    {
      printf("Error: %f.\n", $stmt->error);
      return false;
    }


     
}
}
?>
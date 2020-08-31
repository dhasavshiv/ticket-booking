 <?php
    class Database{
        private $host = "localhost";
        private $db ="movie";
        private $username = "dhairya";
        private $password = "dhairya";
        private $conn;
        public function connect(){
            $this->conn = null;
            $this->conn=new PDO('mysql:host='.$this->host.';dbname='.$this->db, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        }
    }
    class Post{
        private $conn;
        private $table='posts';
        private $name;
        private $phone;
        private $time;
        public function __construct($db){
            $this->conn = $db;
        }
        
        
        public function read(){
            $query = 'INSERT INTO ' . $this->table . '
            SET
                name = ?,
                time = ?,
                phone = ?'
            $statement = $this->conn->prepare($query);
            $statement->bindParam(1,$this->name);
            $statement->bindParam(2,$this->phone);
            $statement->bindParam(3,$this->time);
            $statement->execute();
            return $statement;
        }
    $database = new Database();
    $db = $database->connect();
    $post = new Post($db);
    $data= json_decode(file_get_contents("php://input"));
    $post->name=$data->name;
    $post->phone=$data->phone;
    $post->time=$data->time;

    if($post->create_post()){
        echo  'Post created';
    }else{
        echo 'Post Not created';
    }

?>
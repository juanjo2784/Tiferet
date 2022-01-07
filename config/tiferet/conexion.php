<?php 

class CNX {
    private static $user;
    private static $password;
    private static $host;
    private $conn;

    public function __construct() {
      self::$user = 'admin';
      self::$password = 'Ruti1970';
      self::$host = "mysql:host=tiferet.c5utj3yixqrd.us-east-2.rds.amazonaws.com;dbname=bdTiferet;charset=utf8mb4";
      /*self::$user = 'root';
      self::$password = '';
      self::$host = "mysql:host=localhost;dbname=bdTiferet;charset=utf8mb4";*/
    }
    //Metods
    function cnx(){
      try {
        $this->conn = new PDO(self::$host,self::$user,self::$password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
        $conn = $this->conn;
      } catch (Exception $e) {
        echo "Error al conectar con la App ".$e ;       
      }
      //var_dump($this->conn);
      return $conn;
    }
    
}

?>
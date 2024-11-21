<?php
class Database
{
  private $con;
  function __construct( )
  {
    $this->con= $this->connect();
  }
  
  //connect to db
  private function connect(){
    $string="mysql:host=".DBHOST.";dbname=".DBNAME;
    try
    {
      $connection=new PDO($string, DBUSER, DBPASS);
      return $connection;
    }catch(PDOException $e){
      $e->getMessage();
      die;
    }
    return false;
  }
  public function write($query, $data_array=[])
  {
    
      $con=$this->connect();
      $stmt=$con->prepare($query);
      $check=$stmt->execute($data_array);
    if($check)return true;
    return false;
  }
  
  public function generate_id($max){
    $rand="";
    $rand_count=rand(4,$max);
    for($i=0; $i<$rand_count;$i++ ){
      $r=rand(0,9);
      $rand.=$r;
    }
    return $rand;
  }
  #read from db
  public function read($query, $data_array=[])
    {
      $con=$this->connect();
      $stmt=$con->prepare($query);
      $check=$stmt->execute($data_array);
      if($check){
         $result=$stmt->fetchAll(PDO::FETCH_OBJ);
        if(is_array($result) && count($result)>0){
          return $result;
        }
        return false;
      }
      return false;
    }
    public function get_user($userid)
    {
      $con=$this->connect();
      $arr['user_id']=$userid;
      $query="select * from users where user_id = :user_id limit 1 ";
      $stmt=$con->prepare($query);
      $check=$stmt->execute($arr);
      if($check){
         $result=$stmt->fetchAll(PDO::FETCH_OBJ);
        if(is_array($result) && count($result)>0){
          return $result[0];
        }
        return false;
      }
      return false;
    }
}
$myclass=new Database();

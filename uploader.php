<?php
session_start();
$info=(object)[];
if(!isset($_SESSION["user_id"]))
{
  if(isset($DATA_OBJ->data_type ) && $DATA_OBJ->data_type != "login" && $DATA_OBJ->data_type != "signup"){
    $info->logged_in=false;
      echo json_encode($info);
      die;
  }
}

require_once("classes/autoload.php");
$DB=new Database();
$data_type="";
if (isset($_POST['data_type'])){
  $data_type=$_POST['data_type'];
}
$destination="";
if(isset($_FILES['file'])&& $_FILES['file']['name'] != "")
{
  $allowed[]="image/jpeg";
  $allowed[]="image/png";
  
  if($_FILES['file']['error'] == 0 && in_array($_FILES['file']['type'], $allowed)){
    //good to go
    $temp=$_FILES['file']['tmp_name'];
    $folder="uploads/";
    if(!file_exists($folder)){
      mkdir($folder,0777, true);
    }
    $id=$_SESSION['user_id'];
    $file_name=$id."_".$_FILES['file']['name'];
     $destination=$folder.$file_name;
    $query_img="select * from users where user_id ='$id' limit 1";
    $result=$DB->read($query_img, []);
    $arr_image=$result[0]->image;
    if($arr_image != ""){
        $prev_image=$arr_image;
        
        if(file_exists($prev_image)){
          unlink($prev_image);
          move_uploaded_file($temp, $destination);
        }else{
          move_uploaded_file($temp, $destination);
        }
        $info->message="your image was uploaded";
         $info->data_type=$data_type;
        echo json_encode($info);
      }
    }
  }
if($data_type == "change_profile_image"){
  if ($destination != "") {
    // save to database
    $id=$_SESSION['user_id'];
    $query="update users set image='$destination' where user_id ='$id' limit 1 ";
    $DB->write($query, []);
    
  }
  
}else if($data_type == "send_image"){
  $arr['user_id']="null";
  if(isset($_POST['user_id'])){
    $arr['user_id']=addslashes($_POST['user_id']);
  }
  
    $arr['message']="";
    $arr['date']=date('Y-m-d H:i:s');
    $arr['sender']=$_SESSION['user_id'];
    $arr['msgid']= get_random_string_max(60);
    $arr['file'] =$destination;
      $arr2['sender']=$_SESSION['user_id'];
      $arr2['receiver']=$arr['user_id'];
    $sql="select * from messages where (sender=:sender && receiver =:receiver) || (sender=:receiver && receiver =:sender) limit 1";
     $result2= $DB->read($sql, $arr2);
     if (is_array($result2)) {
      $arr['msgid']= $result2[0]->msgid;
    }
    $query="insert into messages(sender,receiver,message,date,msgid,files) values(:sender,:user_id,:message,:date, :msgid,:file)";
    $DB->write($query, $arr);
    $id=$_SESSION['user_id'];
}
function get_random_string_max($length){
    $array=array(0,1,2,3,4,5,6,7,8,9,'a','b' ,'c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B' ,'C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
    $text="";
    $length=rand(4,$length);
    for($i=0; $i < $length; $i++){
      $random=rand(0,61);
      $text.=$array[$random];
    }
    return $text;
  }

<?php
  $data;
  $info=(object)[];
  $data["user_id"]=$_SESSION['user_id'];
   $data['username']=$DATA_OBJ->username;
   //validate username
   if(empty($data["username"])){
     $error.="please enter a valid username . <br>";
   }else{
     if(strlen($data["username"]) < 3){
       $error.="username must be at least 4 characters long.<br>";
     }
     if(!preg_match("/^[a-zA-Z]*$/", $data["username"] )){
       $error.="please enter a valid username. <br>";
     }
   }
   
   $data['email']=$DATA_OBJ->email;
   if(empty($data["email"])){
    $error.="please enter a valid email . <br>";
    }else{
    if(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $data["email"] )){
      $error.="please enter a valid email. <br>";
    }
  }
   $data['password']=$DATA_OBJ->password;
   $password=$DATA_OBJ->password2;
   if(empty($data["password"])){
      $error.="please enter a valid password. <br>";
   }else{
     if(strlen($data["password"]) < 8){
       $error.="password must be at least 8 characters long. <br>";
       }
     if($data["password"] != $password){
      $error.="passwords must match.<br>";
     }
     
   }
   $data['gender']=$DATA_OBJ->gender;
    if($data["gender"] == "--select gender--"){
      $error.="please put a valid gender. <br>";
    }

 if($error == ""){
   $query =" update users set username = :username,email=:email, gender= :gender, password= :password where user_id=:user_id limit 1";
   $result=  $DB->write($query, $data);
   if($result){
     $info->message="data was saved";
     $info->data_type="save_settings";
     echo json_encode($info);
    }else{
      $info->message="Oops! data was not saved due to an error";
      $info->data_type="save_settings";
      echo json_encode($info);
    }
 }else{
   $info->message=$error;
   $info->data_type="save_settings";
   echo json_encode($info);
 }
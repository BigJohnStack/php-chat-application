<?php
  $data;
  $info=(object)[];
   $data["user_id"]=$DB->generate_id(10);
   $data['date']=date("Y-m-d H:i:s");
   
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
   $query ="insert into users(user_id,username,	email, gender,password, date) values (:user_id, :username, :email, :gender, :password, :date)";
   $result=  $DB->write($query, $data);
   if($result){
     $info->message="profile created";
     $info->data_type="info";
     echo json_encode($info);
    }else{
      $info->message="profile was not created due to an error";
      $info->data_type="error";
      echo json_encode($info);
    }
 }else{
   $info->message=$error;
   $info->data_type="error";
   echo json_encode($info);
 }
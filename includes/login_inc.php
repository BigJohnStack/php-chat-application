<?php
    $info=(object)[];
    $data;
   # validate info
   $data['email']=$DATA_OBJ->email;
   if(empty($DATA_OBJ->email)){
     $error="email cannot be empty";
   }
   if(empty($DATA_OBJ->password)){
        $error="password cannot be empty";
      }
  if($error == ""){
    $query ="select * from users where email =:email limit 1";
   $result=$DB->read($query, $data);
   if(is_array($result)){
     $result=$result[0];
     if($result->password ==$DATA_OBJ->password){
        $_SESSION["user_id"]=$result->user_id;
        $info->message="you're logged in";
        $info->data_type="info";
        echo json_encode($info);
     }else{
       $info->message="wrong password";
       $info->data_type="error";
       echo json_encode($info);
     }
     
    }else{
      $info->message="wrong email";
      $info->data_type="error";
      echo json_encode($info);
    }
 }else{
   $info->message=$error;
   $info->data_type="error";
   echo json_encode($info);
 }
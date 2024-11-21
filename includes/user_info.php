<?php
    $info=(object)[];
    $data;
   $data["user_id"]=$_SESSION["user_id"];
  if($error == ""){
    $query ="select * from users where user_id=:user_id limit 1";
   $result=$DB->read($query, $data);
   if(is_array($result)){
     $result=$result[0];
     $result->data_type="user_info";
     //check if image exist
      $image=($result->gender == "Male" ) ? "ui/images/male.jpg" :"ui/images/female.jpg";
         if(file_exists($result->image)){
           $image=$result->image;
         }
         $result->image=$image;
     
     echo json_encode($result);
     
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
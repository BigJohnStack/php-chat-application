<?php
session_start();
$DATA_RAW=file_get_contents("php://input");
$DATA_OBJ=json_decode($DATA_RAW);
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

$DATA_RAW=file_get_contents("php://input");
$DATA_OBJ=json_decode($DATA_RAW);
$error="";
//process the data
if(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "signup")
{
   //sign up
   include("includes/signup_inc.php");
   
}else if(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "login")
{
   //sign up
   include("includes/login_inc.php");
   
}elseif(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "logout") {
  //user info
  include("includes/logout_inc.php");
}elseif(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "user_info") {
  //user info
  include("includes/user_info.php");
}elseif(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "contacts") {
  //user info
  include("includes/contact_inc.php");
}elseif(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "settings") {
  //user info
  include("includes/setting_inc.php");
}elseif(isset($DATA_OBJ->data_type) && ($DATA_OBJ->data_type == "chats" || $DATA_OBJ->data_type == "chats_refresh")) {
  //user info
  include("includes/chat_inc.php");
}elseif(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "save_settings") {
  //user info
  include("includes/save_setting.php");
}elseif(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "send_message") {
    //send messages
    include("includes/send_message.php");
}elseif(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "delete_message") {
    //send messages
    include("includes/delete_message.php");
}
function message_left($data, $result){
  $image=($result->gender == "Male" ) ? "ui/images/male.jpg" :"ui/images/female.jpg";
         if(file_exists($result->image)){
             $image=$result->image;
          }
    $m="<div id='message_left' style='max-height:800px;height:auto;'>";
     $m.="<div></div>";
     $m .="<img  id='prof_img'  src='$image'/>
       <span><b>$result->username</b></span><br>
      <span> $data->message</span><br>";
       if($data->files !== "" && file_exists($data->files)){
            $m.="<img src='$data->files' style='width:200px;' onclick='image_show(event)'/><br>";
       }
      $m .="<span style='font-size:11px; color:#000;'>".date("js M Y h:i:s a",strtotime($data->date))." </span>
    <strong id='trash' onclick='delete_message(event)' msgid='$data->id' >Del</strong>
       </div>";
       return $m;
}
function message_right($data, $result){
  $image=($result->gender == "Male" ) ? "ui/images/male.jpg" :"ui/images/female.jpg";
  if(file_exists($result->image)){
    $image=$result->image;
   }
    $m = "<div id='message_right'style='max-height:800px;height:auto;'>";
    if($data->seen){
       $m.= "<div style='background-color:blue'></div>";
     }else if($data->received){
       $m.= "<div style='background-color:green'></div>";
     }else{
       $m.= "<div></div>";
     }
     $m.= "<img id='prof_img' src='$image'/>
       <span><b>$result->username</b></span><br>
      <span> $data->message</span><br> ";
       if($data->files !== "" && file_exists($data->files)){
            $m.="<img src='$data->files' style='width:200px;' onclick='image_show(event)'//><br>";
       }
      $m .=" <span style='font-size:11px; color:#888;'>".date("jS M Y h:i:s a", strtotime($data->date))."</span>
       <strong id='trash' onclick='delete_message(event)' msgid='$data->id' >Del</strong>
       </div>
  ";
  return $m;
}
function message_controls(){
  return "</div> 
       <span style=' color: purple; cursor:pointer;' onclick='delete_thread(event)'> Delete this thread</span>
       <div style='display:flex; width:100%; height:40px'>
           <label for='message_file' ><img src='ui/icons/clip.png' style='opacity:0.8;width:30px; margin:5px; cursor:pointer; '></label>
          <input id='message_file' style='display:none;'type='file' name='file' onchange='send_image(this.files)'>
          <input id='message_text' style='flex:6; border:solid thin #ccc; border-bottom:none;font-size:14px; padding' type='text'; onkeyup='enter_pressed(event)' ;placeholder='type your message'>
          <input style='flex:1; cursor:pointer;' type='button' value='send' onclick='send_message(event)'>
        </div>
        </div>
        ";
}


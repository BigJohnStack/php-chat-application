  <?php
  $arr['user_id']="null";
  if(isset($DATA_OBJ->find->user)){
    $arr['user_id']=$DATA_OBJ->find->user;
  }
  $refresh=false;
  $seen=false;
  if($DATA_OBJ->data_type == "chats_refresh"){
    $refresh=true;
    $seen=$DATA_OBJ->find->seen;
  } 
  $sql="select * from users where user_id =:user_id limit 1";
  $result= $DB->read($sql, $arr);
  if (is_array($result)) {
    // user found
  $result=$result[0];
  $image=($result->gender == "Male" ) ? "ui/images/male.jpg" :"ui/images/female.jpg";
   if(file_exists($result->image)){
     $image=$result->image;
   }
  $result->image=$image;
  $myData=""; 
  if(!$refresh){
    $myData="Now chatting with <br>
    <div id='active_contact'>
       <img src='$image'/>
       <br>
       <span>$result->username</span> 
       </div>";
  }
  $messages="";
  $new_message=false;
  if(!$refresh){
    $messages="<div id='messages_holder_parent' onclick='set_seen(event)' style='height:630px;'>
    <div id='messages_holder' style='height:480px; overflow-y:scroll;'>";
  }
 //read from db
  $a['sender']= $_SESSION['user_id'];
  $a['receiver']=$arr['user_id'];
  $sql="select * from messages where (sender=:sender && receiver =:receiver && deleted_sender=0) || (sender=:receiver && receiver =:sender && deleted_receiver=0) order by id desc limit 10";
     $result2= $DB->read($sql, $a);
     if (is_array($result2)) {
       $result2=array_reverse($result2);
       foreach ($result2 as $data){
         //check for new messages
         if($data->receiver == $_SESSION['user_id'] && $data->received ==0){
           $new_message=true;
         }
         if($data->receiver == $_SESSION['user_id'] && $data->received == 1 && $seen){
           $DB->write("update messages set seen = 1 where id = $data->id limit 1 ");
         }
         if($data->receiver == $_SESSION['user_id']){
           $DB->write("update messages set received = 1 where id = $data->id limit 1 ");
         }
         $myuser=$DB->get_user($data->sender);
         if($_SESSION['user_id'] == $data->sender){
           
           $messages.=message_right($data,$myuser);
         }else{
           $messages.=message_left($data,$myuser);
         }
         
         
        }
     }
  if(!$refresh){
    $ms['sender']= $_SESSION['user_id'];
    $ms['receiver']=$arr['user_id'];
    $sql="select * from messages where (sender=:sender && receiver =:receiver && deleted_sender=0) || (sender=:receiver && receiver =:sender && deleted_receiver=0) order by id desc limit 10";
     $prod= $DB->read($sql, $ms);
    $messages .= message_controls($prod);
  }
  
  $info->user=$myData;
  $info->messages=$messages;
  $info->new_message=$new_message;
  $info->data_type="chats";
  if($refresh){
    $info->data_type="chats_refresh";
  }
  echo json_encode($info);
  }else{
    $a['user_id']= $_SESSION['user_id'];
    $sql="select * from messages where (sender=:user_id || receiver =:user_id) group by msgid order by id desc limit 10";
   $result2= $DB->read($sql, $a);
   if (is_array($result2)) {
     $myData="Previous chats<br>";
       $result2=array_reverse($result2);
       foreach ($result2 as $data){
         $other_user= $data->sender == $_SESSION['user_id'] ? $data->receiver : $data->sender;
         $myuser=$DB->get_user($other_user);
         $image=($myuser->gender == "Male" ) ? "ui/images/male.jpg" :"ui/images/female.jpg";
         if(file_exists($myuser->image)){
             $image=$myuser->image;
          }
         $myData.="
         <div id='active_contact' userid='$myuser->user_id' onclick='start_chat(event)' style='cursor:pointer'>
       <img src='$image'/>
       <br>
       <span>$myuser->username</span><br>
       <span style='font-size:11px'>'$data->message'</span>
       </div>";
        }
     }
    //user not found
    $info->user=$myData;
  $info->messages="";
  $info->data_type="chats";
  echo json_encode($info);
  }
  
  ?>
 
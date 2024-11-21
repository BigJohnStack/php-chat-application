 <?php
  $arr['user_id']="null";
  if(isset($DATA_OBJ->find->user)){
    $arr['user_id']=$DATA_OBJ->find->user;
  }
  $sql="select * from users where user_id = :user_id limit 1";
  $result= $DB->read($sql, $arr);
  if (is_array($result)) {
    $arr['message']=$DATA_OBJ->find->message;
    $arr['date']=date('Y-m-d H:i:s');
    $arr['sender']=$_SESSION['user_id'];
    $arr['msgid']= get_random_string_max(60);
      $arr2['sender']=$_SESSION['user_id'];
      $arr2['receiver']=$arr['user_id'];
   
    $sql="select * from messages where (sender=:sender && receiver =:receiver) || (sender=:receiver && receiver =:sender) limit 1";
     $result2= $DB->read($sql, $arr2);
     if (is_array($result2)) {
      $arr['msgid']= $result2[0]->msgid;
    }
    $query="insert into messages(sender,receiver, message, date, msgid, files) values(:sender,:user_id, :message, :date, :msgid, '')";
    $DB->write($query, $arr);
    
    
    // user found
  $result=$result[0];
  $image=($result->gender == "Male" ) ? "ui/images/male.jpg" :"ui/images/female.jpg";
       if(file_exists($result->image)){
         $image=$result->image;
         
       }
       $result->image=$image;
  $myData="now chatting with:
       <div id='active_contact'>
       <img src='$image'/>
       <br>
       <span>$result->username</span> 
       </div>";
  $messages="<div id='messages_holder_parent' style='height:630px;'>
  <div id='messages_holder' style='height:480px; overflow-y:scroll;'>";

  //read from db
  $a['msgid']= $arr['msgid'];
  $sql="select * from messages where msgid=:msgid order by id desc limit 10";
     $result2= $DB->read($sql, $a);
     if (is_array($result2)) {
       $result2=array_reverse($result2);
       foreach ($result2 as $data){
         $myuser=$DB->get_user($data->sender);
         if($_SESSION['user_id'] == $data->sender){
           $messages.=message_right($data,$myuser);
         }else{
           $messages.=message_left($data,$myuser);
         }
         
         
        }
     }
  
  
  $messages .=message_controls();
       
  $info->user=$myData;
  $info->messages=$messages;
  $info->data_type="send_message";
  echo json_encode($info);
  }else{
    //user not found
    $info->message="That contact was not found";
  $info->data_type="send_message";
  echo json_encode($info);
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
  ?>
 
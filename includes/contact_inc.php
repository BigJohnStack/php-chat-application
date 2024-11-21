  <?php
  $myid=$_SESSION['user_id'];
  $sql="select * from users where user_id != '$myid' limit 10";
  $myusers=$DB->read($sql, [] );
  $myData='<style>
    @keyframes appear{
      0%{opacity:0;transform:translateY(50px) rotate(5deg)};
      100%{opacity:1;transform:translateY(0px) rotate(0deg)};
    }
    #contact{
      cursor:pointer;
      transition:all .5s cubic-bezier(0.68,.-2,0.264,.1.55);
    }
   #contact:hover{
        transform:scale(1.1);
    }
  </style>
  
  
  <div style="text-align:center;">
   ';
   if(is_array($myusers)){
     //check for new messages
     $mgs=array();
     $me=$_SESSION['user_id'];
     $query= "select * from messages where receiver = '$me' && received = 0";
     $mymgs=$DB->read($query, [] );
      if(is_array($mymgs)){
        foreach ($mymgs as $row2){
          $sender=$row2->sender;
          if(isset($mgs[$sender])){
            $mgs[$sender]++;
          }else{
            $mgs[$sender]=1;
          }
        }
      }
     foreach ($myusers as $row) {
       $image=($row->gender == "Male" ) ? "ui/images/male.jpg" :"ui/images/female.jpg";
       if(file_exists($row->image)){
         $image=$row->image;
       }
       
       $myData.="<div id='contact' style='position:relative;' userid='$row->user_id' onclick='start_chat(event)'>
       <img src='$image'/>
       <br>
       <span>$row->username</span>";
       if(count($mgs) > 0 && isset($mgs[$row->user_id])){
           $myData .=" <div style='width:20px; height:20; border-radius:50px; color: white; position:absolute; left:0;top:0; background-color:orange;'>".$mgs[$row->user_id]."</div>";
       }
       $myData .= "</div>";
     }
   }
  $myData.='</div>';
    
  //$result=$result[0];
  $info->data_type="contacts";
  $info->message=$myData;
  echo json_encode($info);
  die;
  $info->message="no contacts were found";
  $info->data_type="error";
  echo json_encode($info);
 
  <?php
  $arr['user_id']="null";
  if(isset($DATA_OBJ->find->msgid)){
    $arr['msgid']=$DATA_OBJ->find->msgid;
  }
  $id=$arr["msgid"];
  $sql="select * from messages where id = '$id' ";
 $result= $DB->read($sql);
  if (is_array($result)) {
    // code...
    $rows=$result[0];
    foreach ($rows as $row) {
     if ($_SESSION['user_id']==$row->sender) {
      // code...
      $sql="update messages set deleted_sender =1 where msgid='$id' limit 1";
       $DB->write($sql);
    }
    if ($_SESSION['user_id']==$row->receiver) {
      // code...
      $sql="update messages set deleted_receiver=1 where msgid='$id' limit 1";
       $DB->write($sql);
    }
  }
 }
  ?>
 
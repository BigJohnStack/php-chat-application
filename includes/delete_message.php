  <?php
  $arr['user_id']="null";
  if(isset($DATA_OBJ->find->rowid)){
    $arr['rowid']=$DATA_OBJ->find->rowid;
  }
  $id=$arr["rowid"];
  $sql="select * from messages where id = '$id' limit 1";
 $result= $DB->read($sql);
  if (is_array($result)) {
    // code...
    $row=$result[0];
    if ($_SESSION['user_id']==$row->sender) {
      // code...
      $sql="update messages set deleted_sender =1 where id ='$row->id' limit 1";
       $DB->write($sql);
    }
    if ($_SESSION['user_id']==$row->receiver) {
      // code...
      $sql="update messages set deleted_receiver=1 where id ='$row->id' limit 1";
       $DB->write($sql);
    }
  }
  ?>
 
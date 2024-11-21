  <?php
  $sql="select * from users where user_id = :user_id limit 1";
  $id=$_SESSION['user_id'];
  $data=$DB->read($sql, ['user_id'=>$id]);
  $myData="";
if(is_array($data)){
    $data=$data[0];
    $gender= $data->gender=='Male' ? 'Female': 'Male';
    
    //check if image exists
   $image=($data->gender == "Male" ) ? "ui/images/male.jpg" :"ui/images/female.jpg";
    if(file_exists($data->image)){
      $image=$data->image;
    }
  $myData='
<style>
    @keyframes appear{
      0%{opacity:0;transform:translateY(50px) rotate(5deg); transform-origin:100% 100%};
      100%{opacity:1;transform:translateY(0px) rotate(0deg)};
    }
  form{
    margin: auto;
    padding: 10px;
    width:100%;
    max-width: 400px;
    text-align:left;
  }
  input[type=text], input[type=email], input[type=password], input[type="submit"]{
    padding:10px;
    margin: 10px;
    width:200px;
    border-radius: 5px;
    border: solid thin #ccc;
  } 
  input[type="button"]{
    width:220px;
    margin: 10px;
    height:40px;
   background-color:#2b5488; 
   color:#fff;
  }
  select{
    padding:10px;
    margin: 10px;
    width:225px;
    border-radius: 5px;
    border: solid thin #ccc;
    cursor:pointer;
    background-color: #fff;
  }
    #error{
        text-align:center; 
        padding:0.5em; 
        background-color:#ecaf91;
        color:white; 
        display:none;
        font-size:14px;
        font-weight: bold;
    }
  .dragging{
    border: dashed 2px #aaa;
  }
</style>
    <div id="error"></div>
    <div style="display:flex;animation:appear 1s ease"">
      <div>
      <span style="font-size:11px"> drag and drop to change image</span>
         <img src='.$image.' ondragover="handle_drag_and_drop(e)" ondrop="handle_drag_and_drop(e)" ondragleave="handle_drag_and_drop(e)" style="width:150px; height:150px; margin:10px"/>
         <label for="change_img_input" id="change_img_btn" style="background-color:#9b9a80; display:inline-block;padding:1em;border-radius:5px; cursor:pointer;"> Change Image</label>
           <input type="file" onchange="upload_profile_image(this.files)" id="change_img_input" style="display:none";><br>
      </div>
      <form id="myform">
        <input type="text" name="username" placeholder="Username" value="'.$data->username.'">
       <input type="email" name="email" placeholder="Email" value="'.$data->email.'">
        <select id="gender" name ="gender">
          <option>'.$data->gender.'</option>
          <option>'.$gender.'</option>
        </select>
      <input type="password" name="password" placeholder="Password" value="'.$data->password.'"><br>
      <input type="password" name="password2" placeholder="Retype password" value="'.$data->password.'"><br>
      <input type="button" id="save_settings_btn" value="Save settings" onclick="collect_data(event)"><br>
      <br>
      </form>
    </div>
 ';
  $info->data_type="contacts";
  $info->message=$myData;
  echo json_encode($info);
}else{
  $info->message="no contacts were found";
  $info->data_type="error";
  echo json_encode($info);
}
?>
 
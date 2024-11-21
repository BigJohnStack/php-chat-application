<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> My Chat</title>
</head>
<style>
@font-face{
  font-family:headFont;
  src: url('ui/fonts/Summer-Vibes-OTF.otf')
}

@font-face{
  font-family:myFont;
  src: url('ui/fonts/OpenSans-Regular.ttf')
}


  #wrapper{
    max-width:800px;
    min-height:500px;
    max-height:630px;
   display:flex;
   margin:auto;
   color:white;
   font-family:myFont;
   font-style: 13px; 
  }
  #left_pannel{
    min-height:500px;
    background:#27344b;
    flex:1;
    text-align: center; 
  }
  #profile_image{
    width:80%;
    border:solid thin white;
    border-radius:50%; 
    margin:10px;
  }
  #left_pannel label{
    width:100%;
    height:30px;
    display:block;
    background-color: #404b56;
    border-bottom:solid thin #ffffff55;
    cursor: pointer;
    padding:5px;
    transition: all 1s ease;
  } 
  
  #left_pannel label img{
    float:right;
    width:25px;
    
 }
 #left_pannel label:hover{
   background: #77859;
 }
  #right_pannel{
    min-height:500px;
    flex:4;
    text-align: center; 
  }
  #header{
    background:#485b6c;
    font-size: 40px;
    text-align: center;
    height:70px;
    font-family: headFont;
    position:relative;
  }
  #container{
    display:flex;
  }
  #inner_left_pannel{
    flex:1;
    background:#273445;
    min-height:430px;
    max-height:530px;
  }
  #inner_right_pannel{
    flex:2;
    background: #f2f7f8;
    min-height: 430px;
    max-height:530px;
    transition: all 1s ease;
  }
  #radio_contacts:checked ~ #inner_right_pannel{
    flex:0;
  }
   #radio_settings:checked ~ #inner_right_pannel{
   flex:0;
   }
   #contact{
     width:100px;
     height:120px;
     margin:10px;
     display: inline-block;
    // overflow: hidden;
     vertical-align: top;
   }
   #contact img{
     width:100px;
     height:100px;
   
   }
   #active_contact{
     height:70px;
     margin:10px;
     border:solid thin #aaa;
     padding:5px;
     background-color:#eee;
     color:#444;
   }
   #active_contact img{
     width:70px;
     height:70px;
     float:left;
     margin:2px;
   
   }
      #message_left{
     height:70px;
     margin:10px;
     padding:2px;
     padding-right:10px;
     background-color:#c979d5;
     color:#fff;
     float:left;
     box-shadow: 0px 0px 10px #aaa;
     border-bottom-left-radius: 50%;
     position:relative;
     width:60%;
     min-width:200px;
     overflow-x: hidden;
   }
   #message_left #prof_img{
     width:60px;
     height:60px;
     float:left;
     margin:2px;
     border-radius: 50%;
     border:solid 2px white ;
   }
   #message_left div{
     width:20px;
     height:20px;
     background-color: #34474f;
     border: solid 2px white;
     border-radius: 50%;
     position: absolute;
     left:-10px;
     top:20px;
     
   }
   
   #message_right{
     height:70px;
     margin:10px;
     padding:2px;
     padding-right:10px;
     background-color:#fbffee;
     color:#444;
     float:right!important;
     box-shadow: 0px 0px 10px #aaa;
     border-bottom-right-radius: 50%;
     position:relative;
     width:60%;
     min-width:200px;
     overflow-x:auto;
   }
   #message_right #prof_img{
     width:60px;
     height:60px;
     float:left;
     margin:2px;
     border-radius: 50%;
     border:solid 2px white ;
   }
   #message_right #trash{
     width:30px;
     height:20px;
     position: absolute;
     top:8px;
     left:-30px;
     border:thin solid #aaa;
     border-radius: 50px;
     cursor:pointer;
     background-color: #d8d8;
   }
    #message_left #trash{
     width:30px;
     height:20px;
     position: absolute;
     top:8px;
     right:-30px;
     border:thin solid #aaa;
     border-radius: 50px;
     cursor:pointer;
     background-color:#e68;
     
    
   }
   #message_right div{
     width:20px;
     height:20px;
     background-color: #34474f;
     border: solid 2px white;
     border-radius: 50%;
     position: absolute;
     right:-10px;
     top:20px;
     
   }
   .loader_on{
     position: absolute;
     width:30%;
   }
   .loader_off{
     display:none;
   }
   .image_on{
     position: absolute;
     height:450px;
     width:450px;
     margin:auto;
     z-index: 100;
     top:50px;
     left:50px;
   }
   .image_off{
     display:none;
   }
</style>
<body>
  <div id="wrapper">
    <div id='left_pannel'>
      <div id='user_info' style="padding:10px">
        <img id="profile_image" src="ui/images/placholder.jpg" alt="" style="height:100px; width:100px"/><br>
       <span id="username">username</span> <br>
       <span id="email" style="font-size: 12px; opacity:0.5"> email@gmail.com </span><br><br><br>
       <div>
         <label id="label_chats" for="radio_chat">Chat<img src="ui/icons/chat.png" ></label>
         <label id="label_contacts" for="radio_contacts">Contacts <img src="ui/icons/contacts.png" ></label>
         <label id="label_settings" for="radio_settings">Settings <img src="ui/icons/settings.png" > </label>
           <label id="logout" for="radio_logout">Logout<img src="ui/icons/logout.png" > </label>
        </div>
      </div>
    </div>
    <div id='right_pannel'>
      <div id='header'>
     <div id="loader_holder" class="loader_off"><img style="width:50px" src="ui/icons/giphy.gif"></div>
     <div id='image_viewer' class='image_off' onclick='close_image(event)'></div>
        Mychat
      </div>
      <div id='container'>
      
        <div id='inner_left_pannel'> 
       
       </div>
        <input type="radio" id="radio_chat" name="myRadio" style="display:none">
        <input type="radio" id="radio_contacts" name="myRadio" style="display: none">
        <input type="radio" id="radio_settings" name="myRadio" style="display: none">
        <div id='inner_right_pannel'></div>
      </div>
    </div>
  </div>
<script type="text/javascript">
var sent_audio =new Audio("sent_audio.mp3");
var received_audio=new Audio("received_audio.mp3");
 var CURRENT_CHAT_USER= "";
 var SEEN_STATUS=false;
  function _(elem, parent){
    if(!parent)return document.getElementById(elem);
    else return parent.getElementById(elem);
  }
  var label_contacts=_("label_contacts");
  label_contacts.addEventListener("click", get_contacts);
 var label_chats=_("label_chats");
    label_chats.addEventListener("click", get_chats);
  var label_settings=_("label_settings");
      label_settings.addEventListener("click", get_settings);
  var logout_btn=_("logout");
  logout_btn.addEventListener("click", logout);
  function get_data(find, type){
    
    var xml=new XMLHttpRequest();
    var loader_holder=_("loader_holder");
    loader_holder.className="loader_on";
    xml.onload=function(){
      if(xml.readyState==4 ||xml.status == 200){
       // alert(xml.responseText);
       loader_holder.className="loader_off";
        handle_result(xml.responseText, type);
      }
    }
    var data={};
    data.find=find;
    data.data_type=type;
    data=JSON.stringify(data);
    xml.open("POST", "api.php", true);
    xml.send(data);
  }
  function handle_result(result, type){
    //alert(result);
    if(result.trim() != ""){
      var pannel2=_("inner_right_pannel");
      pannel2.style.overflow="visible";
      var obj=JSON.parse(result);
      if(typeof(obj.logged_in) != 'undefined' && !obj.logged_in){
         window.location="login.php";
      }else{
         switch(obj.data_type){
         case "user_info":
             var username=_("username");
             var email=_("email");
             var profile_image=_("profile_image");
             
             username.innerHTML=obj.username;
             email.innerHTML=obj.email;
             profile_image.src=obj.image;
             break;
         case "contacts":
           var pannel=_("inner_left_pannel");
           pannel.innerHTML=obj.message;
           pannel2.style.overflow="hidden";
           break;
        case "chats_refresh":
           SEEN_STATUS=false;
           var messages_holder=_("messages_holder");
             messages_holder.innerHTML=obj.messages;
             if(typeof obj.new_message != "undefined"){
               if(obj.new_message){
                 received_audio.play();
                 setTimeout(function(){
                    messages_holder.scrollTo(0,messages_holder.scrollHeight);
                      var message_text=_('message_text');
                     message_text.focus();
                   },100);
               }
             }
          break;
         case "send_message":
           sent_audio.play();
         case "chats":
           SEEN_STATUS=false;
           var pannel=_("inner_left_pannel");
           pannel.innerHTML=obj.user;
           pannel2.innerHTML=obj.messages;
           var messages_holder=_('messages_holder');
           setTimeout(function(){
             messages_holder.scrollTo(0,messages_holder.scrollHeight);
             var message_text=_('message_text');
             message_text.focus();
           },100);
           if(typeof obj.new_message != "undefined"){
               if(obj.new_message){
                 received_audio.play();
               }
             }
           break;
           
           case "settings":
             var pannel=_("inner_left_pannel");
             pannel.innerHTML=obj.message;
              break;
           case "save_settings":
              alert(obj.message);
              get_data({}, "user_info");
              get_settings(true);
               break;
          case "send_image":
            alert(obj.message);
            break;
         }
      } 
    }
  }
  function logout(){
    var answer=confirm("Do you want to logout?")
    if(answer){
      get_data({}, "logout");
    }
  }
  get_data({}, "user_info");
  get_data({}, "contacts");
  var radio_contacts=_('radio_settings');
  radio_contacts.checked=true;
  
  function get_contacts(e){
    get_data({}, "contacts");
  }
  function get_chats(e){
      get_data({}, "chats");
  }
  function get_settings(e){
        get_data({}, "settings");
  }
  function send_message(e){
    var message_text=_("message_text");
    if(message_text.value.trim() == ""){
      alert("type something to send")
    }else{
      get_data({
       message:message_text.value.trim(),
       user:CURRENT_CHAT_USER
     }, "send_message")
    }
  }
 function enter_pressed(e)
 {
        if(event.keyCode == 13)
        {
          send_message(e)
        }
        SEEN_STATUS=true;
  }
      
  setInterval(function(){
    var radio_chat=_("radio_chat");
    var radio_contacts=_("radio_contacts");
       if(CURRENT_CHAT_USER != "" && radio_chat.checked )
       {
         get_data({
          user:CURRENT_CHAT_USER,
          seen:SEEN_STATUS
        },"chats_refresh" );
        
       }
      if(radio_contacts.checked )
       {
        get_data({}, "contacts");
       }
      },5000);
      function set_seen(e)
      {
        SEEN_STATUS=true;
      }
      function delete_message (e)
      {
        if(confirm("Are you sure you want to delete this message?")){
          var msgid=e.target.getAttribute('msgid');
          get_data({
              rowid:msgid
           }, "delete_message");
           get_data({
             
          user:CURRENT_CHAT_USER,
          seen:SEEN_STATUS
        },"chats_refresh" );
    }
  }
</script>
<script type="text/javascript">
 function collect_data(){
     var save_settings_btn=_("save_settings_btn");
     save_settings_btn.disabled=true;
     save_settings_btn.value="please wait loading... ";
      var myform=_("myform");
      var inputs=myform.getElementsByTagName("*"); 
      var data={};
      for(var i=0; i< inputs.length; i++){
        var key=inputs[i].name;
        switch(key){
          case "username": 
            data.username=inputs[i].value;
            break;
          case "email":
            data.email=inputs[i].value;
            break;
          case "gender":
            data.gender=inputs[i].value;
             break;k
          case "password":
            data.password=inputs[i].value;
            break;
          case "password2":
            data.password2=inputs[i].value;
            break;
            
        }
      }
      send_data(data, "save_settings");
      
    } 
      function send_data(data, type){
        var xml=new XMLHttpRequest();
        xml.onload=function(){
          if(xml.readyState == 4 || xml.status==200 ){
           handle_result(xml.responseText);
            var save_settings_btn=_("save_settings_btn")
           save_settings_btn.disabled=false;
            save_settings_btn.value="save_settings";
          }
        }
          data.data_type=type;
          var data_string=JSON.stringify(data);
         xml.open("POST", "api.php", true);
         xml.send(data_string);
      } to
      function upload_profile_image(files){
          var file_name=files[0].name;
        var ext_start=file_name.lastIndexOf('.');
        var ext= file_name.substr(ext_start + 1,3)
        if(!(ext == "jpg"||ext == "JPG")){
          alert('unsupported file type');
          return;
        }
   
      var change_img_btn =_("change_img_btn");
         change_img_btn.disabled=true;
         change_img_btn.innerHTML="uploading Image...";
         //form data convert the data im tgeform to an array
         var myform= new FormData();
          var xml=new XMLHttpRequest();
          xml.onload=function(){
           if(xml.readyState == 4 || xml.status==200 ){
             //alert(xml.responseText);
             get_data({},"user_info");
             get_settings(true);
            change_img_btn.disabled=false;
           change_img_btn.innerHTML="Change Image";
              
            }
           }
           //in php array will be accessed eith $_FILES
           myform.append('file', files[0])
           //while string are accessed with $_POST
           myform.append('data_type',"change_profile_image");
          xml.open("POST", "uploader.php", true);
           xml.send(myform);
      } 
      function handle_drag_and_drop(e){
        if(e.type == "dragover"){
          e.preventDefault();
          e.target.className="dragging"
        }else if(e.type == "dragleave"){
          e.preventDefault()
          e.target.className=""
        }else if(e.type == "drop"){
          e.preventDefault()
          e.target.className=""
          upload_profile_image(e.dataTransfer.files);
        }else{
          
        }
      }
      function start_chat(e){
        var userid=e.target.getAttribute('userid');
        if(e.target.id == ""){
           userid=e.target.parentNode.getAttribute('userid');
        }
       CURRENT_CHAT_USER=userid;
         var radio_chat=_('radio_chat');
          radio_chat.checked=true;
          get_data({user:CURRENT_CHAT_USER},"chats" );
      }
      function send_image(files){
        var file_name=files[0].name;
        var ext_start=file_name.lastIndexOf('.');
        var ext= file_name.substr(ext_start + 1,3)
        if(!(ext == "jpg"||ext == "JPG")){
          alert('unsupported file type');
          return;
        }
        var myform= new FormData();
        var xml=new XMLHttpRequest();
            xml.onload=function(){
             if(xml.readyState == 4 || xml.status==200 ){
             alert(xml.responseText);
                  get_data({
                      user:CURRENT_CHAT_USER,
                      seen:SEEN_STATUS
                  },"chats_refresh" );
                }
           }
           //in php array will be accessed eith $_FILES
           myform.append('file', files[0])
           //while string are accessed with $_POST
           myform.append('data_type',"send_image");
           myform.append('user_id',CURRENT_CHAT_USER )
          xml.open("POST", "uploader.php", true);
           xml.send(myform);
      }
      function close_image(e){
        e.target.className="image_off";
      }
     function image_show(e){
        var source= e.target.src;
        var image_viewer=_('image_viewer');
        image_viewer.innerHTML="<img src='" +source+"'style='width:100%'/>";
        image_viewer.className="image_on"
      }
      
</script>
</body>
</html>

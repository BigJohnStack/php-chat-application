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
   margin:auto;
   color:grey;
   font-family:myFont;
   font-style: 13px; 
  }
  form{
    margin: auto;
    padding: 10px;
    width:100%;
    max-width: 400px;
  }
  input[type=text], input[type=email], input[type=password], input[type="submit"]{
    padding:10px;
    margin: 10px;
    width:98%;
    border-radius: 5px;
    border: solid thin #ccc;
  }
  input[type="button"]{
    width:103%;
    height:40px;
   background-color:#2b5488; 
   color:#fff;
  }
  select{
    padding:10px;
    margin: 10px;
    width:98%;
    border-radius: 5px;
    border: solid thin #ccc;
    cursor:pointer;
    background-color: #fff;
  }
 #header{
    background:#485b6c;
    font-size: 40px;
    text-align: center;
    font-family: headFont;
    width:100%;
    color:#fff;
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
</style>
<body>
  <div id="wrapper">
    <div id="header">
      My Chat
      <div style="font-size:20px; font-family:myFont; margin:10px">Sign Up <br></div>
    </div>
    <div id="error"></div>
    <form id="myform">
      <input type="text" name="username" placeholder="Username">
       <input type="email" name="email" placeholder="Email">
        <select id="gender" name ="gender">
          <option>--select gender--</option>
          <option>Male</option>
          <option>Female</option>
        </select>
      <input type="password" name="password" placeholder="Password"><br>
      <input type="password" name="password2" placeholder="Retype password"><br>
      <input type="button" id="signup_btn" value="Sign up"><br>
      <br>
      <a href="login.php" style="display:block; text-align:center;text-decoration:none; "> Already have an account? Login now</a>
      </form>
  </div>
</body>
<script type="text/javascript">
  function _(elem, parent){
    if(!parent)return document.getElementById(elem);
    else return parent.getElementById(elem);
  }
  var signup= _('signup_btn');
  signup.addEventListener('click', collect_data);
 function collect_data(){
     signup.disabled=true;
     signup.value="please wait loading... "
      var myform=_('myform');
      var inputs=myform.getElementsByTagName('*');
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
             break;
          case "password":
            data.password=inputs[i].value;
            break;
          case "password2":
            data.password2=inputs[i].value;
            break;
        }
      }
      send_data(data, "signup");
      
    } 
      function send_data(data, type){
        var xml=new XMLHttpRequest();
        xml.onload=function(){
          if(xml.readyState == 4 || xml.status==200 ){
           handle_result(xml.responseText);
           signup.disabled=false;
            signup.value="Signup";
          }
        }
          data.data_type=type;
          var data_string=JSON.stringify(data);
         xml.open("POST", "api.php", true);
         xml.send(data_string);
      }
      function handle_result(result){
        var data=JSON.parse(result);
        if(data.data_type == "info" ){
          window.location="index.php";
        }else{
          var error=_("error");
          error.innerHTML=data.message;
          error.style.display="block";
        }
      }
</script>
</html>

<style>
.background{
  background-color: #A2E4B8;
  background: linear-gradient(45deg, transparent 49%,  #FFFFFF 49% 51%, transparent 51%) , linear-gradient(-45deg, transparent 49%,  #FFFFFF 49% 51%, transparent 51%);
  background-size: 3em 3em;
  background-color: #A2E4B8;
  opacity: 1;
}
.body01{
  font-family: "Cambria" ;
  color : #966E5C;
}
.websitepanel{
  display : flex;
  flex-direction: row;
  justify-content:space-around;
  backdrop-filter: blur(5px);
  border : 4px solid #966E5C;
}
.panelbox{
width : 150px;
height: 30px;
text-align: center;
font-size: 20px;
list-style: none;
}
.websitetitlecontainer{
  display: flex;
  justify-content: center;
}
.websitetitle{
text-align: center;
font-family: "papyrus";
font-weight: bold;
color: black;
border: 5px solid #966E5C;
width: 400px;
color : #966E5C;
background-color: #A2E4B8;
}

.loginform{
  width: 300px;
  height: 300px;
  padding: 25px;
  background-color: #966E5C;
  font-size: 20px;
  color: black;
  font-family: "clarendon" ;
  text-align: left;
  margin: auto;
  border : 2px solid black;
}
.LoginInputtextbox{
  width: 100%;
  background-color: #FFFFFF;
  text-align: left;
  color: black;
  padding: 10px 10px;
  margin: auto;;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.LoginButtonuser{
  width: 30%;
  background-color: #4CAF50;
  text-align: center;
  color: white;
  padding: 10px 10px;
  margin-left: 100px;
  margin-right: 100px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}
.LoginButtonuser:hover {
  background-color: #45a049;
}
a:link, a:visited {
  background-color: green;
  color: white;
  border: 2px solid green;
  padding: 5px 5px;
  text-align: left;
  text-decoration: none;
  display: inline-block;
  margin-left: 25px;
  margin-right: 25px;
}

a:hover, a:active {
  background-color:greenyellow;
  color: white;
} 
</style>
<?php
require 'config.php';

if( (!empty($_SESSION["id"]))  AND (!empty($user["SSN"])) )  
{
    header("Location: userindex.php");
}

if( (!empty($_SESSION["id"]))  AND (!empty($admin["email"])) )  
{
    header("Location: adminindex.php");
}

if(isset($_POST["submit"])){
  $email=$_POST["email"];
  $password=$_POST["password"];
  $usertype=$_POST["usertype"];
  if($usertype=="user")
  {
      unset($usertype);
  $result = mysqli_query($conn, "SELECT * FROM customer WHERE email = '$email'");
  $user = mysqli_fetch_assoc($result);
    if(mysqli_num_rows($result) > 0){
    if($password == $user['PASSWORD']){
     $_SESSION["login"] = true;
    $_SESSION["SSN"] = $user["SSN"];
      header("Location: userindex.php"); 
    }
    else{
      echo
      "<script> alert('Wrong Password'); </script>";
    }
  }
  else{
    echo
    "<script> alert('User Not Registered'); </script>";
  }
  }
  else if($usertype=="admin")
  {
    unset($usertype);
  $result = mysqli_query($conn, "SELECT * FROM admin WHERE email = '$email'");
  $admin = mysqli_fetch_assoc($result);
    if(mysqli_num_rows($result) > 0){
    if($password == $admin['PASSWORD']){
     $_SESSION["login"] = true;
    $_SESSION["email"] = $admin["email"];
      header("Location: adminindex.php"); 
    }
    else{
      echo
      "<script> alert('Wrong Password'); </script>";
    }
  }
  else{
    echo
    "<script> alert('Admin Not Registered'); </script>";
  }
   
  }
  }
?>
<html lang="en">

<head> </head>
<title>Login Page</title>
<link rel="stylesheet" href="style.css">

<body class="background body01">

<div class="websitetitlecontainer">
<h1 class="websitetitle">&nbsp;Legendary&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Motorsport</h1>
  </div>


<div class="websitepanel">
  <div class="panelbox">Login page</div>
</div>
<br><br>

<!-- creates a form -->
    <form class="loginform" action="" method="post" autocomplete="off" name="myform2" " >
         <!-- creates the label Email -->
         <label for="email">Email : </label> 
       <!-- takes an input from user as text to use as an entered email -->
      <input type="text" name="email" class="LoginInputtextbox" id = "email" required> <br>
      
      <label for="password">Password : </label>
      <input type="password" class="LoginInputtextbox" name="password" id = "password" required> <br><br>
      
      <input type="radio" id="user" name="usertype" value="user" required>
  <label for="user">Sign in as an user</label><br>
  
  <input type="radio" id="admin" name="usertype" value="admin" required>
  <label for="admin">Sign in as an admin</label><br>
  
 
      <br>
      <button type="submit" class="LoginButtonuser" name="submit">Login</button>
      <br><br>

      <a href="signup.php">No account? Sign up here</a>
    </form>
  
    





</body>

<script type="text/javascript">






</script>
</html>

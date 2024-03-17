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
.signupform{
  width: 300px;
  height: 800px;
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

.selectFrom {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
</style>
<?php
require 'config.php';
$result = mysqli_query($conn, "SELECT `CITY` FROM office WHERE 1");
$counter=1;
while($row = mysqli_fetch_assoc($result))
{        
$cityOptions[$counter] = $row;
$counter=$counter+1;
}
$size=$counter;
if(!empty($_SESSION["id"])){
  header("Location: login.php");
}
if(isset($_POST["submit"])){
    $SSN=$_POST["SSN"];
  $FNAME=$_POST["FNAME"];
  $LNAME=$_POST["LNAME"];
 $email=$_POST["email"];
  $password=$_POST["password"];
  $confirmpassword=$_POST["confirmpassword"];
  $LICENSE_NO=$_POST["LICENSE_NO"];
   $PHONE_NO=$_POST["PHONE_NO"];
   $COUNTRTY=$_POST["COUNTRY"];
   $CITY=$_POST["CITY"];
   $ADDRESS=$_POST["ADDRESS"];



  $copy=mysqli_query($conn, "SELECT * FROM customer WHERE SSN = '$SSN' OR email = '$email'");
  if(mysqli_num_rows($copy) > 0){
    echo
    "<script> alert('SSN or Email Has Already Taken'); </script>";
  }
  else{
    if($password == $confirmpassword){
        $query = "INSERT INTO customer VALUES('$SSN','$FNAME','$LNAME','$email','$password','$LICENSE_NO','$PHONE_NO','$COUNTRTY','$CITY','$ADDRESS')";
      mysqli_query($conn, $query);
      echo
      "<script> alert('Registration Successful'); </script>";
      $_POST = array();
    }
    else{
      echo
      "<script> alert('Password Does Not Match'); </script>";
      $_POST = array();
    }
  }
}
   $_POST = array();



?>

<html lang="en">

<head> </head>
<title>Sign up page</title>
<link rel="stylesheet" href="style.css">

<body class="background body01">

<div class="websitetitlecontainer">
<h1 class="websitetitle">&nbsp;Legendary&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Motorsport</h1>
  </div>


<div class="websitepanel">
  <div class="panelbox">Sign up page</div>
</div>
<br><br>

<!-- creates a form -->
    <form class="signupform" name="signupform" action="" method="post" autocomplete="off" name="myform" onsubmit="return validate()" >
     
        <label for="SSN">SSN : </label>
      <input type="text" class="LoginInputtextbox" name="SSN" id = "SSN" required> <br>
        
      <label for="FNAME">First Name : </label>
      <input type="text" class="LoginInputtextbox" name="FNAME" id = "FNAME" required> <br>  
      
      <label for="LNAME">Last Name : </label>
      <input type="text" class="LoginInputtextbox" name="LNAME" id = "LNAME" required> <br>  
      
        <!-- creates the label Email -->
        <label for="email">Email : </label> 
       <!-- takes an input from user as text to use as an entered email -->
      <input type="text" name="email" class="LoginInputtextbox" id = "email" required> <br>
      
      <label for="password">Password : </label>
      <input type="password" class="LoginInputtextbox" name="password" id = "password" required> <br>
      
      <label for="confirmpassword">Confirm password : </label>
      <input type="password" class="LoginInputtextbox" name="confirmpassword" id = "confirmpassword" required> <br>
      
      <label for="LICENSE_NO">License Number : </label>
      <input type="text" class="LoginInputtextbox" name="LICENSE_NO" id = "LICENSE_NO" required> <br> 
      
      <label for="PHONE_NO">Phone Number : </label>
      <input type="text" class="LoginInputtextbox" name="PHONE_NO" id = "PHONE_NO" required> <br>
      
      <label for="COUNTRY">Country : </label>
      <input type="text" class="LoginInputtextbox" name="COUNTRY" id = "COUNTRY" required> <br>
      
      
      <label for="CITY">City : </label>
      <select id="CITY" class="selectFrom" name="CITY">
        <option value="not chosen">Choose a city where an office resides</option>
        <?php
       
        $counter=1;
        while($counter < $size){
            $item=$cityOptions[$counter]['CITY'];
            echo "<option value='$item'>$item</option>";
            $counter=$counter+1; 
        }
        ?>
      </select><br>
      
      
    
      
      <label for="ADDRESS">Address : </label>
      <input type="text" class="LoginInputtextbox" name="ADDRESS" id = "ADDRESS" required> <br>
      
      
      <br>
      <button type="submit" class="LoginButtonuser" name="submit">Sign up</button>
      <br><br>
      <a href="login.php">Already have an account? Log in here</a>
    </form>

  
    





</body>

<script type="text/javascript">
 function validate()
    {
    var checkSSN=document.forms["signupform"]["SSN"].value;
    if(checkSSN.length!==14)
    {
        alert("A SSN should be 14 numbers long");
        return false;
    }
      var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
var checkEmail=document.forms["signupform"]["email"].value;
  if (!(checkEmail.match(validRegex))) 
  { alert("Invalid email address!");
    return false;
  }
    var checkPhone=document.forms["signupform"]["PHONE_NO"].value;
     if(checkPhone.length!==11)
    {
        alert("A Phone number should be 11 numbers long");
        return false;
    }
   var checkCity=document.forms["signupform"]["CITY"].value;
    if(checkCity=="not chosen")
    {
        alert("A city must be chosen");
        return false;
    }
    
    
   
   

  }


    
    
    



</script>
</html>

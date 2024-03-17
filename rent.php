<style>
    /* unvisited link */
a:link {
  font-family: "Cambria" ;
  color : #966E5C;

}

/* visited link */
a:visited {
  font-family: "Cambria" ;
  color : #966E5C;
}

/* mouse over link */
a:hover {
  color : #94786c;
}

/* selected link */
a:active {
  color : #966E5C; 
}
.confirmrent{
  width: 500px;
  height: 500px;
  padding: 25px;
  background-color: #966E5C;
  font-size: 20px;
  color: black;
  font-family: "clarendon" ;
  text-align: left;
  margin: auto;
  border : 2px solid black;
}
.rentButtonuser{
  width: 30%;
  background-color: #4CAF50;
  text-align: center;
  color: white;
  padding: 10px 10px;
  margin-left: 175px;
  margin-right: 175px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}
.LoginButtonuser:hover {
  background-color: #45a049;
}
input[type="date"] { 
  background:green;
  color: white;
}

input[type="date"]::-webkit-calendar-picker-indicator {
  filter: invert(100%);
}
.textiguess {
  color: navy;
  text-indent: 30px;
}
</style>

<?php
require 'config.php';
if(!empty($_SESSION["SSN"]))
{
    $SSN=$_SESSION["SSN"];
    $result=mysqli_query($conn, "SELECT * FROM customer WHERE SSN = $SSN");
    $user=mysqli_fetch_assoc($result);
    $plateId=$_GET['plate'];
   
    $result=mysqli_query($conn, "SELECT * FROM car WHERE `PLATE` ='$plateId'");
    $car=mysqli_fetch_assoc($result);
     
     $RETURNED=0;
     $PICKEDUP=0;
     $PAID=0;
     $PRICE_DAY=$car['PRICE_DAY'];
     
     if(isset($_POST["submit"]))
     {
         $RETURNED_DATE=$_POST['RETURNED_DATE'];
         $RENTED_DATE=$_POST['RENTED_DATE'];
         
         
         $date1 = new DateTime("$RENTED_DATE");
        $date2 = new DateTime("$RETURNED_DATE");
        $interval = $date1->diff($date2);
        $days=$interval->days;
        $TOTAL_PRICE=$days * $PRICE_DAY;
        $date1 = $date1->format('Y-m-d');
         $date2 = $date2->format('Y-m-d');
        if($date2<=$date1)
        {
         echo  "<script> alert('Please make sure that the returned date is after the rent date'); </script>";
        }
        else 
        {
            $query = "INSERT INTO `rent` VALUES ('','$SSN','$plateId','$date1','$date2','$TOTAL_PRICE','$RETURNED','$PICKEDUP','$PAID')";
            mysqli_query($conn, $query);
             $query="UPDATE `car`SET `RESERVED`='1' WHERE `PLATE`='$plateId'";
             mysqli_query($conn, $query);
             echo  "<script> alert('Reservation  Successful'); </script>";
             header("Location: browse.php");
        }
         
        
        
        unset($_POST); 
     }
     
     
     
     
     
}
else
{
    header("Location: sessionless.php");
}
?>

<html lang="en">

<head>
<title>Profile</title>
<link rel="stylesheet" href="style.css">

<script type="text/javascript">






</script>
</head>

<body class="background body01">

<div class="websitetitlecontainer">
<h1 class="websitetitle">&nbsp;Legendary&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Motorsport</h1>
  </div>


<div class="websitepanel">
  <div class="panelbox"><a href="userindex.php">profile</a></div>
  <div class="panelbox"><a href="browse.php">Browse</a></div>
  <div class="panelbox"><a href="payment.php">Payment</a></div>
  <div class="panelbox"><a href="logout.php">Log out</a></div>
</div>
    
<br><br>
<form class="confirmrent" name="confirmrent" action="" method="post" autocomplete="off"  >
    
    <label for="PLATE">Plate : </label>
    <?Php  echo $car['PLATE']; ?> <br>
    
    <label for="PLATE">Motor id : </label>
    <?Php  echo $car['MOTOR_ID']; ?> <br>
    
    <label for="PLATE">Model : </label>
    <?Php  echo $car['MODEL']; ?> <br>
    
    <label for="PLATE">Year : </label>
    <?Php  echo $car['YEAR']; ?> <br>
    
    <label for="PLATE">Class : </label>
    <?Php  echo $car['CLASS']; ?> <br>
    
    <label for="PLATE">Brand : </label>
    <?Php  echo $car['BRAND']; ?> <br>
    
    <label for="PLATE">Color : </label>
    <?Php  echo $car['COLOR']; ?> <br>
    
    <label for="PLATE">Price per day : </label>
    <?Php  echo $car['PRICE_DAY']; ?> <br>
    
    
  <label for="RENTED_DATE">starting from:</label>
  <input type="date" id="RENTED_DATE" name="RENTED_DATE">
<br>
  <label for="RETURNED_DATE">ending in:</label>
  <input type="date" id="RETURNED_DATE" name="RETURNED_DATE">
    <br>    <br>
    
    
     
      <button type="submit" class="rentButtonuser" name="submit">Confirm</button>
      
</form>

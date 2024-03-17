<html lang="en">

<head>
<title>Welcome</title>
<link rel="stylesheet" href="style.css">

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

.paymentflexcontainer{
/*background-color: grey;*/
display: flex;
flex-direction: row;
/*border : 1px solid blue;*/
/*justify-content:space-around;*/
}


.paymentflexbox{
/*border : 1px solid green;*/
width: 50%;
height: 500px;
}

.paymentform{

  width: 300px;
  height: 300px;
  padding: 25px;
  background-color: #966E5C;
  font-size: 20px;
  color: black;
  font-family: "clarendon" ;
  text-align: center;
  margin: auto;
  border : 2px solid black;


}

.payment_summary{

  width: 90%;
  height: 300px;
  padding: 25px;
  background-color: #966E5C;
  font-size: 15px;
  color: black;
  font-family: "clarendon" ;
  text-align: center;
  margin: auto;
  border : 2px solid black;


}

.payment_summary_table{
  border: 2px solid black;
  border-collapse: collapse;
  color: black;
}

.confirm_payment_button {
  background-color: #04AA6D;
  border: none;
  color: white;
  padding: 16px 32px;
  text-decoration: none;
  margin: 4px 2px;
  cursor: pointer;
}


.final_price{

text-align: left;
font-size: 15px;
}

.postpaymentbox{

  width: 50%;
  height: 300px;
  padding: 25px;
  background-color: #966E5C;
  font-size: 15px;
  color: black;
  font-family: "clarendon" ;
  text-align: center;
  margin: auto;
  border : 2px solid black;

}


</style>

<script type="text/javascript">


</script>
</head>


<?php
require 'config.php';
if(!empty($_SESSION["SSN"]))
{
    $SSN=$_SESSION["SSN"];
    $result=mysqli_query($conn, "SELECT * FROM customer WHERE SSN = $SSN");
    $user=mysqli_fetch_assoc($result);
}
else{
  header("Location: sessionless.php");
}



 ?>



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


<div class="postpaymentbox">

<h3>Your transaction was successful</h3>

<?php
echo "Thank you for dealing with Legendary Motorsport.<br>";
echo "Your transaction number is " . $_SESSION["transaction_number"] . " .<br>";
echo "Please head to the office in your region to receive your car.<br>";
 ?>

</div>




</body>

</body>
</html>

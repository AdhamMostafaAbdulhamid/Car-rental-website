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

</style>










<?php
require 'config.php';
if(!empty($_SESSION["SSN"]))
{
    $SSN=$_SESSION["SSN"];
    $result=mysqli_query($conn, "SELECT * FROM customer WHERE SSN = $SSN");
    $user=mysqli_fetch_assoc($result);


    if (isset($_POST["payment_button"])){

      if(is_numeric($_POST["cvc_box"]) and is_numeric($_POST["card_number_box"])){




        $CARD_NO = $_POST["card_number_box"];
        $CVC     = $_POST["cvc_box"];



        $p_query = mysqli_query($conn, "SELECT R.RENT_ID,R.TOTAL_PRICE
        FROM CAR  AS C
        JOIN RENT AS R ON  C.PLATE = R.PLATE
        WHERE              R.SSN   = $SSN
                  AND      R.PAID  = 0");



        //loop on rent_id numbers and insert each one
        $p_total_price = 0.0;

        $first_time=1;
        $p_index;
        $entered = 0;
        while($row = mysqli_fetch_array($p_query)){
        $entered = 1;


        $RENT_ID    = $row['RENT_ID'];
        $TOTAL_PRICE= $row['TOTAL_PRICE'];
        $p_total_price = $p_total_price + $TOTAL_PRICE;


        if($first_time == 1){

          mysqli_query($conn,"INSERT INTO PAYMENT VALUES(NULL,'$RENT_ID',now(),'$TOTAL_PRICE','$CARD_NO','$CVC');" );
          $p_index = mysqli_insert_id($conn);
          $first_time=0;

        }
        else if ($first_time == 0){
          mysqli_query($conn,"INSERT INTO PAYMENT VALUES('$p_index','$RENT_ID',now(),'$TOTAL_PRICE','$CARD_NO','$CVC');" );

        }

      }


      if($entered ==1){

        //setting paid boolean to 1
        mysqli_query($conn,"UPDATE RENT
        SET RENT.PAID =1
        WHERE RENT.SSN = $SSN;" );



        $_SESSION['transaction_number'] = $p_index;
        $_POST["payment_button"]=0;

        header("Location: postpayment.php");



      }else {

        echo "<script> alert('No cars reserved. Payment will not be processed') </script>";

      }






      }
      else{

        echo "<script> alert('Please enter correct numeric values below') </script>";


      }


    }





}
else
{
    header("Location: sessionless.php");
}

?>









<html lang="en">

<head>
<title>Payment</title>
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




<div class="paymentflexcontainer">

  <div class="paymentflexbox">

    <h2 style="text-align:center;"><strong>Please enter your payment info</strong></h2>



    <form class="paymentform" name="register"  method="POST">



    <p>CARD NUMBER:</p>
    <input type="text" name="card_number_box">

    <p>CVC:</p>
    <input type="text" name="cvc_box">

    <br><br><input class="confirm_payment_button "name="payment_button" type="submit"  value="Confirm" style="text-align:center;">

    </form>


  </div>


<div class="paymentflexbox">

  <h3 style="font-size:22px;"> Details</h3>

<div class="payment_summary payment_summary_table" style="color:black;">
<?php
/*Query that get cars that are marked as rented by user but not paid for yet to display*/
$car_query = mysqli_query($conn, "SELECT C.BRAND, C.MODEL , C.YEAR , C.CLASS , C.COLOR, C.PLATE , C.PRICE_DAY , R.TOTAL_PRICE, DATEDIFF(R.RETURNED_DATE,R.RENTED_DATE) AS 'DAYS'
FROM CAR  AS C
JOIN RENT AS R ON  C.PLATE = R.PLATE
WHERE              R.SSN   = $SSN
          AND      R.PAID  = 0");

$car_arary = array();

echo "<table border='1' class='payment_summary_table'>
<tr>
<th>BRAND</th>
<th>MODEL</th>
<th>YEAR</th>
<th>CLASS</th>
<th>COLOR</th>
<th>PLATE</th>
<th>PRICE_DAY</th>
<th>#DAYS</th>
<th>TOTAL_PRICE</th>
</tr>";

$total_price = 0.0;
while($row = mysqli_fetch_array($car_query)){

  echo "<tr>";
  echo "<td>" . $row['BRAND'] . "</td>";
  echo "<td>" . $row['MODEL'] . "</td>";
  echo "<td>" . $row['YEAR'] . "</td>";
  echo "<td>" . $row['CLASS'] . "</td>";
  echo "<td>" . $row['COLOR'] . "</td>";
  echo "<td>" . $row['PLATE'] . "</td>";
  echo "<td>" . $row['PRICE_DAY'] . "</td>";
  echo "<td>" . $row['DAYS'] . "</td>";
  echo "<td>" . $row['TOTAL_PRICE'] . "</td>";
  echo "</tr>";

  $total_price = $total_price + $row['TOTAL_PRICE'] ;
  }
echo "</table>";
echo "<br>";
echo "<div class = 'final_price'>";
echo "Total price to pay is ".$total_price;
echo "</div>";

 ?>
</div>








</div>


</div>

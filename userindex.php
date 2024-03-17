```<style>
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
.profile_summary{
  
  width: 70%;
  height: 50%;
  padding: 25px;
  background-color: #966E5C;
  font-size: 15px;
  color: black;
  font-family: "clarendon" ;
  text-align: center;
  margin: auto;
  border : 2px solid black;


}
.profile_summary_table{
  border: 2px solid black;
  border-collapse: collapse;
  color: black;
  align-items: center;
  align-content: center;
}
</style>

<?php
require 'config.php';
if(!empty($_SESSION["SSN"]))
{
    $SSN=$_SESSION["SSN"];
    $result=mysqli_query($conn, "SELECT * FROM customer WHERE SSN = $SSN");
    $user=mysqli_fetch_assoc($result);
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
  <div class="panelbox"><a href="userindex.php">Profile</a></div>
  <div class="panelbox"><a href="browse.php">Browse</a></div>
  <div class="panelbox"><a href="payment.php">Payment</a></div>
  <div class="panelbox"><a href="logout.php">Log out</a></div>
</div>
<br><br>
<h3 style="font-size:22px;">Profile details :</h3>
<div class="profileflexcontainer">


<div class="profile_summary profile_summary_table" style="color:black;">
<?php
/*Query that get cars that are marked as rented by user*/

$car_query = mysqli_query($conn, "SELECT C.BRAND, C.MODEL , C.YEAR , C.CLASS , C.COLOR, C.PLATE , C.PRICE_DAY , 
R.TOTAL_PRICE, DATEDIFF(R.RETURNED_DATE,R.RENTED_DATE) AS 'DAYS',R.RENT_ID,R.PICKED_UP,R.RENTED_DATE,R.RETURNED_DATE
FROM CAR  AS C
JOIN RENT AS R ON  C.PLATE = R.PLATE
WHERE              R.SSN   = $SSN
          AND      R.PAID  = 1");

if (mysqli_num_rows($car_query) == 0) {
  echo"<p style ='text-align:center; font-size:30px;'> No rented cars! \n Try browsing for one. </p>"; 
}
else{
echo "<table border='1' class='profile_summary_table'>
<tr>
<th>BRAND</th>
<th>MODEL</th>
<th>YEAR</th>
<th>CLASS</th>
<th>COLOR</th>
<th>PLATE</th>
<th>PRICE PER DAY</th>
<th>#DAYS</th>
<th>TOTAL_PRICE</th>
<th>RENT_ID</th>
<th>PICKED_UP</th>
<th>RENTED_DATE</th>
<th>RETURN_DATE</th>
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
  echo "<td>" . $row['RENT_ID'] . "</td>";
  if($row['PICKED_UP']==0)
  echo "<td>" . "NO" . "</td>";
  else
  echo "<td>" . "YES" . "</td>";
  echo "<td>" . $row['RENTED_DATE'] . "</td>";
  echo "<td>" . $row['RETURNED_DATE'] . "</td>";

  echo "</tr>";

  $total_price = $total_price + $row['TOTAL_PRICE'] ;
  }
echo "</table>";
echo "<br>";
}

$car_arary = array();
?>
</div>
</div>
</body>
</html>```
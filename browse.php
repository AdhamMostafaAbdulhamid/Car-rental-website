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
.browseselect {
  width: 19.5%;
  color:white;
  background-color: #023020 ;
  padding: 10px 10px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
.browseform{
  width: 1600px;
  height: 80px;
  padding: 25px;
  background-color: #966E5C;
  font-size: 20px;
  color: black;
  font-family: "clarendon" ;
  text-align: left;
  margin: auto;
  border : 2px solid black;
}
.nocars{
  width: 500px;
  height: 200px;
  padding: 25px;
  background-color: #966E5C;
  font-size: 20px;
  color: black;
  font-family: "clarendon" ;
  text-align: left;
  margin: auto;
  border : 2px solid black;
}
.cars{
  float:left;
  width: 500px;
  height: 250px;
  padding: 25px;
  background-color: #966E5C;
  font-size: 20px;
  color: black;
  font-family: "clarendon" ;
  text-align: left;
  margin: auto;
  border : 2px solid black;
}
.browsebutton{
  width: 10%;
  background-color: #4CAF50;
  text-align: center;
  color: white;
  padding: 10px 10px;
  margin-left: 700px;
  margin-right: 700px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}
.LoginButtonuser:hover {
  background-color: #45a049;
}
.rentbutton{
  width: 20%;
  background-color: #4CAF50;
  text-align: center;
  color: white;
  padding: 10px 10px;
  margin-left: 200px;
  margin-right: 200px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}
.rentButtonuser:hover {
  background-color: #45a049;
}
.arent:link, .arent:visited{
  background-color: green;
  color: white;
  border: 2px solid green;
  padding: 5px 5px;
  text-align: left;
  text-decoration: none;
  display: inline-block;
  margin-left: 175px;
  margin-right: 175px;
}

.arent:hover, .arent:active {
  background-color:greenyellow;
  color: white;
}
.images {
      float:right;
  border: 1px solid #ddd;
  border-radius: 4px;
  padding: 5px;
  width: 150px;
}
</style>
<?php
require 'config.php';
$ARRAY=array();
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
$result = mysqli_query($conn, "SELECT DISTINCT `COLOR` FROM car WHERE 1");
$counter=1;
while($row = mysqli_fetch_assoc($result))
{        
$colorOptions[$counter] = $row;
$counter=$counter+1;
}
$colorsize=$counter;

$result = mysqli_query($conn, "SELECT DISTINCT `YEAR` FROM car WHERE 1");
$counter=1;
while($row = mysqli_fetch_assoc($result))
{        
$yearOptions[$counter] = $row;
$counter=$counter+1;
}
$yearsize=$counter;
sort($yearOptions);
$result = mysqli_query($conn, "SELECT DISTINCT `CLASS` FROM car WHERE 1");
$counter=1;
while($row = mysqli_fetch_assoc($result))
{        
$classOptions[$counter] = $row;
$counter=$counter+1;
}
$classsize=$counter;

$result = mysqli_query($conn, "SELECT DISTINCT `BRAND` FROM car WHERE 1");
$counter=1;
while($row = mysqli_fetch_assoc($result))
{        
$brandOptions[$counter] = $row;
$counter=$counter+1;
}
$brandsize=$counter;
if(isset($_POST["submit"])){
    $CITY= $user['CITY'];
     $display=array();
    $temp=array();
    $ARRAY=array();
    $result = mysqli_query($conn, "SELECT `OFFICE_ID` FROM `office` WHERE `CITY` = '$CITY'");
    $row = mysqli_fetch_assoc($result);
    $OFFICE_ID= $row['OFFICE_ID'];
    $result=mysqli_query($conn, "SELECT `PLATE` FROM `car` WHERE `OFFICE_ID`=$OFFICE_ID AND `STATUS`= 'active' AND `RESERVED`=0");
    
        $counter=0;
        while($row = mysqli_fetch_assoc($result))
        {        
        $display[$counter] = $row['PLATE'];
        $counter=$counter+1;
        }
   
    $BRAND=$_POST["BRAND"];
    $COLOR=$_POST["COLOR"];
    $CLASS=$_POST["CLASS"];
    $YEAR=$_POST["YEAR"];
    $PRICE=$_POST["PRICE"];
    
    if($BRAND=="not chosen")
    {  
        $result=mysqli_query($conn, "SELECT `PLATE` FROM `car` WHERE 1");
        $counter=0;
        while($row = mysqli_fetch_assoc($result))
        {        
        $temp[$counter] = $row['PLATE'];
        $counter=$counter+1;
        }
    }
    else
    {
        $result=mysqli_query($conn, "SELECT `PLATE` FROM `car` WHERE `BRAND`='$BRAND';");
        $counter=0;
        while($row = mysqli_fetch_assoc($result))
        {        
        $temp[$counter] = $row['PLATE'];
        $counter=$counter+1;
        } 
    }
  if(count($temp)==0)
    {
        $display=$temp;
    }  
  if(count($display)>0 and count($temp)>0)
  {
    $result = array_intersect($display, $temp);
    $display=$result;
  }
  $temp=array();
   
  
  
  if($COLOR=="not chosen")
    {  
        $result=mysqli_query($conn, "SELECT `PLATE` FROM `car` WHERE 1");
        $counter=0;
        while($row = mysqli_fetch_assoc($result))
        {        
        $temp[$counter] = $row['PLATE'];
        $counter=$counter+1;
        }
    }
    else
    {
        $result=mysqli_query($conn, "SELECT `PLATE` FROM `car` WHERE `COLOR`='$COLOR';");
        $counter=0;
        while($row = mysqli_fetch_assoc($result))
        {        
        $temp[$counter] = $row['PLATE'];
        $counter=$counter+1;
        } 
    }
   if(count($temp)==0)
    {
        $display=$temp;
    } 
  if(count($display)>0 and count($temp)>0)
  {
    $result = array_intersect($display, $temp);
    $display=$result;
  }
  $temp=array();
  
  if($CLASS=="not chosen")
    {  
        $result=mysqli_query($conn, "SELECT `PLATE` FROM `car` WHERE 1");
        $counter=0;
        while($row = mysqli_fetch_assoc($result))
        {        
        $temp[$counter] = $row['PLATE'];
        $counter=$counter+1;
        }
    }
    else
    {
        $result=mysqli_query($conn, "SELECT `PLATE` FROM `car` WHERE `CLASS`='$CLASS';");
        $counter=0;
        while($row = mysqli_fetch_assoc($result))
        {        
        $temp[$counter] = $row['PLATE'];
        $counter=$counter+1;
        } 
    }
    
    if(count($temp)==0)
    {
        $display=$temp;
    }
  if(count($display)>0 and count($temp)>0)
  {
    $result = array_intersect($display, $temp);
    $display=$result;
  }
  $temp=array();
  
  if($YEAR=="not chosen")
    {  
        $result=mysqli_query($conn, "SELECT `PLATE` FROM `car` WHERE 1");
        $counter=0;
        while($row = mysqli_fetch_assoc($result))
        {        
        $temp[$counter] = $row['PLATE'];
        $counter=$counter+1;
        }
    }
    else
    {
        $result=mysqli_query($conn, "SELECT `PLATE` FROM `car` WHERE `YEAR`='$YEAR';");
        $counter=0;
        while($row = mysqli_fetch_assoc($result))
        {        
        $temp[$counter] = $row['PLATE'];
        $counter=$counter+1;
        } 
    }
   if(count($temp)==0)
    {
        $display=$temp;
    } 
  if(count($display)>0 and count($temp)>0)
  {
    $result = array_intersect($display, $temp);
    $display=$result;
  }
  $temp=array();
  
  if($PRICE=="not chosen")
    {  
        $result=mysqli_query($conn, "SELECT `PLATE` FROM `car` WHERE 1");
        $counter=0;
        while($row = mysqli_fetch_assoc($result))
        {        
        $temp[$counter] = $row['PLATE'];
        $counter=$counter+1;
        }
    }
    else{ if($PRICE=="500+")
    {
        
        $result=mysqli_query($conn, "SELECT `plate` FROM `car` WHERE `PRICE_DAY`>499.9");
        $counter=0;
        while($row = mysqli_fetch_assoc($result))
        {        
        $temp[$counter] = $row['PLATE'];
        $counter=$counter+1;
        }
    }
 else
    {
     $token = strtok($PRICE, "-");
     $min=$token;
    
     $token =strtok("");
     $max=$token;
     $result=mysqli_query($conn, "SELECT `PLATE` FROM `car` WHERE `PRICE_DAY` BETWEEN '$min' AND '$max'");
        $counter=0;
        while($row = mysqli_fetch_assoc($result))
        {        
        $temp[$counter] = $row['PLATE'];
        $counter=$counter+1;
        }
    }}
    if(count($temp)==0)
    {
        $display=$temp;
    }
  if(count($display)>0 and count($temp)>0)
  {
    $result = array_intersect($display, $temp);
    $display=$result;
  }
  $temp=$display;
  $length=count($display);
  $display=array();
  $counter=0;
  $i=0;
  while($counter<$length)
  {
      if(@$temp[$i]!==NULL)
      {
          $display[$counter]=$temp[$i];
          $counter++;
      }
      $i++;
  }
  
  $ARRAY=$display;


}






?>
<html lang="en">
<head>
<title>Browse</title>
<link rel="stylesheet" href="style.css">

<script type="text/javascript">






</script>
</head> </head>

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

<form class="browseform" name="signupform" action="" method="post" autocomplete="off" name="myform" >
      <select id="BRAND" class="browseselect" name="BRAND">
        <option value="not chosen">Any Brand</option>
        <?php
        $counter=1;
        while($counter < $brandsize){
            $item=$brandOptions[$counter]['BRAND'];
            echo "<option value='$item'>$item</option>";
            $counter=$counter+1; 
        }
        ?>
      </select>
       
    <select id="COLOR" class="browseselect" name="COLOR">
        <option value="not chosen">Any Color</option>
        <?php
        $counter=1;
        while($counter < $colorsize){
            $item=$colorOptions[$counter]['COLOR'];
            echo "<option value='$item'>$item</option>";
            $counter=$counter+1; 
        }
        ?>
      </select>  

      <select id="CLASS" class="browseselect" name="CLASS">
        <option value="not chosen">Any Class</option>
        <?php
        $counter=1;
        while($counter < $classsize){
            $item=$classOptions[$counter]['CLASS'];
            echo "<option value='$item'>$item</option>";
            $counter=$counter+1; 
        }
        ?>
      </select> 
      
     
       <select id="YEAR" class="browseselect" name="YEAR">
        <option value="not chosen">Any year</option>
        <?php
        $counter=0;
        while($counter < $yearsize-1){
            $item=$yearOptions[$counter]['YEAR'];
            echo "<option value='$item'>$item</option>";
            $counter=$counter+1; 
        }
        ?>
        
      </select>
      <select id="PRICE" name="PRICE" class="browseselect">
      <option value="not chosen">Any price range</option>
      <option value="0-100">0-100 $</option>
      <option value="100-300">100-300 $</option>
      <option value="300-500">300-500 $</option>
      <option value="500+">500+ $</option>
    </select>
    <br>
      <button type="submit" class="browsebutton" name="submit">Search</button>
  </form>

     <?php
     
if(count($ARRAY)==0 AND isset($_POST["submit"])){?>

<form class="nocars" name="yes" action="" method="post" autocomplete="off" name="no" >
    <label for="no">No cars found </label><br>
     <label for="no">please Try another combination</label><br>
</form>
<?php }
else if(isset($_POST["submit"])){
    $i=0;
    $b=0;
    $initiali=0;
    while(@$ARRAY[$i]==NULL)
    {
        $i=$i+1;
        $initiali=$i;
        
    }
    $submit='submit';
    ?>
<?php $counter=count($ARRAY);
        while($counter>0){
            $submithere= $submit . $b?>
<form class="cars" name="signupform" action="" method="post" autocomplete="off" name=<?php $submithere ?> >
    <?php  $result=mysqli_query($conn," SELECT * FROM `car` WHERE `PLATE`='$ARRAY[$i]'");
                $car=mysqli_fetch_assoc($result);?>
    
    <img class="images" src="<?php echo $car['IMAGE']; ?>" alt=""">
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
    
    <br>
    <a class="arent" href="rent.php?plate=<?php echo $car['PLATE']?>">Rent this car</a>
      
</form>

 <?php  $counter=$counter-1;
 $i=$i+1;
 $b=$b+1;
}
 }
        
        
        
        
        ?>


</body>
</html>

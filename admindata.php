<style>
.browseselect {
  width: 100%;
  color:white;
  background-color: #023020 ;
  padding: 10px 10px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
.adminselect{
  width: 400px;
  height: 90px;
  padding: 10px;
  background-color: #966E5C;
  font-size: 20px;
  color: black;
  font-family: "clarendon" ;
  text-align: left;
  margin: auto;
  border : 2px solid black;
}
.selectgeneral{
  width: 600px;
  height: 200px;
  padding: 10px;
  background-color: #966E5C;
  font-size: 20px;
  color: black;
  font-family: "clarendon" ;
  text-align: left;
  margin: auto;
  border : 2px solid black;
}
.browsebutton{
  width: 100%;
  background-color: #4CAF50;
  text-align: center;
  color: white;
  padding: 10px 10px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}
input[type="date"] { 
  background:green;
  color: white;
}
.arent:link, .arent:visited{
  background-color: green;
  color: white;
  width:100%;
  border: 2px solid green;
  padding: 5px 5px;
  text-align: center;
  text-decoration: none;
  display: inline-block;

}

.arent:hover, .arent:active {
  background-color:greenyellow;
  color: white;
}
.cars{
  float:left;
  width: 500px;
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
</style>
<?php
      require 'config.php';
      $SELECTION=$_GET['data'];
      
      if(isset($_POST["submit"]))
     {
          if($SELECTION==1)
          {
         $RETURNED_DATE=$_POST['RETURNED_DATE'];
         $RENTED_DATE=$_POST['RENTED_DATE'];
         
         
         $date1 = new DateTime("$RENTED_DATE");
        $date2 = new DateTime("$RETURNED_DATE");
         $date1 = $date1->format('Y-m-d');
         $date2 = $date2->format('Y-m-d');
              $query= "SELECT `SSN`,`PLATE`,`MOTOR_ID`,`MODEL`,`YEAR`,`CLASS`,`BRAND`,`COLOR`,`STATUS`,`PRICE_DAY`,`FNAME`,`LNAME`,`LICENSE_NO`,`PHONE_NO`,`CITY` FROM `rent` NATURAL JOIN `car` NATURAL JOIN `customer`  WHERE `RENTED_DATE` between  '$date1' AND '$date2'";
              $result=mysqli_query($conn,$query);
              $counter=0;
            while($row = mysqli_fetch_assoc($result))
            {        
         $SSN[$counter] = $row['SSN'];
         $PLATE[$counter] = $row['PLATE'];
         $MOTOR_ID[$counter] = $row['MOTOR_ID'];
         $YEAR[$counter] = $row['YEAR'];
         $CLASS[$counter] = $row['CLASS'];
         $BRAND[$counter] = $row['BRAND'];
         $COLOR[$counter] = $row['COLOR'];
         $STATUS[$counter] = $row['STATUS'];
         $PRICE_DAY[$counter] = $row['PRICE_DAY'];
         $FNAME[$counter] = $row['FNAME'];
         $LNAME[$counter] = $row['LNAME'];
         $LICENSE_NO[$counter] = $row['LICENSE_NO'];
         $PHONE_NO[$counter] = $row['PHONE_NO'];
         $CITY[$counter] = $row['CITY'];
            $counter=$counter+1;
            }
            $size=$counter; 
          }
          if($SELECTION==2)
          {
              $RETURNED_DATE=$_POST['RETURNED_DATE'];
         $RENTED_DATE=$_POST['RENTED_DATE'];
         $PLATE_ID=$_POST['PLATE_ID'];
         
         
         $date1 = new DateTime("$RENTED_DATE");
        $date2 = new DateTime("$RETURNED_DATE");
         $date1 = $date1->format('Y-m-d');
         $date2 = $date2->format('Y-m-d');
            $query= "SELECT `RENT_ID` , `BRAND` , `MODEL` ,`YEAR`, `COLOR` ,`PLATE`, `RENTED_DATE`, `RETURNED_DATE`, `TOTAL_PRICE`, `RETURNED`, `PICKED_UP`, `PAID` FROM `rent` NATURAL JOIN `car` WHERE `PLATE` ='$PLATE_ID' AND `RENTED_DATE` BETWEEN '$date1' AND '$date2'";
              $result=mysqli_query($conn,$query);
              $counter=0;
            while($row = mysqli_fetch_assoc($result))
            {
           $PLATE[$counter] = $row['PLATE'];
        
         $YEAR[$counter] = $row['YEAR'];

         $BRAND[$counter] = $row['BRAND'];
         $COLOR[$counter] = $row['COLOR'];
        
         $RENTEDDATE[$counter] = $row['RENTED_DATE'];
         $RETURNEDDATE[$counter] = $row['RETURNED_DATE'];
         $PICKED_UP[$counter] = $row['PICKED_UP'];
         $PAID[$counter]=$row['PAID'];
         
         $counter=$counter+1;
            }
            $size=$counter;   
          }
     
      if($SELECTION==3)
          {
         $query= "SELECT `PLATE` ,  `STATUS` ,`RESERVED` FROM `car`  WHERE 1";
              $result=mysqli_query($conn,$query);
              $counter=0;
            while($row = mysqli_fetch_assoc($result))
            {
           $PLATE[$counter] = $row['PLATE'];
         $STATUS[$counter] = $row['STATUS'];
         $RESERVED[$counter] = $row['RESERVED'];

        
         
         $counter=$counter+1;
            }
            $size=$counter;   
          }
      if($SELECTION==4)
      {
          $SSNINQUESTION=$_POST['SSNINQUESTION'];
          $query="SELECT `SSN` , `FNAME` , `LNAME` ,`PLATE` FROM `rent` NATURAL JOIN `customer` WHERE `SSN` ='$SSNINQUESTION'";
               $result=mysqli_query($conn,$query);
              $counter=0;
            while($row = mysqli_fetch_assoc($result))
            {
           $SSN[$counter] = $row['SSN'];
         $FNAME[$counter] = $row['FNAME'];
         $LNAME[$counter] = $row['LNAME'];
         
          $PLATE[$counter] = $row['PLATE'];
        
        
         
         $counter=$counter+1;
            }
            $size=$counter;
          
     }
     
     
     
     
            }
      
      
      
      
      ?>
      
<html lang="en">

<head>
<title>Admin page</title>
<link rel="stylesheet" href="style.css">

<script type="text/javascript">






</script>
</head>

<body class="background body01">

<div class="websitetitlecontainer">
<h1 class="websitetitle">&nbsp;Legendary&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Motorsport</h1>
  </div>


<div class="websitepanel">
  <div class="panelbox"><a href="adminindex.php">Menu</a></div>
</div>
    <br>

    <?php if($SELECTION==1)
               {
               ?>    
    <form class="selectgeneral" name="signupform" action="" method="POST" autocomplete="off" name="myform" >
        <label for="PLATE">All reservations within a specified period : </label> 
        <br>
            <label for="RENTED_DATE">starting from:</label>
             <input type="date" id="FROM" name="RENTED_DATE">
            
            <label for="RETURNED_DATE">ending in:</label>
            <input type="date" id="TO" name="RETURNED_DATE">
               <br>  <br> <br> <br> <br> 
               <br>
      <button type="submit" class="browsebutton" name="submit">Search</button>          
</form>
    
    
     <?php
     if(@$size>0)
     {
         $counter=0;
       while($counter<$size)
       { ?>
     
    <form class="cars" name="signupform" action="" method="post" autocomplete="off" name=<?php $submithere ?> >
    <label for="PLATE">Plate : </label>
    <?Php  echo $PLATE[$counter] ?> <br>
    
    <label for="PLATE">Motor id : </label>
    <?Php  echo $MOTOR_ID[$counter]; ?> <br>
    
    <label for="PLATE">Year : </label>
    <?Php  echo $YEAR[$counter]; ?> <br>
    
    <label for="PLATE">Class : </label>
    <?Php  echo $CLASS[$counter]; ?> <br>
    
    <label for="PLATE">Brand : </label>
    <?Php  echo $BRAND[$counter]; ?> <br>
    
    <label for="PLATE">Color: </label>
    <?Php  echo $COLOR[$counter]; ?> <br>
    
    
    <label for="PLATE">Status : </label>
    <?Php  echo $STATUS[$counter]; ?> <br>
    
    <label for="PLATE">Price per day : </label>
    <?Php  echo $PRICE_DAY[$counter]; ?> <br>
    
    <label for="PLATE">SSN : </label>
    <?Php  echo $SSN[$counter]; ?> <br>
    
    <label for="PLATE">First name : </label>
    <?Php  echo $FNAME[$counter]; ?> <br>
    
    <label for="PLATE">Last name : </label>
    <?Php  echo $LNAME[$counter]; ?> <br>
    
    <label for="PLATE">Phone number : </label>
    <?Php  echo $PHONE_NO[$counter]; ?> <br>
    
    <label for="PLATE">License number : </label>
    <?Php  echo $LICENSE_NO[$counter]; ?> <br>
    
    <label for="PLATE">City : </label>
    <?Php  echo $CITY[$counter]; ?> <br>
    <br>    
</form>
           
           
      <?php
      $counter=$counter+1; }
     
        
     }
     
               }
               
               
               if($SELECTION==2)
               {
                 $result = mysqli_query($conn, "SELECT DISTINCT `PLATE` FROM car WHERE 1");
                $counter=0;
                while($row = mysqli_fetch_assoc($result))
                {        
                $plateOptions[$counter] = $row;
                $counter=$counter+1;
                }
                $platesize=$counter;   
                   
                   
               ?>
       <form class="selectgeneral" name="signupform" action="" method="post" autocomplete="off" name="myform" >
                  
                    <select id="PLATE_ID" class="browseselect" name="PLATE_ID">
                    <?php
                    $counter=0;
                    while($counter < $platesize){
                        $item=$plateOptions[$counter]['PLATE'];
                        echo "<option value='$item'>$item</option>";
                        $counter=$counter+1; 
                    }
        ?>
        
      </select>
                  
                  <br>
            <label for="RENTED_DATE">starting from:</label>
             <input type="date" id="RENTED_DATE" name="RENTED_DATE">
            
            <label for="RETURNED_DATE">ending in:</label>
            <input type="date" id="RETURNED_DATE" name="RETURNED_DATE">
               <br>  <br> <br> <br>  
               <button type="submit" class="browsebutton" name="submit">Search</button>  
            
</form>
    <?php
     if(@$size>0)
     {
         $counter=0;
       while($counter<$size)
       { ?>
     
    <form class="cars" name="signupform" action="" method="post" autocomplete="off" name=<?php $submithere ?> >
    <label for="PLATE">Plate : </label>
    <?Php  echo $PLATE[$counter] ?> <br>
    
   
    
    <label for="PLATE">Year : </label>
    <?Php  echo $YEAR[$counter]; ?> <br>
    
  
    <label for="PLATE">Brand : </label>
    <?Php  echo $BRAND[$counter]; ?> <br>
    
    <label for="PLATE">Color: </label>
    <?Php  echo $COLOR[$counter]; ?> <br>


    <label for="PLATE">Rented date : </label>
    <?Php  echo $RENTEDDATE[$counter]; ?> <br>
    
    <label for="PLATE">Day to return: </label>
    <?Php  echo $RETURNEDDATE[$counter]; ?> <br>
    
      <label for="PLATE">Paid: </label>
    <?Php  echo $PAID[$counter]; ?> <br>
    
     <label for="PLATE">Picked up: </label>
    <?Php  echo $PICKED_UP[$counter]; ?> <br>
</form>
   
      <?php
      $counter=$counter+1; }
     
        
     }
    
    
               }
               if($SELECTION==3)
               {?>
               
                  <form class="selectgeneral" name="signupform" action="" method="post" autocomplete="off" name="myform" >   
            <label for="RENTED_DATE">Day:</label>
             <input type="date" id="RENTED_DATE" name="RENTED_DATE">
            
           
               <br>  <br> <br> <br> <br> <br> <br> 
               <button type="submit" class="browsebutton" name="submit">Search</button>  
            
                </form>

        <?php
     if(@$size>0)
     {
         $counter=0;
       while($counter<$size)
       { ?>
     
    <form class="cars" name="signupform" action="" method="post" autocomplete="off" name=<?php $submithere ?> >
    <label for="PLATE">Plate : </label>
    <?Php  echo $PLATE[$counter] ?> <br>
    
   
    
    <label for="PLATE">Status : </label>
    <?Php  echo $STATUS[$counter]; ?> <br>
    
  
    <label for="PLATE">Reserved : </label>
    <?Php  echo $RESERVED[$counter]; ?> <br>
    



</form>
   
      <?php
      $counter=$counter+1; }
    
    
               }
               
               
               
               
       } if($SELECTION==4)
               {  
                   $result = mysqli_query($conn, "SELECT DISTINCT `SSN` FROM customer WHERE 1");
                $counter=0;
                while($row = mysqli_fetch_assoc($result))
                {        
                $plateOptions[$counter] = $row;
                $counter=$counter+1;
                }
                $platesize=$counter;   
                   
                   
                   ?> 
                     <form class="selectgeneral" name="signupform" action="" method="post" autocomplete="off" name="myform" >
                  
                    <select id="SSNINQUESTION" class="browseselect" name="SSNINQUESTION">
                    <?php
                    $counter=0;
                    while($counter < $platesize){
                        $item=$plateOptions[$counter]['SSN'];
                        echo "<option value='$item'>$item</option>";
                        $counter=$counter+1; 
                    }
                    
        ?>  </select>
       
    
                         <button type="submit" class="browsebutton" name="submit">Search</button>
                          </form>
<?php 









       if(@$size>0)
     {
         $counter=0;
       while($counter<$size)
            { ?>
     
    <form class="cars" name="signupform" action="" method="post" autocomplete="off" name=<?php $submithere ?> >
    
      
    
     <label for="PLATE">SSN : </label>
    <?Php  echo $SSN[$counter]; ?> <br>
    
    <label for="PLATE">First name : </label>
    <?Php  echo $FNAME[$counter]; ?> <br>
    
    <label for="PLATE">Last name : </label>
    <?Php  echo $LNAME[$counter]; ?> <br>
    
 <label for="PLATE">Plate : </label>
    <?Php  echo $PLATE[$counter] ?> <br>
    
     


</form>
   
      <?php
      $counter=$counter+1; 
           
       }   
       
       
       
               }}
               if($SELECTION==5)
               {
                  ?>
    <form class="selectgeneral" name="signupform" action="" method="POST" autocomplete="off" name="myform" >
        <label for="PLATE">All payments within a period : </label> 
        <br>
            <label for="RENTED_DATE">starting from:</label>
             <input type="date" id="FROM" name="RENTED_DATE">
            
            <label for="RETURNED_DATE">ending in:</label>
            <input type="date" id="TO" name="RETURNED_DATE">
               <br>  <br> <br> <br> <br> 
               <br>
      <button type="submit" class="browsebutton" name="submit">Search</button>          
</form>
                   
    
    
    
                   
                   
                   
             <?php 
             
                              
                 if($SELECTION==5 and isset($_POST["submit"]))
     {
$date_1=$_POST["RENTED_DATE"];
$date_2=$_POST["RETURNED_DATE"];
$current_date = $date_1;
//$conn =mysqli_connect("localhost", "root","" ,"carrentalsystem");

echo "<table border='1'>
<tr>
<th>DAY</th>
<th>TOTAL PAYMENTS</th>
</tr>";


while (strtotime($current_date) <= strtotime($date_2)) {
              $query_dt=mysqli_query($conn,"SELECT DATE(P.PAYMENT_DATE) as 'DATE', SUM(P.PRICE) as 'SUM'
                          FROM PAYMENT  AS P
                          WHERE DATE(P.PAYMENT_DATE) = '$current_date'");
              
              $row =  mysqli_fetch_assoc($query_dt);

    
              if (mysqli_num_rows($query_dt)==0)
              {
                echo "</tr>";
              echo "<td>" . "$current_date" . "</td>";
              echo "<td>" . "0" . "</td>";
              echo "</tr>";
              }
              else
              {
              echo "</tr>";
              echo "<td>" . $row['DATE'] . "</td>";
              echo "<td>" . $row['SUM'] . "</td>";
              echo "</tr>";
              }

              $current_date = date ("Y-m-d", strtotime("+1 day", strtotime($current_date)));
            }
echo "</table>";
     }
             
             
             
             
               } 
               
               
               
                  if($SELECTION==6){
  

                    ?>
                    <form class="paymentform" name="register" style="height:80px;"  method="POST">
                    <input type='text' name='platebox1'>
                    <input class='confirm_payment_button 'name='return_button' type='submit'  value='Return' style='text-align:center;'>
                  </form>
                  <form class="paymentform" name="register2" style="height:80px;"  method="POST"> 
                  <input type='text' name='platebox2'>
                  <input class='confirm_payment_button 'name='pickup_button' type='submit'  value='Pick up' style='text-align:center;'>
                  </form>
                    <?php
                 
                 //enters
                 if (isset($_POST['return_button']))
                 {
               
                     
                     @$PLATE = $_POST['platebox1'];
                     //echo "<script> alert('here')</script>";
                   mysqli_query($conn,"UPDATE RENT
                                        SET RENT.RETURNED =1
                                        WHERE RENT.PLATE = '$PLATE'
                                        And RENT.PICKED_UP=1;" );

                   mysqli_query($conn,"UPDATE CAR
                    SET CAR.RESERVED = 0
                    WHERE CAR.PLATE = '$PLATE'" );










                 }
                 if (isset($_POST['pickup_button']))
                 {
                 
                $PLATE = $_POST['platebox2'];
             
                    mysqli_query($conn,"UPDATE RENT
                    SET RENT.PICKED_UP =1
                    WHERE RENT.PLATE = '$PLATE'" );


                 }





               }
               
               ?>


</body>

</body>
</html>

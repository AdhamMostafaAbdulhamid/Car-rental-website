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
</style>
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
  <div class="panelbox">Admin page</div>
</div>
    <br>
<form class="adminselect" name="signupform" action="" method="post" autocomplete="off" name="myform" >

    <select id="SELECTION" name="SELECTION" class="browseselect">
      <option value="1">All reservations within a specified period</option>
      <option value="2">All reservations of any car within a specified period</option>
      <option value="3">The status of all cars on a specific day</option>
      <option value="4">All reservations of specific customer</option>
      <option value="5">Daily payments within specific</option>
      <option value="6">Process picking up and returning</option>
    </select>
<br>
        
 <button type="submit" class="browsebutton" name="submit">select</button>
</form>
    <br> <br> 
    
      <?php
      require 'config.php';
      
      if(isset($_POST["submit"]))
            {
          $SELECTION=$_POST["SELECTION"];
               if($SELECTION==1)
               {
              header("Location: admindata.php?data=1"); 
               }
               if($SELECTION==2)
               {
              header("Location: admindata.php?data=2"); 
               }
               if($SELECTION==3)
               {
              header("Location: admindata.php?data=3"); 
               }
               if($SELECTION==4)
               {
              header("Location: admindata.php?data=4"); 
               }
               if($SELECTION==5)
               {
              header("Location: admindata.php?data=5"); 
               }
              if($SELECTION==6)
               {
              header("Location: admindata.php?data=6"); 
               }
               }
                
      
      ?>





</body>

</body>
</html>


<!DOCTYPE html>
<html>
<head>
<style>
    
#customers {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}
</style>
</head>
<body>
<h2>
<?php

   session_start();
   $username =  $_SESSION['user'];
   echo "welcom our fantastic dr.". $username ;


?>
</h2>
<form action="" method="POST">
       
        <label id="icon" for="name"><i class="fas fa-user"></i></label>
        <input type="text" name="email" id="name" placeholder="enter the email of patient" required/>
        
        <div class="btn-block">
          <button name="seerch">Search</button>
        </div>
      </form>


      <?php

        
         

    $connect = mysqli_connect('localhost','root','','clinic');
    // take data from database
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        $name = mysqli_query($connect, "select name from patients where email = '". $email ."' ");
        $examReport = mysqli_query($connect, "select report from examination where email = '". $email ."' ");
        $medicReport = mysqli_query($connect, "select report from medication where email = '". $email ."' ");
    }

?>


<table id="customers">
  <tr>
    <th>name</th>
    <th>examination report</th>
    <th>medication report </th>
  </tr>
  
  <tr>
    <td>
               
    <?php 
         if (isset($_POST['email'])) {
            echo mysqli_fetch_array($name)[0];
             
         }

    ?> 
</td>
    <td>
    <?php 
         if (isset($_POST['email'])) {
            echo mysqli_fetch_array($examReport)[0];
             
         }

    ?> 

    </td>
    <td>
           
    <?php 
         if (isset($_POST['email'])) {
            echo mysqli_fetch_array($medicReport)[0];
             
         }

    ?> 

    </td>
  </tr>
</table>

</body>
</html>

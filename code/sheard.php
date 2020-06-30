<?php

function showSheard()
{
    $c = new mysqli('localhost', 'root', '', 'clinic');

    $r = mysqli_query($c, "select email from shear ");
     
    while ($row = mysqli_fetch_array($r)[0]) {
        echo "<tr>";
        echo "<td>" . $row ."</td>" ;
        echo "</tr>";
    }
}

function add($email)
{ 
  session_start();
  $docemail =  $_SESSION['email']; 

    $c = new mysqli('localhost', 'root', '', 'clinic');

    $stmt = $c->prepare("insert into doctor_patient (email_doctor,email) values(?,?)");
    $stmt->bind_param('ss', $docemail , $email  );
    $stmt->execute();

}

    ?>






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


<!DOCTYPE html>
<html>
<body>

<p>enter email to add to your patients and see more info .</p>

<?php
       if(isset($_POST['add']))
          {
              add($_POST['email']);
          }
?>

<p>  only email availible here , if you take the patient you should know his email .</p>

<form method="post" >
  <label  >email of patient</label>
  <input type="text" name="email"><br><br>
  <input type="submit" name="add"
                value="add"/>
</form>








<table id="customers">
  <tr>
    <th>name</th>
    
  </tr>
  
  <tr>
    
    <td>
           
    <?php 
         {
            showSheard();
             
         }

    ?> 

    </td>
  </tr>
</table>

</body>
</html>
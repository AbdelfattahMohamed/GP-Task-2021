<?php

    session_start();
   $email =  $_SESSION['email']; 


function showpatient($email)
{
    $c = new mysqli('localhost', 'root', '', 'clinic');

    $r = mysqli_query($c, "select email from doctor_patient where email_doctor = '". $email ."' ");
     
    while ($row = mysqli_fetch_array($r)) {
        $nam = mysqli_query($c, "select name from patients where email = '". $row['email'] ."' ");
        $name = mysqli_fetch_array($nam)[0];


        $emai = mysqli_query($c, "select email from patients where email = '". $row['email'] ."' ");
        $ema = mysqli_fetch_array($emai)[0];



        $gmc = mysqli_query($c, "select GMC_Case_details from examination where email = '". $row['email'] ."' ");
        $gm = mysqli_fetch_array($gmc)[0];


        $fitn = mysqli_query($c, "select Opinion_on_fitness_to_practise from examination where email = '". $row['email'] ."' ");
        $fit = mysqli_fetch_array($fitn)[0];


        $note = mysqli_query($c, "select Notes from examination where email = '". $row['email'] ."' ");
        $not = mysqli_fetch_array($note)[0];


        $exa = mysqli_query($c, "select report from examination where email = '". $row['email'] ."' ");
        $exam = mysqli_fetch_array($exa)[0];
        

        $med = mysqli_query($c, "select medication_report from examination where email = '". $row['email'] ."' ");
        $medic = mysqli_fetch_array($med)[0];
        echo "<tr>";
        echo "<td>" . $name ."</td>" ;
        echo "<td>" . $ema ."</td>" ;
        echo "<td>" . $exam ."</td>" ;
        echo "<td>" . $medic ."</td>" ;
        echo "<td>" . $gm ."</td>" ;
        echo "<td>" . $fit ."</td>" ;
        echo "<td>" . $not ."</td>" ;
        echo "</tr>";
    
    }

    
}

function shear($email)
    { 
        $c = new mysqli('localhost', 'root', '', 'clinic');

        $stmt = $c->prepare("insert into shear(email) values(?)");
        $stmt->bind_param('s', $email);
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

<p>enter email to shear patient info with others .</p>

<?php
       if(isset($_POST['shear']))
          {
              shear($_POST['email']);
          }
?>



<form method="post" >
  <label  >email of patient</label>
  <input type="text" name="email"><br><br>
  <input type="submit" name="shear"
                value="shear"/>
</form>








<table id="customers">
  <tr>
    <th>name</th>
    <th>email of patient</th>
    <th>examination report</th>
    <th>medication report </th>
    <th>	GMC Case details </th>
    <th>Opinion on fitness to practise</th>
    <th>	Notes</th>

    
  </tr>
  
  <tr>
    
    <td>
           
    <?php 
         {
            showpatient($email);
             
         }

    ?> 

    </td>
  </tr>
</table>

</body>
</html>
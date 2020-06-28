<?php

   $c = mysqli_connect('localhost','root','','clinic');
   
   if(isset($_POST['username']))
   {
      $name =$_POST['username'];
      $pass  = $_POST['pass'];
      $sql = "select * from users where email = '".$name."'AND password = '".$pass."' limit 1  ";
      $sqlrole = "select * from users where email = '".$name."'AND password = '".$pass."' AND role = '". 1 ."' limit 1  ";
      $result = mysqli_query($c,$sql);
      $resultrole = mysqli_query($c,$sqlrole);
   

     
      if (mysqli_num_rows($result) == 1 )
      {
         
              
         if (mysqli_num_rows($resultrole) == 1){
           header("Location:\GP-Task-2021/pages/doctor.html");
           exit;
         }
         else {
            header("Location:\GP-Task-2021/pages/pharmacist.html");
            exit;
         }
         
      }

      else {
          print(" fault in email or password ");
      }
      
      
     
   }

?>
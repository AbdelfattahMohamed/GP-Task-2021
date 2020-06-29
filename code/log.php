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

      // session 
         session_start();
         $nameuser = mysqli_query($c, "select name from doctors where email = '". $name ."' ");
        
         $_SESSION['user'] =  mysqli_fetch_array($nameuser)[0];
      
   

     
      if (mysqli_num_rows($result) == 1 )
      {
         
              
         if (mysqli_num_rows($resultrole) == 1){
           header("Location:doctor.php");
           exit;
         }
         else {
            header("Location:pharmacist.php");
            exit;
         }
         
      }

      else {
          print(" fault in email or password "); 
      }
      
      
     
   }

?>


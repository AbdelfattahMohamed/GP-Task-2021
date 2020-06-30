<?php

  // $conn = mysqli_connect('localhost','root','','clinic');
  
   $email = $_POST['email'];
   $name = $_POST['name'];
   $pass = $_POST['password'];
   $national_id = $_POST['id'];
   $phone = $_POST['phone'];
   $kind = $_POST['account'];

   // Database connection
	$conn = new mysqli('localhost','root','','clinic');
	  if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
   } 
   else {
      // registraion
		$stmt = $conn->prepare("insert into doctors(email,name, password , national_id, phone , kind) values(?, ?, ?, ?, ?, ?)");
      $stmt->bind_param('sssiis', $email, $name, $pass, $national_id, $phone, $kind);
      // to add to users table 
      $user = $conn->prepare("insert into users(email,password ,role) values(?, ?, ?)");
      $user->bind_param('sss', $email, $pass, $kind);
     // $stmt->bind_param("s", $email);
     // $stmt->bind_param("s", $name);
     // $stmt->bind_param("s", $pass);
    //  $stmt->bind_param("i", $national_id);
     // $stmt->bind_param("i", $phone);
    //  $stmt->bind_param("s", $kind);
		$registration = $stmt->execute();
      $users = $user->execute();
      
      if ($registration == 1 && $users == 1)
      {
         header("Location: \GP-Task-2021/pages/regisrtrationSucs.html");
           exit;
      }

		$stmt->close();
		$conn->close();
	}



   ?>
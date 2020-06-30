<?php

    function doctoremail()
    {
        session_start();
        return $docEmail = $_SESSION['email'];

    }
  // $conn = mysqli_connect('localhost','root','','clinic');
   function addpatient($docEmail)
   {
       $email = $_POST['email'];
       $name = $_POST['name'];
       $age = $_POST['age'];

       $phone = $_POST['phone'];
       $gender = $_POST['account'];

       // Database connection
       $conn = new mysqli('localhost', 'root', '', 'clinic');
       if ($conn->connect_error) {
           echo "$conn->connect_error";
           die("Connection Failed : ". $conn->connect_error);
       } else {
           // registraion
           $stmt = $conn->prepare("insert into patients(email,name, age , phone , gender) values(?, ?, ?, ?, ?)");
           $stmt->bind_param('sssis', $email, $name, $age, $phone, $gender);
           // to add to users table
           $user = $conn->prepare("insert into doctor_patient (email_doctor,email) values(?, ?)");
           $user->bind_param('ss', $docEmail, $email);

           $registration = $stmt->execute();
           $users = $user->execute();
      
           if ($registration == 1 && $users == 1) {
               header("Location: \GP-Task-2021/examinationform.html");
               exit;
           }
           else 
           {
               print("error , ensure that you added a new patient ");
           }

           $stmt->close();
           $conn->close();
       }
   }
  
               addpatient(doctoremail());
   ?>
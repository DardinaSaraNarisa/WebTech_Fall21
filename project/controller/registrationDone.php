
<?php
session_start();
?>



<?php


     require_once '../model/model.php';


     $data['Name']                     =     $_SESSION['name'];
     $data['Email']                    =     $_SESSION['email']; 
     $data['Gender']                   =     $_SESSION['gender'];
     $data['Dob']                      =     $_SESSION['dob'];  
     $data['User Name']                =     $_SESSION['username'];  
     $data['Password']                 =     $_SESSION['pass'];

     $data['image']                    = $_SESSION['image'];


    if (addUsers($data)) {
          header('location:../view/registrationSuccess.php');
        //echo 'Successfully added!!';
    } else {
        echo 'You are not allowed to access this page.';    
    }
               
?>


<?php
session_start();

if(isset($_SESSION['username'])){


}
else{

    header('location: login.php');
}

?>



<?php  
    require_once '../controller/readData.php';
    $user = fetchUsers($_SESSION['username']);

?>



<!DOCTYPE html>
<html>
<style>
.error {color: #394393;}
.error2 {color: #FF0000;}


</style>
<head>
    <title>Profile</title>
</head>

 <?php include('header2.php')?>



 <?php

    // define variables and set to empty values
    $nameErr = $emailErr = $genderErr = $usernameErr = "";

    $name = $email = $username = "";

    $check=0;


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //name validation//name validation//name validation
          if (empty($_POST["name"])) {
            $nameErr = "Name is required";
          } 
          else {
            $name = test_input($_POST["name"]);
            //validating alphabet
            if (!preg_match("/^[a-zA-Z][a-zA-Z.\_\-]+ +[a-zA-Z.\-\_]+/",$name)) {
              $nameErr = "Only Can contain a-z, A-Z, period(.) , dash only(-) and at least two words";
            }
            else
              $check++;
              //!preg_match("/^[a-zA-Z-'{2,8} ]*$/",$name  
          }




        //email validation//email validation//email validation
        
          if (empty($_POST["email"])) {
            $emailErr = "Email is required";
          } 
          else {
            $email = test_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
              $emailErr = "Must be a valid email_address : anything@example.Com";
            }
            else
              $check++;
          }
          




          //username username   
          if (empty($_POST["username"])) {
            $usernameErr = "username is required";
          } 
          else 
          {
              $username = test_input($_POST["username"]);
              //validating alphabet
              if (!preg_match("/^[0-9a-zA-Z-_]{2,}[^\s.]$/",$username)) {
                $usernameErr = "User Name must contain at least two (2) characters and can contain alpha numeric characters, period, dash or underscore only";
              }
              else
                $check++;
          }


    }


    if($check==3){

        
          $_SESSION['name1']=$_REQUEST['name'];
          $_SESSION['email1']=$_REQUEST['email'];



          header('location:../controller/editProfileDone.php');


    }
    
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }



 
?>


<body>

    <center>
    <fieldset align="center">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <br><br><h1 align = 'center' style='color: #5D006F;' >Edit Profile Information<br><br></h1>
            <h2 class="error" align = "center">Profile Name : <input type='text' name='name' value="<?php echo $user["Name"] ?>" id="name" onkeyup="nameVal()"></h2>
            <span class="error2" id="nameErr">* <?php echo $nameErr;?></span>
            <h2 class="error" align = "center">Email Address :<input type='text' name='email' value="<?php echo $user["Email"]?>" id="email" onkeyup="emailVal()" ></h2>
            <span class="error2" id="emailErr">* <?php echo $emailErr;?></span>
            <h2 class="error" align = "center">User Name : <input type='text' name='username' value="<?php echo $user["User_Name"] ?>" readonly></h2>
            <h2 class="error" align = "center">Date of Birth : <?php echo $user["Dob"];?></h2>
            <h2 class="error" align = "center">Gender : <?php echo $user["Gender"];?></h2>
            <h2 class="error" align ="center"><input type='submit' value='Update'></h2>
        </form>
    </fieldset>
   </center>
</body>

<script type="text/javascript" src="../javascript/regiPage.js"></script>



<?php include('footer.php')?> 


  </html>
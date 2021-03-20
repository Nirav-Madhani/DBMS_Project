<?php

require 'login_professional.html';
$mysqli = new mysqli("localhost","root");

if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}

$mysqli -> select_db("test");


//Password 4m|+16Pd


https://localhost/project/login_prof.php?b_name=Business&ad1=&ad2=&city=Ahmedabad&pcode=380058&pno=1234567890&mail=niravmadhani3%40gmail.com&pwd=4m%7C%2B16Pd&desc=Description
if(isset($_POST['b_name']))
{
  //echo 'IS set';
  $email = $_POST['mail'];
  $pass = md5($_POST['pwd']);
  $phno = $_POST['pno'];
  //$ad1 = $_POST['ad1'];
  //$ad2 = $_POST['ad2'];
  $name = $_POST['b_name'];
  $city = $_POST['city'];
  $pco = $_POST['pcode'];
  $desc = $_POST['desc'];
  $rs1 = $mysqli -> query("Select * from user where email = '$email' ");
 if( mysqli_num_rows($rs1) >0 )
 {
   echo "<script>alert('Email already exists')</script>";
 }
 else{
  $result = $mysqli -> query("INSERT INTO user  VALUES (NULL, '$email', '$pass', '$phno') ");
  //echo "INSERT INTO 'user' ('UID', 'email', 'password', 'phno') VALUES (NULL, '$email', '$pass', '$phno'); ";
        $result = $mysqli -> query("SELECT UID , email FROM user WHERE email = '$email' and password = '$pass';") ;
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user']=$row['UID'];
       
        $k =  "INSERT INTO professional values ('{$row['UID']}', 5 ,'$name','Economy' , '$desc' , 0 , '$city', '$pco' ) ";
        echo $k;
      $res =  $mysqli -> query($k) ;
     //   echo "Query Successful";
  //echo $result;
  }
  
}



if(isset($_POST['email']))

        {
                check();
        }

function check(){
    $mysqli = new mysqli("localhost","root");
    $email= $_POST['email'];
    $pass = md5($_POST['passwd']);


    if ($mysqli -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
    }
    $mysqli -> select_db("test");
    
    if($result = $mysqli -> query("SELECT UID , email FROM user WHERE email = '$email' and password = '$pass';") )
        {
            $row = mysqli_fetch_assoc($result);
            if (mysqli_num_rows($result)==1){
                
                $_SESSION['user']=$row['UID'];
                //echo 'Welcome '.$row['email'].'. How do you do.';
                echo "<script>alert('Correct Password {$row['UID']}')</script>";
                header("Location: index.php");
                exit;
            }
            else{
                echo "<script>alert('InCorrect  Username or Password');</script>";
            }
        }

} 

?>
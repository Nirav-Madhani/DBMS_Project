

<?php

require 'login.html';
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
    echo "<script>alert('Correct Password')</script>";
    if($result = $mysqli -> query("SELECT UID , email FROM user WHERE email = '$email' and passwword = '$pass';") )
        {
            echo "<script>alert('Correct Password')</script>";
            $row = mysqli_fetch_assoc($result);
            if (mysqli_num_rows($result)==1){
                
                $_SESSION['user']=$row['UID'];
                //echo 'Welcome '.$row['email'].'. How do you do.';
                echo "<script>alert('Correct Password')</script>";
            }
            else{
                echo "<script>alert('INCorrect Password');</script>";
            }
        }

} 

?>

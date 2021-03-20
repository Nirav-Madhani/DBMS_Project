<?php
session_start();
function logout(){
    echo 'Logged out';
    //session_destroy();
}
echo $_SESSION['user'];
if(isset($_SESSION['user']))
{
echo ' <button type="button" onclick="">Log Out!</button> '  ;

}
else
{
        if(isset($_POST['username']))
        {
                check();
        }
        else
        {
        ?>
            <form method='POST'>
            <input type="text" name="username"><br>
            <input type="password" name="password">
            <input type="submit" value="Login">
            </form>
        <?php


        }                               
}
        // echo md5('1234567890');
function check(){
    $mysqli = new mysqli("localhost","root");
    
    if ($mysqli -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
    }
    $mysqli -> select_db("test");
    
    if($result = $mysqli -> query('SELECT UID , email FROM user WHERE email = "'.$_POST['username'].'" AND password ="'.md5($_POST['password']).'";') )
        {
            $row = mysqli_fetch_assoc($result);
            if (mysqli_num_rows($result)==1){
                
                $_SESSION['user']=$row['UID'];
                echo 'Welcome '.$row['email'].'. How do you do.';
               // echo 'Correct Password!';
               //echo '<script> location.reload(); </script>';

              
            }
            else{
                echo 'Incorrect Password';
            }
        }

} 
?>

<title>Login</title>

<script>
function logout(){
 alert("<?PHP logout(); ?>");
 location.reload();     
 }
</script>
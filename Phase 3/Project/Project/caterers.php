<?php


//require 'connect.php';
$mysqli = new mysqli("localhost","root");

if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  die();
}
require 'caterers.html';
$mysqli -> select_db("test");

//echo file_get_contents( "divs.html" ); 

if(isset($_POST['city']))
{
    foreach ($_POST as $key=>$value)
    {
        #echo $key. $value.'<br>';
    }
   // echo "SELECT * FROM hall JOIN professional ON hall.PID=professional.UID WHERE professional.city LIKE '%".$_POST['city']."%'";
   
   //queryRows("SELECT * FROM caterer  JOIN professional ON caterer.PID = professional.UID WHERE P1unit bewtween ". $_POST['price1'].'AND'." AND professional.city LIKE '%".$_POST['city']."%'",$mysqli);
   $city = $_POST['city'];
   $p1 = $_POST['price1'];
   $p2 = $_POST['price2'];
   $sort = $_POST['rate'];
 $date= $_POST['beta_date'];
 echo $date;
  //   echo $p1.$p2;
 if(!isset($_POST['category']))
 $_cat = "";
 else
 $_cat = $_POST['category'];
   // echo $_cat;
  if($sort == 1)   
   {queryRows("SELECT * FROM caterer  JOIN professional ON caterer.PID = professional.UID WHERE Category LIKE '%$_cat%' and professional.city LIKE '%$city%' AND (P1unit between $p1 and $p2 or P2unit between $p1 and $p2 or P3unit between $p1 and $p2 or P4unit between $p1 and $p2 )  order by rating desc",$mysqli); 
 // echo "SELECT * FROM caterer  JOIN professional ON caterer.PID = professional.UID WHERE Category = '$_cat' and professional.city LIKE '%$city%' AND (P1unit between $p1 and $p2 or P2unit between $p1 and $p2 or P3unit between $p1 and $p2 or P4unit between $p1 and $p2 )   order by rating desc";
  }elseif ($sort==2) 
      queryRows("SELECT * FROM caterer  JOIN professional ON caterer.PID = professional.UID WHERE professional.city LIKE '%$city%' AND (P1unit between $p1 and $p2 or P2unit between $p1 and $p2 or P3unit between $p1 and $p2 or P4unit between $p1 and $p2 ) and Category LIKE '%$_cat%' and 	TO_DATE($date, 'DD-MON-YYYY') not between (select FromDate from unavailable where unavailable.PID = caterer.PID ) and (select ToDate from unavailable where unavailable.PID = caterer.PID )  order by B_name asc",$mysqli); 
    else
      queryRows("SELECT * FROM caterer  JOIN professional ON caterer.PID = professional.UID WHERE professional.city LIKE '%$city%' AND (P1unit between $p1 and $p2 or P2unit between $p1 and $p2 or P3unit between $p1 and $p2 or P4unit between $p1 and $p2 ) and Category LIKE '%$_cat%' order by B_name asc",$mysqli); 
    
  }
  else{
    queryRows("SELECT * FROM caterer  JOIN professional ON caterer.PID = professional.UID   order by rating desc",$mysqli);
  }

function queryRows($qry,$mysqli){
    if ($result = $mysqli -> query($qry) ) {
      //echo mysqli_num_rows($result).'<br>';
        //echo '<table>' ;
       // echo '<th>Business Name</th><th>City</th><th>Category</th><th>Price</th>';// table
        while($row = mysqli_fetch_assoc($result))// $result -> fetch_row())
        {
            $pid = $row['PID'];
            $bName= $row['B_name'];
            $category=$row['Category'];
            $price=$row['P1unit'].' - '.$row['P4unit'];
            $city=$row['City'];
            $rating=$row['Rating'];
          $pincode=$row['PinCode'];
           // echo '<tr>'   ;
            //echo '<td>'.$bName.'</td><td>'.$city.'</td><td>'.$category.'</td><td>'.$price.'<td>';
             //echo '<tr>';
             require ('catDiv.php');
            
        }
       // echo '</table>';//table close
        $result -> close();
      }
      
     // echo $result;
     
      
}
?>


<?php

session_start();
//require 'connect.php';
$mysqli = new mysqli("localhost","root");

if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  die();
}
require 'hall_filter.html';
$mysqli -> select_db("test");

//echo file_get_contents( "divs.html" ); 



if(isset($_POST['city']))
{
    foreach ($_POST as $key=>$value)
    {
        #echo $key. $value.'<br>';
    }

    $city = $_POST['city'];
    $p1 = $_POST['price1'];
    $p2 = $_POST['price2'];
    $sort = $_POST['rate'];
   // echo $p1.$p2;
  if($sort==1)
    queryRows("SELECT * FROM hall JOIN professional ON hall.PID=professional.UID WHERE Price between $p1 and $p2 and  professional.city LIKE '%$city%' order by rating desc  ",$mysqli);
    else if($sort==2)
    queryRows("SELECT * FROM hall JOIN professional ON hall.PID=professional.UID WHERE Price between $p1 and $p2 and  professional.city LIKE '%$city%' order by B_name asc  ",$mysqli);
    else
    queryRows("SELECT * FROM hall JOIN professional ON hall.PID=professional.UID WHERE Price between $p1 and $p2 and  professional.city LIKE '%$city%' order by B_name desc  ",$mysqli);
}
else{
  queryRows("SELECT * FROM hall JOIN professional ON hall.PID=professional.UID   ",$mysqli);
}

function queryRows($qry,$mysqli){
    if ($result = $mysqli -> query($qry) ) {
      //Row cout  echo mysqli_num_rows($result).'<br>';
        //echo '<table>' ;
       // echo '<th>Business Name</th><th>City</th><th>Category</th><th>Price</th>';// table
        while($row = mysqli_fetch_assoc($result))// $result -> fetch_row())
        {
            $pid = $row['PID'];
            $bName= $row['B_name'];
            $category=$row['Category'];
            $price=$row['Price'];
            $city=$row['City'];
            $rating=$row['Rating'];
          //  echo $rating*20;
          $pincode=$row['PinCode'];
          $capacity = $row['Capacity'];
           // echo '<tr>'   ;
            //echo '<td>'.$bName.'</td><td>'.$city.'</td><td>'.$category.'</td><td>'.$price.'<td>';
             //echo '<tr>';
             require ('divs.php');
            
        }
       // echo '</table>';//table close
        $result -> close();
      }
      
     // echo $result;
     
      
}
?>





<style>

table {
  margin: 0 auto;
  border-collapse: collapse;
  width: 50%;
}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) td{background-color: #f2f2f2}

th {
  background-color: #4CAF50;
  color: white;
}


tr:hover {background-color: #f5f5f5;}
</style>
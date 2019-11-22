<?php
  session_start();
  include('adminfunctions.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>View User</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/Concert-Ticket-Website/css/generalstylesheet.css">
<link rel="stylesheet" href="/Concert-Ticket-Website/css/viewuser.css">
<link rel="stylesheet" href="/Concert-Ticket-Website/css/adminerror.css">
<link href="https://fonts.googleapis.com/css?family=Staatliches&display=swap" rel="stylesheet">
</head>

<body>
<?php include('header.html');?>

<?php
    if (isLoggedIn())
    {
      require_once "config.php";
      $username = $_GET['username'];

      $result=$link->query("SELECT Username, Email, Firstname, Lastname, Street, City, State, created, admin
        FROM users WHERE Username='".$username."'");

      while($row=$result->fetch_object()){
        echo "<div id='top'><h1>".$row->Username." Info</h1>";
        echo "<div id='centered'><a href='deleteuser.php?username=".$row->Username."'>Delete User</a></div></div>";
        
        echo "<div id='container'>";
        if($row->admin == 1){
          echo "<h2>Admin User</h2>";
        }else{
          echo "<h2>Regular User</h2>";
        }
        echo "<table>";
        echo "<tr><td>User Since </td><td>".$row->created."</td></tr>";
        echo "<tr><td>Email </td><td>".$row->Email."</td></tr>";
        echo "<tr><td>Full Name </td><td>".$row->Firstname." ".$row->Lastname."</td></tr>";

        if(!empty($row->Street) && !empty($row->City) && !empty($row->State)){
          echo "<tr><td>Address </td><td>".$row->Street.", ".$row->City.", ".$row->State."</td></tr>";
        }else {
          echo "<tr><td>Address </td><td>N/A</td>"."</td></tr>";
        }
        echo "</table>";
        echo "</div>";
      }

      $link->close();
    }
    else
    {
      isNotLoggedIn();
    }

      include('footer.html');
  ?>

<!doctype html>
<html>
<head>
  <title>Sentence</title>

</head>
<body>


<?php

require_once('database.php');
$conn = new mysqli($hostname, $username, $password, $database);
if ($conn->connect_errno) {
  die('ERROR NO DATABSE');
}
var_dump($_POST);


if(isset($_POST["submit"])) {
  $sql = "SELECT count(*) AS BOAT FROM mydb.Jobs";
  $result = $conn->query($sql);

  $row = $result->fetch_assoc();
  echo $row["BOAT"].

  $avg =  $conn->query("SELECT count(*) FROM mydb.Jobs");



  //$min
  //$max
}


echo nl2br("bop")


 ?>

</body>
</html>

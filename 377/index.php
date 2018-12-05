<!doctype html>
<html>

<head>
<script src="jquery-3.3.1.min.js"></script>
<title>Salary DB</title>


</head>
<body>

<form name="myForm" acion="sentence.php" method="post">
  <select name="Job" size="1">
    <option value="Data Analyst">Data Analyst</option>
  </select>
</form>


<?php
require_once('database.php');
$conn = new mysqli($hostname, $username, $password, $database);
if ($conn->connect_errno) {
  die('ERROR NO DATABSE'):
}



?>
</body>
</html>

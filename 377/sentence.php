<!DOCTYPE html>
<html>
<head>
  <title>Salary DB</title>

</head>
<body>

<?php
if(isset($_POST['submit'])) {
  require_once('database.php');
  $conn = new mysqli($hostname, $username, $password, $database);
  if ($conn->connect_errno) {
    die('ERROR NO DATABSE');
  }
  //var_dump($_POST);
  $job = $_POST["Job"];
  echo "<h2>$job</h2>";
  $job = mysql_real_escape_string($job);

  $avg = "SELECT avg(salary) AS avg from mydb.Instances INNER JOIN mydb.Jobs on mydb.Instances.job_id = mydb.Jobs.job_id WHERE job_title='$job'";
  $avgRes = $conn->query($avg);
  $avRow = $avgRes->fetch_assoc();
  $avg = $avRow["avg"];

  $min = "SELECT min(salary) as min from mydb.Instances INNER JOIN mydb.Jobs on mydb.Instances.job_id = mydb.Jobs.job_id WHERE job_title='$job'";
  $minRes = $conn->query($min);
  $minRow = $minRes->fetch_assoc();
  $min = $minRow["min"];

  $max = "SELECT max(salary) AS max from mydb.Instances INNER JOIN mydb.Jobs on mydb.Instances.job_id = mydb.Jobs.job_id WHERE job_title='$job'";
  $maxRes = $conn->query($max);
  $maxRow = $maxRes->fetch_assoc();
  $max = $maxRow["max"];


  echo $job, "'s make on average $", $avg, " a year. The minimum is $", $min, " and the maximum is $", $max, ".";
  echo nl2br("\n\nThe following table shows details about people with this title. \n\n");


  $table = "SELECT salary AS 'Salary', degree_level AS 'Education Level', experience AS 'Years of Experience' from mydb.Instances INNER JOIN mydb.Jobs on mydb.Instances.job_id = mydb.Jobs.job_id INNER JOIN Degree on mydb.Instances.degree_id = mydb.Degree.degree_id WHERE job_title='$job' ORDER BY salary";
  $tableRes = $conn->query($table);
  echo "<table border='1'>";
  echo "<tr><td>Salary</td><td>Education Level</td><td>Years of Experience</td><tr>";
  while ($row = $tableRes->fetch_assoc()) {
    echo "<tr><td>{$row['Salary']}</td><td>{$row['Education Level']}</td><td>{$row['Years of Experience']}</td><tr>";
  }
  echo "</table>";
}
?>

</body>
</html>

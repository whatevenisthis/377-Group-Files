<!DOCTYPE html>
<html>

<head>
<script src="jquery-3.3.1.min.js"></script>
<title>iSchool Salary Application</title>
<h1>Salary database for iSchool undergrads</h1>
<p>Please select a position from the dropdown below to see a summary and details.</p>

<script>
function validateForm() {
 return true;
}
</script>

</head>
<body>

<?php
  require_once('database.php');
  $conn = new mysqli($hostname, $username, $password, $database);
  if ($conn->connect_errno) {
    die('ERROR NO DATABSE');
  }
    $joblist = "SELECT job_title AS joblist FROM mydb.Jobs";
    $jobsRes = $conn->query($joblist);


    echo "<form name='myForm' action='' method='post' onsubmit='return validateForm()'>";
    echo "<select name='Job' size='1'>";
    while ($row = $jobsRes->fetch_assoc()) {
      echo "<option value='{$row['joblist']}'>{$row['joblist']}</option>";
    }
    echo "</select>";
    echo "<button type='submit' name='submit'>Submit</button>";
    echo "</form>";

    if(isset($_POST['submit'])) {
      //var_dump($_POST);
      $job = $_POST["Job"];
      echo "<h2>$job</h2>";
      //$job = mysql_real_escape_string($job);

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
      while ($row2 = $tableRes->fetch_assoc()) {
        echo "<tr><td>{$row2['Salary']}</td><td>{$row2['Education Level']}</td><td>{$row2['Years of Experience']}</td><tr>";
      }
      echo "</table>";
    }


?>









</body>
</html>

<?php
// Database connection variables
$MySQL_username = 'u510162695_scheduling_db';
$Password = '1Scheduling_db';
$MySQL_database_name = 'u510162695_scheduling_db';

try {
  // Create a PDO instance and connect to the database
  $conn = new PDO('localhost', $MySQL_username, $Password, $MySQL_database_name);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // SQL query to retrieve data from the database
  $sql = "SELECT `faculty`, GROUP_CONCAT(DISTINCT `subjects` ORDER BY `subjects` ASC SEPARATOR ', ') AS `subject`, SUM(`total_units`) AS `totunits` FROM `loading` GROUP BY `faculty`";

  // Execute the query and fetch the result
  $stmt = $conn->query($sql);
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

  // Display the data in a table
  if ($result) {
    echo "<table>";
    echo "<thead><tr><th>Instructor Name</th><th>Subjects</th><th>Load</th><th>Other Load</th><th>Overload</th><th>Total</th></tr></thead>";
    echo "<tbody>";
    foreach ($result as $row) {
      echo "<tr><td>".$row['Instructor Name']."</td><td>".$row['Subjects']."</td><td>".$row['Load']."</td><td>".$row['Other Load']."</td><td>".$row['Overload']."</td><td>".$row['Total']."</td></tr>";
    }
    echo "</tbody>";
    echo "</table>";
  } else {
    echo "No results found.";
  }

} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}

// Close the database connection
$conn = null;
?>
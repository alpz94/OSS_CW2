<!-- Author: Ana Lucia Petinga Zorro 
CO551 Open Source Systems -->
<?php

   include("_includes/config.inc");
   include("_includes/dbconnect.inc");
   include("_includes/functions.inc");


   // check logged in
   if (isset($_SESSION['id'])) {

      echo template("templates/partials/header.php");
      echo template("templates/partials/nav.php");

      // Build SQL statment that selects a student's modules
      $sql = "select * from student;";

      $result = mysqli_query($conn,$sql);

      $data['content'] .= "<form method='post' action=''>";
      // prepare page content
      $data['content'] .= "<table border='1'>";
      $data['content'] .= "<tr><th colspan='10' align='center'>Student</th></tr>";
      $data['content'] .= "<tr><th>Student ID</th><th>Password</th><th>DOB</th><th>First Name</th>
      <th>Last Name</th><th>House</th><th>Town</th><th>County</th><th>Country</th><th>Postcode</th><th>Select</th></tr>";
      // Display the modules within the html table
      while($row = mysqli_fetch_array($result)) {
         $data['content'] .= "<tr><td> $row[studentid] </td><td> $row[password] </td>";
         $data['content'] .= "<td> $row[dob] </td><td> $row[firstname] </td><td> $row[lastname] </td>";
         $data['content'] .= "<td> $row[house] </td><td> $row[town] </td><td> $row[county] </td><td> $row[country] </td><td> $row[postcode] </td><td><input type='checkbox' name='Select[$row[studentid]]' </td></tr>";
      }
      $data['content'] .= "</table>";
      $data['content'] .= '<input type="submit" name="delete" value="Delete Records">';
      $data['content'] .= "</form>";

      // render the template
      echo template("templates/default.php", $data);

   } else {
      header("Location: index.php");
   }

   echo template("templates/partials/footer.php");

?>

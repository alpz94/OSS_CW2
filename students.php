<!-- Author: Ana Lucia Petinga Zorro 
CO551 Open Source Systems -->
<?php
   include("_includes/config.inc");
   include("_includes/dbconnect.inc");
   include("_includes/functions.inc");

   // Test what I get through in $_POST
   //var_dump($_POST);

   // Check logged in
   if (isset($_SESSION['id'])) {

      echo template("templates/partials/header.php");
      echo template("templates/partials/nav.php");
?>

<!-- Jumbotron -->
<section class="container-md">
   <div class="jumbotron text-center mdb-color lighten-2 white-text mx-2 mb-5">
      <h1 class="card-title h1">Students Records</h1>
      <p class="card-text">In this page you can modify the student table by modifying its records.</p>
   </div>
</section>

<?php
      // Build SQL statement that selects all student records
      $sql = "SELECT * FROM student;";

      $result = mysqli_query($conn,$sql);

      $data['content'] .= "<h2>Students Details</h2><br/>";
      // Form submitted to script itself (students.php)
      $data['content'] .= "<form method='post' action=''>";
      // Prepare page content
      $data['content'] .= "<table class='table table-hover'>";
      $data['content'] .= "<tr><th colspan='10' align='center'>Student</th></tr>";
      $data['content'] .= "<tr><th>ID No</th><th>DOB</th><th>Forename</th>
      <th>Surname</th><th>House</th><th>Town</th><th>County</th><th>Country</th><th>Postcode</th><th>Select</th></tr>";
      // Display the students within the html table
      while($row = mysqli_fetch_array($result)) {
         $data['content'] .= "<tr><td> $row[studentid] </td><td> $row[dob] </td>";
         $data['content'] .= "<td> $row[firstname] </td><td> $row[lastname] </td>";
         $data['content'] .= "<td> $row[house] </td><td> $row[town] </td><td> $row[county] </td><td> $row[country] </td><td> $row[postcode] </td>";
         $data['content'] .= "<td><input type='checkbox' name='delete[$row[studentid]]' /></td></tr>";
      }
      $data['content'] .= "</table></br>"; // End of table

      $data['content'] .="<section class='container'>";
      $data['content'] .="<div class='row'>";
      $data['content'] .="<div class='col-1'>";
      // Delete Button
      $data['content'] .="<section class='form-group'>";
      $data['content'] .="<button type='submit' value='Delete' name='btndelete' class='btn mdb-color lighten-2 white-text mx-2 mb-5 btn-sm'><i class='fas fa-user-minus'></i></button>"; 
      $data['content'] .="</section>";
      $data['content'] .= "</form>";

      $data['content'] .="</div>";
      $data['content'] .="<div class='col-1'>";
      // Form submitted to script addstudent.php (add button)
      $data['content'] .= "<form action='addstudent.php' method='post'>";
      $data['content'] .="<section class='form-group'>";
      $data['content'] .="<button type='submit' value='Add' name='btnaddstudent' class='btn mdb-color lighten-2 white-text mx-2 mb-5 btn-sm'><i class='fas fa-user-plus'></i></button>";    
      $data['content'] .="</section>";
      $data['content'] .="</div>";
      $data['content'] .="</div>";
      $data['content'] .="</section>";
      $data['content'] .= "</form>";

      // When the Delete button is clicked
      if (!empty($_POST['delete']))
      {
         foreach($_POST['delete'] as $studentid => $value)
         {
            // Protecting against injection using MySQLi prepared statement
            // 's' specifies the variable type will be an 'string'
            $stmt = $conn->prepare("DELETE FROM student WHERE studentid= ?");
            $stmt->bind_param("s", $studentid);
            $stmt->execute();

            /* $sql = "DELETE FROM student WHERE studentid= '$studentid';";

               $result = mysqli_query($conn,$sql); */

            $data['content'] = "<p>Student = " . $studentid . " has been successfully deleted.<br /><br /></p>";
         }
      }

      // Render the template
      echo template("templates/default.php", $data);

   } else {
      header("Location: index.php");
   }

   echo template("templates/partials/footer.php");
?>
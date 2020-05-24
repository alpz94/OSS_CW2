<!-- Author: Ana Lucia Petinga Zorro 
CO551 Open Source Systems -->
<?php
   include("_includes/config.inc");
   include("_includes/dbconnect.inc");
   include("_includes/functions.inc");

   //test what I get through in $_POST
   //var_dump($_POST);

   // check logged in
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

      $data['content'] .= "<form method='post' action=''>";
      // prepare page content
      $data['content'] .= "<table border='1'>";
      $data['content'] .= "<tr><th colspan='10' align='center'>Student</th></tr>";
      $data['content'] .= "<tr><th>Student ID</th><th>DOB</th><th>First Name</th>
      <th>Last Name</th><th>House</th><th>Town</th><th>County</th><th>Country</th><th>Postcode</th><th>Select</th></tr>";
      // Display the students within the html table
      while($row = mysqli_fetch_array($result)) {
         $data['content'] .= "<tr><td> $row[studentid] </td><td> $row[dob] </td>";
         $data['content'] .= "<td> $row[firstname] </td><td> $row[lastname] </td>";
         $data['content'] .= "<td> $row[house] </td><td> $row[town] </td><td> $row[county] </td><td> $row[country] </td><td> $row[postcode] </td>";
         $data['content'] .= "<td><input type='checkbox' name='delete[$row[studentid]]' /></td></tr>";
      }
      $data['content'] .= "</table>";
      $data['content'] .= '<input type="submit" value="Delete">';
      $data['content'] .= "</form>";

      // When the Delete button is clicked
      if (!empty($_POST['delete']))
      {
         foreach($_POST['delete'] as $studentid => $value)
         {
            $sql = "DELETE FROM student WHERE studentid= '$studentid';";

            $result = mysqli_query($conn,$sql);

            echo "Student = " . $studentid . " has been successfully deleted.<br />";
         }
      }

      // render the template
      echo template("templates/default.php", $data);

   } else {
      header("Location: index.php");
   }

   echo template("templates/partials/footer.php");
?>

<table class="table table-sm table-dark">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td colspan="2">Larry the Bird</td>
      <td>@twitter</td>
    </tr>
  </tbody>
</table>

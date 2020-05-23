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
?>

<!-- Jumbotron -->
<section class="container-md">
   <div class="jumbotron text-center mdb-color lighten-2 white-text mx-2 mb-5">
      <h1 class="card-title h1">Modules Records</h1>
      <p class="card-text">In this page you can view the modules table.</p>
   </div>
</section>

<?php
      // Build SQL statment that selects a student's modules
      $sql = "select * from studentmodules sm, module m where m.modulecode = sm.modulecode and sm.studentid = '" . $_SESSION['id'] ."';";

      $result = mysqli_query($conn,$sql);

      // prepare page content
      $data['content'] .= "<table border='1'>";
      $data['content'] .= "<tr><th colspan='5' align='center'>Modules</th></tr>";
      $data['content'] .= "<tr><th>Code</th><th>Type</th><th>Level</th></tr>";
      // Display the modules within the html table
      while($row = mysqli_fetch_array($result)) {
         $data['content'] .= "<tr><td> $row[modulecode] </td><td> $row[name] </td>";
         $data['content'] .= "<td> $row[level] </td></tr>";
      }
      $data['content'] .= "</table>";

      // render the template
      echo template("templates/default.php", $data);

   } else {
      header("Location: index.php");
   }

   echo template("templates/partials/footer.php");
?>
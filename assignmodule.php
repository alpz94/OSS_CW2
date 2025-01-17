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
      <h1 class="card-title h1">Assign Module</h1>
      <p class="card-text">In this page you can assign a module.</p>
   </div>
</section>

<?php
   // If a module has been selected
   if (isset($_POST['selmodule'])) {
      $sql = "insert into studentmodules values ('" .  $_SESSION['id'] . "','" . $_POST['selmodule'] . "');";
      $result = mysqli_query($conn, $sql);
      $data['content'] .= "<p>The module " . $_POST['selmodule'] . " has been assigned to you</p>";
   }
   else  // If a module has not been selected
   {

   // Build sql statment that selects all the modules
   $sql = "select * from module";
   $result = mysqli_query($conn, $sql);

   $data['content'] .= "<form name='frmassignmodule' action='' method='post' >";
   $data['content'] .= "<h2>Select a Module to Assign</h2><br/>";
   $data['content'] .= "<section class='form-group'>";
   $data['content'] .= "<section class='col-sm-4'>";
   $data['content'] .= "<select class='form-control' name='selmodule' id='Select'>";
   //$data['content'] .= "<select name='selmodule' >";
   // Display the module name in a drop down selection box
   while($row = mysqli_fetch_array($result)) {
      $data['content'] .= "<option value='$row[modulecode]'>$row[name]</option>";
   }
   $data['content'] .= "</select>";
   $data['content'] .= "</section>";
   $data['content'] .= "</section><br/><br/>";
   $data['content'] .= "<section class='form-group'>";
   $data['content'] .= "<input type='submit' value='Save' name='confirm' class='btn mdb-color lighten-2 white-text mx-2 mb-5 btn-sm'><br/><br/><br/>";
   $data['content'] .= "</section>";
   $data['content'] .= "</form>";
   }

   // render the template
   echo template("templates/default.php", $data);

} else {
   header("Location: index.php");
}

echo template("templates/partials/footer.php");
?>
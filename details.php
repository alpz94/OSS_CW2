<!-- Author: Ana Lucia Petinga Zorro 
CO551 Open Source Systems -->
<?php
   include("_includes/config.inc");
   include("_includes/dbconnect.inc");
   include("_includes/functions.inc");


   // Check logged in
   if (isset($_SESSION['id'])) {

      echo template("templates/partials/header.php");
      echo template("templates/partials/nav.php");
?>

<!-- Jumbotron -->
<section class="container-md">
   <div class="jumbotron text-center mdb-color lighten-2 white-text mx-2 mb-5">
      <h1 class="card-title h1">My Details</h1>
      <p class="card-text">In this page you can update your details at any time.</p>
   </div>
</section>

<?php
   // If the form has been submitted
   if (isset($_POST['submit'])) {

      /* // Build A SQL prepared statement that updates the users details
      // 's' specifies the variable type will be a 'string'
      $stmt = $conn->prepare("UPDATE student SET firstname = ?, 
      lastname = ?, 
      house = ?, 
      town = ?, 
      county = ?, 
      country = ?, 
      postcode = ?) 
      WHERE studentid = ?");
      $stmt->bind_param("ssssssss", 
      $_POST['txtfirstname'], 
      $_POST['txtlastname'], 
      $_POST['txthouse'], 
      $_POST['txttown'], 
      $_POST['txtcounty'], 
      $_POST['txtcountry'], 
      $_POST['txtpostcode'], 
      $_SESSION['id']);
      $stmt->execute(); */

      // Build a SQL statement to update the student details
      $sql = "update student set firstname ='" . $_POST['txtfirstname'] . "',";
      $sql .= "lastname ='" . $_POST['txtlastname']  . "',";
      $sql .= "house ='" . $_POST['txthouse']  . "',";
      $sql .= "town ='" . $_POST['txttown']  . "',";
      $sql .= "county ='" . $_POST['txtcounty']  . "',";
      $sql .= "country ='" . $_POST['txtcountry']  . "',";
      $sql .= "postcode ='" . $_POST['txtpostcode']  . "' ";
      $sql .= "where studentid = '" . $_SESSION['id'] . "';";
      $result = mysqli_query($conn,$sql); */

      $data['content'] = "<p>Your details have been updated.</p>";

   }
   else {
      // Build a SQL statement to return the student record with the id that
      // matches that of the session variable.
      $sql = "select * from student where studentid='". $_SESSION['id'] . "';";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result);

      // Using <<<EOD notation to allow building of a multi-line string
      // See http://stackoverflow.com/questions/6924193/what-is-the-use-of-eod-in-php for info
      // Also http://stackoverflow.com/questions/8280360/formatting-an-array-value-inside-a-heredoc
      $data['content'] = <<<EOD

   <h2>My Details</h2><br/>
    <form class="form-horizontal" name="frmdetails" action="" method="post">
        <section class="form-group">
            <section class="form-group row">
                <label for="firstname" class="col-sm-2 col-form-label">First Name</label>
                <div class="col-sm-4">
                    <input name="txtfirstname" type="text" value="{$row['firstname']}" class="form-control" id="firstname">
                </div>
            </section>
            <section class="form-group row">
                <label for="lastname" class="col-sm-2 col-form-label">Last Name</label>
                <div class="col-sm-4">
                    <input name="txtlastname" type="text" value="{$row['lastname']}" class="form-control" id="lastname">
                </div>
            </section>
            <section class="form-group row">
                <label for="house" class="col-sm-2 col-form-label">Street</label>
                <div class="col-sm-4">
                    <input name="txthouse" type="text" value="{$row['house']}" class="form-control" id="house">
                </div>
            </section>
            <section class="form-group row">
                <label for="town" class="col-sm-2 col-form-label">Town</label>
                <div class="col-sm-4">
                    <input name="txttown" type="text" value="{$row['town']}" class="form-control" id="town">
                </div>
            </section>
            <section class="form-group row">
                <label for="county" class="col-sm-2 col-form-label">County</label>
                <div class="col-sm-4">
                    <input name="txtcounty" type="text" value="{$row['county']}" class="form-control" id="county">
                </div>
            </section>
            <section class="form-group row">
                <label for="country" class="col-sm-2 col-form-label">Country</label>
                <div class="col-sm-4">
                    <input name="txtcountry" type="text" value="{$row['country']}" class="form-control" id="country">
                </div>
            </section>
            <section class="form-group row">
                <label for="postcode" class="col-sm-2 col-form-label">Postcode</label>
                <div class="col-sm-4">
                    <input name="txtpostcode" type="text" value="{$row['postcode']}" class="form-control" id="postcode">
                </div>
            </section>
        </section>
        <section class="form-group">
            <input type="submit" value="Save" name="submit" class="btn mdb-color lighten-2 white-text mx-2 mb-5 btn-sm">
        </section>
    </form>

EOD;

   }

   // Render the template
   echo template("templates/default.php", $data);

} else {
   header("Location: index.php");
}

echo template("templates/partials/footer.php");
?>
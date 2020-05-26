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
      <h1 class="card-title h1">Add New Student</h1>
      <p class="card-text">In this page you can add a new student.</p>
   </div>
</section>

<?php
   // If the form has been submitted
   if (isset($_POST['btninsert'])) {

      // Build SQL prepared statement that inserts the new student record
      // 's' specifies the variable type will be a 'string'
      $stmt = $conn->prepare("INSERT INTO student (studentid, password, dob, firstname, lastname, house, town, county, country, postcode) VALUES (?,?,?,?,?,?,?,?,?,?)");
      $stmt->bind_param("ssssssssss", $_POST['txtstudentid'], $_POST['txtpassword'], $_POST['txtdob'], $_POST['txtfirstname'],
      $_POST['txtlastname'], $_POST['txthouse'], $_POST['txttown'], $_POST['txtcounty'],$_POST['txtcountry'], $_POST['txtpostcode']);
      $stmt->execute();
      
      /* // Build SQL statement that inserts the new student record
      $sql = "INSERT INTO student (studentid, firstname, lastname, house, town, county, country postcode)";
      $sql = $sql . " values ('$_POST[txtstudentid]', '$_POST['txtpassword']', '$_POST['txtdob']', '$_POST[txtfirstname]', '$_POST[txtlastname]', '$_POST[txthouse]', 
      '$_POST[txttown]', '$_POST[txtcounty]', '$_POST[txtcountry]', '$_POST[txtpostcode]')"; 

      $result = mysqli_query($conn,$sql);*/
      
      $data['content'] = "<p>A new student has been added.</p>";
   }
   else {
      // Using <<<EOD notation to allow building of a multi-line string
      // See http://stackoverflow.com/questions/6924193/what-is-the-use-of-eod-in-php for info
      // Also http://stackoverflow.com/questions/8280360/formatting-an-array-value-inside-a-heredoc
      $data['content'] = <<<EOD

    <h2>Add New Student</h2><br/>
    <form class="form-horizontal" name="frmaddstudent" action="" method="post">
        <section class="form-group">
            <section class="form-group row">
                <label for="studentid" class="col-sm-2 col-form-label">Student ID</label>
                <div class="col-sm-4">
                    <input name="txtstudentid" type="text" class="form-control" id="studentid">
                </div>
            </section>
            <section class="form-group row">
                <label for="inputpassword" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-4">
                    <input name="txtpassword" type="password" class="form-control" id="inputpassword">
                </div>
            </section>
            <section class="form-group row">
                <label for="dob" class="col-sm-2 col-form-label">Date of Birth</label>
                <div class="col-sm-4">
                    <input name="txtdob" type="date" class="form-control" id="dob">
                </div>
            </section>
            <section class="form-group row">
                <label for="firstname" class="col-sm-2 col-form-label">First Name</label>
                <div class="col-sm-4">
                    <input name="txtfirstname" type="text" class="form-control" id="firstname">
                </div>
            </section>
            <section class="form-group row">
                <label for="lastname" class="col-sm-2 col-form-label">Last Name</label>
                <div class="col-sm-4">
                    <input name="txtlastname" type="text" class="form-control" id="lastname">
                </div>
            </section>
            <section class="form-group row">
                <label for="house" class="col-sm-2 col-form-label">Street</label>
                <div class="col-sm-4">
                    <input name="txthouse" type="text" class="form-control" id="house">
                </div>
            </section>
            <section class="form-group row">
                <label for="town" class="col-sm-2 col-form-label">Town</label>
                <div class="col-sm-4">
                    <input name="txttown" type="text" class="form-control" id="town">
                </div>
            </section>
            <section class="form-group row">
                <label for="county" class="col-sm-2 col-form-label">County</label>
                <div class="col-sm-4">
                    <input name="txtcounty" type="text" class="form-control" id="county">
                </div>
            </section>
            <section class="form-group row">
                <label for="country" class="col-sm-2 col-form-label">Country</label>
                <div class="col-sm-4">
                    <input name="txtcountry" type="text" class="form-control" id="country">
                </div>
            </section>
            <section class="form-group row">
                <label for="postcode" class="col-sm-2 col-form-label">Postcode</label>
                <div class="col-sm-4">
                    <input name="txtpostcode" type="text" class="form-control" id="postcode">
                </div>
            </section>
        </section>
        <section class="form-group">
            <button type="submit" value="Insert" name="btninsert" class="btn mdb-color lighten-2 white-text mx-2 mb-5 btn-sm">Insert</button>
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
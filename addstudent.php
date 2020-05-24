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
      <h1 class="card-title h1">Add New Student</h1>
      <p class="card-text">In this page you can add a new student.</p>
   </div>
</section>

<?php
   // if the form has been submitted
   if (isset($_POST['submit'])) {

      // Build SQL prepared statment that that inserts the student details
      $stmt = $conn->prepare("INSERT INTO student (studentid, password, dob, firstname, lastname, house, town, county, country, postcode) VALUES (?,?,?,?,?,?,?,?,?,?)");
      //attach variables to the dummy values in the prepared template
      // 's' specifies the variable type will be a 'string'
      $stmt->bind_param("ssssssssss", $_POST['txtstudentid'], $_POST['txtpassword'], $_POST['txtdob'], $_POST['txtfirstname'],
      $_POST['txtlastname'], $_POST['txthouse'], $_POST['txttown'], $_POST['txtcounty'],$_POST['txtcountry'], $_POST['txtpostcode']);
      //executing the code
      $stmt->execute();
      $stmt->close();
      
      
      $data['content'] = "<p>Your details have been updated</p>";
   }
   else {
      // using <<<EOD notation to allow building of a multi-line string
      // see http://stackoverflow.com/questions/6924193/what-is-the-use-of-eod-in-php for info
      // also http://stackoverflow.com/questions/8280360/formatting-an-array-value-inside-a-heredoc
      $data['content'] = <<<EOD

   <h2>Add New Student</h2><br/>
   <form name="frmaddstudent" action="" method="post">
   Student ID :
   <input name="txtstudentid" type="text" /><br/>
   Password :
   <input name="txtpassword" type="password" /><br/>
   Date of Birth :
   <input name="txtdob" type="date"/><br/>
   First Name :
   <input name="txtfirstname" type="text" /><br/>
   Last Name :
   <input name="txtlastname" type="text"  /><br/>
   Number and Street :
   <input name="txthouse" type="text"  /><br/>
   Town :
   <input name="txttown" type="text"  /><br/>
   County :
   <input name="txtcounty" type="text"  /><br/>
   Country :
   <input name="txtcountry" type="text"  /><br/>
   Postcode :
   <input name="txtpostcode" type="text"  /><br/><br/>
   <input type="submit" value="Save" name="submit"/><br/></br><br/>
   </form>

EOD;

   }

   // render the template
   echo template("templates/default.php", $data);

} else {
   header("Location: index.php");
}

echo template("templates/partials/footer.php");
?>
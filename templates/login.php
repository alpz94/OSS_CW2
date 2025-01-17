<!-- Author: Ana Lucia Petinga Zorro 
CO551 Open Source Systems -->

<?php echo template("templates/partials/nav_login.php"); ?>

<!-- Jumbotron -->
<section class="container-md">
   <div class="jumbotron text-center mdb-color lighten-2 white-text mx-2 mb-5">
      <h1 class="card-title h1">Login to OSS-CW2</h1>
      <p class="card-text">Enter your login details below.</p>
   </div>

   <?php echo $message; ?>
   
   <section class="container-md">
      <section class="card text-center" style="width: 18rem;">
         <div class="card-body">
            <div class="col-auto my-1">
               <form name="frmLogin" action="authenticate.php" method="post">
                  <div class="form-group mx-sm-3 mb-2">
                     <input name="txtid" type="text" class="form-control-sm" placeholder="Student ID" required="required" id="inputStudentid" aria-describedby="idHelp">
                     <small id="idHelp" class="form-text text-muted">Do not share your ID.</small>
                  </div>
                  <div class="form-group mx-sm-3 mb-2">
                     <input name="txtpwd" type="password" class="form-control-sm" placeholder="Password" required="required" id="inputPassword">
                  </div>
                  <div class="form-group mx-sm-3 mb-2">
                     <button type="submit" value="Login" name="btnlogin" class="btn mdb-color lighten-2 white-text mx-2 mb-5 btn-sm">Login</button>
                  </div>
               </form>
            </div>
         </div>
      </section>
   </section>
   </br></br>
</section>
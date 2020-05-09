
<?php echo $message; ?>

<form name="frmLogin" action="authenticate.php" method="post">
   Student ID:
   <input name="txtid" type="text" value="Enter your ID" />
   <br/>
   Password:
   <input name="txtpwd" type="password" value="Enter your password"/>
   <br/>
   <input type="submit" value="Login" name="btnlogin" />
</form>

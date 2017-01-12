<?php
$register_login = '';

require 'session_db.php';
require 'connect_db.php';

if(!loggedin()){

	if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password_again']) && isset($_POST['firstname']) && isset($_POST['lastname'])){
		$username = $_POST['username'];
	    $password = $_POST['password'];
	    $password_again = $_POST['password_again'];
	    $password_hash = md5($password);
	    $firstname = $_POST['firstname'];
	    $lastname = $_POST['lastname'];
	    $email = $_POST['email'];
        

	    if(!empty($username) && !empty($password) && !empty($password_again) && !empty($firstname) && !empty($lastname) && !empty($email)){
	        if($password!=$password_again){
	        	$register_login =  ' <div class="alert alert-danger fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                Passwords do not match.
                </div>';
            }
            else
            {
            	    //Start Registration:

		            $query = "SELECT username FROM practise.users WHERE username='$username'";
		            $query_run = mysqli_query(mysqli_connect('localhost', 'root', ''), $query);
		            if(mysqli_num_rows($query_run)==1){
			             $register_login =  ' <div class="alert alert-danger fade in">
                         <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                         Sorry, username already taken.
                         </div>';
                     }
                     else
                     {
			$query = "INSERT INTO practise.users VALUES ('','".$username."','".$email."','".$password_hash."','".$firstname."','".$lastname."')";
			if($query_run = mysqli_query(mysqli_connect('localhost', 'root', ''), $query)){
				header('Location: register_success.php');
			}
			
            }
        }

  }  }else{  
  	         $register_login =  '<div class="alert alert-danger fade in">
                         <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                         Enter Something.
                         </div>';

  }
  
}
else{
	$register_login =  ' <div class="alert alert-danger fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        You are already loggedin.
                        </div>';
}
?>


<!DOCTYPE html>
<html>
  <head>
	<title>CodeHub Login</title>
	<!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet'  type='text/css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
  </head>
  <body style="background: #0099ff;"><br>
	<div class="container">
		<div class="row">
			<div class="col-md-3">
			</div>
			<div class="col-md-6">
  <div class="modal-content">

                <!-- header -->
                <div class="modal-header">
                    <center><h3 class="modal-title">Register</h3></center>
                </div>

                <!-- body (form) -->
                <div class="modal-body">
                    <form role="form" action="register.php" method="POST" enctype="multipart/form-data">
                    	<div>
                            <?php echo $register_login ?>

                        </div>
                        <div class="form-group">
                          	<label for="usr">Username:</label>
					<input type="text" class="form-control" id="usr" name="username">
					<label for="email">Email:</label>
					<input type="email" class="form-control" id="email" name="email">
					<label for="pwd">Password:</label>
					<input type="password" class="form-control" id="pwd" name="password">
					<label for="pwd">Password-again:</label>
					<input type="password" class="form-control" id="pwd" name="password_again">
					<label for="usr">Firstname:</label>
					<input type="text" class="form-control" id="usr" name="firstname">
					<label for="usr">Lastname:</label>
					<input type="text" class="form-control" id="usr" name="lastname">
                    
                        </div>
                    
                </div>

                <!-- button -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-block">Register</button>
                </div>
                </form>

            </div>
             </div>
            <div class="col-md-3">
            </div>
         </div>
       </div>
    
   </body>
</html>

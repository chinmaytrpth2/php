<?php

require 'connect_db.php';
require 'session_db.php';


$error_login = '';

if(isset($_POST['username']) && isset($_POST['password'])){
	$username = $_POST['username'];
    $password = $_POST['password'];

    $password_hash = md5($password);

    if(!empty($username) && !empty($password_hash)){
    	$query = "SELECT id FROM practise.users WHERE username='$username' AND password='$password_hash'";
    	if($query_run = mysqli_query(mysqli_connect('localhost', 'root', ''), $query)){
    		$query_num_rows = mysqli_num_rows($query_run);
    		if($query_num_rows==0){
    			$error_login = ' <div class="alert alert-danger fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            Invalid username/password.
        </div>';
    		} 
    		else if($query_num_rows==1){
    			$query_row = mysqli_fetch_assoc($query_run);
    			$user_id = $query_row['id'];
    			$_SESSION['user_id'] = $user_id;
    			header('Location: profile.php');

    		}
    	}
    }
    else{
    	  $error_login =  ' <div class="alert alert-danger fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            Enter something.
        </div>';
    }
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
                    <center><h3 class="modal-title">Login</h3></center>
                </div>

                <!-- body (form) -->
                <div class="modal-body">
                    <form role="form" method="POST" action="">
                        <div>
                            <?php echo $error_login ?>

                        </div>
                        <div class="form-group">
                            <label for="usr">Username:</label>
                    <input type="text" class="form-control" id="usr" name="username">
                    <label for="pwd">Password:</label>
                    <input type="password" class="form-control" id="pwd" name="password">
                   
                        </div>
                    
                </div>

                <!-- button -->
                <div class="modal-footer">
                    <button class="btn btn-primary btn-block">Login</button>
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

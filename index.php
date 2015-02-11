<?php 
session_start();
error_reporting(0);

?>
<?php

$script = '';

if(!isset($_SESSION['msg']))
{
	// The script below shows the sliding panel on page load
	
	$script = '
	<script type="text/javascript">
	
		$(function(){
		
			$("div#panel").show();
			$("#toggle a").toggle();
		});
	
	</script>';
	
}
?>


	







<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>File Sharing System</title>
    
    <link rel="stylesheet" type="text/css" href="demo.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="login_panel/css/slide.css" media="screen" />
    
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
    <script type="text/javascript" src="login_panel/js/check.js"></script>
    <!-- PNG FIX for IE6 -->
    <!-- http://24ways.org/2007/supersleight-transparent-png-in-ie6 -->
    <!--[if lte IE 6]>
        <script type="text/javascript" src="login_panel/js/pngfix/supersleight-min.js"></script>
    <![endif]-->
    
    <script src="login_panel/js/slide.js" type="text/javascript"></script>
    
    <?php echo $script; ?>
</head>

<body>

<!-- Panel -->
<div id="toppanel">
	<div id="panel">
		<div class="content clearfix">
			<div class="left">
				<h1>The file sharing system </h1>
				<h2>Register if you're not already</h2>		
				<p class="grey">Feel free to use it anytime anywhere.</p>
				<h2>Don't be afraid to share </h2>
				     <p class="grey">Espacially made for your needs.</p>
			</div>
            
            
            <?php
			if(!isset($_POST['id'])):
			include("header.php");
			?>
            
			<div class="left">
				<!-- Login Form -->
			<form class="clearfix" action="<?php $_SERVER["PHP_SELF"];?>" method="post">
					<h1>Member Login</h1> 
            <?php

if (!isset($_POST['login'])){
?>
					    
	
					<label class="grey" for="username">Username:</label>
<input class="field" type="text" onkeypress="return IsAlphaNumeric(event);" ondrop="return false;"
        onpaste="return false;" name="username" id="username" value="" size="23" /><br />
		<p id="error" style="color: Red; display: inline">* Special Characters not allowed</p>
					<label class="grey" for="password">Password:</label>
					<input class="field" type="password" name="password" id="password" size="23" /><br />
					<input type="checkbox" name="rememberme" value="rememberme"  />Remeber me
        			<div class="clear"></div>	
					<input type="submit" name="login" value="Login" class="bt_login" />
				
				</form>
			
			</div>
			
			<div class="left right">		
		<?php
} else {
	require_once("db_const.php");
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	# check connection
	if ($mysqli->connect_errno) {
		echo "<p>MySQL error no {$mysqli->connect_errno} : {$mysqli->connect_error}</p>";
		exit();
	}
 
	$username = $_POST['username'];
	$password = $_POST['password'];
    $error;
	$sql = ("SELECT * from users WHERE username='{$username}' AND password='{$password}'");
	$result = $mysqli->query($sql);
	if ($result->num_rows <= 0){
		echo "<p>Invalid username/password combination</p>";
		header( "Refresh:1; url=demo.php", true, 303);
		$error=true;
	} else {
	$_SESSION['username']=$username;
	header("Location:login.php");
	}
}

?>		



			<!-- Register Form -->
			<?php
				require_once("db_const.php");
					
					if (!isset($_POST['register'])) {
			?>
				<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
					<h1>Not a member?Sign up and start sharing!</h1>		
                     
                    		
					<label class="grey" for="username">Username:</label>
					<input class="field" type="text" onkeypress="return IsAlphaNumeric(event);" ondrop="return false;"
        onpaste="return false;" name="username" id="username" value="" size="23" /><br />
		<p id="error" style="color: Red; display: inline">* Special Characters not allowed</p>
					<label class="grey" for="password">Password:</label>
					<input class="field" type="password" name="password" id="password" size="23" />
					<input type="submit" name="register" value="Register" class="bt_register" />
				</form>
				<?php
} else {
## connect mysql server
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	# check connection
	if ($mysqli->connect_errno) {
		echo "<p>MySQL error no {$mysqli->connect_errno} : {$mysqli->connect_error}</p>";
		exit();
	}

		## query database
		# prepare data for insertion
		$username=$_POST['username'];
		$password=$_POST['password'];
		
		
		# check if username and email exist else insert
	$exists = 0;
	$result = $mysqli->query("SELECT username from users WHERE username = '{$username}' LIMIT 1");
	if ($result->num_rows == 1)
		$exists = 1;
	if ($exists == 1)
	{ 
	echo "<p>Username already exists!</p>"; 
	 header( "Refresh:1; url=demo.php", true, 303);	
    }
	
	else {
		# insert data into mysql database
		$sql = "INSERT  INTO `users` (`id`, `username`, `password`) 
				VALUES (NULL, '{$username}', '{$password}')";
 
		if ($mysqli->query($sql)) {
			//echo "New Record has id ".$mysqli->insert_id;
			
			echo "<p>Registered successfully!</p> <br />";
			echo "<p>You can login now.</p>";		
            header( "Refresh:2; url=demo.php", true, 303);			
		} else {
			echo "<p>MySQL error no {$mysqli->errno} : {$mysqli->error}</p>";
			exit();
		}
		
	}
}
?>		
			</div>
            
          
            
           
		</div>
	</div> <!-- /login -->	
<form action="" method="post">
    <!-- The tab on top -->	
	<div class="tab">
		<ul class="login">
	    	<li class="left">&nbsp;</li>
				<li>Hello
			<?php
			if($error==true)
			{ 
			echo $_SESSION['username'];
			}
			else{
		    echo "Guest";
			}
			?>
				!</li>
			<li class="sep">|</li>
			<li id="toggle">
			    	
				<a id="open"  class="open" href="#"><?php echo isset($_SESSION['id']['msg'])?'Open Panel':'Log In | Register';?></a>
				<a id="close"  style="display: block;" class="close" href="#"><?php echo isset($_SESSION['id']['msg'])?'Logout':'Close Panel';?></a>	
					
			</li>
	    	<li class="right">&nbsp;</li>
		</ul> 
	</div> <!-- / top -->
	
</div> <!--panel -->
</form>
 <?php
			endif;
			?>
<div class="mainTitle">

</div>

<hr>
<p class="footer">Copyright 2014 &copy</p>
</body>
</html>

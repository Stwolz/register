<?php session_start();
$now = time();
?>
<?php

$script = '';

if(isset($_SESSION['msg']))
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
<script language="javascript" type="text/javascript">
<!--
function startUpload(){
      document.getElementById('f1_upload_process').style.visibility = 'visible';
      document.getElementById('f1_upload_form').style.visibility = 'hidden';
      return true;
}

function stopUpload(success){
      var result = '';
      if (success == 1){
         result = '<span class="msg">The file was uploaded successfully!<\/span><br/><br/>';
      }
      else {
         result = '<span class="emsg">There was an error during file upload!<\/span><br/><br/>';
      }
      document.getElementById('f1_upload_process').style.visibility = 'hidden';
      document.getElementById('f1_upload_form').innerHTML = result + '<label>File: <input name="myfile" type="file" size="30" /><\/label><label><input type="submit" name="submitBtn" class="sbtn" value="Upload" /><\/label>';
      document.getElementById('f1_upload_form').style.visibility = 'visible';      
      return true;   
}
//-->
</script>  


    
    <link rel="stylesheet" type="text/css" href="demo.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="login_panel/css/slide.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="style/style.css" media="screen"/>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
    
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
				<h1>The file sharing system ei2c</h1>
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
			<form class="clearfix" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
					<h1>Member Logout</h1> 
<!-- <?php
if (!isset($_POST['login'])){
?>
					
					<label class="grey" for="username">Username:</label>
					<input class="field" type="text" name="username" id="username" value="" size="23" />
					<label class="grey" for="password">Password:</label>
					<input class="field" type="password" name="password" id="password" size="23" />
        			<div class="clear"></div>
					<input type="submit" name="login" value="Login" class="bt_login" />
				<form class="clearfix" method="logout.php" method="post"> --><br /><br />
            	<input type="submit" value="Logout" name="logout" class="bt_logout"/><?php echo "Logged as: ".$_SESSION['username']; ?> </form>
<?php
if(isset($_POST['logout']))
{
include("out.php");
echo "Logged out succesfully";
header( "Refresh:1; url=demo.php", true, 303);
} ?>
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
 
	$username = htmlspecialchars($_POST['username'],ENT_QUOTES);
	$sql = "SELECT * from users WHERE username LIKE '{$username}' LIMIT 1";
	
	$result = $mysqli->query($sql);
	if ($result->num_rows != 1) {
		echo "<p>Logged in as:"." ".$_POST['username']."</p>";
		
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
	        <li>Hello <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';?>!</li>
			<li class="sep">|</li>
			<li id="toggle">
			    	
				<a id="open"  class="open" href="#"><?php echo (isset($_SESSION['id']['msg']))?'Open Panel':'Log In | Register';?></a>
				<a id="close" class="close" href="#"><?php echo (isset($_SESSION['id']['msg']))?'Logout':'Close Panel';?></a>	
					
			</li>
	    	<li class="right">&nbsp;</li>
		</ul> 
	</div> <!-- / top -->
	
</div> <!--panel -->

<?php
	endif;
?>


<div class="mainTitle"><br />	

<div class="rightSide">
<h1>SELECT FILE YOU WANT TO UPLOAD:<h1/>
<div class="uploadBtn">
<form method="POST" action="<?php $_SERVER["PHP_SELF"]; ?>">
<input type="submit" value="Upload" name="upload" />
<input type="file"
</form>
</div>
</div>
<div class="leftSide">
<h1>Uploaded files:</h1>
</div>
</div>

</body>
</html>
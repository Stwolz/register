<?php 
    session_start();
    session_destroy();
	echo "Succesfully logged out";
	header( "Refresh:0; url=demo.php", true, 303);
?>
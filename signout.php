<?php

	session_start();
	$role=$_SESSION['loginuser']['role'];
	
	if($role=="admin")
	{
		session_destroy();
		header("location:login");
	}
	else{
		session_destroy();
		header("location:index");
	}
?>
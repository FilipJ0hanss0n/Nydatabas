<?php

	$str="";
	
	if(!isset($_SESSION['username']=||($_SESSION['username'])){
		header("location:login.php");
	}
	
	if(isset($_GET['errmsg'])){
		if($_GET['errmsg']==1){
			$str.="File is not an image.";
		}
		elseif($_GET['errmsg']==2){
			$str."File exists";
		}
		elseif($_GET['errmsg']==3){
			$str.="Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		}
		elseif($_GET['errmsg']==4){
			$str.="Sorry, there was an error uploading your file.";
		}
	}
	
	$username = $_SESSION['username'];
	require"../
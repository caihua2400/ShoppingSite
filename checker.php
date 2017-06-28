<?php
	include('conn.php');
		
	//get the parameter from URL
	$username=$_GET["username"];
	
    $result=$conn->query("SELECT `Username` FROM `customers` WHERE `Username` LIKE '$username'");
    $result_cnt = $result->num_rows;
	if ($result_cnt!=0) {
		echo "$username exists";
	} else {
		echo "$username available";
		if(!preg_match("#[a-zA-Z]+#", $username))
			echo " but one letter included at least .";
	}

?> 

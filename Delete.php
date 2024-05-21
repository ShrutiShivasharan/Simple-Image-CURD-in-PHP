<?php

include('con.php');

if(isset($_GET['deleteId'])){
	$id=$_GET['deleteId'];
	$sql = "DELETE FROM `tables` WHERE id=$id";
	$result = mysqli_query($con,$sql);
	if($result){
		header('location:TableDisplay.php');
	}else{
		echo "Error!While deleting user!";
	}
}

?>
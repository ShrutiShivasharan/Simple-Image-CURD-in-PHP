<?php 

$con = mysqli_connect('localhost','root');
mysqli_select_db($con,'simpleimagecurd');
if($con){
	echo "Connected!";
}else{
	echo "Not Connected!";
}

?>
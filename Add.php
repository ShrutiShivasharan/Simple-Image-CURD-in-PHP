<?php
include('con.php');

//add user php code
if(isset($_POST['submitAddForm'])){
    $username = $_POST['username'];
    $img = $_FILES['image'];
    // echo $name;
    // print_r($img); //array 
    $img_name = $img['name'];
    $img_path = $img['tmp_name'];
    $img_seprate =explode('.',$img_name);
    // $img_extension = strtolower(end($img_seprate));
    $img_extension = strtolower($img_seprate[1]);
    $extension = array('jpeg','jpg','png','xml');
    if(in_array($img_extension, $extension)){
        $upload_img = 'images/'.$img_name;
        move_uploaded_file($img_path, $upload_img);
        $sql = "INSERT INTO `tables`(`name`, `image`) VALUES ('$username','$upload_img')";
        $result = mysqli_query($con,$sql);
        if($result){
            // echo "data inserted!";
            header('location:TableDisplay.php');
        }else{
            echo "Error!while adding user";
        }
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Users</title>
    <!-- bootstrap cdn -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <div class="container m-5 p-5">
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" placeholder="Enter your name" name="username">
            </div>
            <div class="form-group">
                <label>Image</label>
                 <input type="file" name="image" class="form-control"> 
            </div>
            
            <button type="submit" class="btn btn-primary" name="submitAddForm">Submit</button>
        </form>
    </div>
</body>
</html>


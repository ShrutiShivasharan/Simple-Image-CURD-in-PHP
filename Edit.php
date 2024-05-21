<?php 
include('con.php');

$id = $_GET['editId'];
$sql = "SELECT * FROM `tables` WHERE id=$id";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$name = $row['name'];
$img = $row['image'];

if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK){
    $img = $_FILES['image'];
    $imgname = $img['name'];
    $imgtemp = $img['tmp_name'];
    $upload_img = 'images/'.$imgname;
    move_uploaded_file($imgtemp, $upload_img);

    $sql = "UPDATE `tables` SET image='$upload_img' WHERE id='$id'";
    $result = mysqli_query($con, $sql);
    if (!$result) {
        die(mysqli_error($con));
    }
    // Update $img variable with the new image path
    $img = $upload_img;
}

if(isset($_POST['submitEditForm'])){
    $id = $_GET['editId']; // Corrected variable name
    $username = $_POST['username'];

    // Check if a new image is uploaded
    if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK){
        $img = $_FILES['image'];
        $imgname = $img['name'];
        $imgtemp = $img['tmp_name'];
        $upload_img = 'images/'.$imgname;
        move_uploaded_file($imgtemp, $upload_img);
    }

    // If no new image is uploaded, retain the existing image path
    if (!isset($upload_img)) {
        $upload_img = $img;
    }

    $sql = "UPDATE `tables` SET name='$username', image='$upload_img' WHERE id='$id'";
    $result = mysqli_query($con, $sql);
    if ($result) {
        header('location:TableDisplay.php');
        exit();
    } else {
        die(mysqli_error($con));
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Users</title>
    <!-- bootstrap cdn -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<style>
    img{
        width: 100px;
    }
</style>
<body>
    <div class="container m-5 p-5">
        <form method="post" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" placeholder="Enter your name" name="username" value="<?php echo $name ?>">
            </div>
            <div class="form-group">
                <label>Image</label>
                <input type="file" id="imageInput" name="image" class="form-control" onchange="updateImage()" value="">
                <br>
                <div class="row">
                    <div class="col-3 text-center">
                        <?php if($img != ''): ?>
                            <img id="previewImage" src="<?php echo $img; ?>" alt="Current Image">
                        <?php endif; ?>
                    </div>
                </div>
            </div>
             <button type="submit" class="btn btn-primary" name="submitEditForm">Submit</button>
        </form>
    </div>

    <script>
        function updateImage() {
            var input = document.getElementById('imageInput');
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('previewImage').src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>

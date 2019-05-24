<!DOCTYPE html>
<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>INSPINIA | Basic Form</title>

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href="css/plugins/iCheck/custom.css" rel="stylesheet">
        <link href="css/animate.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">

        <link href="css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">

    </head>
    
<?php
include_once('includes/db_connection.php');
$conn = OpenCon();
session_start();
if(isset($_SESSION['success']) && !empty($_SESSION['success'])) {
 ?>
<!--Show alert message on login-->
<div class="alert alert-success fade in alert-dismissible" style="margin-top:18px;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>Success!</strong> <?php echo $_SESSION['success']; ?>
</div>
<?php 
unset($_SESSION['success']);
} ?>

<?php // Save the values in DB
$errorMsg = array();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'])) {

/*Save the file*/
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["try_it_again"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image

$check = getimagesize($_FILES["try_it_again"]["tmp_name"]);
if($check !== false) {
    //echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
} else {
    //echo "File is not an image.";
    $uploadOk = 0;
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["try_it_again"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["try_it_again"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["try_it_again"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
//die('----');
/*########save the file######*/
if($uploadOk == 1){
    $stmt = $conn->prepare("INSERT INTO module_listing (module_name, content,try_it_again) VALUES (?, ?,?)");
    $stmt->bind_param("sss", $_POST['module_name'], $_POST['content'], $target_file);
    $stmt->execute();
    $stmt->close();
    header('location:module_listing.php');
}
else{
    echo "Please choose some diff image";
} 
}

CloseCon($conn);

?>

    <body>

        <div id="wrapper">


            <?php
            include_once('includes/leftNaBar.php');
            ?>


            <div id="page-wrapper" class="gray-bg">

                <?php
                include_once('includes/header.php');
                ?>
                <div class="row wrapper border-bottom white-bg page-heading">
                    <div class="col-lg-10">
                        <h2>Basic Form</h2>
                        <ol class="breadcrumb">
                            <li>
                                <a href="index.html">Home</a>
                            </li>
                            <li>
                                <a>Forms</a>
                            </li>
                            <li class="active">
                                <strong>Basic Form</strong>
                            </li>
                        </ol>
                    </div>
                    <div class="col-lg-2">

                    </div>
                </div>
                <div class="wrapper wrapper-content animated fadeInRight">


                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>Form elements </h5>
                                    <div class="ibox-tools">
                                        <a class="collapse-link">
                                            <i class="fa fa-chevron-up"></i>
                                        </a>
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                            <i class="fa fa-wrench"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-user">
                                            <li><a href="#">Config option 1</a>
                                            </li>
                                            <li><a href="#">Config option 2</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="ibox-content">
                                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                        <div class="form-group"><label class="col-sm-2 control-label">Module Name</label>

                                            <div class="col-sm-10"><input type="text" class="form-control" name="module_name" required></div>
                                        </div>
                                        <div class="hr-line-dashed"></div>

                                        <div class="form-group"><label class="col-sm-2 control-label">Content</label>

                                            <div class="col-sm-10"><input type="text" class="form-control" name="content" required></div>
                                        </div>
                                        <div class="hr-line-dashed"></div>

                                        <div class="form-group"><label class="col-sm-2 control-label">Try It Again</label>

                                            <div class="col-sm-10"><input type="file" class="form-control" name="try_it_again" required></div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-4 col-sm-offset-2">
                                                <button class="btn btn-white" type="submit">Cancel</button>
                                                <button class="btn btn-primary" type="submit" name="save">Save changes</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                include_once('includes/footer.php');
                ?>

            </div>
        </div>


        <!-- Mainly scripts -->
        <script src="js/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="js/custom.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
        <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

        <!-- Custom and plugin javascript -->
        <script src="js/inspinia.js"></script>
        <script src="js/plugins/pace/pace.min.js"></script>

        <!-- iCheck -->
        <script src="js/plugins/iCheck/icheck.min.js"></script>
        <script>
            $(document).ready(function () {
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
            });
        </script>
    </body>

</html>

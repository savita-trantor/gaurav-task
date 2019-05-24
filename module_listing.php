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


    $stmt = $conn->prepare("SELECT * FROM module_listing");
    $stmt->execute();
    $result = $stmt->get_result();
    $module_result = array();
    while ($row = $result->fetch_assoc()) {
        $module_result[] = $row;
    }

    $stmt->close();
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
                                    <h5>Basic Table</h5>
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

                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Module Name</th>
                                                <th>Content</th>
                                                <th>Try It Again</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            foreach ($module_result as $singleModule) {
                                                if($singleModule['try_it_again'] != ''){
                                                    $image = $singleModule['try_it_again'];
                                                }else{
                                                    $image = 'uploads/default.png';
                                                }
                                                echo '<tr id="'.$singleModule['id'].'">
                                                        <td>' . $i . '</td>
                                                        <td>' . $singleModule['module_name'] . '</td>
                                                        <td>' . $singleModule['content'] . '</td>
                                                        <td><img width="100" src="'.$image.'"></td>
                                                        <td><a href="edit_module.php?id='.$singleModule['id'].'">EDIT</a> / <a href="javascript:void(0)" class="remove">DELETE</a></td>
                                                    </tr>';

                                                $i++;
                                            }
                                            ?>

                                        </tbody>
                                    </table>

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

            /*This is for deleting*/
    $(".remove").click(function(){

        var id = $(this).parents("tr").attr("id");


        if(confirm('Are you sure to remove this record ?'))

        {

            $.ajax({

               url: 'http://localhost/task/php-form/delete.php',

               type: 'GET',

               data: {id: id},

               error: function() {

                  alert('Something is wrong');

               },

               success: function(data) {

                    $("#"+id).remove();

                    alert("Record removed successfully");  

               }

            });

        }

    });
        </script>
    </body>

</html>

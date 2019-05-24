<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>LabelyTics</title>
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="assets/extra-libs/multicheck/multicheck.css">
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="css/style.min.css" rel="stylesheet">
	<link href="css/custom.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<?php
    include_once('includes/db_connection.php');
    $conn = OpenCon();
    $qs = $_SERVER['QUERY_STRING'];
    parse_str($qs, $qs_arr);    
    if(count($qs_arr) > 0){
        $editModuleId = $qs_arr['id'];
        if($editModuleId != ''){
        echo "update case";
        //CASE I :- Now fetch the data from DB first and populate the fields
        $result = $conn->query("SELECT * FROM module_listing WHERE id =".$editModuleId);
        $row = $result->fetch_assoc();
        echo "<pre>"; print_r($row); echo "</pre>";
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'])) {
            echo "post method";
        }else{
            echo "normal method";
        }

        //Image check
        if($row['try_it_again'] != ''){
            $image = $row['try_it_again'];
        }else{
            $image = 'uploads/default.png';
        }

        }else{
            header('location: module_listing.php');
        }
    }else{
        header('location: login.php');
    }
    //die('----');

    CloseCon($conn);
    ?>
<body id="moduleName">
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper">
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin5">
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                    <a class="navbar-brand" href="index.html">
                        <b class="logo-icon p-l-10">
                            <img src="assets/images/logo-text.png" alt="homepage" class="light-logo" />
                        </b>
                    </a>
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"></a>
                </div>
				<div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-left mr-auto">
                        <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
                        <!-- ============================================================== -->
                        <!-- create new -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            Welcome <strong>Gaurav Pant</strong>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        
        <aside class="left-sidebar" data-sidebarbg="skin5">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav" class="p-t-30">
						<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="add_module.html" aria-expanded="false"><i class="mdi mdi mdi-relative-scale"></i><span class="hide-menu">Add Modules</span></a></li>
						<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="list_module.html" aria-expanded="false"><i class="mdi mdi mdi-receipt"></i><span class="hide-menu">View Modules</span></a></li>
						<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="index.html" aria-expanded="false"><i class="mdi mdi mdi-account-key"></i><span class="hide-menu">Log Out</span></a></li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <div class="page-wrapper">
            
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Edit Module</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Edit Module</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                
							<!-- Form -->
							<form class="form-horizontal m-t-20" action="" method="POST">
								<div class="row p-b-30">
									<div class="col-12">
										<div class="form-group row">
											<label for="module_name" class="col-sm-2 col-form-label">Module Name</label>
											<div class="col-sm-10">
												<input name="module_name" type="text" class="form-control" id="module_name" placeholder="" aria-label="Module Name" aria-describedby="basic-addon1" required="" value="<?php echo $row['module_name']; ?>">
											</div>
										</div>
										<div class="form-group row">
											<label for="module_content" class="col-sm-2 col-form-label">Content</label>
											<div class="col-sm-10">
												<textarea name="content" class="form-control" id="module_content" placeholder="" aria-label="Content" aria-describedby="basic-addon2" required="" row="10" value="test"><?php echo $row['content']; ?></textarea>
											</div>
										</div>
										<div class="form-group row">
											<label for="module_try" class="col-sm-2 col-form-label">Try if Yourself</label>
											<div class="col-sm-10">
												<div class="custom-file">
													<input type="file" class="custom-file-input" id="validatedCustomFile" value="<?php echo $image; ?>" required="">
													<label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
													<div class="edit-image">

                                                        <img hight="100" width="100" src="<?php echo $image; ?>" alt="" class="light-logo" /></div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row border-secondary">
									<div class="col-12">
										<div class="form-group row">
											<label for="module_try" class="col-sm-2 col-form-label"></label>
											<div class="p-t-20 col-sm-10">
												<button class="btn btn-warning" type="submit">Save</button>
												<!-- <a href="list_module.html" class="btn btn-warning">Save</a>  --><a href="javascript:;" class="btn btn-secondary">Cancel</a>
											</div>
										</div>
									</div>
								</div>
							</form>

                            </div>
                        </div>
                    </div>
                </div>
                </div>
            <footer class="footer text-center">
                All Rights Reserved.
            </footer>
        </div>
    </div>
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="dist/js/custom.min.js"></script>
    <!-- this page js -->
    <script src="assets/extra-libs/multicheck/datatable-checkbox-init.js"></script>
    <script src="assets/extra-libs/multicheck/jquery.multicheck.js"></script>
    <script src="assets/extra-libs/DataTables/datatables.min.js"></script>
    <script>
        /****************************************
         *       Basic Table                   *
         ****************************************/
        $('#zero_config').DataTable();
    </script>

</body>

</html>
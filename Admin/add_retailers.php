<?php
	include("config.php");
	include("../validate_data.php");
	session_start();
	if(isset($_SESSION['admin_login'])) {
		if($_SESSION['admin_login'] == true) {
			$username = $password = $areacode = $phone = $email = $address = "";
			$usernameErr = $passwordErr = $phoneErr = $emailErr = $requireErr = $confirmMessage = "";
			$usernameHolder = $phoneHolder = $emailHolder = $addressHolder = "";
			$query_selectArea = "SELECT * FROM area";
			$result_selectArea = mysqli_query($con,$query_selectArea);
			if($_SERVER['REQUEST_METHOD'] == "POST") {
				if(!empty($_POST['txtRetailerUname'])) {
					$usernameHolder = $_POST['txtRetailerUname'];
					$resultValidate_username = validate_username($_POST['txtRetailerUname']);
					if($resultValidate_username == 1) {
						$username = $_POST['txtRetailerUname'];
					}
					else{
						$usernameErr = $resultValidate_username;
					}
				}
				if(!empty($_POST['txtRetailerPassword'])) {
					$resultValidate_username = validate_password($_POST['txtRetailerPassword']);
					if($resultValidate_username == 1) {
						$password = $_POST['txtRetailerPassword'];
					}
					else {
						$passwordErr = $resultValidate_username;
					}
				}
				if(!empty($_POST['cmbAreaCode'])) {
					$areacode = $_POST['cmbAreaCode'];
				}
				if(!empty($_POST['txtRetailerPhone'])) {
					$phoneHolder = $_POST['txtRetailerPhone'];
					$resultValidate_phone = validate_phone($_POST['txtRetailerPhone']);
					if($resultValidate_phone == 1) {
						$phone = $_POST['txtRetailerPhone'];
					}
					else {
						$phoneErr = $resultValidate_phone;
					}
				}
				if(!empty($_POST['txtRetailerEmail'])) {
					$emailHolder = $_POST['txtRetailerEmail'];
					$resultValidate_email = validate_email($_POST['txtRetailerEmail']);
					if($resultValidate_email == 1) {
						$email = $_POST['txtRetailerEmail'];
					}
					else {
						$emailErr = $resultValidate_email;
					}
				}
				if(!empty($_POST['txtRetailerAddress'])) {
					$address = $_POST['txtRetailerAddress'];
					$addressHolder = $_POST['txtRetailerAddress'];
				}
				if($username != null && $password != null && $areacode != null && $phone != null) {
					$query_addRetailer = "INSERT INTO retailer(username,password,address,area_id,phone,email) VALUES('$username','$password','$address','$areacode','$phone','$email')";
					if(mysqli_query($con,$query_addRetailer)) {
						echo "<script> alert(\"Retailer Added Successfully\"); </script>";
						header('location:retailers.php');
					}
					else {
						$requireErr = "Adding Retailer Failed";
					}
				}
				else {
					$requireErr = "* Valid Username, Password, Areacode & Email are compulsory";
				}
			}
		}
		else {
			header('Location:index.php');
		}
	}
	else {
		header('Location:index.php');
	}
?>
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<title>scm</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
	<meta content="Themesbrand" name="author" />
	<!-- App favicon -->
	<link rel="shortcut icon" href="assets/images/favicon.ico">
	<!-- Bootstrap Css -->
	<link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
	<!-- Icons Css -->
	<link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
	<!-- App Css-->
	<link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
	<script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
</head>

<body>
	<!-- <body data-layout="horizontal" data-topbar="colored"> -->
	<!-- Begin page -->
	<div id="layout-wrapper">
		<header id="page-topbar">
			<div class="navbar-header">
				<div class="d-flex">
					<!-- LOGO -->
					<div class="navbar-brand-box">
						<a href="index.html" class="logo logo-dark">
							<span class="logo-sm">
								<!-- <img src="assets/images/logo-sm.png" alt="" height="22"> -->
							</span>


					</div>
					<button type="button"
						class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn"> <i
							class="fa fa-fw fa-bars"></i> </button>
					<!-- App Search-->
					<form class="app-search d-none d-lg-block" method='post'>
						<div class="position-relative">
							<input type="text" class="form-control" placeholder="Search..."> <span
								class="uil-search"></span>
						</div>
					</form>
				</div>
				<div class="d-flex">
					<div class="dropdown d-inline-block d-lg-none ms-2">
						<button type="button" class="btn header-item noti-icon waves-effect"
							id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
							aria-expanded="false"> <i class="uil-search"></i> </button>
						<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
							aria-labelledby="page-header-search-dropdown">
							<form class="p-3">
								<div class="m-0">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Search ..."
											aria-label="Recipient's username">
										<div class="input-group-append">
											<button class="btn btn-primary" type="submit" name='admin_login'><i
													class="mdi mdi-magnify"></i></button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>

					<div class="dropdown d-none d-lg-inline-block ms-1">
						<button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="dropdown"
							aria-haspopup="true" aria-expanded="false"> <i class="uil-apps"></i> </button>
						<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
							<div class="px-lg-2">
								<div class="row g-0">
									<div class="col">
										<a class="dropdown-icon-item" href="#"> <img
												src="assets/images/brands/github.png" alt="Github"> <span>GitHub</span>
										</a>
									</div>
									<div class="col">
										<a class="dropdown-icon-item" href="#"> <img
												src="assets/images/brands/bitbucket.png" alt="bitbucket">
											<span>Bitbucket</span> </a>
									</div>
									<div class="col">
										<a class="dropdown-icon-item" href="#"> <img
												src="assets/images/brands/dribbble.png" alt="dribbble">
											<span>Dribbble</span> </a>
									</div>
								</div>
								<div class="row g-0">
									<div class="col">
										<a class="dropdown-icon-item" href="#"> <img
												src="assets/images/brands/dropbox.png" alt="dropbox">
											<span>Dropbox</span> </a>
									</div>
									<div class="col">
										<a class="dropdown-icon-item" href="#"> <img
												src="assets/images/brands/mail_chimp.png" alt="mail_chimp"> <span>Mail
												Chimp</span> </a>
									</div>
									<div class="col">
										<a class="dropdown-icon-item" href="#"> <img
												src="assets/images/brands/slack.png" alt="slack"> <span>Slack</span>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="dropdown d-none d-lg-inline-block ms-1">
						<button type="button" class="btn header-item noti-icon waves-effect"
							data-bs-toggle="fullscreen"> <i class="uil-minus-path"></i> </button>
					</div>
					<div class="dropdown d-inline-block">
						<button type="button" class="btn header-item noti-icon waves-effect"
							id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
							aria-expanded="false"> <i class="uil-bell"></i> <span
								class="badge bg-danger rounded-pill">3</span> </button>
						<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
							aria-labelledby="page-header-notifications-dropdown">
							<div class="p-3">
								<div class="row align-items-center">
									<div class="col">
										<h5 class="m-0 font-size-16"> Notifications </h5>
									</div>
									<div class="col-auto"> <a href="#!" class="small"> Mark all as read</a> </div>
								</div>
							</div>
							<div data-simplebar style="max-height: 230px;">
								<a href="" class="text-reset notification-item">
									<div class="d-flex align-items-start">
										<div class="flex-shrink-0 me-3">
											<div class="avatar-xs"> <span
													class="avatar-title bg-primary rounded-circle font-size-16">
													<i class="uil-shopping-basket"></i>
												</span> </div>
										</div>
										<div class="flex-grow-1">
											<h6 class="mb-1">Your order is placed</h6>
											<div class="font-size-12 text-muted">
												<p class="mb-1">If several languages coalesce the grammar</p>
												<p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 min ago</p>
											</div>
										</div>
									</div>
								</a>
								<a href="" class="text-reset notification-item">
									<div class="d-flex align-items-start">
										<div class="flex-shrink-0 me-3"> <img src="assets/images/users/avatar-3.jpg"
												class="rounded-circle avatar-xs" alt="user-pic"> </div>
										<div class="flex-grow-1">
											<h6 class="mb-1">James Lemire</h6>
											<div class="font-size-12 text-muted">
												<p class="mb-1">It will seem like simplified English.</p>
												<p class="mb-0"><i class="mdi mdi-clock-outline"></i> 1 hours ago</p>
											</div>
										</div>
									</div>
								</a>
								<a href="" class="text-reset notification-item">
									<div class="d-flex align-items-start">
										<div class="flex-shrink-0 me-3">
											<div class="avatar-xs"> <span
													class="avatar-title bg-success rounded-circle font-size-16">
													<i class="uil-truck"></i>
												</span> </div>
										</div>
										<div class="flex-grow-1">
											<h6 class="mb-1">Your item is shipped</h6>
											<div class="font-size-12 text-muted">
												<p class="mb-1">If several languages coalesce the grammar</p>
												<p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 min ago</p>
											</div>
										</div>
									</div>
								</a>
								<a href="" class="text-reset notification-item">
									<div class="d-flex align-items-start">
										<div class="flex-shrink-0 me-3"> <img src="assets/images/users/avatar-4.jpg"
												class="rounded-circle avatar-xs" alt="user-pic"> </div>
										<div class="flex-grow-1">
											<h6 class="mb-1">Salena Layfield</h6>
											<div class="font-size-12 text-muted">
												<p class="mb-1">As a skeptical Cambridge friend of mine occidental.</p>
												<p class="mb-0"><i class="mdi mdi-clock-outline"></i> 1 hours ago</p>
											</div>
										</div>
									</div>
								</a>
							</div>
							<div class="p-2 border-top">
								<div class="d-grid">
									<a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
										<i class="uil-arrow-circle-right me-1"></i> View More.. </a>
								</div>
							</div>
						</div>
					</div>
					<div class="dropdown d-inline-block">
						<button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
							data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <img
								class="rounded-circle header-profile-user" src="#" alt="Header Avatar"> <span
								class="d-none d-xl-inline-block ms-1 fw-medium font-size-15">Admin</span> <i
								class="uil-angle-down d-none d-xl-inline-block font-size-15"></i> </button>
						<div class="dropdown-menu dropdown-menu-end">
							<!-- item--><a class="dropdown-item" href="#"><i
									class="uil uil-user-circle font-size-18 align-middle text-muted me-1"></i> <span
									class="align-middle">View Profile</span></a> <a class="dropdown-item" href="logout.php">
										<i
									class="uil uil-sign-out-alt font-size-18 align-middle me-1 text-muted"></i> <span
									class="align-middle">Sign out</span></a>
						</div>
					</div>
					<div class="dropdown d-inline-block">
						<button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect"> <i
								class="uil-cog"></i> </button>
					</div>
				</div>
			</div>
		</header>
		<!-- ========== Left Sidebar Start ========== -->
		<div class="vertical-menu" style="background-color:black ;">
			<!-- LOGO -->
			<div class="navbar-brand-box" style="background-color:black ;">
				<a href="dashboard.php" ><img style="width: 70%;" src="ghj.jpg"> </a>
				<h3> M&DS</h3>
			</div>
			<button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn"> <i class="fa fa-fw fa-bars"></i> </button>
			<div data-simplebar class="sidebar-menu-scroll" >
				<!--- Sidemenu -->
				<div id="sidebar-menu" >
					<!-- Left Menu Start -->
			
					<ul class="metismenu list-unstyled" id="side-menu">
					
						<!-- <li>
							<a href="index.html" class="waves-effect"> <i class="fas fa-dashboard"></i><span>Dashboard</span> </a>
							
						</li> -->
						<br><br>
						<li>
							<a href="javascript: void(0);" class="has-arrow waves-effect"><i class="fas fa-users fa-3x"></i><span>Retailers</span> </a>
							<ul class="sub-menu" aria-expanded="false">
								<li><a href="add_retailers.php">Add Retailers</a></li>
								<li><a href="retailers.php">View Retailers</a></li>
								
							</ul>
						</li>
						<li>
							<a href="javascript: void(0);" class="has-arrow waves-effect"> <i class=" fas fa-solid fa-industry fa-3x"></i> <span>Manufacturers</span> </a>
							<ul class="sub-menu" aria-expanded="false">
								<li><a href="add_manufacturers.php">Add Manufacturers</a></li>
								<li><a href="manufacturers.php">View Manufacturers</a></li>
								
							</ul>
						</li>
						<li>
							<a href="javascript: void(0);" class="has-arrow waves-effect"><i class="fas fa-users fa-3x"></i> <span>Distributors</span> </a>
							<ul class="sub-menu" aria-expanded="false">
								<li><a href="add_distributors.php">Add Distributors</a></li>
								<li><a href="distributors.php">View Distributors</a></li>
								
							</ul>
						</li>
						<li>
							<a href="javascript: void(0);" class="has-arrow waves-effect">  <i class="fa-brands fa-product-hunt fa-3x"></i></i> <span>wholesalers</span> </a>
							<ul class="sub-menu" aria-expanded="false">
								<li><a href="add_wholesaler.php">Add wholesalers</a></li>
								<li><a href="wholesaler.php">View wholesalers</a></li>
								
							</ul>
						</li>
						<li>
							<a href="javascript: void(0);" class="has-arrow waves-effect"><i class="fas fa-users fa-3x"></i> <span>Customers</span> </a>
							<ul class="sub-menu" aria-expanded="false">
								<li><a href="add_customers.php">Add Customers</a></li>
								<li><a href="customers.php">View Customers</a></li>
								
							</ul>
						</li>
						<li>
							<a href="javascript: void(0);" class="has-arrow waves-effect"><i class="fa-brands fa-product-hunt fa-3x"></i></i> <span>Products</span> </a>
							<ul class="sub-menu" aria-expanded="false">
								<li><a href="add_products.php">Add Products</a></li>
								<li><a href="products.php">View Products</a></li>
								
							</ul>
						</li>

						<li>
							<a href="orders.php" ><i class="fas fa-shopping-cart fa-3x"></i> <span>Orders</span> </a>
							
						</li>
						<li>
							<a href="invoice.php" > <i class="fas fa-file-invoice fa-3x"></i><span>Invoices</span> </a>
							
						</li>
						
					</ul>
				</div>
				<!-- Sidebar -->
			</div>
		</div>
		<!-- Left Sidebar End -->
		<!-- ============================================================== -->
		<!-- Start right Content here -->
		<!-- ============================================================== -->
		<div class="main-content">
			<div class="page-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-xl-6">
							<div class="card">
								<div class="card-body">
									<h4 class="card-title">Add Retailers</h4>
									<hr>


									<form class="custom-validation" method='POST'>
										<div class="mb-3">
											<label class="form-label">username</label>
											<input type="text" class="form-control" id="retailer:username" name="txtRetailerUname" placeholder="Username" value="<?php echo $usernameHolder; ?>" required /><span class="error_message"><?php echo $usernameErr; ?></span>
										</div>

										<div class="mb-3">
											<label class="form-label">password</label>
											<div>
												<input type="password" class="form-control"id="retailer:password" name="txtRetailerPassword" placeholder="Password" required /><span class="error_message"><?php echo $passwordErr; ?></span>
											</div>
											
										</div>

										<div class="mb-3">
											<label class="form-label">E-Mail</label>
											<div>
												<input type="email" class="form-control" id="retailer:email" name="txtRetailerEmail" placeholder="Email" value="<?php echo $emailHolder; ?>" required /> <span class="error_message"><?php echo $emailErr; ?></span>
											</div>
										</div>
										<div class="label-block"> <label for="retailer:areaCode">Area Code</label> </div>
										<div class="input-box">
											<select name="cmbAreaCode" id="retailer:areaCode">
												<option value="" disabled selected>--- Select Area Code ---</option>
										<?php while($row_selectArea = mysqli_fetch_array($result_selectArea)) { ?>
										<option value="<?php echo $row_selectArea["area_id"]; ?>"><?php echo $row_selectArea["area_code"]." (".$row_selectArea["area_name"].")"; ?></option>
										<?php } ?>
											</select>
										</div>	
									
										
										<div class="mb-3">
											<label class="form-label">Phone Number</label>
											<div>
												<input data-parsley-type="number" type="text" class="form-control"
												id="retailer:phone" name="txtRetailerPhone" placeholder="Phone" value="<?php echo $phoneHolder; ?>" /> <span class="error_message"><?php echo $phoneErr; ?></span>
											</div>
										</div>
										
										<div class="mb-3">
											<label class="form-label">Address</label>
											<div>
												<textarea required class="form-control" rows="5" id="retailer:address" name="txtRetailerAddress" placeholder="Address"><?php echo $addressHolder; ?></textarea>
											</div>
										</div>
										<div>
											<div>
												<button type="submit" name=''
													class="btn btn-primary waves-effect waves-light me-1">
													Submit
												</button>
												<button type="reset" class="btn btn-secondary waves-effect">
													Cancel
												</button>
											</div>
										</div>
									</form>

								</div>
							</div>
						</div> <!-- end col -->
					</div>
					<!-- container-fluid -->
				</div>
				<!-- End Page-content -->
				<footer class="footer">
					<div class="container-fluid">
						<div class="row">
							<div class="col-sm-6">
								<script>
									document.write(new Date().getFullYear())
								</script> ?? stock management.
							</div>

						</div>
					</div>
				</footer>
			</div>
			<!-- end main content-->
		</div>
		<!-- END layout-wrapper -->
		<!-- Right Sidebar -->
		<div class="right-bar">
			<div data-simplebar class="h-100">
				<div class="rightbar-title d-flex align-items-center px-3 py-4">
					<h5 class="m-0 me-2">Settings</h5>
					<a href="javascript:void(0);" class="right-bar-toggle ms-auto"> <i
							class="mdi mdi-close noti-icon"></i> </a>
				</div>
				<!-- Settings -->
				<hr class="mt-0" />
				<h6 class="text-center mb-0">Choose Layouts</h6>
				<div class="p-4">
					<div class="mb-2"> <img src="assets/images/layouts/layout-1.jpg" class="img-thumbnail"
							alt="layout images"> </div>
					<div class="form-check form-switch mb-3">
						<input type="checkbox" class="form-check-input theme-choice" id="light-mode-switch" checked />
						<label class="form-check-label" for="light-mode-switch">Light Mode</label>
					</div>
					<div class="mb-2"> <img src="assets/images/layouts/layout-2.jpg" class="img-thumbnail"
							alt="layout images"> </div>
					<div class="form-check form-switch mb-3">
						<input type="checkbox" class="form-check-input theme-choice" id="dark-mode-switch" />
						<label class="form-check-label" for="dark-mode-switch">Dark Mode</label>
					</div>
					<div class="mb-2"> <img src="assets/images/layouts/layout-3.jpg" class="img-thumbnail"
							alt="layout images"> </div>
					<div class="form-check form-switch mb-3">
						<input type="checkbox" class="form-check-input theme-choice" id="rtl-mode-switch" />
						<label class="form-check-label" for="rtl-mode-switch">RTL Mode</label>
					</div>
					<div class="mb-2"> <img src="assets/images/layouts/layout-4.jpg" class="img-thumbnail"
							alt="layout images"> </div>
					<div class="form-check form-switch mb-5">
						<input class="form-check-input theme-choice" type="checkbox" id="dark-rtl-mode-switch">
						<label class="form-check-label" for="dark-rtl-mode-switch">Dark RTL Mode</label>
					</div>
				</div>
			</div>
			<!-- end slimscroll-menu-->
		</div>
		<!-- /Right-bar -->
		<!-- Right bar overlay-->
		<div class="rightbar-overlay"></div>
		<!-- JAVASCRIPT -->
		<script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
		<script src="assets/libs/jquery/jquery.min.js"></script>
		<script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
		<script src="assets/libs/metismenu/metisMenu.min.js"></script>
		<script src="assets/libs/simplebar/simplebar.min.js"></script>
		<script src="assets/libs/node-waves/waves.min.js"></script>
		<script src="assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
		<script src="assets/libs/jquery.counterup/jquery.counterup.min.js"></script>
		<!-- apexcharts -->
		<script src="assets/libs/apexcharts/apexcharts.min.js"></script>
		<script src="assets/js/pages/dashboard.init.js"></script>
		<!-- App js -->
		<script src="assets/js/app.js"></script>
</body>

</html>
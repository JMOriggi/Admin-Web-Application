<!DOCTYPE html>
<html>
  <head>
    <title>Booking Manager: Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- styles -->
    <link href="css/styles.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  	</head>
  	<body class="login-bg">
  	<div class="header">
        <div class="container">
        <div class="row">
            <div class="col-md-5">
                <!-- Logo -->
                <div class="logo">
                    <h1><a href="#">Booking Manager NCC</a></h1>
                </div>

            </div>
            <div class="col-md-4">
            </div>
			</div>
        </div>
	</div>
	<div class="page-content container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="login-wrapper">
			        <div class="box">
			            <div class="content-wrap">
							<form method="post" action="sessionStart.php">
								<h6>Log In</h6>
								<label class="form-control">User Name</label>
								<input class="form-control" type="text" placeholder="Username" id="username" name="username">
								<label class="form-control">Password</label>
								<input class="form-control" type="password" placeholder="Password" id="password" name="password">
								<div class="action">
									<button class="btn btn-primary btn-lg" type="submit" name="login">Login</button>
								</div> 
							</form>               
			            </div>
			        </div>
			    </div>
			</div>
		</div>
	</div>



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
  </body>
</html>
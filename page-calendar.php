<!DOCTYPE html>
<html>
  <head>
    <title>Booking Engine: Calendario</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- jQuery UI -->
    <link href="https://code.jquery.com/ui/1.10.3/themes/redmond/jquery-ui.css" rel="stylesheet" media="screen">
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendors/fullcalendar/fullcalendar.css" rel="stylesheet" media="screen">
    <!-- styles -->
    <link href="css/styles.css" rel="stylesheet">
    <link href="css/calendar.css" rel="stylesheet">
    <link href="css/my-adds.css" rel="stylesheet">
  </head>

  <body>
  <?php include(__DIR__ . '\header.php'); ?>

  <div class="page-content">
      
    <?php include(__DIR__ . '\menu.php'); ?>

    <div class="col-md-10">
          <div class="content-box-large">
          <div class="panel-body spinner-div">
						<div class="spinner-border text-primary col-centered" role="status">
							<span class="sr-only">Loading...</span>
						</div>
					</div>
            <div class="panel-body panel-calendar invisible">
              <div class="row">
                <div class="col-md-12">
                  <div id='calendar'></div>
                </div>
              </div>
            </div>
          </div>
		  </div>
		</div>
    </div>

    <?php include(__DIR__ . '\footer.php'); ?>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- jQuery UI -->
    <script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="vendors/fullcalendar/fullcalendar.js"></script>
    <script src="vendors/fullcalendar/gcal.js"></script>
    <script src="js/custom.js"></script>
    <script src="js/calendar.js"></script>    

  </body>
</html>
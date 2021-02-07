<!DOCTYPE html>
<html>
  <head>
    <title>Booking Engine: Autisti</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- jQuery UI -->
    <link href="https://code.jquery.com/ui/1.10.3/themes/redmond/jquery-ui.css" rel="stylesheet" media="screen">
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- styles -->
    <link href="css/styles.css" rel="stylesheet">
    <link href="css/forms.css" rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <link href="vendors/form-helpers/css/bootstrap-formhelpers.min.css" rel="stylesheet">
    <link href="vendors/select/bootstrap-select.min.css" rel="stylesheet">
    <link href="vendors/tags/css/bootstrap-tags.css" rel="stylesheet">
    <link href="css/forms.css" rel="stylesheet">
  </head>
  <body>
  	<?php include(__DIR__ . '\header.php'); ?>

    <div class="page-content">
    	<?php include(__DIR__ . '\menu.php');?>

		  <div class="col-md-10">
			  
		  <div class="row">
		  		<div class="col-md-12">
		  			<div class="content-box-header panel-heading">
	  					<div class="panel-title ">Gestisci Autisti</div>
						
		  			</div>
		  			<div class="content-box-large box-with-header">
						  In questa pagina puoi visualizzare i dati relativi alle prenotazioni, clienti e mezzi.
					  <br />In aggiunta potrai aggiungere nuovi elementi, modificare od eliminare quelli esistenti.<br />
					</div>
		  		</div>
		  	</div>


		  	<div class="content-box-large">
  				<div class="panel-heading">
					<div class="panel-title"><h2>Autisti</h2></div>
					<div class="panel-options">
						<button class="btn btn-primary btn-sm editor_create"><i class="glyphicon glyphicon-edit"></i> Nuovo</button>
					</div>
				</div>
				<div class="panel-body">
  					<table cellpadding="0" cellspacing="0" class="display table table-striped table-bordered" id="example">
					  	<thead>
							<tr>
								<th class="col-xs-3">Campo1</th>
								<th class="col-xs-3">Campo2</th>
								<th class="col-xs-2">Campo3</th>
								<th class="col-xs-1">Campo4</th>
								<th class="col-xs-1">Campo5</th>
								<th class="col-xs-1">Edit/Delete</th>
							</tr>
						</thead>
					</table>
  				</div>
			</div>
			  
			

			</div>
		</div>
    </div>
    <?php include(__DIR__ . '\footer.php'); ?>
	
	<link href="vendors/datatables/dataTables.bootstrap.css" rel="stylesheet" media="screen">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- jQuery UI -->
    <script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="vendors/datatables/js/jquery.dataTables.min.js"></script>
    <script src="vendors/datatables/dataTables.bootstrap.js"></script>
    <script src="js/custom.js"></script>
    <script src="js/tables.js"></script>  
    <script src="js/forms.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="vendors/form-helpers/js/bootstrap-formhelpers.min.js"></script>
    <script src="vendors/select/bootstrap-select.min.js"></script>
    <script src="vendors/tags/js/bootstrap-tags.min.js"></script>
    <script src="vendors/mask/jquery.maskedinput.min.js"></script>
    <script src="vendors/moment/moment.min.js"></script>
    <script src="vendors/wizard/jquery.bootstrap.wizard.min.js"></script>
     <!-- bootstrap-datetimepicker -->
     <link href="vendors/bootstrap-datetimepicker/datetimepicker.css" rel="stylesheet">
     <script src="vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.js"></script> 
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
	<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
  </body>
</html>
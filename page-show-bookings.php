<!DOCTYPE html>
<html>
  <head>
    <title>Booking Engine: Prenotazioni</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- jQuery UI -->
    <link href="https://code.jquery.com/ui/1.10.3/themes/redmond/jquery-ui.css" rel="stylesheet" media="screen">
	<link href="vendors/datatables/dataTables.bootstrap.css" rel="stylesheet" media="screen">
    <!-- styles -->
    <link href="css/styles.css" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <link href="vendors/form-helpers/css/bootstrap-formhelpers.min.css" rel="stylesheet">
    <link href="vendors/select/bootstrap-select.min.css" rel="stylesheet">
    <link href="vendors/tags/css/bootstrap-tags.css" rel="stylesheet">
    <link href="css/my-adds.css" rel="stylesheet">
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
							<div class="panel-title ">Visualizza e Edita</div>
							
						</div>
						<div class="content-box-large box-with-header">
							In questa pagina puoi visualizzare i dati relativi alle prenotazioni, clienti e mezzi.
						<br />In aggiunta potrai aggiungere nuovi elementi, modificare od eliminare quelli esistenti.<br />
						</div>
					</div>
				</div>

				<div class="content-box-large">
					<div class="panel-heading">
						<div class="panel-title"><h2>Prenotazioni</h2></div>
						<div class="panel-options">
							<button type="button" class="btn btn-primary btn-sm editor_create hidden" data-toggle="modal" data-target="#newModal">
								<i class="glyphicon glyphicon-edit"></i> Nuovo
							</button>
						</div>
					</div>
					
					<div class="panel-body spinner-div">
						<div class="spinner-border text-primary col-centered" role="status">
							<span class="sr-only">Loading...</span>
						</div>
					</div>
					<div class="panel-body panel-table hidden">
						<table cellpadding="0" cellspacing="0" class="display table table-striped table-bordered" id="tableBooking">
							<thead>
								<tr>
									<th class="col-xs-3">Data</th>
									<th class="col-xs-2">Campo2</th>
									<th class="col-xs-3">Campo3</th>
									<th class="col-xs-3">Dettagli</th>
									<th class="col-xs-2">Canale</th>
									<th class="col-xs-1">Azioni</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>

				<!-- Modal New-->
				<div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="newModal" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
						<div class="modal-header">
							<h3 class="modal-title" id="newModal">Aggiungi Prenotazione
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button></h3>
						</div>
						<div class="modal-body">
						<form action="">
								<fieldset>
									<div class="form-group">
										<h5>Campo 1</h5>
										<input class="form-control" placeholder="Text field" type="text">
									</div>
									<div class="form-group">
										<h5>Campo2</h5>
										<input class="form-control" placeholder="Text field" type="text" >
									</div>
									<div class="form-group">
										<h5>Campo3</h5>
										<textarea class="form-control" placeholder="Textarea" rows="3"></textarea>
									</div>
									<div class="form-group">
										<h5>Campo4</h5>
										<span class="form-control">Read only text</span>
									</div>
									<div class="form-group">
										<h5>Checkbox</h5>
										<input type="checkbox"> 
									</div>
									<div>
										<h5>Select</h5>
											<div class="bfh-selectbox" data-name="selectbox3" data-value="12" data-filter="true">
											<div data-value="1">Option 1</div>
											<div data-value="2">Option 2</div>
											<div data-value="3">Option 3</div>
											<div data-value="4">Option 4</div>
											<div data-value="5">Option 5</div>
											<div data-value="6">Option 6</div>
											<div data-value="7">Option 7</div>
											<div data-value="8">Option 8</div>
											<div data-value="9">Option 9</div>
											<div data-value="10">Option 10</div>
											<div data-value="11">Option 11</div>
											<div data-value="12">Option 12</div>
											<div data-value="13">Option 13</div>
											<div data-value="14">Option 14</div>
											<div data-value="15">Option 15</div>
											</div>
									</div>

									<div>
										<h5>Date Picker</h5>
											<div class="bfh-datepicker" data-format="y-m-d" data-date="today"></div>
									</div>

									<div>
										<h5>Time Picker</h5>
										<p>
											<div class="bfh-timepicker" data-mode="24h"></div>
										</p>
									</div>

									<div>
										<h5>Country Picker</h5>
											<div class="bfh-selectbox bfh-countries" data-country="US" data-flags="true"></div>
									</div>

									<div>
										<h5>State Picker</h5>
											<div id="countries_states2" class="bfh-selectbox bfh-countries" data-country="US"></div>
											<br><br>
											<div class="bfh-selectbox bfh-states" data-country="countries_states2"></div>
									</div>

									<div>
										<h5>Currency Picker</h5>
											<div class="bfh-selectbox bfh-currencies" data-currency="EUR" data-flags="true"></div>
									</div>

									<div>
										<h5>Language Picker</h5>
											<div class="bfh-selectbox bfh-languages" data-language="en_US" data-flags="true"></div>
									</div>

									<div>
										<h5>Timezone Picker</h5>
											<div class="bfh-selectbox bfh-timezones" data-country="US"></div>
									</div>

									<div class="form-group">
										<h5>Select</h5>
											<select class="selectpicker">
												<option>Mustard</option>
												<option>Ketchup</option>
												<option>Relish</option>
											</select>
									</div>
									
								</fieldset>
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-primary">Salva</button>
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
						</div>
						</div>
					</div>
				</div>
				<!-- Modal Edit-->
				<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
						<div class="modal-header">
							<h3 class="modal-title" id="editModal">Modifica Prenotazione
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button></h3>
						</div>
						<div class="modal-body">
							<h5 class="message"></h5>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-primary">Salva</button>
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
						</div>
						</div>
					</div>
				</div>
				<!-- Modal Add Driver-->
				<div class="modal fade" id="driverModal" tabindex="-1" role="dialog" aria-labelledby="driverModal" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h3 class="modal-title">Aggiungi Autista
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button></h3>
							</div>
							<div class="modal-body">
								<form method="POST" action="">
									<fieldset class = "driverModalForm">
										<div class="form-group">
											<h5>Inserisci autista nuovo o esistente?</h5>
												<select class="selectpicker selectDriverCheck">
													<option name="empty">...</option>
													<option name="existing">Esistente</option>
													<option name="new">Nuovo</option>
												</select>
										</div>
										<div class="formNewDriver hidden">
											<div class="form-group">
												<h5>Campo 1</h5>
												<input id="nome" class="form-control" placeholder="Text field" type="text">
											</div>
											<div class="form-group">
												<h5>Campo 2</h5>
												<input id="cognome" class="form-control" placeholder="Text field" type="text">
											</div>
										</div>
										<div class="formExistingDriver hidden">
											<div class="form-group">
												<h5>Campo 1</h5>
												<input  class="form-control" placeholder="Text field" type="text">
											</div>
											<div class="form-group">
												<h5>Campo 2</h5>
												<input class="form-control" placeholder="Text field" type="text">
											</div>
										</div>
									</fieldset>
								</form>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-primary" type="submit" name="submitDriver" id="submitDriver">Salva</button>
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
							</div>
						</div>
					</div>
				</div>
				<!-- Modal Alert-->
				<div class="modal fade" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="alertModal" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
						<div class="modal-header">
							<h3 class="modal-title" id="alertModal">Attenzione
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button></h3>
						</div>
						<div class="modal-body">
							<h5 class="message" ></h5>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-primary save">Conferma</button>
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
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
	<!-- bootstrap-datetimepicker -->
	<link href="vendors/bootstrap-datetimepicker/datetimepicker.css" rel="stylesheet">
    <script src="vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.js"></script> 
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
	<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="vendors/form-helpers/js/bootstrap-formhelpers.min.js"></script>
    <script src="vendors/select/bootstrap-select.min.js"></script>
    <script src="vendors/tags/js/bootstrap-tags.min.js"></script>
    <script src="vendors/mask/jquery.maskedinput.min.js"></script>
    <script src="vendors/moment/moment.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="vendors/datatables/js/jquery.dataTables.min.js"></script>
    <script src="vendors/datatables/dataTables.bootstrap.js"></script>
    <script src="js/custom.js"></script>
    <script src="js/bookings.js"></script>   
    <script src="js/forms.js"></script> 

  </body>
</html>
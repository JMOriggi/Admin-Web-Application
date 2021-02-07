<!DOCTYPE html>
<html>
  <head>
    <title>Booking Engine: Home Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- styles -->
    <link href="css/styles.css" rel="stylesheet">
  </head>
  <body>
  	<?php include(__DIR__ . '\header.php'); ?>
    <div class="page-content">
    	<?php include(__DIR__ . '\menu.php'); ?>
		  <div class="col-md-10">
		  	<div class="row">
		  		<div class="col-md-6">
		  			<div class="content-box-large">
		  				<div class="panel-heading">
							<div class="panel-title"><h2>Benvenuto</h2></div>
							
						</div>
		  				<div class="panel-body">
							Questa è la tua area riservata per gestire le prenotazione NCC. 
							<br />
							Attraverso il menu a sinistra potrai visualizzare le corse prenotate, i dati di riferimento ai clienti e inserire nuovi dati.
						 	<br /><br />
							Oltre alle corse inserite da te potrai visualizzare le corse attivate da Rideways che verranno aggiunte in maniera automatica al tuo calendario.
							<br /><br />
							Buon Lavoro
							<br /><br />
		  				</div>
					</div>
					  
					<div class="panel-warning">
						<div class="content-box-header panel-heading">
							<div class="panel-title ">Avvisi</div>
							
						</div>
						<div class="content-box-large box-with-header">
							Nuova versione 2.0.1 del portale Booking Manager è ora attiva per te.
						<br />
							Per segnalazioni e/o informazioni sul portale contattaci: bookingManager@gmail.com.
						<br />
						</div>
					</div>

		  		</div>

				

		  		<div class="col-md-6">
		  			<div class="row">
		  				<div class="col-md-12">
		  					<div class="content-box-header">
			  					<div class="panel-title">Prenotazioni richiedenti un azione</div>
								<div class="panel-options">
									<a href="" data-rel="reload"><i class="glyphicon glyphicon-refresh"></i></a>
								</div>
				  			</div>
				  			<div class="content-box-large box-with-header">
							  	<div class="panel-body">
									<?php
										require_once(__DIR__ . '\database.php');
										$flagResult = false;
										$array = array("NEW", "PENDING_AMMENDEMENT", "PENDING_CANCELLATION", "ACCEPTED");
										echo "<table class='table table-striped'>
										<tr>
										<th>Stato</th>
										<th>Numero prenotazioni</th>
										</tr>";
										foreach($array as $item){
											$result = selectCountBookingsByStatus($item);
											if($result->num_rows > 0){
												$row = $result->fetch_assoc();
												echo "<tr>";
												echo "<td>" . $item . "</td>";
												echo "<td>" . $row['number'] . "</td>";
												echo "</tr>";
												$flagResult = true;
											}
										}
										echo "</table>";
										if(!$flagResult){
											echo "Non ci sono risultati al momento";
										}
									?>
		  						</div>
							</div>
		  				</div>
		  			</div>
		  			<div class="row">
		  				<div class="col-md-12">
		  					<div class="content-box-header">
			  					<div class="panel-title">Prenotazioni imminenti</div>
								<div class="panel-options">
									<a href="" data-rel="reload"><i class="glyphicon glyphicon-refresh"></i></a>
								</div>
				  			</div>
				  			<div class="content-box-large box-with-header">
							  	<div class="panel-body">
									<?php
										require_once(__DIR__ . '\database.php');
										$result = selectBookingsCloseDate();
										echo "<table class='table table-striped'>
										<tr>
										<th>Date</th>
										<th>Description</th>
										</tr>";
										if($result->num_rows > 0){
											while ($row = $result->fetch_assoc()) {
												echo "<tr>";
												echo "<td>" . $row['date'] . "</td>";
												echo "<td>" . $row['description'] . "</td>";
												echo "</tr>";
											}
											echo "</table>";
										}
										else{
											echo "</table>";
											echo "Non ci sono risultati al momento";	
										}
									?>
		  						</div>
							</div>
		  				</div>
		  			</div>
		  		</div>
		  	</div>

		  </div>
		</div>
    </div>

    <?php include('footer.php'); ?>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
  </body>
</html>
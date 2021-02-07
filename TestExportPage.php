

<!DOCTYPE html>
<html>
   <head>
     <title>Convert HTML Table to Excel using PHPSpreadsheet</title>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
   </head>
   <body>
     <div class="container">
      <br />
      <h3 align="center">Convert HTML Table to Excel using PHPSpreadsheet</h3>
      <br />
      <div class="table-responsive">
        <form method="POST" id="convert_form" action="exportDoc.php">
          <div class="panel-body panel-table">
            
            <table cellpadding="0" cellspacing="0" class="display table table-striped table-bordered" id="tableContent">
							<thead>
								<tr>
									<th class="col-xs-1">Data</th>
									<th class="col-xs-2">Campo2</th>
									<th class="col-xs-1">Campo3</th>
									<th class="col-xs-1">Dettagli</th>
									<th class="col-xs-1">Canale</th>
									<th class="col-xs-1">Azioni</th>
								</tr>
							</thead>
						</table>
          
          </div>
          <input type="hidden" name="file_content" id="file_content" />
          <input type="hidden" name="file_type" id="file_type" />
        </form>
            <button type="button" name="convertExcel" id="convertExcel" class="btn btn-primary">Convert Excel</button>
            <button type="button" name="convertPdf" id="convertPdf" class="btn btn-primary">Convert PDF</button>
          <br />
          <br />
      </div>
     </div>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  </body>
</html>

<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="vendors/datatables/js/jquery.dataTables.min.js"></script>
<script src="vendors/datatables/dataTables.bootstrap.js"></script>
<script>
$(document).ready(function(){
  $('#tableContent').DataTable();
  $('#tableContent').DataTable().fnAddData( [
          "1",
          "2",
          "3",
          "4",
          "5",
          "<button type='button' name='test' id='test' class='btn btn-primary'>Convert Excel</button>"
  ] );
  $('#convertExcel').click(function(){
    var table_content = '<table>';
    table_content += $('#tableContent').html();
    table_content += '</table>';
    $('#file_content').val(table_content);
    $('#file_type').val('excel');
    $('#convert_form').submit();
  });
  $('#convertPdf').click(function(){
    var table_content = '<table>';
    table_content += $('#tableContent').html();
    table_content += '</table>';
    $('#file_content').val(table_content);
    $('#file_type').val('pdf');
    $('#convert_form').submit();
  });
});
</script>

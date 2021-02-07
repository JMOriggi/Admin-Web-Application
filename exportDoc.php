<?php

    include 'PHPSpreadsheet/vendor/autoload.php';
    use PhpOffice\PhpSpreadsheet\IOFactory;

    if(isset($_POST["file_type"]) && $_POST["file_type"] == 'excel' && isset($_POST["file_content"]))
    {
        $temporary_html_file = './PHPSpreadsheet/tmp_html/' . time() . '.html';

        file_put_contents($temporary_html_file, $_POST["file_content"]);

        $reader = IOFactory::createReader('Html');

        $spreadsheet = $reader->load($temporary_html_file);
        foreach(range('A','G') as $columnID) {
            $spreadsheet->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
        }

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');

        $filename = time() . '.xlsx';

        $writer->save($filename);

        header('Content-Type: application/x-www-form-urlencoded');

        header('Content-Transfer-Encoding: Binary');

        header("Content-disposition: attachment; filename=\"".$filename."\"");

        readfile($filename);

        unlink($temporary_html_file);

        unlink($filename);

        exit;
    }


    if(isset($_POST["file_type"]) && $_POST["file_type"] == 'pdf' && isset($_POST["file_content"])){
        require_once __DIR__ . '/PHPPdf/vendor/autoload.php';
        /*$temporary_html_file = __DIR__ . "/PHPSpreadsheet/tmp_html/" . time() . '.html';
        file_put_contents($temporary_html_file, $_POST["file_content"]);*/
        $mpdf = new \Mpdf\Mpdf(['win-1252','A4','','',15,10,16,10,10,10]);
        $mpdf->SetHeader('|Export PDF|');
        $mpdf->setFooter('{PAGENO}');// Giving page number to your footer.
        $mpdf->SetDisplayMode('fullpage');
        //$mpdf->WriteHTML();
        $mpdf-> WriteHTML( $_POST["file_content"]);
        $mpdf->Output('MyPDF.pdf', 'D');
        exit;
    }


?>
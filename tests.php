<?php

    //export.php

    include 'PHPSpreadsheet/vendor/autoload.php';
    use PhpOffice\PhpSpreadsheet\IOFactory;

    if(isset($_POST["file_content"]))
    {
        $temporary_html_file = './PHPSpreadsheet/tmp_html/' . time() . '.html';

        file_put_contents($temporary_html_file, $_POST["file_content"]);

        $reader = IOFactory::createReader('Html');

        $spreadsheet = $reader->load($temporary_html_file);

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


    //echo "HELLO TEST";
    
    //require_once("sendMail.php");
    //sendGmail();

    //require_once("bookingAPI.php");

    //getAPI("NEW");
    //postAPI("bwb919pr6ixs34fs8kxnbv19pl6f1q1f905d1c5q1j1jfrfy8f6w6a8pb28g", "ACCEPT", "");

    
    //session_destroy();
    //session_unset();

    /*$data["properties"] = (object) array(
        "state_hash" => (object) array("type" => "string", "examples" => array("4b2c68f6c847284e73c73b26693d9905")),
        "supplierResponse" => (object) array("type" => "string", "enum" => array("4b2c68f6c847284e73c73b26693d9905")),
        "cancellationReason" => (object) array("type" => "string", "enum" => array("CANT_FULFILL_CUSTOMER_REQUEST"))
    );
    $data = [ "properties" => [
        "state_hash" => ["type" => "string", "examples" => [""]],
        "supplierResponse" => ["type" => "string", "enum" => [""]],
        "cancellationReason" => ["type" => "string", "enum" => [""]]
        ]
    ];
    $json = json_encode($data);
    echo $json;
    print_r(json_decode($json));*/
    //print_r($data);



?>